<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create()
    {
        $title = "Add Post";
        return view('posts.create-post', compact('title'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'community' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'video' => 'nullable|file|mimes:mp4,mov,avi',
        ]);

        // Simpan post ke database
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->community = $request->community;
        $post->description = $request->description;

        // Simpan foto dan video jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $post->photo = $photoPath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            $post->video = $videoPath;
        }

        $post->save();

        // Redirect atau tampilkan pesan sukses
        return redirect('/home')->with('success', 'Post created successfully');
    }

    public function likePost(Request $request, Post $post)
    {
        $user = auth()->user();

        // Cek apakah pengguna sudah like post ini sebelumnya
        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            // Tambahkan like
            $like = new Like();
            $like->user_id = $user->id;
            $post->likes()->save($like);
        }

        // Kirim respons JSON dengan jumlah like
        return response()->json(['likes' => $post->likes()->count()]);
    }

    public function commentPost(Request $request, Post $post)
    {
        $user = auth()->user();

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->content = $request->input('content');
        $post->comments()->save($comment);

        // Return the count of comments as JSON response
        return response()->json(['comments' => $post->comments()->count()]);
    }

    public function editPost(Post $post)
    {
        // Pastikan pengguna yang mencoba mengedit adalah pemilik post
        $this->authorize('update', $post);
        $title = "Edit Post";
        return view('posts.edit-post', compact('post', 'title'));
    }

    public function updatePost(Request $request, Post $post)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'community' => 'required|string|in:Network Engineer,Database Administrator,Frontend,Data Analyst,Backend,Web Developer',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'video' => 'nullable|file|mimes:mp4,mov,avi',
        ]);

        // Pastikan pengguna yang mencoba mengupdate adalah pemilik post
        $this->authorize('update', $post);

        // Update post
        $post->update([
            'title' => $request->title,
            'community' => $request->community,
            'description' => $request->description,
        ]);

        // Update foto dan video jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($post->photo) {
                Storage::disk('public')->delete($post->photo);
            }

            $photoPath = $request->file('photo')->store('photos', 'public');
            $post->update(['photo' => $photoPath]);
        }

        if ($request->hasFile('video')) {
            // Hapus video lama jika ada
            if ($post->video) {
                Storage::disk('public')->delete($post->video);
            }

            $videoPath = $request->file('video')->store('videos', 'public');
            $post->update(['video' => $videoPath]);
        }

        return redirect('/home')->with('success', 'Post updated successfully');
    }

    public function deletePost(Post $post)
    {
        // Pastikan pengguna yang mencoba menghapus adalah pemilik post
        $this->authorize('delete', $post);

        // Hapus foto dan video terkait jika ada
        if ($post->photo) {
            Storage::disk('public')->delete($post->photo);
        }

        if ($post->video) {
            Storage::disk('public')->delete($post->video);
        }

        // Hapus post
        $post->delete();

        return redirect('/home')->with('success', 'Post deleted successfully');
    }

    public function deleteComment(Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        $this->authorize('delete', $comment);

        // Delete the comment
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }

    public function index(): JsonResponse
    {
        $posts = Post::all();
        $formattedPosts = $posts->map(function ($post) {
            return [
                'post' => $post,
                'links' => $post->getLinks(),
            ];
        });
        return response()->json([
            'posts' => $formattedPosts,
        ]);
    }

    public function show($id): JsonResponse
    {
        $post = Post::findOrFail($id);
        return response()->json([
            'post' => $post,
            'links' => $post->getLinks(),
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post,
            'links' => $post->getLinks(),
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json([
            'message' => 'Post deleted successfully',
        ]);
    }

    public function likes(Post $post): JsonResponse
    {
        $likes = $post->likes;
        $formattedLikes = $likes->map(function ($like) {
            return [
                'like' => $like,
                'links' => $like->getLinks(),
            ];
        });

        return response()->json([
            'post_id' => $post->id,
            'likes' => $formattedLikes,
        ]);
    }

    public function comments(Post $post): JsonResponse
    {
        $comments = $post->comments;
        $formattedComments = $comments->map(function ($comment) {
            return [
                'comment' => $comment,
                'links' => $comment->getLinks(),
            ];
        });

        return response()->json([
            'post_id' => $post->id,
            'comments' => $formattedComments,
        ]);
    }

    public function likesPost(Request $request, Post $post): JsonResponse
    {
        $user = auth()->user();

        // Check if the user has already liked the post
        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            // Add like
            $like = new Like();
            $like->user_id = $user->id;
            $post->likes()->save($like);
        }

        return response()->json([
            'message' => 'Post liked successfully',
            'likes' => $post->likes()->count(),
            'links' => $like->getLinks(),
        ]);
    }

    public function creates(Request $request, Post $post): JsonResponse
    {
        $user = auth()->user();

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->content = $request->input('content');
        $post->comments()->save($comment);

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $comment,
            'links' => $comment->getLinks(),
        ]);
    }
}

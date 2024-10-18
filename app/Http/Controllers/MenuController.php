<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\ContactUs;

class MenuController extends Controller
{
    /* --- --- --- HOME --- --- --- */
    // 1. Home
    public function home()
    {
        $user = Auth::user();
        $posts = Post::with(['user', 'likes', 'comments'])->latest()->get();
        $title = "Home";
        return view('menu.home.home', compact('user', 'posts', 'title'));
    }

    // 2. Home Admin
    public function adminhome()
    {
        $posts = Post::all();
        $users = User::all();
        $title = "Home Admin";
        return view('menu.home.homeadmin', compact('posts', 'users', 'title'));
    }

    // 2.1. Controller untuk menghapus post (khusus admin)
    public function adminDeletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully');
    }

    public function adminDeleteComment($commentId)
    {
        // Find the comment and delete it
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }

    public function deleteUser(User $user)
    {
        // Implement logic to delete user account
        // Pastikan Anda menambahkan validasi atau kebijakan yang diperlukan di sini

        $user->delete();

        return redirect()->back()->with('success', 'User account deleted successfully');
    }

    // 3. Search
    public function search(Request $request)
    {
        // mencari keywordnyalah intinya
        $keyword = $request->input('keyword');
        $results = User::where('name', 'like', '%' . $keyword . '%')->get();
        $title = "Search";
        return view('menu.home.search_results', compact('results', 'title'));
    }

    public function searchadmin(Request $request)
    {
        // mencari keywordnyalah intinya
        $keyword = $request->input('keyword');
        $results = User::where('name', 'like', '%' . $keyword . '%')->get();
        $title = "Search";
        return view('menu.home.search_results_admin', compact('results', 'title'));
    }

    /* --- --- --- About Us --- --- --- */
    public function about_us()
    {
        $title = "About Us";
        return view('menu.aboutus.aboutus', compact('title'));
    }

    /* --- --- --- PROFILE --- --- --- */
    // 1. Profile
    public function profile()
    {
        $user = Auth::user();
        $userPosts = $user->posts;
        $title = "Profile";
        return view('menu.profile.profile', compact('user', 'userPosts', 'title'));
    }

    // 2. Edit Profile
    public function edit_profile()
    {
        $title = "Edit Profile";
        return view('menu.profile.edit-profile', compact('title'));
    }

    // 2.1. Controller untuk mengupdate profilenyalah intinya
    public function updateProfile(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            'background_picture' => 'image|mimes:jpeg,png,jpg,gif|max:100000',
            'birthdate' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Simpan perubahan pada profil
        $user = Auth::user();
        $user->name = $request->name;
        $user->birthdate = $request->birthdate;
        $user->location = $request->location;
        $user->description = $request->description;

        // Upload dan simpan foto profil
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        // Upload dan simpan foto background
        if ($request->hasFile('background_picture')) {
            $backgroundPicturePath = $request->file('background_picture')->store('background_pictures', 'public');
            $user->background_picture = $backgroundPicturePath;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }

    // 3. User Profile (Profile-Profile User)
    public function show($id)
    {
        $user = User::findOrFail($id);
        $userPosts = Post::where('user_id', $user->id)->get();
        $title = "User Profile";
        return view('menu.profile.user-profile', compact('user', 'userPosts', 'title'));
    }

    public function showadmin($id)
    {
        $user = User::findOrFail($id);
        $userPosts = Post::where('user_id', $user->id)->get();
        $title = "User Profile";
        return view('menu.profile.user-profile-admin', compact('user', 'userPosts', 'title'));
    }

    /* --- --- --- Community --- --- --- */
    /* 1. Community (Ini dihapus karna gak guna) */
    public function community()
    {
        $title = "Community";
        return view('menu.community.index', compact('title'));
    }
    
    /* 2.  Network Engineer*/
    public function network_engineer()
    {
        $posts = Post::where('community', 'Network Engineer')->get();
        $title = "Network Engineer";
        return view('menu.community.network_engineer', compact('posts', 'title'));
    }

    /* 3. Database Administrator */
    public function database_administrator()
    {
        $posts = Post::where('community', 'Database Administrator')->get();
        $title = "Database Administrator";
        return view('menu.community.database_administrator', compact('posts', 'title'));
    }

    /* 4. Frontend */
    public function frontend()
    {
        $posts = Post::where('community', 'Frontend')->get();
        $title = "Frontend";
        return view('menu.community.frontend', compact('posts', 'title'));
    }

    /* 5. Data Analyst */
    public function data_analyst()
    {
        $posts = Post::where('community', 'Data Analyst')->get();
        $title = "Data Analyst";
        return view('menu.community.data_analyst', compact('posts', 'title'));
    }

    /* 6. Backend */
    public function backend()
    {
        $posts = Post::where('community', 'Backend')->get();
        $title = "Backend";
        return view('menu.community.backend', compact('posts', 'title'));
    }

    /* 7. Web Developer */
    public function web_developer()
    {
        $posts = Post::where('community', 'Web Developer')->get();
        $title = "Web Developer";
        return view('menu.community.web_developer', compact('posts', 'title'));
    }

    /* --- --- --- Settings --- --- --- */
    // 1. Settings
    public function settings()
    {
        $title = "Settings";
        return view('menu.settings.settings', compact('title'));
    }

    // 2. Mengupdate Email
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);
        auth()->user()->update(['email' => $request->email]);
        return redirect()->route('settings')->with('success', 'Email updated successfully');
    }

    // 3. Mengupdate Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'The new password confirmation does not match.',
        ]);
        auth()->user()->update(['password' => Hash::make($request->password)]);
        return redirect()->route('settings')->with('success', 'Password updated successfully');
    }

    /* --- --- --- Contact Us --- --- --- */
    public function contact_us()
    {
        $title = "Contact Us";
        return view('menu.contactus.contactus', compact('title'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'video' => 'file|mimes:mp4,ogv,webm|max:20480', // Sesuaikan dengan format video yang diizinkan
    ]);

    // Proses penyimpanan data ke database
    $contactUs = new ContactUs;
    $contactUs->title = $request->title;
    $contactUs->description = $request->description;

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('contact_us_photos', 'public');
        $contactUs->photo = $photoPath;
    }

    if ($request->hasFile('video')) {
        $videoPath = $request->file('video')->store('contact_us_videos', 'public');
        $contactUs->video = $videoPath;
    }

    $contactUs->save();

    return redirect()->route('contactus')->with('success', 'Contact form submitted successfully!');
}

    public function contactusadmin()
    {
        $title = "Contact Us";
        $contactUsData = ContactUs::all();
        return view('menu.contactus.contactusadmin', ['contactUsData' => $contactUsData],  compact('title'));
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post; // Import the Post model
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    // 1. Welcome
    public function welcome()
    {
        $title = "Welcome";
        return view('welcome', compact('title'));
    }

    // 2. Register
    public function showRegistrationForm()
    {
        $title = "Register";
        return view('register', compact('title'));
    }

    // 2.1. Controller untuk penyimpanan data yang di-register
    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat pengguna
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirect ke halaman login
        return redirect('/login')->with('success', 'Registrasi berhasil');
    }

    // 3. Login
    public function showLoginForm()
    {
        $title = "Login";
        return view('login', compact('title'));
    }

    // 3.1. Controller untuk proses login
    public function login(Request $request)
    {
        // Validasi data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Proses login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil
            if (Auth::user()->email == 'adminppw@gmail.com') {
                // Admin login, arahkan ke halaman homeadmin
                return redirect('/homeadmin');
            } else {
                // Pengguna biasa login, arahkan ke halaman home
                return redirect('/home');
            }
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return redirect('/login')->withErrors(['email' => 'Email atau password salah']);
    }

    // 4. Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Mengarahkan kembali ke halaman login setelah logout
    }

    public function index(): JsonResponse
    {
        $users = User::all();
        $formattedUsers = $users->map(function ($user) {
            return [
                'user' => $user,
                'links' => $user->getLinks(),
            ];
        });
        return response()->json([
            'users' => $formattedUsers,
        ]);
    }

    public function show($id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user,
            'links' => $user->getLinks(),
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
            'links' => $user->getLinks(),
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }

    // 5. Show user's posts
    public function showUserPosts(User $user): JsonResponse
    {
        $posts = $user->posts;
        $formattedPosts = $posts->map(function ($post) {
            return [
                'post' => $post,
                'links' => $post->getLinks(),
            ];
        });

        return response()->json([
            'user_id' => $user->id,
            'posts' => $formattedPosts,
        ]);
    }
}

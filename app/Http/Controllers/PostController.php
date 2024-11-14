<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;


class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Post/Index');
    }

    public function posts()
    {
        $posts = Post::paginate(5);

        return Inertia::render('Post/Posts', [
            'posts' => $posts->items(), // 데이터 배열
            'meta' => [
                'current_page' => $posts->currentPage(), //현재 페이지 번호 반환
                'last_page' => $posts->lastPage(), // 전체 페이지 수 반환
                'per_page' => $posts->perPage(), //현재 페이지에 설정된 항목의 수 반환
                'total' => $posts->total(), //전체 게시물의 수
                'links' => [
                    'prev' => $posts->previousPageUrl(),
                    'next' => $posts->nextPageUrl(),
                ],
            ],
        ]);
    }

    public function search($search)
    {
        $posts = Post::where('title', 'like', "%{$search}%")
            ->orWhere('content', 'like', "%{$search}%")
            ->paginate(5);
        return Inertia::render('Post/Search', [
            'search' => $search,
            'posts' => $posts->items(),
            'inputValue' => $search,
            'inSearching' => true,
            'meta' => [
                'current_page' => $posts->currentPage(), //현재 페이지 번호 반환
                'last_page' => $posts->lastPage(), // 전체 페이지 수 반환
                'per_page' => $posts->perPage(), //현재 페이지에 설정된 항목의 수 반환
                'total' => $posts->total(), //전체 게시물의 수
                'links' => [
                    'prev' => $posts->previousPageUrl(),
                    'next' => $posts->nextPageUrl(),
                ],
            ],
        ]);
    }

    public function show(Post $post)
    {
        $post->increment('view_count');
        return Inertia::render('Post/Show', ['post' => $post]);
    }

    public function store(Request $request)
    {
        $post = new Post($request->all());
        $post->save();
        return redirect()->route('posts');
    }

    public function storeUser(Request $request)
    {
        //        $email = $request->input('email');
        //        if (User::where('email', 'like', "%{$email}%")->exists()) {
        //            return redirect()->route('posts.index')->with('error', '등록된 이메일입니다');
        //        }
        $user = new User($request->all());
        $user->save();
        return redirect()->route('/');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Post/Create', ['post' => $post, 'isUpdating' => true]);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts');
    }

    public function like(Post $post)
    {
        $post->increment('like_count');
    }

    public function dislike(Post $post)
    {
        $post->decrement('like_count');
    }

    public function register()
    {
        $users = User::all();
        return Inertia::render('Post/Register', ['users' => $users]);
    }

    public function popup()
    {
        return Inertia::render('Post/PopUp');
    }
    // public function login()
    // {
    //     $users = User::all();
    //     return Inertia::render('Post/Login', ['users' => $users]);
    // }
}

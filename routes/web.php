<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::controller(PostController::class)
    ->group(
        function () {
            //기본 페이지
            Route::get('/', 'index')->name('/');

            //회원가입 페이지
            Route::get('/register', 'register');

            //회원가입 페이지에서 입력한 값 저장
            Route::post('/addUser', 'storeUser');

            Route::get('/popup', 'popup');
            //  //로그인 페이지
            // Route::get('/login', 'login');

            Route::prefix('/posts')->group(function () {

                Route::get('/', 'posts')->name('posts');

                //글쓰기 페이지
                Route::get('/create', 'create');

                //글쓰기 페이지에서 작성한 내용 저장
                Route::post('/add', 'store');

                //수정 페이지
                Route::get('/{post}/edit', 'edit');

                //수정 페이지에서 수정한 값 저장
                Route::put('/{post}/update', 'update');

                //검색페이지
                Route::any('/{search}/search', 'search');
                //Route::get('/{search}/search', 'search');

                //게시글 자세히 보여주는 페이지
                Route::get('/{post}/show', 'show');

                //삭제 기능
                Route::delete('/{post}/delete', 'destroy');

                //좋아요 기능
                Route::get('/{post}/like', 'like');

                //싫어요 기능
                Route::get('/{post}/dislike', 'dislike');
            });
        }
    );

//로그인 페이지
Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage');

//otp 로그인 페이지
Route::get('/OtpLoginPage', [AuthController::class, 'OtpLoginPage'])->name('OtpLoginPage');

//Qr 로그인 페이지
Route::get('/QrLoginPage', [AuthController::class, 'QrLoginPage'])->name('QrLoginPage');

//로그인 페이지에서 받은 메일, 비밀번호가 일치하면 로그인 다르면 오류메시지 출력하는 기능
Route::post('/login/check', [AuthController::class, 'login'])->name('login');

//로그아웃 기능
Route::post('/logout', [AuthController::class, 'logout']);



Route::get('/test', function () {
    return Inertia::render('Post/test');
});

Route::get('/ParentComp', function () {
    return Inertia::render('Post/ParentComp');
});

Route::get('/ChildComp', function () {
    return Inertia::render('Post/test/ChildComp');
});




require __DIR__ . '/auth.php';

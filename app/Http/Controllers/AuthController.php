<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;



class AuthController extends Controller
{
    // 로그인 페이지 렌더링
    public function loginPage()
    {
        return Inertia::render('Post/Login');
    }

    public function OtpLoginPage()
    {
        return Inertia::render('Post/OtpLogin');
    }

    public function QrLoginPage()
    {
        return Inertia::render('Post/QrLogin');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            // 인증 시도
            $request->authenticate();

            // 세션 재생성
            $request->session()->regenerate();

            // 성공 시 대시보드로 리다이렉트
            return redirect()->intended(route('posts', absolute: false));
        } catch (ValidationException $e) {
            // 인증 실패 시 사용자 정의 메시지를 포함한 예외 반환
            throw ValidationException::withMessages([
                'email' => ['아이디(로그인 전화번호, 로그인 전용 아이디) 또는 비밀번호가 잘못 되었습니다. 아이디와 비밀번호를 정확히 입력해 주세요.'],
            ]);
        }
    }
    // public function login(Request $request)
    // {
    //     // 유효성 검사
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // 로그인 시도
    //     if (Auth::attempt($validated)) {
    //         return redirect()->intended('/posts');
    //     }

    //     // 로그인 실패 시 Inertia로 오류 메시지 및 입력값 반환
    //     return Inertia::render('Post/Login', [
    //         'errors' => [
    //             'login' => ['이메일 또는 비밀번호가 잘못되었습니다.'],
    //         ],
    //         'email' => $request->email, // 입력한 이메일 전달
    //     ]);
    // }




    // 로그아웃 처리
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

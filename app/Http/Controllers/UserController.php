<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function Login(): Response
    {
        return response()->view('user.login', [
            'title' => 'Login'
        ]);
    }

    public function DoLogin(Request $request): Response|RedirectResponse
    {
        $username = $request->input('user');
        $password = $request->input('password');

        if($this->userService->login($username, $password))
        {
            $request->session()->put('user', $username);
            return redirect("/");
        } else {

            return response()->view('user.login', [
                "title" => "Login",
                "error" => "User Or Password Incorrect"
            ]);

        }
    }

    public function DoLogout(Request $request):RedirectResponse
    {
        $request->session()->forget('user');

        return redirect("/");
    }
}

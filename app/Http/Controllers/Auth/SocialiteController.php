<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public $userService;
    
    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $requestForm = $request->only('email', 'password');
        $credentials = Auth::attempt($requestForm);
        if($credentials){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error', 'Invalid Credentials');
        }

    }

    public function gitRedirected()
    {
        return Socialite::driver('github')->redirect();
    }

    public function authCallback()
    {
        try {
            $user = Socialite::driver('github')->user();

            $searchUser = $this->userService->getUserDataByGithubId($user->id);

            if($searchUser){
                Auth::login($searchUser);
     
                return redirect('/dashboard');
            }else{
                $usersData = $this->userService->createNewUserData([
                    'name' => $user->name,
                    'username' => str_replace(' ', '',$user->name),
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'auth_type'=> 'github',
                    'password' => bcrypt('password')
                ]);
                if($usersData){
                    Auth::login($usersData);
                    return redirect('/dashboard');
                }else{
                    return redirect('/')->with('error', 'Invalid Github Provider request');
                }
            }
            
        } catch (\Throwable $th) {
            report($th->getMessage());
            return redirect('/')->with('error', 'Internal Server Error');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

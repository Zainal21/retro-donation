<?php

namespace App\Http\Repositories;
use App\Models\User;
use App\Models\Socialmedia;
use App\Models\Amountsetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

interface UserContract
{
    public function getUserByGithubId($githubId);
    public function createUser($data);
    public function updateUser($data, $id);
    public function getUserSignIn();
}

class UserRepository implements UserContract
{
    public function getUserByGithubId($githubId)
    {
       return User::where('github_id', $githubId)->first();
    }

    public function createUser($data)
    {
        $user = User::create($data);
        $insertedId = [
            'user_id' => $user->id
        ];
        $socialMedia = Socialmedia::create($insertedId);
        $socialMedia = Amountsetting::create($insertedId);
        return $user;
    }

    public function updateUser($data, $id)
    {
        return User::where('id', $id)->update($data);
    }

    public function getUserSignIn()
    {
       $user = Auth::user();
       return User::with('social_media', 'amount_setting')->whereId($user->id)->first();
    }

    public function updateUserSocialMedia($data, $id)
    {
        return Socialmedia::where('user_id', $id)->update($data);
    }

    public function updateUserAmount($data, $id)
    {
        return Amountsetting::where('user_id', $id)->update($data);
    }

    public function checkCurrentPassword($password)
    {
        $user =  Auth::user();
        $userData = User::whereId($user->id)->first();
        if (Hash::check($password, $userData->password)){
            return true;
        }
        return false;
    }

    public function updateCurrentPassword($password)
    {
        return User::whereId(Auth::user()->id)->update(['password' => Hash::make($password)]);
    }
    
    public function getAccountByUsernamen($username)
    {
        return User::with('social_media', 'amount_setting')->where('username', $username)->first();
    }
}
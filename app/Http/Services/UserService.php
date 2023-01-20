<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class UserService
{
    public $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAccountSignIn()
    {
        return $this->userRepository->getUserSignIn();
    }

    public function getAccountByUsernamen($username)
    {
        return $this->userRepository->getAccountByUsernamen($username);
    }

    public function getUserDataByGithubId($githubid)
    {
        try {
            return $this->userRepository->getUserByGithubId($githubid);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }
    
    public function createNewUserData($data)
    {
        try {    
            return $this->userRepository->createUser($data);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }

    public function changePassword($new_password)
    {
        try {    
            return $this->userRepository->updateCurrentPassword($new_password);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }

    public function checkCurrentPassword($password)
    {
        try {    
            return $this->userRepository->checkCurrentPassword($password);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }

    public function updateUserData($data, $id)
    {
        try {
            return $this->userRepository->updateUser($data, $id);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }

    public function updateUserSocialMedia($data, $id)
    {
        try {
            return $this->userRepository->updateUserSocialMedia($data, $id);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }

    public function updateUserAmount($data, $id)
    {
        try {
            return $this->userRepository->updateUserAmount($data, $id);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }
}
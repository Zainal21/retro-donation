<?php

namespace App\Http\Services;


class UserService
{
    public $userRepository;

    public function __contruct(
        UserRepository $userRepository
    )
    { }

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

    public function updateUserData($data, $id)
    {
        try {
            return $this->userRepository->updateUser($data, $id);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }
}
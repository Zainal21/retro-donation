<?php

namespace App\Http\Repositories;


interface UserContract
{
    public function getUserByGithubId($githubId);
    public function createUser(array $datad);
    public function updateUser(array $data, $id);
}

class UserRepository implements UserContract
{
    public function getUserByGithubId($githubId)
    {
       return  User::where('github_id', $githubId)->first();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(array $data, $id)
    {
        return User::where('id', $id)->update($data);
    }
}
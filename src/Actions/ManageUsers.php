<?php

namespace Mukja\HackerRank\Actions;

use Mukja\HackerRank\Resources\User;

trait ManageUsers
{
    /**
     * Get the collection of users.
     *
     * @return User[]
     */
    public function users($limit = 10, $offset = 0)
    {
        return $this->transformCollection(
            $this->get('users')['data'], User::class
        );
    }

    /**
     * Get a user instance.
     *
     * @param  string $userId
     * @return User
     */
    public function user($userId) :User
    {
        return new User($this->get("users/{$userId}"), $this);
    }

    /**
     * Create a new user.
     *
     * @param  array $data
     * @return User
     */
    public function createUser(array $data) :User
    {
        $response = $this->post('users', $data);

        return new User($response, $this);
    }

    /**
     * Update the given user.
     *
     * @param  string $userId
     * @param  array $data
     * @return User
     */
    public function updateUser($userId, array $data)
    {
        return $this->put("users/{$userId}", $data);
    }

    /**
     * Delete the given user.
     *
     * @param  string $userId
     * @return void
     */
    public function deleteUser($userId)
    {
        $this->delete("users/{$userId}");
    }

    /**
     * Search Users
     * @param  string  $searchString
     * @param  integer $limit
     * @param  integer $offset
     * @return array
     */
    public function searchUsers(string $searchString, $limit = 10, $offset = 0) :array
    {
        return $this->transformCollection(
            $this->get("users/search?search={$searchString}&limit={$limit}&offset={$offset}")['data'], User::class
        );
    }
}

<?php

namespace Mukja\HackerRank\Resources;

use Mukja\HackerRank\HackerRank;
use Mukja\HackerRank\Resources\Resource;

class User
{
    use Resource;

    /**
     * Get the collection of users.
     *
     * @return User[]
     */
    public static function get($limit = 10, $offset = 0)
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("users?limit={$limit}&offset={$offset}")['data'], User::class
        );
    }

    /**
     * Get a user instance.
     *
     * @param  string $userId
     * @return User
     */
    public static function retrive($userId) :User
    {
        $hackerRank = HackerRank::getInstance();

        return new User($hackerRank->get("users/{$userId}"));
    }

    /**
     * Create a new user.
     *
     * @param  array $data
     * @return User
     */
    public static function create(array $data) :User
    {
        $hackerRank = HackerRank::getInstance();
        $response = $hackerRank->post('users', $data);

        return new User($response);
    }

    /**
     * Update the given user.
     *
     * @param  string $userId
     * @param  array $data
     * @return User
     */
    public function update(array $data)
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->put("users/{$this->id}", $data);
    }

    /**
     * Delete the given user.
     *
     * @param  string $userId
     * @return void
     */
    public function lock($userId)
    {
        $hackerRank = HackerRank::getInstance();

        $hackerRank->delete("users/{$userId}");
    }

    /**
     * Search Users
     * @param  string  $searchString
     * @param  integer $limit
     * @param  integer $offset
     * @return array
     */
    public function search(string $searchString, $limit = 10, $offset = 0) :array
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("users/search?search={$searchString}&limit={$limit}&offset={$offset}")['data'], User::class
        );
    }

    public function invite($testId)
    {
        dd($testId);
    }
}

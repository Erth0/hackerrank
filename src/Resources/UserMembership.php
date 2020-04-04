<?php

namespace Mukja\HackerRank\Resources;

use Mukja\HackerRank\Resources\Resource;

class UserMembership
{
    use Resource;

    /**
     * Get the collection of teams memberships.
     *
     * @param  $teamId
     *
     * @return UserMembership[]
     */
    public function get(int $teamId, $limit = 10, $offset = 0) :array
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("teams/{$teamId}/users?limit={$limit}&offset={$offset}")['data'], self::class
        );
    }

    /**
     * Get a user membership instance.
     *
     * @param  int $teamId
     * @param  int $userId
     *
     * @return UserMembership
     */
    public function retreive(int $teamId, int $userId) : UserMembership
    {
        $hackerRank = HackerRank::getInstance();

        return new UserMembership($hackerRank->get("teams/{$teamId}/users/{$userId}"));
    }

    /**
     * Create a new user membership.
     *
     * @param  int $teamId
     * @param  int $userId
     *
     * @return UserMembership
     */
    public function create(int $teamId, int $userId) :UserMembership
    {
        $hackerRank = HackerRank::getInstance();

        $response = $hackerRank->post("teams/{$teamId}/users/{$userId}");

        return new UserMembership($response);
    }

    /**
     * Delete the given user membership.
     *
     * @return bool|NotFoundException
     */
    public function delete(int $teamId, int $userId) :bool
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->delete("teams/{$teamId}/users/{$userId}");
    }
}

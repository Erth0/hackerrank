<?php

namespace Mukja\HackerRank\Resources;

use Mukja\HackerRank\HackerRank;
use Mukja\HackerRank\Resources\UserMembership;

class Team
{
    use Resource;

    /**
     * Get the collection of teams.
     *
     * @return Team[]
     */
    public function get($limit = 10, $offset = 0) :array
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("teams?limit={$limit}&offset={$offset}")['data'], self::class
        );
    }

    /**
     * Get a team instance.
     *
     * @param  int $teamId
     *
     * @return Team
     */
    public function retreive(int $teamId) : Team
    {
        $hackerRank = HackerRank::getInstance();

        return new Team($hackerRank->get("teams/{$teamId}"));
    }

    /**
     * Create a new team.
     *
     * @param  array $data
     *
     * @return Team
     */
    public function create(array $data) :Team
    {
        $hackerRank = HackerRank::getInstance();

        $response = $hackerRank->post('teams', $data);

        return new Team($response);
    }

    /**
     * Update the given team.
     *
     * @param  array $data
     *
     * @return Team
     */
    public function update(array $data) :Team
    {
        $hackerRank = HackerRank::getInstance();

        return new Team($hackerRank->put("teams/{$this->id}", $data));
    }

    /**
     * Delete the given team.
     *
     * @return bool|NotFoundException
     */
    public function delete() :bool
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->delete("teams/{$this->id}");
    }

    /**
     * Search Teams
     *
     * @param  string  $searchString
     * @param  integer $limit
     * @param  integer $offset
     *
     * @return array
     */
    public function search(string $searchString, $limit = 10, $offset = 0) :array
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("teams/search?search={$searchString}&limit={$limit}&offset={$offset}")['data'], Team::class
        );
    }

    /**
     * Get the collection of team memberships.
     *
     * @return UserMembership[]
     */
    public function memberships($limit = 10, $offset = 0) :array
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("teams/{$this->id}/users?limit={$limit}&offset={$offset}")['data'], UserMembership::class
        );
    }

    /**
     * Get a team membership.
     *
     * @param  int $userId
     *
     * @return UserMembership
     */
    public function membership(int $userId) :UserMembership
    {
        $hackerRank = HackerRank::getInstance();

        return new UserMembership($hackerRank->get("teams/{$this->id}/users/{$userId}"));
    }

    /**
     * Create a new team membership.
     *
     * @param  int $userId
     *
     * @return UserMembership
     */
    public function createMembership(int $userId) :UserMembership
    {
        $hackerRank = HackerRank::getInstance();

        $response = $hackerRank->post("teams/{$this->id}/users/{$userId}");

        return new UserMembership($response);
    }

    /**
     * Delete the given team membership.
     *
     * @return bool|NotFoundException
     */
    public function removeMembership(int $userId) :bool
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->delete("teams/{$this->id}/users/{$userId}");
    }
}

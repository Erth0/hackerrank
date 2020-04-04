<?php

namespace Mukja\HackerRank\Resources;

use Mukja\HackerRank\HackerRank;
use Mukja\HackerRank\Resources\Resource;
use Mukja\HackerRank\Resources\TestCandidate;

class Test
{
    use Resource;

    /**
     * Get the collection of tests.
     *
     * @return Test[]
     */
    public function get($limit = 10, $offset = 0)
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("tests?limit={$limit}&offset={$offset}")['data'], Test::class
        );
    }

    /**
     * Get a test instance.
     *
     * @param  string $testId
     * @return Test
     */
    public function retrive($testId) :Test
    {
        $hackerRank = HackerRank::getInstance();

        return new Test($hackerRank->get("tests/{$testId}"));
    }

    /**
     * Create a new test.
     *
     * @param  array $data
     * @return Test
     */
    public function create(array $data) :Test
    {
        $hackerRank = HackerRank::getInstance();

        $response = $hackerRank->post('tests', $data);

        return new Test($response);
    }

    /**
     * Update the given test.
     *
     * @param  array $data
     * @return Test
     */
    public function update(array $data)
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->put("tests/{$this->id}", $data);
    }

    /**
     * Delete the given test.
     *
     * @return void
     */
    public function delete()
    {
        $hackerRank = HackerRank::getInstance();

        $hackerRank->delete("tests/{$this->id}");
    }

    /**
     * Archive the given test.
     *
     * @return void
     */
    public function archive()
    {
        $hackerRank = HackerRank::getInstance();

        $hackerRank->post("tests/{$this->id}/archive");
    }

    public function inviters()
    {
        $hackerRank = HackerRank::getInstance();

        dd($hackerRank->get("tests/{$this->id}/inviters"));

        return $hackerRank->transformCollection(
            $hackerRank->get("tests?limit={$limit}&offset={$offset}")['data'], Test::class
        );
    }

    public function candidates($limit = 10, $offset = 0)
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("tests/{$this->id}/candidates?limit={$limit}&offset={$offset}")['data'], TestCandidate::class
        );
    }

    public function invite(array $data)
    {
        $hackerRank = HackerRank::getInstance();

        $response = $hackerRank->post("tests/{$this->id}/candidates", $data);

        return new TestCandidate($response);
    }

    public function candidate(int $candidateId)
    {
        $hackerRank = HackerRank::getInstance();

        return new TestCandidate($hackerRank->get("tests/{$this->id}/candidates/{$candidateId}"));
    }

    /**
     * Search Tests
     * @param  string  $searchString
     * @param  integer $limit
     * @param  integer $offset
     * @return array
     */
    public function search(string $searchString, $limit = 10, $offset = 0) :array
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("tests/search?search={$searchString}&limit={$limit}&offset={$offset}")['data'], Test::class
        );
    }
}

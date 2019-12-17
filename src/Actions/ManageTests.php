<?php

namespace Mukja\HackerRank\Actions;

use Mukja\HackerRank\Resources\Test;

trait ManageTests
{
    /**
     * Get the collection of tests.
     *
     * @return Test[]
     */
    public function tests($limit = 10, $offset = 0)
    {
        return $this->transformCollection(
            $this->get("tests?limit={$limit}&offset={$offset}")['data'], Test::class
        );
    }

    /**
     * Get a test instance.
     *
     * @param  string $testId
     * @return Test
     */
    public function test($testId) :Test
    {
        return new Test($this->get("tests/{$testId}"), $this);
    }

    /**
     * Create a new test.
     *
     * @param  array $data
     * @return Test
     */
    public function createTest(array $data) :Test
    {
        $response = $this->post('tests', $data);

        return new Test($response, $this);
    }

    /**
     * Update the given test.
     *
     * @param  string $testId
     * @param  array $data
     * @return Test
     */
    public function updateTest($testId, array $data)
    {
        return $this->put("tests/{$testId}", $data);
    }

    /**
     * Delete the given test.
     *
     * @param  string $testId
     * @return void
     */
    public function deleteTest($testId)
    {
        $this->delete("tests/{$testId}");
    }

    /**
     * Search Tests
     * @param  string  $searchString
     * @param  integer $limit
     * @param  integer $offset
     * @return array
     */
    public function searchTests(string $searchString, $limit = 10, $offset = 0) :array
    {
        return $this->transformCollection(
            $this->get("tests/search?search={$searchString}&limit={$limit}&offset={$offset}")['data'], Test::class
        );
    }
}

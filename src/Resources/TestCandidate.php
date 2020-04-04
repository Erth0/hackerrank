<?php

namespace Mukja\HackerRank\Resources;

use Mukja\HackerRank\HackerRank;
use Mukja\HackerRank\Resources\Resource;

class TestCandidate
{
    use Resource;

    public function get(int $testId, $limit = 10, $offset = 0)
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("tests/{$testId}/candidates?limit={$limit}&offset={$offset}")['data'], TestCandidate::class
        );
    }

    public function retrive(int $testId, int $candidateId)
    {
        $hackerRank = HackerRank::getInstance();

        return new TestCandidate($hackerRank->get("tests/{$testId}/candidates/{$candidateId}"));
    }

    public function invite(array $data)
    {
        $hackerRank = HackerRank::getInstance();

        $response = $hackerRank->post("tests/{$this->test}/candidates", $data);

        return new TestCandidate($response);
    }

    public function update(array $data)
    {
        $hackerRank = HackerRank::getInstance();

        $response = $hackerRank->put("tests/{$this->test}/candidates/{$this->id}", $data);

        return new TestCandidate($response);
    }

    public function cancelInvitation()
    {
        $hackerRank = HackerRank::getInstance();

        $hackerRank->delete("tests/{$this->test}/candidates/{$this->id}/invite");
    }

    public function pdfReport()
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->get("tests/{$this->test}/candidates/{$this->id}/pdf");
    }

    public function deleteReport()
    {
        $hackerRank = HackerRank::getInstance();

        $hackerRank->delete("tests/{$this->test}/candidates/{$this->id}/report");
    }

    /**
     * Search Tests
     * @param  string  $searchString
     * @param  integer $limit
     * @param  integer $offset
     * @return array
     */
    public function search($testId, string $searchString, $limit = 10, $offset = 0) :array
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("tests/{$testId}/candidates/search?search={$searchString}&limit={$limit}&offset={$offset}")['data'],
            TestCandidate::class
        );
    }
}

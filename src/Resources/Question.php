<?php

namespace Mukja\HackerRank\Resources;

use Mukja\HackerRank\HackerRank;
use Mukja\HackerRank\Resources\Resource;

class Question
{
    use Resource;

    /**
     * Get the collection of questions.
     *
     * @return Question[]
     */
    public function get(array $data = [], $limit = 10, $offset = 0) :array
    {
        $hackerRank = HackerRank::getInstance();

        return $hackerRank->transformCollection(
            $hackerRank->get("questions?limit={$limit}&offset={$offset}", $data)['data'], Question::class
        );
    }
}

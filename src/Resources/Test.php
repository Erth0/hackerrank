<?php

namespace Mukja\HackerRank\Resources;

use Mukja\HackerRank\Resources\Resource;

class Test extends Resource
{
    public function invite(array $userData)
    {
        dd($this->hackerRank);
        $response = $this->hackerRank->post("tests/{$this->id}/candidates", $userData);
        dd($response);
    }
}

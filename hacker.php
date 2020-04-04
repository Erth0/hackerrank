<?php

use Mukja\HackerRank\HackerRank;
use Mukja\HackerRank\Resources\Question;
use Mukja\HackerRank\Resources\Team;
use Mukja\HackerRank\Resources\Test;
use Mukja\HackerRank\Resources\TestCandidate;
use Mukja\HackerRank\Resources\User;

require 'vendor/autoload.php';
$hacker = HackerRank::setApiKey('4d348080ab139e946feeb6bf7027ce784a400b2c9aa34cafccba85163e51ff7f');

// User ID => 265303
// Test ID => 490147
// Candidate ID => 14175251
// Team ID => 104406

// $user = User::retrive(265303);
// $users = User::search('pro');
// $tests = Test::get();
// $candidate = $test->candidate(14175251);
// $test = Test::retrive(490147);
// $candidate = $test->invite([
//     'full_name' => 'Eluert Mukja',
//     'email' => 'e.mukja@icloud.com',
// ]);

// $candidate = TestCandidate::retrive(490147, 14175251);

// $teams = Team::get();
// $team = Team::retreive(104406);
// $team = Team::create([
//     'name' => 'Testing Team',
// ]);

// $team = Team::retreive(161688)->update([
//     'name' => 'Testing Team Updated',
// ]);

// $team = Team::retreive(161693);
// $membership = Team::retreive(104406)->membership(265303);
//
$questions = Question::get([
    'status' => 'active',
]);
dd($questions);

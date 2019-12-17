<?php

namespace Mukja\HackerRank\Resources;

use Mukja\HackerRank\Resources\HackerRankResources;

class Teams extends HackerRankResources
{
    /**
     * ID of the team
     * @var string
     */
    public $id;

    /**
     * Name of the team
     * @var string
     */
    public $name;

    /**
     * Timestamp at which this team is created
     * @var string|dateTime
     */
    public $created_at;

    /**
     * Count of recruiters of this team.
     * @var integer
     */
    public $recruiter_count;

    /**
     * Count of developers of this team.
     * @var integer
     */
    public $developer_count;

    /**
     * Limit of recruiters of this team.
     * @var integer
     */
    public $recruiter_cap;

    /**
     * Limit of developers of this team.
     * @var integer
     */
    public $developer_cap;

    /**
     * The display name for invite emails sent to candidates.
     * @var integer
     */
    public $invite_as;

    /**
     * Locations of this team
     * @var array
     */
    public $locations = [];

    /**
     * Departments of developers of this team.
     * @var array
     */
    public $departments = [];
}

<?php

namespace Mukja\HackerRank;

class Version
{
    const MAJOR = 1;
    const MINOR = 0;
    const TINY = 0;

    public static function get()
    {
        return self::MAJOR . '.' . self::MINOR . '.' . self::TINY;
    }
}

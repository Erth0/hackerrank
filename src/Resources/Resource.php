<?php

namespace Mukja\HackerRank\Resources;

trait Resource
{
    protected $attributes;

    protected static $with = [];

    protected static $fields = [];

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->fill();
    }

    public static function with(...$resources)
    {
        static::$with = array_merge(static::$with, $resources);

        return new self([]);
    }

    public static function select(...$fields)
    {
        static::$fields = $fields;

        return new self([]);
    }

    /**
     * Fill the resource with the array of attributes.
     *
     * @return void
     */
    private function fill()
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
    }

    /**
     * Convert the key name to camel case.
     *
     * @param $key
     */
    private function camelCase($key)
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }
}

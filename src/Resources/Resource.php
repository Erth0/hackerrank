<?php

namespace Mukja\HackerRank\Resources;

class Resource
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    public $attributes;

    /**
     * The HackerRank SDK instance.
     *
     * @var HackerRank
     */
    protected $hackerRank;

    /**
     * Create a new resource instance.
     *
     * @param  array $attributes
     * @param  HackerRank $hackerRank
     * @return void
     */
    public function __construct(array $attributes, $hackerRank = null)
    {
        $this->attributes = $attributes;
        $this->hackerRank = $hackerRank;

        $this->fill();
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

<?php

namespace Resly;

class SlotEntry
{
    private $starting;
    private $finishing;
    private $free;

    public function __construct($starting, $finishing, $free)
    {
        $this->starting = $starting;
        $this->finishing = $finishing;
        $this->free = $free;
    }



    public function isFree()
    {
        return $this->free;
    }
}
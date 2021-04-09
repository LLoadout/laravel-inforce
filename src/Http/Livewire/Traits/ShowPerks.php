<?php

namespace LLoadoutInforce\Http\Livewire\Traits;

trait ShowPerks
{
    public $showPerks = false;

    public function __construct()
    {
        $this->showPerks = true;
    }
}
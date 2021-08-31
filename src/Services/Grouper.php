<?php
namespace LLoadoutInforce\Services;

class Grouper
{

    public function exec($collectionOfDottedStrings, $grouped = [])
    {
        $collectionOfDottedStrings->each(function ($dottedString, $key) use (&$grouped) {
            data_set($grouped, $dottedString, $key, $overwrite = true);
        });
        return $grouped;
    }

}

<?php
namespace LLoadoutInforce\Services;

class Grouper
{

    public function exec($collectionOfDottedStrings, $grouped = [])
    {
//        return $collectionOfDottedStrings->map(function ($dottedString, $key) use($grouped) {
//            return data_set($grouped, $dottedString, $key, $overwrite = true);
//        });

        $collectionOfDottedStrings->each(function ($dottedString, $key) use (&$grouped) {
            data_set($grouped, $dottedString, $key, $overwrite = true);
        });
        return $grouped;
    }

}

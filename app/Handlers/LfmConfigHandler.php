<?php

namespace App\Handlers;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        return parent::userField();
    }

    public function sortFilesAndDirectories($arr_items, $sort_type)
    {
        if ($sort_type == 'time') {
            $key_to_sort = 'updated';
        } elseif ($sort_type == 'alphabetic') {
            $key_to_sort = 'name';
        } else {
            $key_to_sort = 'updated';
        }

        uasort($arr_items, function ($a, $b) use ($key_to_sort) {
            if ( $a->$key_to_sort == $b->$key_to_sort )
                return 0;
            else if ( $a->$key_to_sort > $b->$key_to_sort)
                return -1;
            else
                return 1;
        });

        return $arr_items;
    }
}

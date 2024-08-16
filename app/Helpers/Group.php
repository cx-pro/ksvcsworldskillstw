<?php
namespace App\Helpers;

class Group
{
    public static function collection_group_by_grade($collections)
    {
        $arr = [];
        foreach ($collections as $coll) {
            $g = $coll->get_grade();
            if (!array_key_exists($g, $arr))
                $arr[$g] = [];
            array_push($arr[$g], $coll);
        }
        krsort($arr);
        return array_merge(...array_values($arr));
    }

}
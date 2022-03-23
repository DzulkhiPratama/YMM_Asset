<?php

namespace App\Models;



class asset
{
    private static $exist_asset = [
        [
            "asset" => "MEJA",
            "tittle" => "apa",
            "assetid" => "123",
            "Desc" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio commodi nam quas porro doloribus corporis, distinctio perferendis ab alias repellat voluptas eos sed voluptate illo vel vitae accusamus eum. Ex."
        ],
        [
            "asset" => "KURSI",
            "tittle" => "kita",
            "assetid" => "456",
            "Desc" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio commodi nam quas porro doloribus corporis, distinctio perferendis ab alias repellat voluptas eos sed voluptate illo vel vitae accusamus eum. Ex."
        ]
    ];

    public static function all()
    {
        return collect(self::$exist_asset);
    }

    public static function find($assetid)
    {
        $assests = static::all();
        return $assests->firstWhere('assetid', $assetid);
    }
}

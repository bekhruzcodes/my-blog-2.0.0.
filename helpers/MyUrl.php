<?php

namespace app\helpers;

use yii\helpers\Url;

class MyUrl extends Url
{
    public static function to($url = '', $scheme = false)
    {
        $fullUrl = parent::to($url, $scheme);

        return str_replace('/www/', '/', $fullUrl);

    }

}
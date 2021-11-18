<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlMapper extends Model
{
    //
    protected $fillable = [
        'url',
        'url_code',
        'visits_count',
    ];
}

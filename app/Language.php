<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'referance',  'en_text', 'ger_text', 'status',
    ];
}

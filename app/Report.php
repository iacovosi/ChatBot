<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
        'category', 'url', 'where', 'type', 'description', 'personal_data', 'personal_details', 'name', 'surname', 'email', 'phone',
        'age', 'gender',

    ];
}

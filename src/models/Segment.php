<?php

namespace Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Segment extends Eloquent
{
    protected $fillable = [
        'name', 'title', 'subtitle', 'content'
    ];
}
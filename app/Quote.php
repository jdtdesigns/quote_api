<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['quote', 'author'];
    protected $hidden = ['created_at', 'updated_at'];
}

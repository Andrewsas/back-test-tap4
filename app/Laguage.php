<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laguage extends Model
{
    protected $table = 'language';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'creator', 'site', 'type', 'year', 'version',
    ];
}

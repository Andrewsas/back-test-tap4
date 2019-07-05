<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'creator', 'site', 'image', 'type', 'year', 'version',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Framework extends Model
{
    protected $table = 'frameworks';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'id_language', 'creator', 'site' ,'image', 'type' ,'year' ,'version' ,'against' ,'pro'
    ];

    public function language() {
        $query = $this->belongsTo('App\Language', 'id_language');

        if($query)
           $query = $query->select('id', 'name', 'creator', 'site' ,'type' ,'year' ,'version');

        return $query;
    }

}

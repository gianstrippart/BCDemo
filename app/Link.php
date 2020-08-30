<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = [
        'user_id', 'longlink', 'shortlink', 'name', 'user-agent'
    ];
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}

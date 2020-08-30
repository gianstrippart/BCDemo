<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    protected $table = 'hits';

    protected $fillable = [
        'user_id', 'link_id'
    ];
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function link(){
        return $this->belongsTo('App\Link', 'link_id');
    }
}

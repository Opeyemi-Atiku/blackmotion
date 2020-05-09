<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question', 'link', 'category', 'type', 'user_id', 'name'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function answer() {
    	return $this->hasMany('App\Answer');
    } 
}

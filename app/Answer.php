<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['answer', 'question_id', 'user_id', 'link', 'type'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function question() {
        return $this->belongsTo('App\Question');
    }

    public function reply() {
    	return $this->hasMany('App\Reply');
    } 
}
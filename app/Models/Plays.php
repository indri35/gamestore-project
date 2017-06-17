<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plays extends Model
{
    public $table = 't_play_games';
    public $fillable = ['id','idplayer','idgames','subscription','score'];
    public $primaryKey = 'id';
    public $incrementing = true; 
    public $timestamps = true;

}
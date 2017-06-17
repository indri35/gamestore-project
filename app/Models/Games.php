<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    public $table = 't_games';
    public $fillable = ['id','name','desc','category','img', 'img_slider', 'count_play', 'coint'];
    public $primaryKey = 'id';
    public $incrementing = true; 
    public $timestamps = true;

}
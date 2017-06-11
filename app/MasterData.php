<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterData extends Model
{
    public $table = 't_games';
    public $fillable = ['id','name','desc', 'img','category','updated_at', 'created_at','id_user'];
    public $primaryKey = 'id';
    public $incrementing = true; 

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterData extends Model
{
    public $table = 't_games';
    public $fillable = ['id','name','desc','coint','img','category','updated_at', 'created_at','id_user','banner'];
    public $primaryKey = 'id';
    public $incrementing = true; 

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterData extends Model
{
    public $table = 't_rate';
    public $fillable = ['id','name','desc', 'img','category'];
    public $primaryKey = 'id';
    public $incrementing = true; 

}
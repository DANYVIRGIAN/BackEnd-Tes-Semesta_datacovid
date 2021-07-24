<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datacovid extends Model
{
    protected $fillable = ['id','kota','jumlah'];
    protected $table = "datacovid";
    protected $primaryKey = 'id';

}

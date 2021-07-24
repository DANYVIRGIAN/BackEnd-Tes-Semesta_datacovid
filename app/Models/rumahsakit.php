<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rumahsakit extends Model
{
    protected $fillable = ['id', 'nama_rs', 'alamat'];
    protected $table = "rumahsakit";
    protected $primaryKey = 'id';
}

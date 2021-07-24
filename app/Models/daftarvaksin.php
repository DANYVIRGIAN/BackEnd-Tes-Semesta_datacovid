<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daftarvaksin extends Model
{
    protected $fillable = ['id', 'nama', 'alamat', 'umur'];
    protected $table = "daftarvaksin";
    protected $primaryKey = 'id';
}

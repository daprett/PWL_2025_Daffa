<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;// Menggunakan HasFactory untuk memungkinkan pembuatan factory data
    protected $fillable = [ // Menentukan atribut yang dapat diisi secara massal
        'name',
        'description',
    ];
}

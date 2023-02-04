<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Web extends Model
{
    use HasFactory;
    protected $table = 'webs';

    protected $fillable = [
        'nama_web',
        'inis_web',
        'desk_web',
        'logo_web',
        'copy_web',
        'year_web',
    ];
}

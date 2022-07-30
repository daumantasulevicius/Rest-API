<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'index_start_at',
        'integer',
        'float',
        'name',
        'surname',
        'fullname',
        'email',
        'bool'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

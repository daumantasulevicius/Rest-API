<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "comment";
    protected $fillable = [
        'data_id',
        'comment'
    ];

    public function data()
    {
        return $this->belongsTo(Data::class);
    }
}

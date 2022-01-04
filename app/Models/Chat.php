<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'image', 'nom', 'message','id','created_at','user',
        'id','from_id','to_id','content','offre'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','from_id','to_id','content','created_at','image','file','sujet',
    ];

    public $timestamps;
    protected $data=['created_at'];

    public function from()
    {
        return $this->belongsTo(User::class,'from_id');
    }
}

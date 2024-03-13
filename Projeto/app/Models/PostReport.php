<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    use HasFactory;

    protected $connection = 'posts';
    protected $table = 'post_report';
    protected $primaryKey = 'id_post_report';
    protected $fillable = ['id_post', 'id_user', 'reason'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
}
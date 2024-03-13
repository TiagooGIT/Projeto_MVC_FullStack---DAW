<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostInteraction extends Model
{
    use HasFactory;

    protected $connection = 'posts';
    protected $table = 'post_interactions';
    protected $primaryKey = 'id_post_interactions';
    protected $fillable = ['id_post', 'action'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
}

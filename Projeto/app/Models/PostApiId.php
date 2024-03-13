<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostApiId extends Model
{
    use HasFactory;

    protected $connection = 'posts';
    protected $table = 'postsAPI_IDs';
    protected $primaryKey = 'id_postsAPI_ID';
    protected $fillable = ['local_post_id', 'api_post_id', 'api_translated_post_id'];
}

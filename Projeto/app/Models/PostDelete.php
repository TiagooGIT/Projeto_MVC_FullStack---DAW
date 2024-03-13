<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDelete extends Model
{
    use HasFactory;
    
    protected $connection = 'posts';
    protected $table = 'post_deleted';
    protected $primaryKey = 'id_post_delete';
    protected $fillable = ['title','content','id_user','deleted_by','reason'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
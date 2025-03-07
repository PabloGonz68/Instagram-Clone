<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'n_likes',
        'belongs_to',
        'publish_date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'belongs_to');
    }

    /**
     * Relación con el modelo Comment.
     * Un post puede tener muchos comentarios.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

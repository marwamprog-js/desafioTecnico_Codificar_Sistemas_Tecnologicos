<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post', 'created_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rules() {
        return [
            'post' => 'required|min:5|max:280',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'post.min' => 'O campo nome de ter no mínimo 5 caracteres',
            'post.max' => 'O campo nome de ter no máximo 280 caracteres',
        ];
    }

}

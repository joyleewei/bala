<?php

namespace App\Models;

class Reply extends Model{
    protected $fillable = ['content'];
    // 获取该评论的话题信息
    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    // 获取该评论的用户信息
    public function user(){
        return $this->belongsTo(User::class);
    }
}
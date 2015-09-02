<?php
  namespace thatoneduderob\Models;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class News extends Eloquent {
    protected $table = 'news';
    protected $fillable = [
      'title',
      'body',
      'poster',
      'tag',
      'public'
    ];

    public function getPost($postId) {
      return $this->where('id', $postId)->first();
    }

    public function getTotalPosts() {
      return $this->get()->count();
    }
  }
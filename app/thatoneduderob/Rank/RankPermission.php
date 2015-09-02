<?php
  namespace thatoneduderob\Rank;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class RankPermission extends Eloquent {
    protected $table = 'ranks_permissions';
    protected $fillable = [
      'can_post',
      'can_comment'
    ];
  }
<?php
  namespace thatoneduderob\Rank;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class Rank extends Eloquent {
    protected $table = 'ranks';
    protected $fillable = [
      'name'
    ];

    public function getRankName($rankId) {
      return $this->where('id', $rankId)->first()->name;
    }

    public function permissions() {
      return $this->hasOne('thatoneduderob\Rank\RankPermission', 'id');
    }
  }
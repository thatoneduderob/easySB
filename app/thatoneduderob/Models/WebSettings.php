<?php
  namespace thatoneduderob\Models;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class WebSettings extends Eloquent {
    protected $table = 'settings';
    protected $fillable = [
      'site_name',
      'timezone'
    ];

    public function getSiteName() {
      return $this->where('id', 1)->first()->site_name;
    }

    public function getTimezone() {
      return $this->where('id', 1)->first()->timezone;
    }
  }
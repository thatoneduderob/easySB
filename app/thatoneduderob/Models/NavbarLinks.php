<?php
  namespace thatoneduderob\Models;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class NavbarLinks extends Eloquent {
    protected $table = 'navbar_links';
    protected $fillable = [
      'title',
      'route'
    ];

    public function getLinks() {
      $titles = array();
      foreach($this->get() as $title) {
        array_push($titles, $title);
      }
      return $titles;
    }
  }
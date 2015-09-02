<?php
  namespace thatoneduderob\Classes;

  class Pagination {
    public function construct_table ($table, $item_per_page, $array, $pageUrl, $app, $page_number, $tableConstruction) {
      ################# PAGINATION #################
      $db_username        = $app->config->get('db.username');
      $db_password        = $app->config->get('db.password');
      $db_name            = $app->config->get('db.name');
      $db_host            = $app->config->get('db.host');
      $page_url           = $app->config->get('app.url').$pageUrl;
      $pagination = "";

      foreach ($tableConstruction as $con) {
        $pagination .= $con;
      }

      $mysqli_conn = new \mysqli($db_host, $db_username, $db_password, $db_name);
      if ($mysqli_conn->connect_error) {
          die("There was an error connecting to the database.");
      }

      $get_total_rows = $app->user->count();
      $total_pages = ceil($get_total_rows/$item_per_page);

      ################# Display Records per page ############################
      $page_position = (($page_number-1) * $item_per_page);
      $results = $mysqli_conn->query("SELECT * FROM $table ORDER BY id ASC LIMIT $page_position, $item_per_page");

      foreach ($array as $arr) {
        foreach($arr as $a) {
          $pagination .= $a;
        }
      }

      $pagination .= "</table><div class='text-center'><ul class='pagination'>";

      if($page_position <= 0) {
        $page_position = 1;
      }

      $genLinks = $this->generateLinks($page_number, $pagination, $total_pages);

      return $genLinks;
    }

    public function construct_news ($table, $item_per_page, $array, $pageUrl, $app, $page_number, $divConstruction) {
      ################# PAGINATION #################
      $db_username        = $app->config->get('db.username');
      $db_password        = $app->config->get('db.password');
      $db_name            = $app->config->get('db.name');
      $db_host            = $app->config->get('db.host');
      $page_url           = $app->config->get('app.url').$pageUrl;
      $pagination = "";

      foreach ($divConstruction as $con) {
        $pagination .= $con;
      }

      $mysqli_conn = new \mysqli($db_host, $db_username, $db_password, $db_name);
      if ($mysqli_conn->connect_error) {
          die("There was an error connecting to the database.");
      }

      $get_total_rows = $app->user->count();
      $total_pages = ceil($get_total_rows/$item_per_page);

      ################# Display Records per page ############################
      $page_position = (($page_number-1) * $item_per_page);
      $results = $mysqli_conn->query("SELECT * FROM $table ORDER BY id ASC LIMIT $page_position, $item_per_page");

      foreach ($array as $arr) {
        foreach($arr as $a) {
          $pagination .= $a;
        }
      }

      $pagination .= "</ul><div class='text-center'><ul class='pagination'>";

      if($page_position <= 0) {
        $page_position = 1;
      }

      $genLinks = $this->generateLinks($page_number, $pagination, $total_pages);

      return $genLinks;
    }

    private function generateLinks($page_position, $pagination, $total_pages) {
      ## FIRST PAGE ##
      if($page_position == 1) {
        $pagination .= "<li class='disabled'><a href='?p=$page_position'>FIRST</a></li>";
      } else {
        $pagination .= "<li><a href='?p=1'>FIRST</a></li>";
      }

      ## PREVIOUS PAGE ##
      if($page_position == 1) {
        $pagination .= "<li class='disabled'><a href='?p=1'><i class='material-icons'>chevron_left</i></a></li>";
      } else {
        if($page_position <= 1) {
          $pagination .= "<li class='disabled'><a href='?p=1'><i class='material-icons'>chevron_left</i></a></li>";
        } else {
          $pagination .= "<li><a href='?p=".($page_position-1)."'><i class='material-icons'>chevron_left</i></a></li>";
        }
      }

      if(($page_position - 2) < $page_position && (($page_position - 2) > 0) && (($page_position - 2) < $total_pages)) {
        $pagination .= "<li><a href='?p=".($page_position - 2)."'>".($page_position - 2)."</a></li>";
      }

      if(($page_position - 1) < $page_position && (($page_position - 1) > 0) && (($page_position - 1) < $total_pages)) {
        $pagination .= "<li><a href='?p=".($page_position - 1)."'>".($page_position - 1)."</a></li>";
      }

      $pagination .= "<li class='active'><a href='?p=$page_position'>$page_position</a></li>";

      if(($page_position + 1) > $page_position && (($page_position + 1) <= $total_pages)) {
        $pagination .= "<li><a href='?p=".($page_position + 1)."'>".($page_position + 1)."</a></li>";
      }

      if(($page_position + 2) > $page_position && (($page_position + 2) <= $total_pages)) {
        $pagination .= "<li><a href='?p=".($page_position + 2)."'>".($page_position + 2)."</a></li>";
      }

      ## NEXT PAGE ##
      if($page_position == $total_pages) {
        $pagination .= "<li class='disabled'><a href='?p=$page_position'><i class='material-icons'>chevron_right</i></a></li>";
      } else {
        if($page_position > $total_pages) {
          $pagination .= "<li class='disabled'><a href='?p=1'><i class='material-icons'>chevron_right</i></a></li>";
        } else {
          $pagination .= "<li><a href='?p=".($page_position+1)."'><i class='material-icons'>chevron_right</i></a></li>";
        }
      }

      ## LAST PAGE ##
      if($page_position == $total_pages) {
        $pagination .= "<li class='disabled'><a href='?p=$page_position'>LAST</a></li>";
      } else {
        $pagination .= "<li><a href='?p=".($total_pages)."'>LAST</a></li>";
      }

      $pagination .= "</ul></div>";

      return $pagination;
    }
  }
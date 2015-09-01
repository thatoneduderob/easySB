<?php
  namespace thatoneduderob\Classes;

  class Pagination {
    public function construct ($table, $item_per_page = 25, $array, $pageUrl, $app) {
      ## PAGINATION ##
      $db_username        = $app->config->get('db.username');
      $db_password        = $app->config->get('db.password');
      $db_name            = $app->config->get('db.name');
      $db_host            = $app->config->get('db.host');
      $page_url           = $app->config->get('app.url').$pageUrl;
      $endResult = null;

      $mysqli_conn = new \mysqli($db_host, $db_username, $db_password, $db_name); //connect to MySql
      if ($mysqli_conn->connect_error) { //Output any connection error
          die('Error : ('. $mysqli_conn->connect_errno .') '. $mysqli_conn->connect_error);
      }

      if(isset($_GET["p"])){ //Get page number from $_GET["page"]
          $page_number = filter_var($_GET["p"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
          if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
          if($page_number <= 0){$page_number=1;}
      }else{
          $page_number = 1; //if there's no page number, set it to 1
      }

      $get_total_rows = $app->user->count();

      $total_pages = ceil($get_total_rows/$item_per_page); //break records into pages

      ################# Display Records per page ############################
      $page_position = (($page_number-1) * $item_per_page); //get starting position to fetch the records
      //Fetch a group of records using SQL LIMIT clause
      $results = $mysqli_conn->query("SELECT * FROM $table ORDER BY id ASC LIMIT $page_position, $item_per_page");

      //Display records fetched from database.
      while($row = $results->fetch_assoc()) {
        foreach ($array as $arr) {
          $endResult .= $arr;
        }
      }

      $endResult .= "</table>";
      ## End displaying Records ##

      $result = null;
      $result = "<div class='text-center'>";
      $result .= "<ul class='pagination'>";

      $cur_page = $page_position;
      $item_count = $get_total_rows;

      if($cur_page <= 0) {
        $cur_page = 1;
      }

      ## FIRST PAGE ##
      if($cur_page == 1) {
        $result .= "<li class='disabled'><a href='?p=$cur_page'>FIRST</a></li>";
      } else {
        $result .= "<li><a href='?p=1'>FIRST</a></li>";
      }

      ## PREVIOUS PAGE ##
      if($cur_page == 1) {
        $result .= "<li class='disabled'><a href='?p=$cur_page'><i class='material-icons'>chevron_left</i></a></li>";
      } else {
        $result .= "<li><a href='?p=".($cur_page-1)."'><i class='material-icons'>chevron_left</i></a></li>";
      }

      if(($cur_page - 2) < $cur_page && (($cur_page - 2) > 0)) {
        $result .= "<li><a href='?p=".($cur_page - 2)."'>".($cur_page - 2)."</a></li>";
      }

      if(($cur_page - 1) < $cur_page && (($cur_page - 1) > 0)) {
        $result .= "<li><a href='?p=".($cur_page - 1)."'>".($cur_page - 1)."</a></li>";
      }

      $result .= "<li class='active'><a href='?p=$cur_page'>$cur_page</a></li>";

      if(($cur_page + 1) > $cur_page && (($cur_page + 1) <= $item_count)) {
        $result .= "<li><a href='?p=".($cur_page + 1)."'>".($cur_page + 1)."</a></li>";
      }

      if(($cur_page + 2) > $cur_page && (($cur_page + 2) <= $item_count)) {
        $result .= "<li><a href='?p=".($cur_page + 2)."'>".($cur_page + 2)."</a></li>";
      }

      ## NEXT PAGE ##
      if($cur_page == $item_count) {
        $result .= "<li class='disabled'><a href='?p=$cur_page'><i class='material-icons'>chevron_right</i></a></li>";
      } else {
        $result .= "<li><a href='?p=".($cur_page+1)."'><i class='material-icons'>chevron_right</i></a></li>";
      }

      ## LAST PAGE ##
      if($cur_page == $item_count) {
        $result .= "<li class='disabled'><a href='?p=$cur_page'>LAST</a></li>";
      } else {
        $result .= "<li><a href='?p=".($item_count)."'>LAST</a></li>";
      }

      $result .= "</ul>";
      $result .= "</div>";

      return $endResult.$result;
    }
  }
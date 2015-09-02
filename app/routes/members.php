<?php
  $app->get('/members(/:p)', function() use ($app) {
    $page = $app->request->get('p');
    // Get the current page if not set to page 1
    $currentPage = isset($page) ? $page : 1;
    if(!is_numeric($currentPage)) {
        $app->notFound();
    }
    $itemsPerPage = 25;
    $page_position = (($currentPage-1) * $itemsPerPage);
    
    $members = $app->user->where('active', true)->skip($page_position)->take($itemsPerPage)->get();
    $args = array();
    foreach ($members as $mem) {
      $profileLink = $app->urlFor('user.profile', array('id' => $mem->id));
      $arrs = array("<tr>",
      "<td>[<a href='$profileLink'>".$app->user->getUsername($mem->id)."</a>]</td>",
      "<td>".$app->general->getDateFromStamp($mem->created_at)."</td>",
      "</tr>");
      $args[$mem->id] = $arrs;
    }
    $tableConstruction = array(
      "<table>",
      "<tr>",
      "<td>Name</td>",
      "<td>Join Date</td>",
      "</tr>"
    );

    $app->render('members.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'pagination' => $app->pagination->construct_table("users", $itemsPerPage, $args, "/members", $app, $currentPage, $tableConstruction),
      'webSiteName' => $app->websettings->getSiteName()
    ]);
  })->name('members');
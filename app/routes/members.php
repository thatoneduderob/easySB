<?php
  $app->get('/members(/:p)', function() use ($app) {
    $page = $app->request->get('p');
    // Get the current page if not set to page 1
    $currentPage = isset($page) ? $page : 1;
    if(!is_numeric($currentPage)) {
        $app->notFound();
    }

    $members = $app->user->where('active', true)->get();
    foreach ($members as $mem) {
      $args = array("<tr>",
      "<td><a href='{{urlFor('user.profile', {id: ".$mem->id."})}}'>".$app->user->getUsername($mem->id)."</a></td>",
      "<td>".$app->user->getDateFromStamp($mem->created_at)."</td>",
      "</tr>");
    }

    $app->render('members.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'pagination' => $app->pagination->construct("users", 25, $args, "/members", $app),
      'webSiteName' => $app->websettings->getSiteName()
    ]);
  })->name('members');
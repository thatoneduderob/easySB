<?php
  $app->get('/(/:p)', function() use ($app) {
    $page = $app->request->get('p');
    // Get the current page if not set to page 1
    $currentPage = isset($page) ? $page : 1;
    if(!is_numeric($currentPage)) {
        $app->notFound();
    }
    $itemsPerPage = 25;
    $page_position = (($currentPage-1) * $itemsPerPage);

    $news = $app->news->where('public', true)->skip($page_position)->take($itemsPerPage)->get();
    $perRowArgs = array();
    foreach ($news as $post) {
      // commented out for now because there is no news post page created yet
      $profileLink = $app->urlFor('user.profile', array('id' => $post->poster));
      $arrs = array(
        "<li class='collection-item'>",
        "<font size='5'>$post->title</font>",
        "<p><a href='$profileLink'>".$app->user->getUsername($post->poster)."</a> posted on ".$app->general->getDateFromStamp($post->created_at, $app)." at ".$app->general->getTimeFromStamp($post->created_at, $app)."</p>",
        "<br>",
        "<p>$post->body</p>",
        "</li>"
      );
      $perRowArgs[$post->id] = $arrs;
    }
    $divConstruction = array(
      "<ul class='collection'>"
    );

    $app->render('home.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'webSiteName' => $app->websettings->getSiteName(),
      'pagination' => $app->pagination->construct_news("news", $itemsPerPage, $perRowArgs, "/", $app, $currentPage, $divConstruction)
    ]);
  })->name('home');
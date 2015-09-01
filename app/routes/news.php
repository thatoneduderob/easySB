<?php
  $app->get('/news', function() use ($app) {
    $app->render('news.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'webSiteName' => $app->websettings->getSiteName()
    ]);
  })->name('news');
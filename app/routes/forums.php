<?php
  $app->get('/forums', function() use ($app) {
    $app->render('forums.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'webSiteName' => $app->websettings->getSiteName()
    ]);
  })->name('forums');
<?php
  $app->get('/news', function() use ($app) {
    $app->render('news.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers()
    ]);
  })->name('news');
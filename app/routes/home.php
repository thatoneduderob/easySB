<?php
  $app->get('/', function() use ($app) {
    $app->render('home.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'webSiteName' => $app->websettings->getSiteName()
    ]);
  })->name('home');
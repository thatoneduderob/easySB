<?php
  $app->get('/chat', function() use ($app) {
    $app->render('chat.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers()
    ]);
  })->name('chat');
<?php
  $app->get('/members', function() use ($app) {
    $app->render('members.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers()
    ]);
  })->name('members');
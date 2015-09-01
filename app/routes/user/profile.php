<?php
  $app->get('/u/:id', function($id) use ($app) {
    $user = $app->user->where('id', $id)->first();

    if(!$user) {
      $app->notFound();
    }

    $app->render('user/profile.php', [
      'user' => $user,
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'webSiteName' => $app->websettings->getSiteName()
    ]);
  })->name('user.profile');
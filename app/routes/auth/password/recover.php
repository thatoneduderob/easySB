<?php
  $app->get('/recover-password', $guest(), function() use ($app) {
    $app->render('auth/password/recover.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'webSiteName' => $app->websettings->getSiteName()
    ]);
  })->name('auth.password.recover');

  $app->post('/recover-password', $guest(), function() use ($app) {
    $request = $app->request;

    $email = $request->post('email');

    $v = $app->validation;

    $v->validate([
      'email' => [$email, 'required|email']
    ]);

    if($v->passes()) {
      $user = $app->user->where('email', $email)->first();

      if(!$user) {
        $app->flash('global', 'Could not find a user with that email.');
        $app->response->redirect($app->urlFor('password.recover'));
      } else {
        $identifier = $app->randomlib->generateString(128);

        $user->update([
          'recover_hash' => $app->hash->hash($identifier)
        ]);

        $app->mail->send(
          'email/auth/password/recover.php',
          ['user' => $user, 'identifier' => $identifier],
          function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Password recovery instructions");
          }
        );

        $app->flash('global', 'We have emailed you instructions to reset your password.');
        $app->response->redirect($app->urlFor('home'));
      }
    }

    $app->render('auth/password/recover.php', [
      'errors' => $v->errors(),
      'request' => $request
    ]);
  })->name('password.recover.post');
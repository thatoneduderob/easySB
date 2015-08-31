<?php
  $app->get('/change-password', $authenticated(), function() use ($app) {
    $app->render('auth/password/change.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers()
    ]);
  })->name('auth.password.change');

  $app->post('/change-password', $authenticated(), function() use ($app) {
    $request = $app->request;

    $passwordOld = $request->post('password_old');
    $passwordNew = $request->post('password_new');
    $passwordConfirm = $request->post('password_confirm');

    $v = $app->validation;
    $v->validate([
      'password_old' => [$passwordOld, 'required|matchesCurrentPassword'],
      'password_new' => [$passwordNew, 'required|min(6)'],
      'password_confirm' => [$passwordConfirm, 'required|matches(password_new)']
    ]);

    if($v->passes()) {
      $user = $app->auth;

      $app->auth->update([
        'password' => $app->hash->password($passwordNew)
      ]);

      $app->mail->send(
        'email/auth/password/change.php',
        [],
        function($message) use ($user) {
          $message->to($user->email);
          $message->subject("You changed your password");
        }
      );

      $app->flash('global', 'Your password has been updated!');
      $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/password/change.php', [
      'errors' => $v->errors()
    ]);
  })->name('password.change.post');
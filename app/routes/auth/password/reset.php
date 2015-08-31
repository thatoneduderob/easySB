<?php
  $app->get('/reset-password', $guest(), function() use ($app) {
    $request = $app->request;

    $identifier = $request->get('identifier');
    $email = $request->get('email');

    $hashedIdentifier = $app->hash->hash($identifier);

    $user = $app->user->where('email', $email)->first();

    if(!$user
      || !$user->recover_hash
      || !$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
      $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/password/reset.php', [
      'email' => $user->email,
      'identifier' => $identifier,
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers()
    ]);
  })->name('password.reset');

  $app->post('/reset-password', $guest(), function() use ($app) {
    $request = $app->request;
    $identifier = $request->get('identifier');
    $email = $request->get('email');
    $password = $request->post('password_new');
    $password_confirm = $request->post('password_confirm');

    $hashedIdentifier = $app->hash->hash($identifier);

    $user = $app->user->where('email', $email)->first();

    if(!$user
      || !$user->recover_hash
      || !$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
      $app->response->redirect($app->urlFor('home'));
    }

    $v = $app->validation;
    $v->validate([
      'password_new' => [$password, 'required|min(6)'],
      'password_confirm' => [$password_confirm, 'required|matches(password_new)']
    ]);

    if($v->passes()) {
      $user->update([
        'password' => $app->hash->password($password),
        'recover_hash' => null
      ]);

      $app->flash('global', 'Your password has been reset and you may now login with the new password.');
      $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/password/reset.php', [
      'errors' => $v->errors(),
      'email' => $user->email,
      'identifier' => $identifier
    ]);
  })->name('password.reset.post');
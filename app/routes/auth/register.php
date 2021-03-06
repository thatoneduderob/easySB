<?php
  use thatoneduderob\User\UserPermission;

  $app->get('/register', $guest(), function() use ($app) {
    $app->render('auth/register.php', [
      'links' => $app->navlinks->getLinks(),
      'totalUsers' => $app->user->getTotalUsers(),
      'totalNewsPosts' => $app->news->getTotalPosts(),
      'webSiteName' => $app->websettings->getSiteName(),
      'timezones' => $app->general->getTimezones()
    ]);
  })->name('register');

  $app->post('/register', $guest(), function() use ($app) {
    $request = $app->request;

    $email = $request->post('email');
    $username = $request->post('username');
    $password = $request->post('password');
    $password_confirm = $request->post('password_confirm');
    $timezone = $request->post('timezone');

    $v = $app->validation;
    $v->validate([
      'email' => [$email, 'required|email|uniqueEmail'],
      'username' => [$username, 'required|alnumDash|max(30)|uniqueUsername'],
      'password' => [$password, 'required|min(6)'],
      'password_confirm' => [$password_confirm, 'required|matches(password)'],
      'timezone' => [$timezone, 'required']
    ]);

    if($v->passes()) {
      $identifier = $app->randomlib->generateString(128);

      $user = $app->user->create([
        'email' => $email,
        'username' => $username,
        'password' => $app->hash->password($password),
        'active' => false,
        'active_hash' => $app->hash->hash($identifier),
        'timezone' => $timezone,
        'rank' => "Member"
      ]);

      $user->permissions()->create(UserPermission::$defaults);

      $app->mail->send(
        'email/auth/register.php',
        ['user' => $user, 'identifier' => $identifier],
        function($message) use ($user) {
          $message->to($user->email);
          $message->subject("Thanks for registering!");
        }
      );

      $app->flash('global', 'You have been registered. Please check your email for an activation link.');
      $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/register.php', [
      'errors' => $v->errors(),
      'request' => $request
    ]);
  })->name('register.post');
{% extends 'templates/default.php' %}

{% block title %}
  Recover Password
{% endblock %}

{% block content %}
  <form action="{{ urlFor('password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post" autocomplete="off">
    <div>
      <label for="password_new">New password</label>
      <input type="password" name="password_new" id="password_new">
      {% if errors.has('password_new') %}{{ errors.first('password_new') }}{% endif %}
    </div>
    <div>
      <label for="password_confirm">Confirm password</label>
      <input type="password" name="password_confirm" id="password_confirm">
      {% if errors.has('password_confirm') %}{{ errors.first('password_confirm') }}{% endif %}
    </div>
    <div>
      <button class="btn waves-effect waves-light" type="submit">Reset</button>
    </div>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}
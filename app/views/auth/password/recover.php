{% extends 'templates/default.php' %}

{% block title %}
  Recover Password
{% endblock %}

{% block content %}
  <p>Enter your email address to start your password recovery</p>
  <form action="{{ urlFor('password.recover.post') }}" method="post" autocomplete="off">
    <div>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" {% if request.post('email') %}value="{{ request.post('email') }}"{% endif %}>
      {% if errors.has('email') %}{{ errors.first('email') }}{% endif %}
    </div>
    <div>
      <button class="btn waves-effect waves-light" type="submit">Request reset</button>
    </div>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}
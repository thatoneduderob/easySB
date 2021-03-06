{% extends 'templates/default.php' %}

{% set title = 'Register' %}

{% block content %}
  <form action="{{ urlFor('register.post') }}" method="post" autocomplete="off">
    <div>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" {% if request.post('email') %}value="{{ request.post('email') }}"{% endif %}>
      {% if errors.has('email') %}{{ errors.first('email') }}{% endif %}
    </div>
    <div>
      <label for="username">Username</label>
      <input type="text" name="username" id="username" {% if request.post('username') %}value="{{ request.post('username') }}"{% endif %}>
      {% if errors.has('username') %}{{ errors.first('username') }}{% endif %}
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" name="password" id="password">
      {% if errors.has('password') %}{{ errors.first('password') }}{% endif %}
    </div>
    <div>
      <label for="password_confirm">Repeat Password</label>
      <input type="password" name="password_confirm" id="password_confirm">
      {% if errors.has('password_confirm') %}{{ errors.first('password_confirm') }}{% endif %}
    </div>
    <div>
      <label for="timezone">Timezone</label>
      <select class="browser-default" name="timezone" id="timezone">
        {% for tz in timezones %}
          <option value="{{tz}}">{{tz}}</option>
        {% endfor %}
      </select>
    </div>
    <div>
      <button class="btn waves-effect waves-light" type="submit">Register</button>
    </div>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}
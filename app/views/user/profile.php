{% extends 'templates/default.php' %}

{% set title %}
<strong>{{user.getFullNameOrUsername}}</strong>'s Profile
{% endset %}

{% block content %}
  <h2>{{ user.username }}</h2>
  <img src="{{ user.getAvatarUrl({size: 90}) }}" height="90" width="90" alt="Profile picture for {{ user.getFullNameOrUsername }}">
  <dl>
    {% if user.getFullName %}
      <dt>Full Name</dt>
      <dd>{{ user.getFullName() }}</dd>
    {% endif %}
    <dt>Email</dt>
    <dd>{{ user.email }}</dd>
  </dl>
{% endblock %}
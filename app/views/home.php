{% extends 'templates/default.php' %}

{% set title = 'Home' %}

{% block content %}
<div class="col s12">
  <div class="card blue">
    <div class="card-content white-text">
      <h3>News</h3>
      {{pagination|raw}}
    </div>
  </div>
</div>
{% endblock %}
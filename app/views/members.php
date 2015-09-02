{% extends 'templates/default.php' %}

{% set title = 'Members' %}

{% block content %}
<div class="col s12">
  <div class="card blue">
    <div class="card-content white-text">
      <h3>Members</h3>
      {{pagination|raw}}
    </div>
  </div>
</div>
{% endblock %}
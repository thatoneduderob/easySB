{% extends 'templates/default.php' %}

{% set title = 'Members' %}

{% block content %}
  <h3>Members</h3>
  <table>
    <tr>
      <td>Name</td>
      <td>Join date</td>
    </tr>
    {{pagination|raw}}
{% endblock %}
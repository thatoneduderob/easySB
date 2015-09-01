<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>{{webSiteName}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="/for_fun/easySB/css/custom.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <header>
      {% include 'templates/partials/navigation.php' %}
    </header>
    <main>
      <div class="row">
        {% include 'templates/partials/left_sidebar.php' %}
        <div class="col s8">
          {% include 'templates/partials/messages.php' %}
          {% block content %}{% endblock %}
        </div>
        {% include 'templates/partials/right_sidebar.php' %}
      </div>
    </main>
    {% include 'templates/partials/footer.php' %}
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
  </body>
</html>
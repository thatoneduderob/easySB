easySB
===================
easySB is a simple website template built using PHP ([Slim framework](http://www.slimframework.com/) and [Twig](http://twig.sensiolabs.org/) for the page templates).

----------
##SQL Data Dump
The provided sql file is just a table dump. It includes only the required settings for the website to run for first launch. Once the site is up and running, you must edit the settings using any mysql database editor of your choice (for settings that can't be changed on the website itself).

----------
##Creating a page
Making a new web-page is fairly simple. There are only a few steps to follow.

1. Create a new PHP file in the folder named 'routes' under 'app/routes' (view **code block 1** below)
2.  Create a new PHP file in the folder named 'views' under 'app/views' (view **code block 2** below)
3. Add your route file to the PHP file named 'routes.php' under 'app/' (view **code block 3** below)

####PLEASE NOTE THAT YOU MAY VIEW EITHER OF THE FILES IN THIS PROJECT TO USE AS AN EXAMPLE

**Code Block 1**
`<?php
  $app->get('/<## address bar path to page ##>', function() use ($app) {
    $app->render('<## path to views files starting from the root of app/views ##>');
  })->name('<## name of route - can be anything but must be unique ##>');`
  
**Code Block 2**
`{% extends 'templates/default.php' %}
{% set title = '<## name of the page - can be anything ##>' %}
{% block content %}
<## content of the page starting from where your template leaves off at this block ##>
{% endblock %}`

**Code Block 3**
`require INC_ROOT.'/app/routes/<## remainder of the path to the route file ##>';`

----------
##Removing a page

1. Delete the route file under 'app/routes'
2. Delete the view file under 'app/views'
3. Remove the `include` line from the 'routes.php' file under 'app/'
4. Remove any line on any page that calls either of those files or the name of its' route

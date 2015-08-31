<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper">
      <ul>
        {% for link in links %}
          <li><a href="{{urlFor(link.route)}}">{{link.title}}</a></li>
        {% endfor %}
      </ul>
    </div>
  </nav>
</div>
<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper">
      <h4 style="text-align:center;margin: 0.912rem 0 0.912rem 0;">{{webSiteName}}</h4>
    </div>
  </nav>
</div>
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
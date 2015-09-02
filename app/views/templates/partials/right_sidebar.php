<div class="sidebar_widget" id="sb_wd">
  <div class="col s3">
    <div class="card blue">
      <div class="card-content white-text">
        {% if auth %}
          <span class="card-title">{{auth.username}}</span>
          <p>{{auth.rank}}</p>
          {% if auth.isAdmin %}
          <p>## [<a href="#">Admin area</a>] ##</p>
          {% endif %}
          <p>[<a href="{{urlFor('user.profile', {id: auth.id})}}">Forum Profile</a>]</p>
          <p>[<a href="#">Account</a>]</p>
          <p><a class="waves-effect waves-light btn white-text" href="{{urlFor('logout')}}">Logout</a></p>
        {% else %}
          <span class="card-title">Your account</span>
          <p>Please <a href="{{urlFor('login')}}">login</a> or <a href="{{urlFor('register')}}">register</a></p>
        {% endif %}
      </div>
    </div>
  </div>
</div>
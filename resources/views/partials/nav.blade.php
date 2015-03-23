<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#home-nav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Code Soda</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="home-nav">
      <ul class="nav navbar-nav">
        @if(Auth::check())
        	<li><a href="/dashboard">Dashboard</a></li>
        	<li><a href="/users/{{Auth::user()->getUsername()}}">Profile</a></li>
        @else 
        	<li><a href="/home">Home</a></li>
        	<li><a href="/users/create">Register</a></li>
        @endif

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="/posts">Posts</a></li>
        <li><a href="/groups">Groups</a></li>

        @if (Auth::check())
          <li><a href="/auth/logout">Logout</a>
        @else
          <li><a href="/auth/login">Login</a>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
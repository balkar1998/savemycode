<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('dashboard') }}">Save My Code</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="nav-link-link"><a href="{{ route('dashboard') }}">{{ Auth::user()->name }}'s {{__('Dashboard') }} <span class="sr-only">(current)</span></a></li>
        <!-- <li><a href="#">Contacts</a></li> -->
      </ul>
      <ul class="mr-2 nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input style="background-color :transparent;color: #fff; padding:0 1em 0 1em;" type="submit" value="Log Out" name="{{ __('Log Out') }}"/>
                </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
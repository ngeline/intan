<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="<?= url_to('profile', user_id()) ?>" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> My Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="/logout" class="dropdown-item">
            <i class="fa fa-sign-out mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
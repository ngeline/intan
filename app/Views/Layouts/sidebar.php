<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Web Pondok</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin Pondok</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <?php if(in_groups('admin')): ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url('/dashboard') ?>" class="nav-link <?php if(url_is('dashboard')):?> active <?php endif; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('/santri') ?>" class="nav-link <?php if(url_is('santri') || url_is('santri/*')):?> active <?php endif; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Santri
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('/wali-santri') ?>" class="nav-link <?php if(url_is('wali-santri') || url_is('wali-santri/*')):?> active <?php endif; ?>">
              <i class="nav-icon fas fa-person-booth"></i>
              <p>
                Wali Santri
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('/kelas') ?>" class="nav-link <?php if(url_is('kelas') || url_is('kelas/*')):?> active <?php endif; ?>">
              <i class="nav-icon fas fa-hotel"></i>
              <p>
                Kelas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('/sumbangan-pembinaan-pendidikan') ?>" class="nav-link <?php if(url_is('sumbangan-pembinaan-pendidikan') || url_is('sumbangan-pembinaan-pendidikan/*')):?> active <?php endif; ?>">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                SPP
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('/user') ?>" class="nav-link <?php if(url_is('user') || url_is('user/*')):?> active <?php endif; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
        </ul>
        <?php endif;?>
        <?php if(in_groups('wali santri')): ?>
          <ul class="nav nav-pills nav-sidebar flex-column"  data-widget="treeview" role="menu" data-accordion="false">

          </ul>
        <?php endif;?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
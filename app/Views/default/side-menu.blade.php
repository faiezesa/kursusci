<?php 
$session = \Config\Services::session();
?>
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="https://idec.upm.edu.my/assets/images/jatanegara.png" class="brand-image img-circle elevation-3" style="opacity: .8">&nbsp;&nbsp;
      <img src="https://idec.upm.edu.my/assets/images/logoupm.png" width="80">&nbsp;&nbsp;&nbsp;
      <img src="https://idec.upm.edu.my/assets/images/50tahun.png" width="35">
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class=" d-flex">
        <div class="brand-link">
          <span class="brand-text font-weight-light">iDEC, UPM</span> 
        </div>
      </div>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <span class="right"><?php echo $session->get('name') ?></span>&nbsp;&nbsp;&nbsp;
          <a href="{!! base_url() !!}/logout" class="text-muted"><i class="fas fa-power-off"></i> Logout</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          
          
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
  
          <li class="nav-item">
            <a href="{!! base_url() !!}/employee" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Employee Data Grid
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Dropdown Menu
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/search/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/search/enhanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu 2</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

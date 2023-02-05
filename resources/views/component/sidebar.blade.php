<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <div class="logo">
        <img src="/asset/shopping-cart.png" width="30" alt="">
        <span class="brand-text font-weight-bold ml-2">Millenial Market</span>
      </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class = "foto-profile">
          <img src="/asset/hacker.png" width="30" alt="">
        </div>
        <div class="info">
          {{-- <img src="/asset/logo.jpg" width="30" alt=""> --}}
          <a href="#" class="d-block" class="font-weight-bold">ALZI</a>
          {{-- <img src="/img/logo1.jpg" alt=""> --}}
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? "active" : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Overview
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/barang" class="nav-link {{ Request::is('dashboard/barang*') ? "active" : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/categories" class="nav-link {{ Request::is('dashboard/categories*') ? "active" : '' }}">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>
          <li class="nav-item">
<a href="#" class="nav-link {{ Request::is('dashboard/reports*') ? "active" : '' }}">
<i class="nav-icon fas fa-newspaper"></i>
<p>
Laporan
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="/dashboard/reports" class="nav-link {{ Request::is('dashboard/reports*') && !Request::is('dashboard/reports/month') ? "active" : '' }}">
<i class="far fa-circle nav-icon"></i>
<p>Harian</p>
</a>
</li>
<li class="nav-item">
<a href="/dashboard/reports/month" class="nav-link {{ Request::is('dashboard/reports/month') ? "active" : '' }}">
<i class="far fa-circle nav-icon"></i>
<p>Bulanan</p>
</a>
</li>
</ul>
</li>
          <li class="nav-item">
            <a href="/dashboard/penjualan" class="nav-link {{ Request::is('dashboard/penjualan*') ? "active" : '' }}">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Penjualan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

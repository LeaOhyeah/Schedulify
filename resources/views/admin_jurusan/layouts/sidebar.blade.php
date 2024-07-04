<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
               <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Schedulify</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->

     <li class="nav-item {{ request()->is('dashboard-jurusan') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin_jurusan.index') }}">

               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Nav Item - Tables -->
     <li class="nav-item {{ request()->is('dashboard-jurusan/agenda*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('agenda.index') }}">
               <i class="fas fa-fw fa-calendar"></i>
               <span>Agenda</span></a>
     </li>

     <!-- Nav Item - Pages Collapse Menu -->
     <!-- <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
               aria-controls="collapseTwo">
               <i class="fas fa-fw fa-cog"></i>
               <span>Manajemen Agenda</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="buttons.html">Presensi Kehadiran</a>
                    <a class="collapse-item" href="cards.html">Notulensi</a>
               </div>
          </div>
     </li> -->

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>



</ul>
<!-- End of Sidebar -->
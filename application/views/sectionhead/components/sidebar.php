<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background-color: rgb(28 30 31);">
        <img src="<?= base_url();?>assets/login/images/pt.ppa.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Putra Perkasa Abadi</b></span>
    </a>
    <style>
        .bg-s{
            background: rgb(30,30,30) !important
        }
    </style>
    <!-- Sidebar -->
    <div class="sidebar bg-s">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url();?>assets/admin_lte/dist/img/orang.png" class="img-circle elevation-2"
                    alt="User Image">
            </div>
                <div class="info">
                    <a href="#" class="d-block"><?=$this->session->userdata('nama');?></a>
                </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url();?>dashboardsh" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>approvalsh" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Approval</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>laporanms/section_head" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url();?>assets/login/images/rsamc3.jpg" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">WEB-CUTI | RS AMC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url();?>assets/admin_lte/dist/img/account.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=$this->session->userdata('nama_lengkap');?></a>
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
                    <a href="<?= base_url();?>Dashboard/dashboard_pegawai" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Cuti/view_pegawai/<?=$this->session->userdata('id_user');?>" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Data Cuti</p>
                    </a>
                </li>
                <li class="nav-item" style="<?php echo  $pegawai['nama_lengkap'] == '' ? 'display:none;' : ' ' ?>">
                    <a href="<?= base_url();?>Form_Cuti/view_pegawai" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Permohonan Cuti</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Upload/view_pegawai" class="nav-link">
                        <i class="nav-icon fas fa-upload"></i>
                        <p>Upload Dokumen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Settings/view_pegawai" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

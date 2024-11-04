<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/components/header.php") ?>
    <!-- <style>
        .bg-warning, .bg-orange {
            color: #000;
        }
    </style> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Ditambahkan!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Ditambahkan!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('edit')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Diedit!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_edit')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Diedit!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('hapus')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Dihapus!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_hapus')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Dihapus !",
        icon: "error"
    });
    </script>
    <?php } ?>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url();?>assets/admin_lte/dist/img/Loading.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("admin/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("admin/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Kains</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Kains</li>
                            </ol>
                        </div><!-- /.col -->

                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                            data-target="#exampleModal">
                            Tambah Kains
                        </button>
                        <br>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Kains</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="aktif-tab" data-toggle="tab" href="#aktif" role="tab" aria-controls="aktif" aria-selected="true">Aktif</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tidak-aktif-tab" data-toggle="tab" href="#tidak-aktif" role="tab" aria-controls="tidak-aktif" aria-selected="false">Tidak Aktif</a>
                                        </li>
                                    </ul>
                                    <br>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="aktif" role="tabpanel" aria-labelledby="aktif-tab">
                                            <table id="tabel-aktif" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Kains</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no_aktif = 0;
                                                    foreach($kains as $i):
                                                        if ($i['status'] == 'aktif'):
                                                            $no_aktif++;
                                                            $id_user = $i['id_user'];
                                                            $nama_lengkap = $i['nama_lengkap'];
                                                            $id_unit = $i['id_unit'];
                                                            $jenis_kelamin = $i['jenis_kelamin'];
                                                            $masa_berlaku_sip = $i['masa_berlaku_sip'];
                                                            
                                                            $row_class = '';
                                                            if (empty($masa_berlaku_sip) || $masa_berlaku_sip == '0000-00-00') {
                                                                $row_class = 'bg-warning';
                                                            } elseif (strtotime($masa_berlaku_sip) < strtotime('+6 months')) {
                                                                $row_class = 'bg-orange';
                                                            }

                                                            // Cek apakah data tidak sesuai dengan syarat
                                                            if (
                                                                strlen($i['nik']) != 16 ||
                                                                (strlen($i['no_bpjs']) > 0 && (strlen($i['no_bpjs']) < 10 || strlen($i['no_bpjs']) > 13)) ||
                                                                (strlen($i['no_bpjs_tk']) > 0 && (strlen($i['no_bpjs_tk']) < 8 || strlen($i['no_bpjs_tk']) > 11)) ||
                                                                (strlen($i['wa_aktif']) > 0 && (strlen($i['wa_aktif']) < 8 || strlen($i['wa_aktif']) > 14)) ||
                                                                (strlen($i['wa_kerabat']) > 0 && (strlen($i['wa_kerabat']) < 8 || strlen($i['wa_kerabat']) > 14))
                                                            ) {
                                                                $row_class = 'bg-green';
                                                            }
                                                    ?>
                                                    <tr class="<?= $row_class ?>">
                                                        <td data-row-number></td>
                                                        <td><?= $nama_lengkap ?></td>
                                                        <td>
                                                            <?php
                                                            foreach($unit as $u) {
                                                                if($u['id_unit'] == $id_unit) {
                                                                    echo $u['nama_unit'];
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $jenis_kelamin ?></td>
                                                        <td>
                                                    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_data_kains<?=$id_user?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="" data-toggle="modal" data-target="#hapus<?=$id_user?>" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Modal Hapus Data Kains -->
                                            <div class="modal fade" id="hapus<?= $id_user ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data
                                                                Kains
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo base_url()?>Kains/hapus_kains"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="id_user"
                                                                            value="<?php echo $id_user?>" />
                                                                        <p>Apakah kamu yakin ingin menghapus data
                                                                            ini?</i></b></p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger ripple"
                                                                        data-dismiss="modal">Tidak</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success ripple save-category">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    <?php
                                                        endif;
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tidak-aktif" role="tabpanel" aria-labelledby="tidak-aktif-tab">
                                            <table id="tabel-tidak-aktif" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Kains</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no_aktif = 0;
                                                    foreach($kains as $i):
                                                        if ($i['status'] == 'tidak aktif'):
                                                            $no_aktif++;
                                                            $id_user = $i['id_user'];
                                                            $nama_lengkap = $i['nama_lengkap'];
                                                            $id_unit = $i['id_unit'];
                                                            $jenis_kelamin = $i['jenis_kelamin'];
                                                            $masa_berlaku_sip = $i['masa_berlaku_sip'];
                                                            
                                                            $row_class = '';
                                                            if (empty($masa_berlaku_sip) || $masa_berlaku_sip == '0000-00-00') {
                                                                $row_class = 'bg-warning';
                                                            } elseif (strtotime($masa_berlaku_sip) < strtotime('+6 months')) {
                                                                $row_class = 'bg-orange';
                                                            }
                                                    ?>
                                                    <tr class="<?= $row_class ?>">
                                                        <td data-row-number></td>
                                                        <td><?= $nama_lengkap ?></td>
                                                        <td>
                                                            <?php
                                                            foreach($unit as $u) {
                                                                if($u['id_unit'] == $id_unit) {
                                                                    echo $u['nama_unit'];
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $jenis_kelamin ?></td>
                                                        <td>
                                                    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_data_kains<?=$id_user?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="" data-toggle="modal" data-target="#hapus<?=$id_user?>" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Modal Hapus Data Kains -->
                                            <div class="modal fade" id="hapus<?= $id_user ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data
                                                                Kains
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo base_url()?>Kains/hapus_kains"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="id_user"
                                                                            value="<?php echo $id_user?>" />
                                                                        <p>Apakah kamu yakin ingin menghapus data
                                                                            ini?</i></b></p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger ripple"
                                                                        data-dismiss="modal">Tidak</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success ripple save-category">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    <?php
                                                        endif;
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
             <!-- Modal Edit Kains -->
            <?php foreach ($kains as $p): ?>
            <div class="modal fade" id="edit_data_kains<?= $p['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Kains</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url(); ?>Kains/edit_kains" method="POST" id="formEditKains<?= $p['id_user'] ?>">
                                <input type="hidden" name="id_user" value="<?= $p['id_user'] ?>">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap*</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $p['nama_lengkap'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_unit">Unit Kerja</label>
                                    <select class="form-control" id="id_unit" name="id_unit" required>
                                        <?php foreach($unit as $u): ?>
                                            <option value="<?= $u['id_unit'] ?>" <?= ($u['id_unit'] == $p['id_unit']) ? 'selected' : '' ?>><?= $u['nama_unit'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $p['tempat_lahir'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $p['tanggal_lahir'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="id_jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="id_jenis_kelamin" name="id_jenis_kelamin">
                                        <?php foreach($jenis_kelamin_p as $jk): ?>
                                            <option value="<?= $jk['id_jenis_kelamin'] ?>" <?= ($jk['id_jenis_kelamin'] == $p['id_jenis_kelamin']) ? 'selected' : '' ?>><?= $jk['jenis_kelamin'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK*</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $p['nik'] ?>" required pattern="\<d>16</d>" title="NIK harus 16 digit angka dan unik" maxlength="16">
                                </div>
                                <div class="form-group">
                                    <label for="no_bpjs">No. BPJS</label>
                                    <input type="text" class="form-control" id="no_bpjs" name="no_bpjs" value="<?= $p['no_bpjs'] ?>" pattern="\d{10,13}" title="No. BPJS harus 10-13 digit angka">
                                </div>
                                <div class="form-group">
                                    <label for="no_bpjs_tk">No. BPJS TK</label>
                                    <input type="text" class="form-control" id="no_bpjs_tk" name="no_bpjs_tk" value="<?= $p['no_bpjs_tk'] ?>" pattern="\d{8,11}" title="No. BPJS TK harus 8-11 digit angka">
                                </div>
                                <div class="form-group">
                                    <label for="alamat_ktp">Alamat KTP</label>
                                    <textarea class="form-control" id="alamat_ktp" name="alamat_ktp"><?= $p['alamat_ktp'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_domisili">Alamat Domisili</label>
                                    <textarea class="form-control" id="alamat_domisili" name="alamat_domisili"><?= $p['alamat_domisili'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="wa_aktif">WA Aktif</label>
                                    <input type="text" class="form-control" id="wa_aktif" name="wa_aktif" value="<?= $p['wa_aktif'] ?>" pattern="\d{8,14}" title="WA Aktif harus 8-14 digit angka">
                                </div>
                                <div class="form-group">
                                    <label for="wa_kerabat">WA Kerabat</label>
                                    <input type="text" class="form-control" id="wa_kerabat" name="wa_kerabat" value="<?= $p['wa_kerabat'] ?>" pattern="\d{8,14}" title="WA Kerabat harus 8-14 digit angka">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $p['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="asal_pt">Asal Perguruan Tinggi</label>
                                    <input type="text" class="form-control" id="asal_pt" name="asal_pt" value="<?= $p['asal_pt'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="no_ijazah">No. Ijazah</label>
                                    <input type="text" class="form-control" id="no_ijazah" name="no_ijazah" value="<?= $p['no_ijazah'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lulus">Tanggal Lulus</label>
                                    <input type="date" class="form-control" id="tanggal_lulus" name="tanggal_lulus" value="<?= $p['tanggal_lulus'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="profesi_str">Profesi Sesuai STR</label>
                                    <input type="text" class="form-control" id="profesi_str" name="profesi_str" value="<?= $p['profesi_str'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="no_str">No. STR</label>
                                    <input type="text" class="form-control" id="no_str" name="no_str" value="<?= $p['no_str'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_terbit_str">Tanggal Terbit STR</label>
                                    <input type="date" class="form-control" id="tanggal_terbit_str" name="tanggal_terbit_str" value="<?= $p['tanggal_terbit_str'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="masa_berlaku_str">Masa Berlaku STR</label>
                                    <input type="date" class="form-control" id="masa_berlaku_str" name="masa_berlaku_str" value="<?= $p['masa_berlaku_str'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="no_sip">No. SIP</label>
                                    <input type="text" class="form-control" id="no_sip" name="no_sip" value="<?= $p['no_sip'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_terbit_sip">Tanggal Terbit SIP</label>
                                    <input type="date" class="form-control" id="tanggal_terbit_sip" name="tanggal_terbit_sip" value="<?= $p['tanggal_terbit_sip'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="masa_berlaku_sip">Masa Berlaku SIP</label>
                                    <input type="date" class="form-control" id="masa_berlaku_sip" name="masa_berlaku_sip" value="<?= $p['masa_berlaku_sip'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nama_faskes_sip">Nama Faskes SIP</label>
                                    <input type="text" class="form-control" id="nama_faskes_sip" name="nama_faskes_sip" value="<?= $p['nama_faskes_sip'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="aktif" <?= ($p['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                                        <option value="tidak aktif" <?= ($p['status'] == 'tidak aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- Modal Tambah Kains -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Kains</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>Kains/tambah_kains" method="POST" id="formTambahKains">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap*</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_unit">Unit Kerja</label>
                                    <select class="form-control" id="id_unit" name="id_unit" required>
                                        <?php foreach($unit as $u): ?>
                                            <option value="<?= $u['id_unit'] ?>" <?= ($u['id_unit'] == $p['id_unit']) ? 'selected' : '' ?>><?= $u['nama_unit'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                </div>
                                <div class="form-group">
                                    <label for="id_jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="id_jenis_kelamin" name="id_jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <?php foreach($jenis_kelamin_p as $jk): ?>
                                            <option value="<?= $jk['id_jenis_kelamin'] ?>"><?= $jk['jenis_kelamin'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK*</label>
                                    <input type="text" class="form-control" id="nik" name="nik" required pattern="\d{16}" title="NIK harus 16 digit angka dan unik" maxlength="16">
                                </div>
                                <div class="form-group">
                                    <label for="no_bpjs">No. BPJS</label>
                                    <input type="text" class="form-control" id="no_bpjs" name="no_bpjs" pattern="\d{10,13}" title="No. BPJS harus 10-13 digit angka">
                                </div>
                                <div class="form-group">
                                    <label for="no_bpjs_tk">No. BPJS TK</label>
                                    <input type="text" class="form-control" id="no_bpjs_tk" name="no_bpjs_tk" pattern="\d{8,11}" title="No. BPJS TK harus 8-11 digit angka">
                                </div>
                                <div class="form-group">
                                    <label for="alamat_ktp">Alamat KTP</label>
                                    <textarea class="form-control" id="alamat_ktp" name="alamat_ktp"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_domisili">Alamat Domisili</label>
                                    <textarea class="form-control" id="alamat_domisili" name="alamat_domisili"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="wa_aktif">WA Aktif</label>
                                    <input type="text" class="form-control" id="wa_aktif" name="wa_aktif" pattern="\d{8,14}" title="WA Aktif harus 8-14 digit angka">
                                </div>
                                <div class="form-group">
                                    <label for="wa_kerabat">WA Kerabat</label>
                                    <input type="text" class="form-control" id="wa_kerabat" name="wa_kerabat" pattern="\d{8,14}" title="WA Kerabat harus 8-14 digit angka">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="asal_pt">Asal Perguruan Tinggi</label>
                                    <input type="text" class="form-control" id="asal_pt" name="asal_pt">
                                </div>
                                <div class="form-group">
                                    <label for="no_ijazah">No. Ijazah</label>
                                    <input type="text" class="form-control" id="no_ijazah" name="no_ijazah">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lulus">Tanggal Lulus</label>
                                    <input type="date" class="form-control" id="tanggal_lulus" name="tanggal_lulus">
                                </div>
                                <div class="form-group">
                                    <label for="profesi_str">Profesi Sesuai STR</label>
                                    <input type="text" class="form-control" id="profesi_str" name="profesi_str">
                                </div>
                                <div class="form-group">
                                    <label for="no_str">No. STR</label>
                                    <input type="text" class="form-control" id="no_str" name="no_str">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_terbit_str">Tanggal Terbit STR</label>
                                    <input type="date" class="form-control" id="tanggal_terbit_str" name="tanggal_terbit_str">
                                </div>
                                <div class="form-group">
                                    <label for="masa_berlaku_str">Masa Berlaku STR</label>
                                    <input type="date" class="form-control" id="masa_berlaku_str" name="masa_berlaku_str">
                                </div>
                                <div class="form-group">
                                    <label for="no_sip">No. SIP</label>
                                    <input type="text" class="form-control" id="no_sip" name="no_sip">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_terbit_sip">Tanggal Terbit SIP</label>
                                    <input type="date" class="form-control" id="tanggal_terbit_sip" name="tanggal_terbit_sip">
                                </div>
                                <div class="form-group">
                                    <label for="masa_berlaku_sip">Masa Berlaku SIP</label>
                                    <input type="date" class="form-control" id="masa_berlaku_sip" name="masa_berlaku_sip">
                                </div>
                                <div class="form-group">
                                    <label for="nama_faskes_sip">Nama Faskes SIP</label>
                                    <input type="text" class="form-control" id="nama_faskes_sip" name="nama_faskes_sip">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("admin/components/js.php") ?>

    <script>
    $(document).ready(function() {
        var table = $('#tabel-aktif').DataTable({
            destroy: true,
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [[1, 'asc']] // Default sort by nama kains column
        });

        // Penomoran default
        table.on('order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        // Penomoran saat melakukan pencarian
        $('#tabel-aktif_filter input').on('keyup', function() {
            table.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        });

        var table_tidak_aktif = $('#tabel-tidak-aktif').DataTable({
            destroy: true,
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [[1, 'asc']] // Default sort by nama kains column
        });

        // Penomoran default
        table_tidak_aktif.on('order.dt search.dt', function () {
            table_tidak_aktif.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        // Penomoran saat melakukan pencarian
        $('#tabel-tidak-aktif_filter input').on('keyup', function() {
            table_tidak_aktif.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        });
    });
    </script>

    <!-- Tambahkan ini di bagian atas file, setelah semua include JavaScript lainnya -->
    <script>
    // Panggil fungsi ini saat halaman dimuat untuk mengatur status awal
    document.addEventListener('DOMContentLoaded', function() {
        var addSelect = document.getElementById('id_unit');
        if (addSelect) {
            toggleMedicalFields(addSelect, '');
        }
        
        // Untuk setiap form edit
        <?php foreach ($kains as $p): ?>
        var editSelect<?= $p['id_user'] ?> = document.getElementById('edit_id_unit<?= $p['id_user'] ?>');
        if (editSelect<?= $p['id_user'] ?>) {
            toggleMedicalFields(editSelect<?= $p['id_user'] ?>, 'edit_');
        }
        <?php endforeach; ?>
    });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("kains/components/header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Status Cuti Berhasil Diubah!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <div class="wrapper">
        <!-- Navbar & Sidebar -->
        <?php 
        $this->load->view("kains/components/navbar.php", array('kains' => $kains, 'kains_data' => $kains_data));
        $this->load->view("kains/components/sidebar.php", array('kains' => $kains));
        ?>

        <!-- Content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Verifikasi Cuti</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Lengkap</th>
                                                <th>Alasan</th>
                                                <th>Tanggal Diajukan</th>
                                                <th>Mulai</th>
                                                <th>Berakhir</th>
                                                <th>Status Cuti</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach($cuti as $i): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $i['nama_lengkap'] ?></td>
                                                <td><?= $i['alasan'] ?></td>
                                                <td><?= $i['tgl_diajukan'] ?></td>
                                                <td><?= $i['mulai'] ?></td>
                                                <td><?= $i['berakhir'] ?></td>
                                                <td>
                                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                                </td>
                                                <td>
                                                    <?php if($i['id_unit'] == $kains['id_unit']) { ?>
                                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTerima<?= $i['id_cuti'] ?>">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalTolak<?= $i['id_cuti'] ?>">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-secondary btn-sm" disabled title="Bukan unit Anda">
                                                            <i class="fas fa-lock"></i>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <!-- Modal Terima -->
                                            <div class="modal fade" id="modalTerima<?= $i['id_cuti'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Terima Pengajuan Cuti</h5>
                                                        </div>
                                                        <form action="<?= base_url('Cuti/proses_verifikasi_kains') ?>" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_cuti" value="<?= $i['id_cuti'] ?>">
                                                                <input type="hidden" name="id_status_cuti" value="2">
                                                                <div class="form-group">
                                                                    <label>Alasan Menerima</label>
                                                                    <textarea class="form-control" name="alasan_verifikasi" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Terima</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Tolak -->
                                            <div class="modal fade" id="modalTolak<?= $i['id_cuti'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Tolak Pengajuan Cuti</h5>
                                                        </div>
                                                        <form action="<?= base_url('Cuti/proses_verifikasi_kains') ?>" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_cuti" value="<?= $i['id_cuti'] ?>">
                                                                <input type="hidden" name="id_status_cuti" value="3">
                                                                <div class="form-group">
                                                                    <label>Alasan Menolak</label>
                                                                    <textarea class="form-control" name="alasan_verifikasi" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php $this->load->view("kains/components/js.php") ?>
    </div>
</body>
</html>

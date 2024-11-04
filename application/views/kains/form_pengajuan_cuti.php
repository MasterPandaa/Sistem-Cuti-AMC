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
        text: "Data Berhasil Ditambahkan!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_input')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Ditambahkan!",
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
        <?php $this->load->view("kains/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("kains/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Form Permohonan Cuti</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Setting</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <form action="<?= base_url();?>Form_Cuti/proses_cuti_kains" method="POST" enctype="multipart/form-data">
                        <input type="text" value="<?=$this->session->userdata('id_user') ?>" name="id_user" hidden>
                        <div class="form-group">
                            <label for="alasan">Alasan</label>
                            <textarea class="form-control" id="alasan" rows="3" name="alasan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jenis_cuti">Jenis Cuti</label>
                            <select class="form-control" id="jenis_cuti" name="jenis_cuti" required>
                                <option value="">-- Pilih Jenis Cuti --</option>
                                <?php foreach($jenis_cuti as $jc) : ?>
                                    <option value="<?= $jc['id'] ?>"><?= $jc['jenis_cuti'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rekan_pengganti">Rekan Pengganti</label>
                            <input type="text" class="form-control" id="rekan_pengganti" aria-describedby="rekan_pengganti"
                                name="rekan_pengganti" required>
                        </div>
                        <div class="form-group">
                            <label for="mulai">Mulai Cuti</label>
                            <input type="date" class="form-control" id="mulai" aria-describedby="mulai" name="mulai"
                                min="" required>
                            <small class="form-text text-muted">*Pengajuan cuti harus dilakukan minimal 3 hari sebelum tanggal mulai cuti</small>
                        </div>
                        <div class="form-group">
                            <label for="berakhir">Berakhir Cuti</label>
                            <input type="date" class="form-control" id="berakhir" aria-describedby="berakhir"
                                name="berakhir" required>

                        </div>

                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                    </form>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("kains/components/js.php") ?>
    <script>
    // Set minimal tanggal mulai cuti (3 hari dari sekarang)
    const today = new Date();
    const minDate = new Date(today);
    minDate.setDate(today.getDate() + 3);
    document.getElementById('mulai').min = minDate.toISOString().split('T')[0];

    // Validasi saat form disubmit
    document.querySelector('form').addEventListener('submit', function(e) {
        const mulaiDate = new Date(document.getElementById('mulai').value);
        const today = new Date();
        const diffTime = Math.abs(mulaiDate - today);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays < 3) {
            e.preventDefault();
            swal({
                title: "Error!",
                text: "Pengajuan cuti harus dilakukan minimal 3 hari sebelum tanggal mulai cuti!",
                icon: "error"
            });
        }
    });
    </script>
</body>

</html>
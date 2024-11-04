<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("kains/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Ditambahkan!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')) { ?>
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
            <img class="animation__shake" src="<?= base_url(); ?>assets/admin_lte/dist/img/Loading.png" alt="AdminLTELogo" height="60" width="60">
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
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Syarat Permohonan Cuti</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="accordion" id="accordionCuti">
                                        <?php
                                        $cutiTypes = [
                                            'Cuti Tahunan' => [
                                                'Diberikan sebanyak 12 hari setelah bekerja minimal 12 (dua belas) bulan berturut-turut dengan tetap mendapat gaji full/penuh dengan maksimal diambil 9 hari, sisanya 3 hari dapat dialokasikan saat hari raya lebaran.',
                                                'Diberikan setelah batas waktu 1 tahun setelah penandatanganan kontrak kerja.',
                                                'Hak cuti tahunan yang tidak diambil dalam tahun berjalan tidak dapat diuangkan dan tidak dapat diambil dalam tahun berikutnya (hilang/hangus secara otomatis).',
                                                'Tidak berlaku cuti bersama yang ditetapkan pemerintah, apabila mengikuti cuti bersama mengikuti surat edaran.',
                                                'Pengambilan cuti tahunan diajukan kepada atasan langsung dengan persetujuan, demi keberlangsungan pelayanan kepada pasien di RS wajib disertai dengan penyerahan pelimpahan tugas secara tertulis.',
                                                'Pelimpahan tugas staf dapat diberikan kepada rekan kerja yang dipercayakan mampu/berkompeten.',
                                                'Pelimpahan tugas dan tanggung jawab pejabat struktural diambil alih oleh pejabat 1 level di atasnya dan dalam kondisi tertentu dapat diberikan kepada staf yang dipercayakan mampu/berkompeten.',
                                                'Pengajuan cuti minimal 3 hari sebelum pelaksanaan cuti.'
                                            ],
                                            'Cuti Besar' => [
                                                'Diberikan kepada karyawan tetap yang telah memiliki masa kerja 6 tahun berturut-turut.',
                                                'Cuti besar diajukan kepada atasan langsung dan sepengetahuan dari Direksi dan dilaksanakan pada tahun ke-7 dan ke-8 dengan lama cuti masing-masing selama 1 bulan.'
                                            ],
                                            'Cuti Melahirkan' => [
                                                'Diberikan selama 3 bulan dengan ketentuan 1,5 bulan sebelum hari perkiraan lahir dan 1,5 bulan setelah melahirkan menurut perhitungan dokter kandungan/bidan (surat keterangan HPL).',
                                                'Diberikan kepada karyawan maksimal 3x persalinan (anak ke-1, 2, dan 3), lebih dari 3x persalinan maka dapat mengajukan cuti diluar tanggungan.',
                                                'Bagi karyawan yang mengalami keguguran diberikan 1,5 bulan atau maksimal 45 hari berdasarkan surat keterangan dokter kandungan/bidan.',
                                                'Cuti melahirkan tidak menghapuskan/menghilangkan cuti tahunan dan cuti besar (pengambilan dapat dilaksanakan 1 tahun setelah cuti melahirkan).'
                                            ],
                                            'Cuti Ibadah' => [
                                                'Diberikan kepada karyawan yang bermaksud menunaikan ibadah haji dan umroh, sesuai dengan waktu yang ditetapkan oleh pemerintah (Depag).',
                                                'Diajukan minimal 2 bulan sebelum pelaksanaan ibadah haji dan umroh.'
                                            ],
                                            'Cuti Alasan Penting' => [
                                                'Diberikan kepada karyawan dengan tetap mendapatkan upah, antara lain:',
                                                'Karyawan menikah selama 5 hari.',
                                                'Karyawan menikahkan anaknya selama 3 hari.',
                                                'Karyawan mengkhitankan anaknya selama 1 hari.',
                                                'Istri karyawan melahirkan/keguguran selama 2 hari.',
                                                'Anggota keluarga karyawan (suami/istri, orangtua/mertua, anak/menantu, kakek/nenek, saudara kandung) meninggal dunia selama 2 hari.',
                                                'Suami/istri, orangtua/mertua, anak/menantu sakit selama 1 hari.',
                                                'Karyawan sakit wajib memberikan surat keterangan dokter.'
                                            ],
                                            'Cuti Diluar Tanggungan' => [
                                                'Diajukan kepada atasan langsung dan dengan sepengetahuan dari direksi.'
                                            ]
                                        ];

                                        foreach ($cutiTypes as $type => $rules) : ?>
                                            <div class="card">
                                                <div class="card-header" id="heading<?= str_replace(' ', '', $type) ?>">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= str_replace(' ', '', $type) ?>" aria-expanded="true" aria-controls="collapse<?= str_replace(' ', '', $type) ?>">
                                                            <?= $type ?>
                                                        </button>
                                                    </h2>
                                                </div>

                                                <div id="collapse<?= str_replace(' ', '', $type) ?>" class="collapse" aria-labelledby="heading<?= str_replace(' ', '', $type) ?>" data-parent="#accordionCuti">
                                                    <div class="card-body">
                                                        <p>Ketentuan:</p>
                                                        <ol>
                                                            <?php foreach ($rules as $rule) : ?>
                                                                <li><?= $rule ?></li>
                                                            <?php endforeach; ?>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
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
</body>

</html>
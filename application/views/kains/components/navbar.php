<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a type="button" href="#" class="dropdown-item dropdown-footer" data-toggle="modal"
                    data-target="#exampleModal">Lengkapi Data</a>
                <a href="<?= base_url();?>Login/log_out" class="dropdown-item dropdown-footer">Logout</a>
            </div>
        </li>
    </ul>
</nav>

<!-- Modal Lengkapi Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lengkapi Data Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php foreach($kains_data as $i): ?>
                <form method="post" action="<?php echo base_url('Settings/lengkapi_data'); ?>" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$i['id_user'];?>" name="id">
                    
                    <!-- Data yang tidak dapat diubah -->
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?=$i['nama_lengkap']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_unit">Unit Kerja</label>
                        <select class="form-control" id="id_unit" name="id_unit" disabled>
                            <?php foreach($unit as $u): ?>
                                <option value="<?= $u['id_unit'] ?>" <?= ($u['id_unit'] == $i['id_unit']) ? 'selected' : '' ?>><?= $u['nama_unit'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?=$i['tempat_lahir']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?=$i['tanggal_lahir']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="id_jenis_kelamin" name="id_jenis_kelamin" disabled>
                            <?php foreach($jenis_kelamin_p as $jk): ?>
                                <option value="<?= $jk['id_jenis_kelamin'] ?>" <?= ($jk['id_jenis_kelamin'] == $i['id_jenis_kelamin']) ? 'selected' : '' ?>><?= $jk['jenis_kelamin'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?=$i['nik']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="no_bpjs">No. BPJS</label>
                        <input type="text" class="form-control" id="no_bpjs" name="no_bpjs" value="<?=$i['no_bpjs']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="no_bpjs_tk">No. BPJS-TK</label>
                        <input type="text" class="form-control" id="no_bpjs_tk" name="no_bpjs_tk" value="<?=$i['no_bpjs_tk']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="asal_pt">Asal Perguruan Tinggi</label>
                        <input type="text" class="form-control" id="asal_pt" name="asal_pt" value="<?=$i['asal_pt']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="no_ijazah">No. Ijazah</label>
                        <input type="text" class="form-control" id="no_ijazah" name="no_ijazah" value="<?=$i['no_ijazah']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="tanggal_lulus">Tanggal Lulus</label>
                        <input type="date" class="form-control" id="tanggal_lulus" name="tanggal_lulus" value="<?=$i['tanggal_lulus']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="profesi_str">Profesi sesuai STR</label>
                        <input type="text" class="form-control" id="profesi_str" name="profesi_str" value="<?=$i['profesi_str']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="no_str">No. STR</label>
                        <input type="text" class="form-control" id="no_str" name="no_str" value="<?=$i['no_str']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="no_sip">No. SIP</label>
                        <input type="text" class="form-control" id="no_sip" name="no_sip" value="<?=$i['no_sip']?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="nama_faskes_sip">Nama Faskes SIP</label>
                        <input type="text" class="form-control" id="nama_faskes_sip" name="nama_faskes_sip" value="<?=$i['nama_faskes_sip']?>" readonly>
                    </div>
                    
                    <!-- Data yang dapat diubah -->
                    <div class="form-group">
                        <label for="alamat_ktp">Alamat KTP</label>
                        <textarea class="form-control" id="alamat_ktp" name="alamat_ktp" rows="3"><?=$i['alamat_ktp']?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat_domisili">Alamat Domisili</label>
                        <textarea class="form-control" id="alamat_domisili" name="alamat_domisili" rows="3"><?=$i['alamat_domisili']?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="wa_aktif">WA Aktif</label>
                        <input type="text" class="form-control" id="wa_aktif" name="wa_aktif" value="<?=$i['wa_aktif']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="wa_kerabat">WA Kerabat</label>
                        <input type="text" class="form-control" id="wa_kerabat" name="wa_kerabat" value="<?=$i['wa_kerabat']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?=$i['email']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="tanggal_terbit_str">Tanggal Terbit STR</label>
                        <input type="date" class="form-control" id="tanggal_terbit_str" name="tanggal_terbit_str" value="<?=$i['tanggal_terbit_str']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="masa_berlaku_str">Masa Berlaku STR</label>
                        <input type="date" class="form-control" id="masa_berlaku_str" name="masa_berlaku_str" value="<?=$i['masa_berlaku_str']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="tanggal_terbit_sip">Tanggal Terbit SIP</label>
                        <input type="date" class="form-control" id="tanggal_terbit_sip" name="tanggal_terbit_sip" value="<?=$i['tanggal_terbit_sip']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="masa_berlaku_sip">Masa Berlaku SIP</label>
                        <input type="date" class="form-control" id="masa_berlaku_sip" name="masa_berlaku_sip" value="<?=$i['masa_berlaku_sip']?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
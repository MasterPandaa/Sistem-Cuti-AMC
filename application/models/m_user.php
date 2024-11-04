<?php

class M_user extends CI_Model
{

    public function get_all_pegawai()
    {
        $this->db->select('user.*, user_detail.*, unit.nama_unit, jenis_kelamin.jenis_kelamin');
        $this->db->from('user');
        $this->db->join('user_detail', 'user.id_user = user_detail.id_user_detail');
        $this->db->join('unit', 'user_detail.id_unit = unit.id_unit', 'left');
        $this->db->join('jenis_kelamin', 'user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin', 'left');
        $this->db->where('user.id_user_level', 1);
        return $this->db->get();
    }

    public function count_all_pegawai()
    {
        $hasil = $this->db->query('SELECT COUNT(id_user) as total_user FROM user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail 
        JOIN jenis_kelamin ON user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin 
        WHERE id_user_level = 1');
        return $hasil;
    }

    public function count_all_admin()
    {
        $hasil = $this->db->query('SELECT COUNT(id_user) as total_user FROM user
        WHERE id_user_level = 2');
        return $hasil;
    }

    public function get_all_admin()
    {
        $hasil = $this->db->query('SELECT * FROM user
        WHERE id_user_level = 2');
        return $hasil;
    }

    public function get_pegawai_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT * FROM user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail 
        WHERE user.id_user='$id_user'");
        return $hasil;
    }

    public function cek_login($login_id)
    {
        $this->db->select('user.*, user_detail.*');
        $this->db->from('user');
        $this->db->join('user_detail', 'user.id_user_detail = user_detail.id_user_detail');
        $this->db->where('user.username', $login_id);
        return $this->db->get();
    }

    public function pendaftaran_user($id, $username, $email, $password, $id_user_level)
    {
       $this->db->trans_start();

       $this->db->query("INSERT INTO user(id_user,username,password,email,id_user_level, id_user_detail) VALUES ('$id','$username','$password','$email','$id_user_level','$id')");
       $this->db->query("INSERT INTO user_detail(id_user_detail) VALUES ('$id')");
       $this->db->query("INSERT INTO sisa_cuti(id_user) VALUES ('$id')");

       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function update_user_detail($id, $data)
    {
        // Siapkan array untuk update
        $update_data = array();
        
        // Cek dan tambahkan field yang ada saja
        if(isset($data['username'])) $update_data['username'] = $data['username'];
        if(isset($data['nama_lengkap'])) $update_data['nama_lengkap'] = $data['nama_lengkap']; 
        if(isset($data['id_unit'])) $update_data['id_unit'] = $data['id_unit'];
        if(isset($data['tempat_lahir'])) $update_data['tempat_lahir'] = $data['tempat_lahir'];
        if(isset($data['tanggal_lahir'])) $update_data['tanggal_lahir'] = $data['tanggal_lahir'];
        if(isset($data['id_jenis_kelamin'])) $update_data['id_jenis_kelamin'] = $data['id_jenis_kelamin'];
        if(isset($data['nik'])) $update_data['nik'] = $data['nik'];
        if(isset($data['no_bpjs'])) $update_data['no_bpjs'] = $data['no_bpjs'];
        if(isset($data['no_bpjs_tk'])) $update_data['no_bpjs_tk'] = $data['no_bpjs_tk'];
        if(isset($data['asal_pt'])) $update_data['asal_pt'] = $data['asal_pt'];
        if(isset($data['no_ijazah'])) $update_data['no_ijazah'] = $data['no_ijazah'];
        if(isset($data['tanggal_lulus'])) $update_data['tanggal_lulus'] = $data['tanggal_lulus'];
        if(isset($data['profesi_str'])) $update_data['profesi_str'] = $data['profesi_str'];
        if(isset($data['no_str'])) $update_data['no_str'] = $data['no_str'];
        if(isset($data['no_sip'])) $update_data['no_sip'] = $data['no_sip'];
        if(isset($data['nama_faskes_sip'])) $update_data['nama_faskes_sip'] = $data['nama_faskes_sip'];

        // Update hanya jika ada data yang akan diupdate
        if(!empty($update_data)) {
            $this->db->where('id_user_detail', $id);
            return $this->db->update('user_detail', $update_data);
        }
        
        return false;
    }

    public function insert_pegawai($id, $nik, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $id_unit, $tempat_lahir, $tanggal_lahir, $no_bpjs, $no_bpjs_tk, $alamat_ktp, $alamat_domisili, $wa_aktif, $wa_kerabat, $asal_pt, $no_ijazah, $tanggal_lulus, $profesi_str, $no_str, $tanggal_terbit_str, $masa_berlaku_str, $no_sip, $tanggal_terbit_sip, $masa_berlaku_sip, $nama_faskes_sip, $status)
    {
        $this->db->trans_start();

        $this->db->query("INSERT INTO user (id_user, username, email, password, id_user_level, id_user_detail) VALUES ('$id', '$nik', '$email', '$password', '$id_user_level', '$id')");
        $this->db->query("INSERT INTO user_detail(id_user_detail, nama_lengkap, id_jenis_kelamin, id_unit, tempat_lahir, tanggal_lahir, nik, no_bpjs, no_bpjs_tk, alamat_ktp, alamat_domisili, wa_aktif, wa_kerabat, asal_pt, no_ijazah, tanggal_lulus, profesi_str, no_str, tanggal_terbit_str, masa_berlaku_str, no_sip, tanggal_terbit_sip, masa_berlaku_sip, nama_faskes_sip, status) VALUES ('$id', '$nama_lengkap', '$id_jenis_kelamin', '$id_unit', '$tempat_lahir', '$tanggal_lahir', '$nik', '$no_bpjs', '$no_bpjs_tk', '$alamat_ktp', '$alamat_domisili', '$wa_aktif', '$wa_kerabat', '$asal_pt', '$no_ijazah', '$tanggal_lulus', '$profesi_str', '$no_str', '$tanggal_terbit_str', '$masa_berlaku_str', '$no_sip', '$tanggal_terbit_sip', '$masa_berlaku_sip', '$nama_faskes_sip', '$status')");

        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function update_pegawai($id, $data)
    {
       $this->db->trans_start();

       // Update tabel user
       $user_data = array(
           'username' => $data['nik'],
           'email' => $data['email']
       );
       $this->db->where('id_user', $id);
       $this->db->update('user', $user_data);

       // Update tabel user_detail
       $this->db->where('id_user_detail', $id);
       $this->db->update('user_detail', $data);

       $this->db->trans_complete();

       return $this->db->trans_status();
    }

    public function delete_pegawai($id)
    {
       $this->db->trans_start();

       $this->db->query("DELETE FROM user WHERE id_user='$id'");
       $this->db->query("DELETE FROM user_detail WHERE id_user_detail='$id'");

       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function update_user($id, $username, $password)
    {
       $this->db->trans_start();

       $this->db->query("UPDATE user SET username='$username', password='$password' WHERE id_user='$id'");
      
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    

    public function delete_admin($id)
    {
       $this->db->trans_start();

       $this->db->query("DELETE FROM user WHERE id_user='$id'");
       $this->db->query("DELETE FROM user_detail WHERE id_user_detail='$id'");

       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function get_all_kains()
    {
        $this->db->select('user.*, user_detail.*, unit.nama_unit, jenis_kelamin.jenis_kelamin');
        $this->db->from('user');
        $this->db->join('user_detail', 'user.id_user = user_detail.id_user_detail');
        $this->db->join('unit', 'user_detail.id_unit = unit.id_unit', 'left');
        $this->db->join('jenis_kelamin', 'user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin', 'left');
        $this->db->where('user.id_user_level', 4);
        return $this->db->get();
    }

    public function count_all_kains()
    {
        $hasil = $this->db->query('SELECT COUNT(id_user) as total_user FROM user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail 
        JOIN jenis_kelamin ON user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin 
        WHERE id_user_level = 4');
        return $hasil;
    }

    public function get_kains_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT * FROM user JOIN user_detail ON user.id_user = user_detail.id_user_detail 
        WHERE user.id_user='$id_user' AND user.id_user_level=4");
        return $hasil;
    }

    public function insert_kains($data)
    {
        $this->db->trans_start();
        
        // Insert ke tabel user
        $user_data = array(
            'id_user' => $data['id_user'],
            'username' => $data['nik'],
            'password' => $data['password'],
            'email' => $data['email'],
            'id_user_level' => 4,
            'id_user_detail' => $data['id_user']
        );
        $this->db->insert('user', $user_data);
        
        // Insert ke tabel user_detail
        $user_detail_data = array(
            'id_user_detail' => $data['id_user'],
            'nama_lengkap' => $data['nama_lengkap'],
            'id_jenis_kelamin' => $data['id_jenis_kelamin'],
            'id_unit' => $data['id_unit'],
            'nik' => $data['nik'],
            'status' => 'aktif'
        );
        $this->db->insert('user_detail', $user_detail_data);
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_kains($id, $data)
    {
        $this->db->trans_start();
        
        // Update user
        $user_data = array(
            'username' => $data['nik'],
            'email' => $data['email']
        );
        $this->db->where('id_user', $id);
        $this->db->update('user', $user_data);
        
        // Update user_detail
        $user_detail_data = array(
            'nama_lengkap' => $data['nama_lengkap'],
            'id_jenis_kelamin' => $data['id_jenis_kelamin'],
            'id_unit' => $data['id_unit'],
            'nik' => $data['nik'],
            'status' => $data['status']
        );
        $this->db->where('id_user_detail', $id);
        $this->db->update('user_detail', $user_detail_data);
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_kains($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id_user', $id);
        $this->db->delete('user');
        
        $this->db->where('id_user_detail', $id);
        $this->db->delete('user_detail');
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_admin_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT * FROM user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE user.id_user='$id_user'");
        return $hasil;
    }

}

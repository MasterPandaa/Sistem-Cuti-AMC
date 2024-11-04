<?php

class M_sisa_cuti extends CI_Model {

    public function get_sisa_cuti_by_id($id_user) {
        $hasil = $this->db->query("SELECT * FROM sisa_cuti WHERE id_user='$id_user'");
        return $hasil;
    }

    public function insert_default_sisa_cuti($id_user) {
        $this->db->trans_start();
        $this->db->query("INSERT INTO sisa_cuti(id_user) VALUES ('$id_user')");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }
}

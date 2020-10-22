<?php
class Libur_model extends CI_Model {

    public function getLibur($idLibur) {
        $this->db->select('id, nama_hari_libur, tanggal');
        $this->db->from('hari_libur');
        $this->db->where('id', $idLibur);
        $libur = $this->db->get()->row_array();

        if ($libur) {
            return $libur;
        }
        return [];
    }

    public function getLiburs() {
        $this->db->select('id, nama_hari_libur, tanggal');
        $this->db->from('hari_libur');
        $data = $this->db->get()->result_array();


        if ($data) {
            return $data;
        } else {
            return [];
        }
    }

    public function getCountLiburBetween($start, $end) {
        $this->db->select('*');
        $this->db->where('tanggal >=', $start);
        $this->db->where('tanggal <=', $end);

        if ($result = $this->db->get('hari_libur')->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getDatesLiburs() {
        $this->db->select('nama_hari_libur, tanggal');
        $this->db->from('hari_libur');
        $data = $this->db->get()->result_array();


        if ($data) {
            return $data;
        }
        return [];
    }
}

<?php
class User_model extends CI_Model {

    public function getUserSidebar($nip) {
        $this->db->select('foto, nama, nip');
        $this->db->from('users');
        $this->db->where('nip', $nip);
        $user = $this->db->get()->row_array();
        $user['foto'] = base64_encode($user['foto']);

        return $user;
    }

    public function getUser($nip) {
        $this->db->select('u.nip, u.alamat, u.jenis_kelamin, u.nama, u.unit_kerja, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, u.foto, u.level, u.jenjang');
        $this->db->from('users as u, unit_kerja as k');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('nip', $nip);
        $user = $this->db->get()->row_array();
        $user['foto'] = base64_encode($user['foto']);

        return $user;
    }

    public function getUsers() {
        $this->db->select('u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, u.foto, u.level, u.jenjang');
        $this->db->from('users as u, unit_kerja as k');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.level <> 0');
        $this->db->order_by('u.level', 'ASC');
        $this->db->order_by('u.unit_kerja', 'ASC');
        $this->db->order_by('u.nip', 'ASC');
        $data = $this->db->get()->result_array();

        return $data;
    }

    public function getPegawais() {
        $this->db->select('u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, u.foto, u.level, u.jenjang');
        $this->db->from('users as u, unit_kerja as k');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.level', 2);
        $data = $this->db->get()->result_array();

        return $data;
    }

    public function getPegawaisUnit($unit) {
        $this->db->select('u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, u.foto, u.level, u.jenjang');
        $this->db->from('users as u, unit_kerja as k');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.unit_kerja', $unit);
        $this->db->where('u.level', 2);
        $data = $this->db->get()->result_array();

        return $data;
    }

    public function getPimpinan($unit) {
        $this->db->select('nama, nip, foto');
        $this->db->where('unit_kerja', $unit);
        $this->db->where('level', 1);
        if ($data = $this->db->get('users')->row_array()) {
            $data['foto'] = base64_encode($data['foto']);
            return $data;
        }
        $data['nama'] = '-';
        $data['nip'] = '-';
        $data['foto'] = '';
        return $data;
    }

    public function getCountPegawais() {
        $this->db->select('nip');
        $this->db->where('level', 2);

        if ($result = $this->db->get('users')->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getCountPegawaisUnit($unit) {
        $this->db->select('nip');
        $this->db->where('level', 2);
        $this->db->where('unit_kerja', $unit);

        if ($result = $this->db->get('users')->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }
}

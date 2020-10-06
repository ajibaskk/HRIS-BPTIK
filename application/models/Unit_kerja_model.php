<?php
class Unit_kerja_model extends CI_Model
{

    public function getUnitKerjas()
    {
        $this->db->select('id_unit_kerja, nama_unit');
        $this->db->from('unit_kerja');
        $data = $this->db->get()->result_array();

        return $data;
    }

}

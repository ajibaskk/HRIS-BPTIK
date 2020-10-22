<?php
class Cuti_model extends CI_Model {

    public function getCuti($idCuti) {
        $this->db->select('cp.id_cuti_pegawai,u.foto, u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, c.jenis, cp.alasan, cp.persetujuan, cp.tanggal_cuti_mulai, cp. tanggal_cuti_akhir, cp.file, cp.type');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $this->db->where('cp.id_cuti_pegawai', $idCuti);
        $cuti = $this->db->get()->row_array();
        $cuti['foto'] = base64_encode($cuti['foto']);
        $cuti['file'] = base64_encode($cuti['file']);

        return $cuti;
    }

    public function getCutis() {
        $this->db->select('cp.id_cuti_pegawai,u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, c.jenis, cp.alasan, cp.persetujuan, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('cp.jenis <> 4');
        $this->db->where('u.level = 2');
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $cuti = $this->db->get()->result_array();

        return $cuti;
    }

    public function getCutisUnit($unit) {
        $this->db->select('cp.id_cuti_pegawai,u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, c.jenis, cp.alasan, cp.persetujuan, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('cp.jenis <> 4');
        $this->db->where('u.level = 2');
        $this->db->where('u.unit_kerja', $unit);
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $cuti = $this->db->get()->result_array();

        return $cuti;
    }

    public function getCutisIndividu($nip) {
        $this->db->select('cp.id_cuti_pegawai,u.nip, u.jenis_kelamin, u.nama, k.nama_unit, c.jenis, cp.persetujuan, cp.tanggal_cuti_mulai, cp. tanggal_cuti_akhir');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $this->db->where('cp.jenis <> 4');
        $this->db->where('u.nip', $nip);
        $cuti = $this->db->get()->row_array();

        return $cuti;
    }

    public function getCutisIndividu2($nip) {
        $this->db->select('cp.id_cuti_pegawai, u.nip, u.jenis_kelamin, u.nama, k.nama_unit, c.jenis, cp.persetujuan, cp.tanggal_cuti_mulai, cp. tanggal_cuti_akhir');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $this->db->where('cp.jenis <> 4');
        $this->db->where('u.nip', $nip);
        $cuti = $this->db->get()->result_array();

        return $cuti;
    }

    public function getCountCutisIndividu($nip, $month, $year) {
        $this->db->select('tanggal_cuti_mulai, tanggal_cuti_akhir');
        $this->db->from('cuti_pegawai');
        $this->db->where('jenis <> 4');
        $this->db->where('persetujuan = 1');
        $this->db->where('(MONTH(tanggal_cuti_mulai) =' . $month . ' OR MONTH(tanggal_cuti_akhir) =' . $month . ')');
        $this->db->where('(YEAR(tanggal_cuti_mulai)=' . $year . ' OR YEAR(tanggal_cuti_akhir) =' . $year . ')');
        $this->db->where('nip', $nip);
        $tanggal = $this->db->get()->result_array();
        $itr = 0;
        $count = 0;
        $this->load->helper('date');
        $this->load->model('Libur_model');
        foreach ($tanggal as $t) {
            if (intval(date('Y', strtotime($t['tanggal_cuti_mulai']))) < intval($year)) {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) < intval($month)) {
                    $tanggal[$itr]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) > intval($month)) {
                    $tanggal[$itr]['tanggal_cuti_mulai'] = date($year . '-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            }
            if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) != intval($month)) {
                $tanggal[$itr]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
            } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) < intval($month)) {
                $tanggal[$itr]['tanggal_cuti_mulai'] = date('Y-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
            }

            $count = $count + daysBetween($tanggal[$itr]['tanggal_cuti_akhir'], $tanggal[$itr]['tanggal_cuti_mulai']);
            $count = $count - countWeekday($tanggal[$itr]['tanggal_cuti_mulai'], $tanggal[$itr]['tanggal_cuti_akhir']);
            $count = $count - $this->Libur_model->getCountLiburBetween($tanggal[$itr]['tanggal_cuti_mulai'], $tanggal[$itr]['tanggal_cuti_akhir']);
            $itr++;
        }

        return $count;
    }

    public function getCountCutisUnit($unit, $month, $year) {
        $this->db->select('u.unit_kerja, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir');
        $this->db->from('cuti_pegawai as cp, users as u');
        $this->db->where('cp.jenis <> 4');
        $this->db->where('cp.persetujuan = 1');
        $this->db->where('(MONTH(cp.tanggal_cuti_mulai) =' . $month . ' OR MONTH(cp.tanggal_cuti_akhir) =' . $month . ')');
        $this->db->where('(YEAR(cp.tanggal_cuti_mulai)=' . $year . ' OR YEAR(cp.tanggal_cuti_akhir) =' . $year . ')');
        $this->db->where('cp.nip = u.nip');
        $this->db->where('u.unit_kerja', $unit);
        $tanggal = $this->db->get()->result_array();
        $i = 0;
        $count = 0;
        $this->load->helper('date');
        $this->load->model('Libur_model');
        foreach ($tanggal as $t) {
            if (intval(date('Y', strtotime($t['tanggal_cuti_mulai']))) < intval($year)) {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) > intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date($year . '-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            } else {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) != intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date('Y-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            }
            $count = $count + daysBetween($tanggal[$i]['tanggal_cuti_akhir'], $tanggal[$i]['tanggal_cuti_mulai']);
            $count = $count - countWeekday($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $count = $count - $this->Libur_model->getCountLiburBetween($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $i++;
        }

        return $count;
    }

    public function getCountCutis($month, $year) {
        $this->db->select('u.unit_kerja, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir');
        $this->db->from('cuti_pegawai as cp, users as u');
        $this->db->where('cp.jenis <> 4');
        $this->db->where('cp.persetujuan = 1');
        $this->db->where('(MONTH(cp.tanggal_cuti_mulai) =' . $month . ' OR MONTH(cp.tanggal_cuti_akhir) =' . $month . ')');
        $this->db->where('(YEAR(cp.tanggal_cuti_mulai)=' . $year . ' OR YEAR(cp.tanggal_cuti_akhir) =' . $year . ')');
        $this->db->where('cp.nip = u.nip');
        $tanggal = $this->db->get()->result_array();
        $i = 0;
        $count = 0;
        $this->load->helper('date');
        $this->load->model('Libur_model');
        foreach ($tanggal as $t) {
            if (intval(date('Y', strtotime($t['tanggal_cuti_mulai']))) < intval($year)) {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) > intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date($year . '-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            } else {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) != intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date('Y-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            }
            $count = $count + daysBetween($tanggal[$i]['tanggal_cuti_akhir'], $tanggal[$i]['tanggal_cuti_mulai']);
            $count = $count - countWeekday($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $count = $count - $this->Libur_model->getCountLiburBetween($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $i++;
        }

        return $count;
    }

    public function getDatesCuti($nip) {
        $this->db->select('jc.jenis, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir');
        $this->db->from('cuti_pegawai as cp, jenis_cuti as jc');
        $this->db->where('cp.jenis <> 4');
        $this->db->where('cp.persetujuan = 1');
        $this->db->where('jc.id_jenis_cuti = cp.jenis');
        $this->db->where('nip', $nip);
        $tanggal = $this->db->get()->result_array();

        $this->load->helper('date');

        $dates = [];
        foreach ($tanggal as $tgl) {
            $period = dateRange($tgl['tanggal_cuti_mulai'], $tgl['tanggal_cuti_akhir']);

            $val['jenis'] = $tgl['jenis'];
            foreach ($period as $value) {
                $val['tanggal'] = $value;
                array_push($dates, $val);
            }
        }

        return $dates;
    }

    public function getDatesDinasLuar($nip) {
        $this->db->select('jc.jenis, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir');
        $this->db->from('cuti_pegawai as cp, jenis_cuti as jc');
        $this->db->where('cp.jenis = 4');
        $this->db->where('cp.persetujuan = 1');
        $this->db->where('jc.id_jenis_cuti = cp.jenis');
        $this->db->where('nip', $nip);
        $tanggal = $this->db->get()->result_array();

        $this->load->helper('date');

        $dates = [];
        foreach ($tanggal as $tgl) {
            $period = dateRange($tgl['tanggal_cuti_mulai'], $tgl['tanggal_cuti_akhir']);

            $val['jenis'] = $tgl['jenis'];
            foreach ($period as $value) {
                $val['tanggal'] = $value;
                array_push($dates, $val);
            }
        }

        return $dates;
    }

    public function getDinasLuar() {
        $this->db->select('u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, c.jenis, cp.alasan, cp.persetujuan, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir, cp.id_cuti_pegawai');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('u.level = 2');
        $this->db->where('cp.jenis = 4');
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $cuti = $this->db->get()->result_array();

        return $cuti;
    }

    public function getDinasLuarUnit($unit) {
        $this->db->select('u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, c.jenis, cp.alasan, cp.persetujuan, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir, cp.id_cuti_pegawai');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('u.level = 2');
        $this->db->where('cp.jenis = 4');
        $this->db->where('u.unit_kerja', $unit);
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $cuti = $this->db->get()->result_array();

        return $cuti;
    }

    public function getDinasLuarIndividu($id) {
        $this->db->select('cp.id_cuti_pegawai, u.foto, u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, c.jenis, cp.alasan, cp.persetujuan, cp.tanggal_cuti_mulai, cp. tanggal_cuti_akhir, cp.file, cp.type');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('cp.jenis = 4');
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $this->db->where('cp.id_cuti_pegawai', $id);
        $dinasluar = $this->db->get()->row_array();
        $dinasluar['foto'] = base64_encode($dinasluar['foto']);
        $dinasluar['file'] = base64_encode($dinasluar['file']);

        return $dinasluar;
    }

    public function getDinasLuarsIndividu($nip) {
        $this->db->select('cp.id_cuti_pegawai,u.nip, u.alamat, u.jenis_kelamin, u.nama, k.nama_unit, u.tempat_lahir, u.tanggal_lahir, c.jenis, cp.alasan, cp.persetujuan, cp.tanggal_cuti_mulai, cp. tanggal_cuti_akhir, cp.file, cp.type');
        $this->db->from('users as u, unit_kerja as k, cuti_pegawai as cp, jenis_cuti as c');
        $this->db->where('u.unit_kerja = k.id_unit_kerja');
        $this->db->where('u.nip = cp.nip');
        $this->db->where('cp.jenis = 4');
        $this->db->where('cp.jenis = c.id_jenis_cuti');
        $this->db->where('u.nip', $nip);
        $dinasluar = $this->db->get()->result_array();

        return $dinasluar;
    }

    public function getCountDinasLuarIndividu($nip, $month, $year) {
        $this->db->select('tanggal_cuti_mulai, tanggal_cuti_akhir');
        $this->db->from('cuti_pegawai');
        $this->db->where('jenis = 4');
        $this->db->where('persetujuan = 1');
        $this->db->where('(MONTH(tanggal_cuti_mulai) =' . $month . ' OR MONTH(tanggal_cuti_akhir) =' . $month . ')');
        $this->db->where('(YEAR(tanggal_cuti_mulai)=' . $year . ' OR YEAR(tanggal_cuti_akhir) =' . $year . ')');
        $this->db->where('nip', $nip);
        $tanggal = $this->db->get()->result_array();
        $i = 0;
        $count = 0;
        $this->load->helper('date');
        $this->load->model('Libur_model');
        foreach ($tanggal as $t) {
            if (intval(date('Y', strtotime($t['tanggal_cuti_mulai']))) < intval($year)) {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) > intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date($year . '-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            } else {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) != intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date('Y-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            }
            $count = $count + daysBetween($tanggal[$i]['tanggal_cuti_akhir'], $tanggal[$i]['tanggal_cuti_mulai']);
            $count = $count - countWeekday($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $count = $count - $this->Libur_model->getCountLiburBetween($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $i++;
        }

        return $count;
    }

    public function getCountDinasLuarUnit($unit, $month, $year) {
        $this->db->select('u.unit_kerja, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir');
        $this->db->from('cuti_pegawai as cp, users as u');
        $this->db->where('cp.jenis = 4');
        $this->db->where('cp.persetujuan = 1');
        $this->db->where('(MONTH(cp.tanggal_cuti_mulai) = ' . $month . ' OR MONTH(cp.tanggal_cuti_akhir) = ' . $month . ')');
        $this->db->where('(YEAR(cp.tanggal_cuti_mulai) = ' . $year . ' OR YEAR(cp.tanggal_cuti_akhir) = ' . $year . ')');
        $this->db->where('cp.nip = u.nip');
        $this->db->where('u.unit_kerja', $unit);
        $tanggal = $this->db->get()->result_array();
        $i = 0;
        $count = 0;
        $this->load->helper('date');
        $this->load->model('Libur_model');
        foreach ($tanggal as $t) {
            if (intval(date('Y', strtotime($t['tanggal_cuti_mulai']))) < intval($year)) {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) > intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date($year . '-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            } else {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) != intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date('Y-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            }
            $count = $count + daysBetween($tanggal[$i]['tanggal_cuti_akhir'], $tanggal[$i]['tanggal_cuti_mulai']);
            $count = $count - countWeekday($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $count = $count - $this->Libur_model->getCountLiburBetween($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $i++;
        }

        return $count;
    }

    public function getCountDinasLuars($month, $year) {
        $this->db->select('u.unit_kerja, cp.tanggal_cuti_mulai, cp.tanggal_cuti_akhir');
        $this->db->from('cuti_pegawai as cp, users as u');
        $this->db->where('cp.jenis = 4');
        $this->db->where('cp.persetujuan = 1');
        $this->db->where('(MONTH(cp.tanggal_cuti_mulai) = ' . $month . ' OR MONTH(cp.tanggal_cuti_akhir) = ' . $month . ')');
        $this->db->where('(YEAR(cp.tanggal_cuti_mulai) = ' . $year . ' OR YEAR(cp.tanggal_cuti_akhir) = ' . $year . ')');
        $this->db->where('cp.nip = u.nip');
        $tanggal = $this->db->get()->result_array();
        $i = 0;
        $count = 0;
        $this->load->helper('date');
        $this->load->model('Libur_model');
        foreach ($tanggal as $t) {
            if (intval(date('Y', strtotime($t['tanggal_cuti_mulai']))) < intval($year)) {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) > intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date($year . '-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            } else {
                if (intval(date('m', strtotime($t['tanggal_cuti_akhir']))) != intval($month)) {
                    $tanggal[$i]['tanggal_cuti_akhir'] = dateLastDayOfMonth($t['tanggal_cuti_mulai']);
                } else if (intval(date('m', strtotime($t['tanggal_cuti_mulai']))) < intval($month)) {
                    $tanggal[$i]['tanggal_cuti_mulai'] = date('Y-' . $month . '-01', strtotime($t['tanggal_cuti_mulai']));
                }
            }
            $count = $count + daysBetween($tanggal[$i]['tanggal_cuti_akhir'], $tanggal[$i]['tanggal_cuti_mulai']);
            $count = $count - countWeekday($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $count = $count - $this->Libur_model->getCountLiburBetween($tanggal[$i]['tanggal_cuti_mulai'], $tanggal[$i]['tanggal_cuti_akhir']);
            $i++;
        }

        return $count;
    }
}

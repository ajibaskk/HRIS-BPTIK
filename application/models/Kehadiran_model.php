<?php
class Kehadiran_model extends CI_Model {


    public function getDateFirstUpdate() {
        $this->db->select('tanggal');
        $this->db->order_by('tanggal', 'ASC');

        if ($result = $this->db->get('kehadiran')->row_array()) {
            return $result['tanggal'];
        }
        return '0001-01-01';
    }

    public function getDateLastUpdate() {
        $this->db->select('tanggal');
        $this->db->order_by('tanggal', 'DESC');

        if ($result = $this->db->get('kehadiran')->row_array()) {
            return $result['tanggal'];
        } else {
            return '0001-01-01';
        }
    }

    public function getDatesKehadiran($idPegawai) {
        $this->load->model('Libur_model');
        $libur = $this->Libur_model->getDatesLiburs();

        $this->db->select('tanggal, jam_masuk, jam_keluar');
        if ($libur) {
            foreach ($libur as $l) {
                $this->db->where("tanggal <>", $l['tanggal']);
            }
        }
        $this->db->where("jam_masuk > '06:00:00'");
        $this->db->where("jam_masuk < '09:00:00'");
        $this->db->where("IF(DAYOFWEEK(tanggal) = 6, jam_keluar > '14:00:00', jam_keluar > '15:30:00')");
        $this->db->where("jam_keluar < '24:00:00'");
        $this->db->where("DAYOFWEEK(tanggal) <> 1");
        $this->db->where("DAYOFWEEK(tanggal) <> 7");
        $this->db->where('nip', $idPegawai);
        if ($result = $this->db->get('kehadiran')->result_array()) {
            return $result;
        } else {
            return [];
        }
    }

    public function getCountPresent($idPegawai, $month, $year) {
        $this->load->model('Libur_model');
        $libur = $this->Libur_model->getDatesLiburs();

        $this->db->select('tanggal');
        if ($libur) {
            foreach ($libur as $l) {
                $this->db->where("tanggal <>", $l['tanggal']);
            }
        }
        $this->db->where("jam_masuk > '06:00:00'");
        $this->db->where("jam_masuk < '09:00:00'");
        $this->db->where("IF(DAYOFWEEK(tanggal) = 6, jam_keluar > '14:00:00', jam_keluar > '15:30:00')");
        $this->db->where("jam_keluar < '24:00:00'");
        $this->db->where("DAYOFWEEK(tanggal) <> 1");
        $this->db->where("DAYOFWEEK(tanggal) <> 7");
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('YEAR(tanggal)', $year);
        $this->db->where('nip', $idPegawai);

        if ($result = $this->db->get('kehadiran')->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getCountPresentUnit($unit, $month, $year) {
        $this->load->model('Libur_model');
        $libur = $this->Libur_model->getDatesLiburs();

        $this->db->select('k.tanggal');
        if ($libur) {
            foreach ($libur as $l) {
                $this->db->where("k.tanggal <>", $l['tanggal']);
            }
        }
        $this->db->from('kehadiran as k, users as u');
        $this->db->where('k.nip = u.nip');
        $this->db->where('u.level = 2');
        $this->db->where("k.jam_masuk > '06:00:00'");
        $this->db->where("k.jam_masuk < '09:00:00'");
        $this->db->where("IF(DAYOFWEEK(k.tanggal) = 6, k.jam_keluar > '14:00:00', k.jam_keluar > '15:30:00')");
        $this->db->where("k.jam_keluar < '24:00:00'");
        $this->db->where("DAYOFWEEK(k.tanggal) <> 1");
        $this->db->where("DAYOFWEEK(k.tanggal) <> 7");
        $this->db->where('MONTH(k.tanggal)', $month);
        $this->db->where('YEAR(k.tanggal)', $year);
        $this->db->where('u.unit_kerja', $unit);

        if ($result = $this->db->get()->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getCountPresents($month, $year) {
        $this->load->model('Libur_model');
        $libur = $this->Libur_model->getDatesLiburs();

        $this->db->select('k.tanggal');
        if ($libur) {
            foreach ($libur as $l) {
                $this->db->where("k.tanggal <>", $l['tanggal']);
            }
        }
        $this->db->from('kehadiran as k, users as u');
        $this->db->where('k.nip = u.nip');
        $this->db->where('u.level = 2');
        $this->db->where("k.jam_masuk > '06:00:00'");
        $this->db->where("k.jam_masuk < '09:00:00'");
        $this->db->where("IF(DAYOFWEEK(k.tanggal) = 6, k.jam_keluar > '14:00:00', k.jam_keluar > '15:30:00')");
        $this->db->where("k.jam_keluar < '24:00:00'");
        $this->db->where("DAYOFWEEK(k.tanggal) <> 1");
        $this->db->where("DAYOFWEEK(k.tanggal) <> 7");
        $this->db->where('MONTH(k.tanggal)', $month);
        $this->db->where('YEAR(k.tanggal)', $year);

        if ($result = $this->db->get()->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getCountNotPresent($idLibur, $month, $year) {
        $this->load->helper('date');
        $this->load->model('Libur_model');
        $firstUpdate = $this->getDateFirstUpdate();
        $lastUpdate = $this->getDateLastUpdate();
        if ($lastUpdate != '0001-01-01') {
            if (date('d', strtotime($firstUpdate)) != '01' && date('m', strtotime($firstUpdate)) == $month) {
                $day = date('d', strtotime(date($firstUpdate)));
            } else {
                $day = '01';
            }
            if (strtotime($lastUpdate) < strtotime(dateLastDayOfMonth(date($year . '-' . $month)))) {
                $end = $lastUpdate;
            } else {
                $end = dateLastDayOfMonth(date($year . '-' . $month));
            }
            $start = date($year . '-' . $month . '-' . $day);

            $days = daysBetween($end, $start);
            $weekdays = countWeekday($start, $end);
            $holiday = $this->Libur_model->getCountLiburBetween($start, $end);
            $present = $this->getCountPresent($idLibur, $month, $year);

            $result = $days - $weekdays - $holiday - $present;
            if ($result < 0) {
                return 0;
            } else {
                return $result;
            }
        } else {
            return 0;
        }
    }

    public function getCountNotPresentUnit($unit, $month, $year) {
        $this->load->helper('date');
        $this->load->model('Libur_model');
        $this->load->model('User_model');
        $firstUpdate = $this->getDateFirstUpdate();
        $lastUpdate = $this->getDateLastUpdate();
        if ($lastUpdate != '0001-01-01') {
            if (date('d', strtotime($firstUpdate)) != '01' && date('m', strtotime($firstUpdate)) == $month) {
                $day = date('d', strtotime(date($firstUpdate)));
            } else {
                $day = '01';
            }
            if (strtotime($lastUpdate) < strtotime(dateLastDayOfMonth(date($year . '-' . $month)))) {
                $end = $lastUpdate;
            } else {
                $end = dateLastDayOfMonth(date($year . '-' . $month));
            }
            $start = date($year . '-' . $month . '-' . $day);

            $countUnit = $this->User_model->getCountPegawaisUnit($unit);
            $days = daysBetween($end, $start) * $countUnit;
            $weekdays = countWeekday($start, $end) * $countUnit;
            $holiday = $this->Libur_model->getCountLiburBetween($start, $end) * $countUnit;
            $present = $this->getCountPresentUnit($unit, $month, $year);

            $result = $days - $weekdays - $holiday - $present;
            if ($result < 0) {
                return 0;
            } else {
                return $result;
            }
        } else {
            return 0;
        }
    }

    public function getCountNotPresents($month, $year) {
        $this->load->helper('date');
        $this->load->model('Libur_model');
        $this->load->model('User_model');
        $firstUpdate = $this->getDateFirstUpdate();
        $lastUpdate = $this->getDateLastUpdate();
        if ($lastUpdate != '0001-01-01') {
            if (date('d', strtotime($firstUpdate)) != '01' && date('m', strtotime($firstUpdate)) == $month) {
                $day = date('d', strtotime(date($firstUpdate)));
            } else {
                $day = '01';
            }
            if (strtotime($lastUpdate) < strtotime(dateLastDayOfMonth(date($year . '-' . $month)))) {
                $end = $lastUpdate;
            } else {
                $end = dateLastDayOfMonth(date($year . '-' . $month));
            }
            $start = date($year . '-' . $month . '-' . $day);

            $countUnit = $this->User_model->getCountPegawais();
            $days = daysBetween($end, $start) * $countUnit;
            $weekdays = countWeekday($start, $end) * $countUnit;
            $holiday = $this->Libur_model->getCountLiburBetween($start, $end) * $countUnit;
            $present = $this->getCountPresents($month, $year);

            $result = $days - $weekdays - $holiday - $present;
            if ($result < 0) {
                return 0;
            } else {
                return $result;
            }
        } else {
            return 0;
        }
    }

    public function getCountLate($idPegawai, $month, $year) {
        $this->load->model('Libur_model');
        $libur = $this->Libur_model->getDatesLiburs();

        $this->db->select('tanggal');
        if ($libur) {
            foreach ($libur as $l) {
                $this->db->where("tanggal <>", $l['tanggal']);
            }
        }
        $this->db->where("jam_masuk > '07:00:00'");
        $this->db->where("jam_masuk < '09:00:00'");
        $this->db->where("IF(DAYOFWEEK(tanggal) = 6, jam_keluar > '14:00:00', jam_keluar > '15:30:00')");
        $this->db->where("jam_keluar < '24:00:00'");
        $this->db->where("DAYOFWEEK(tanggal) <> 1");
        $this->db->where("DAYOFWEEK(tanggal) <> 7");
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('YEAR(tanggal)', $year);
        $this->db->where('nip', $idPegawai);

        if ($result = $this->db->get('kehadiran')->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getCountLateUnit($unit, $month, $year) {
        $this->load->model('Libur_model');
        $libur = $this->Libur_model->getDatesLiburs();

        $this->db->select('k.tanggal');
        $this->db->from('kehadiran as k, users as u');
        if ($libur) {
            foreach ($libur as $l) {
                $this->db->where("tanggal <>", $l['tanggal']);
            }
        }
        $this->db->where('k.nip = u.nip');
        $this->db->where("k.jam_masuk > '07:00:00'");
        $this->db->where("k.jam_masuk < '09:00:00'");
        $this->db->where("IF(DAYOFWEEK(tanggal) = 6, k.jam_keluar > '14:00:00', k.jam_keluar > '15:30:00')");
        $this->db->where("k.jam_keluar < '24:00:00'");
        $this->db->where("DAYOFWEEK(k.tanggal) <> 1");
        $this->db->where("DAYOFWEEK(k.tanggal) <> 7");
        $this->db->where('MONTH(k.tanggal)', $month);
        $this->db->where('YEAR(k.tanggal)', $year);
        $this->db->where('u.unit_kerja', $unit);

        if ($result = $this->db->get()->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getCountLates($month, $year) {
        $this->load->model('Libur_model');
        $libur = $this->Libur_model->getDatesLiburs();

        $this->db->select('tanggal');
        if ($libur) {
            foreach ($libur as $l) {
                $this->db->where("tanggal <>", $l['tanggal']);
            }
        }
        $this->db->where("jam_masuk > '07:00:00'");
        $this->db->where("jam_masuk < '09:00:00'");
        $this->db->where("IF(DAYOFWEEK(tanggal) = 6, jam_keluar > '14:00:00', jam_keluar > '15:30:00')");
        $this->db->where("jam_keluar < '24:00:00'");
        $this->db->where("DAYOFWEEK(tanggal) <> 1");
        $this->db->where("DAYOFWEEK(tanggal) <> 7");
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('YEAR(tanggal)', $year);

        if ($result = $this->db->get('kehadiran')->num_rows()) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getListYearFirstLast() {
        return range(date("Y", strtotime($this->getDateFirstUpdate())), date("Y", strtotime($this->getDateLastUpdate())));
    }

    public function getListMonthFirstLast($year) {
        if (strtotime($this->getDateFirstUpdate()) > strtotime(date($year . '-01-01'))) {
            $start = $this->getDateFirstUpdate();
        } else {
            $start = date($year . '-01-01');
        }
        if (strtotime($this->getDateLastUpdate()) < strtotime(date($year . '-12-31'))) {
            $end = $this->getDateLastUpdate();
        } else {
            $end = date($year . '-12-12');
        }
        $months = range(date("m", strtotime($start)), date("m", strtotime($end)));
        $itr = 0;
        foreach ($months as $month) {
            if (strlen($month) == 1) {
                $months[$itr] = '0' . $months[$itr];
            }
            $itr++;
        }
        return $months;
    }
}

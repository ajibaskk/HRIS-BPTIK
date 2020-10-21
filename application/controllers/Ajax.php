<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{


    public function getUser($nip)
    {
        if ($this->session->has_userdata('user')) {
            $this->load->model('User_model');
            $user = $this->User_model->getUser($nip);
            echo json_encode($user);
        }
    }

    public function getLibur($id)
    {
        if ($this->session->has_userdata('user')) {
            $this->load->model('Libur_model');
            $libur = $this->Libur_model->getLibur($id);
            echo json_encode($libur);
        }
    }

    public function getCuti($id)
    {
        if ($this->session->has_userdata('user')) {
            $this->load->model('Cuti_model');
            $cuti = $this->Cuti_model->getCuti($id);
            echo json_encode($cuti);
        }
    }

    public function getCuti2($id)
    {
        if ($this->session->has_userdata('user')) {
            $this->load->model('Cuti_model');
            $dl = $this->Cuti_model->getDinasLuarIndividu($id);
            echo json_encode($dl);
        }
    }

    public function getAnalisisKehadiran($nip, $month, $year)
    {
        if ($this->session->has_userdata('user')) {

            $this->load->model('Cuti_model');
            $this->load->model('User_model');
            $this->load->model('Kehadiran_model');
            $user = $this->User_model->getUser($nip);
            $cuti = $this->Cuti_model->getCountCutisIndividu($nip, $month, $year);
            $dinasLuar = $this->Cuti_model->getCountDinasLuarIndividu($nip, $month, $year);
            $hadir = $this->Kehadiran_model->getCountPresent($nip, $month, $year);
            $tidakHadir = $this->Kehadiran_model->getCountNotPresent($nip, $month, $year) - $cuti - $dinasLuar;

            $result = [
                'foto' => $user['foto'],
                'nama' => $user['nama'],
                'nip' => $user['nip'],
                'cuti' => $cuti,
                'dinas_luar' => $dinasLuar,
                'tidak_hadir' => $tidakHadir,
                'hadir' => $hadir
            ];

            echo json_encode($result);
        }
    }

    public function getAnalisisKeterlambatan($nip, $month, $year)
    {
        if ($this->session->has_userdata('user')) {

            $this->load->model('User_model');
            $this->load->model('Kehadiran_model');
            $late = $this->Kehadiran_model->getCountLate($nip, $month, $year);
            $ontime = $this->Kehadiran_model->getCountPresent($nip, $month, $year) - $late;

            $result = [
                'late' => $late,
                'ontime' => $ontime
            ];

            echo json_encode($result);
        }
    }

    public function getAnalisisAbsen($nip, $month, $year)
    {
        if ($this->session->has_userdata('user')) {

            $this->load->model('User_model');
            $this->load->model('Cuti_model');
            $this->load->model('Kehadiran_model');
            $user = $this->User_model->getUser($nip);
            $cuti = $this->Cuti_model->getCountCutisIndividu($nip, $month, $year);
            $dinasLuar = $this->Cuti_model->getCountDinasLuarIndividu($nip, $month, $year);
            $hadir = $this->Kehadiran_model->getCountPresent($nip, $month, $year);
            $tidakHadir = $this->Kehadiran_model->getCountNotPresent($nip, $month, $year) - $cuti - $dinasLuar;
            $late = $this->Kehadiran_model->getCountLate($nip, $month, $year);
            $ontime = $this->Kehadiran_model->getCountPresent($nip, $month, $year) - $late;

            $result = [
                'foto' => $user['foto'],
                'nama' => $user['nama'],
                'nip' => $user['nip'],
                'cuti' => $cuti,
                'dinas_luar' => $dinasLuar,
                'tidak_hadir' => $tidakHadir,
                'hadir' => $hadir,
                'late' => $late,
                'ontime' => $ontime
            ];

            echo json_encode($result);
        }
    }

    public function getAnalisisKehadiranUnit($unit, $month = 0, $year = 0)
    {
        if ($this->session->has_userdata('user')) {
            $this->load->model('Cuti_model');
            $this->load->model('User_model');
            $this->load->model('Kehadiran_model');
            $listYear = $this->Kehadiran_model->getListYearFirstLast();
            $listMonth = $this->Kehadiran_model->getListMonthFirstLast($listYear[count($listYear) - 1]);

            if ($year == 0) {
                $year = $listYear[count($listYear) - 1];
            }
            if ($month == 0) {
                $month = $listMonth[count($listMonth) - 1];
            }
            if ($unit == 'all') {
                $namaUnit = "Seluruh Pegawai Non PNS BPTIK";
                $jumlahPegawai = $this->User_model->getCountPegawais();
                $cuti = $this->Cuti_model->getCountCutis($month, $year);
                $dinasLuar = $this->Cuti_model->getCountDinasLuars($month, $year);
                $tidakHadir = $this->Kehadiran_model->getCountNotPresents($month, $year) - $cuti - $dinasLuar;
                $late = $this->Kehadiran_model->getCountLates($month, $year);
                $ontime = $this->Kehadiran_model->getCountPresents($month, $year) - $late;
            } else {
                if ($unit == 1) {
                    $namaUnit = "Tata Usaha";
                } else if ($unit == 2) {
                    $namaUnit = "Pengembangan TIK";
                } else if ($unit == 3) {
                    $namaUnit = "Pemberdayaan TIK";
                }
                $jumlahPegawai = $this->User_model->getCountPegawaisUnit($unit);
                $cuti = $this->Cuti_model->getCountCutisUnit($unit, $month, $year);
                $dinasLuar = $this->Cuti_model->getCountDinasLuarUnit($unit, $month, $year);
                $tidakHadir = $this->Kehadiran_model->getCountNotPresentUnit($unit, $month, $year) - $cuti - $dinasLuar;
                $late = $this->Kehadiran_model->getCountLateUnit($unit, $month, $year);
                $ontime = $this->Kehadiran_model->getCountPresentUnit($unit, $month, $year) - $late;
            }

            $result = [
                'list_year' => $listYear,
                'list_month' => $listMonth,
                'nama_unit' => $namaUnit,
                'jumlah_pegawai' => $jumlahPegawai,
                'cuti' => $cuti,
                'dinas_luar' => $dinasLuar,
                'tidak_hadir' => $tidakHadir,
                'late' => $late,
                'ontime' => $ontime
            ];

            echo json_encode($result);
        }
    }

    public function getTabelAnalisisKehadiranUnit($type, $unit, $month, $year)
    {
        if ($this->session->has_userdata('user')) {
            $this->load->model('Cuti_model');
            $this->load->model('User_model');
            $this->load->model('Kehadiran_model');

            $i = 0;
            $data = [];

            if ($unit == 'all') {
                $namaUnit = "Seluruh Pegawai Non PNS BPTIK";
                $pegawais = $this->User_model->getPegawais();
                foreach ($pegawais as $pegawai) {
                    if($type == 'Cuti'){
                        $total = $this->Cuti_model->getCountCutisIndividu($pegawai['nip'], $month, $year);
                    }
                    else if($type == 'Dinas%20Luar'){
                        $total = $this->Cuti_model->getCountDinasLuar($pegawai['nip'], $month, $year);
                    }
                    else if($type == 'Tidak%20Masuk'){
                        $total = $this->Kehadiran_model->getCountNotPresent($pegawai['nip'], $month, $year) - $this->Cuti_model->getCountCutisIndividu($pegawai['nip'], $month, $year) - $this->Cuti_model->getCountDinasLuarIndividu($pegawai['nip'], $month, $year);
                    }
                    else if($type == 'Terlambat'){
                        $total = $this->Kehadiran_model->getCountLate($pegawai['nip'], $month, $year);
                    }
                    else if($type == 'Tepat%20Waktu'){
                        $total = $this->Kehadiran_model->getCountPresent($pegawai['nip'], $month, $year) - $this->Kehadiran_model->getCountLate($pegawai['nip'], $month, $year);
                    }
                    if($total == 0){
                        continue;
                    }
                    else{
                        $data[$i]['id'] = $pegawai['nip'];
                        $data[$i]['nama'] = $pegawai['nama'];
                        $data[$i]['total'] = $total;
                        $i++;
                    }
                }
            } else {
                if ($unit == 1) {
                    $namaUnit = "Tata Usaha";
                } else if ($unit == 2) {
                    $namaUnit = "Pengembangan TIK";
                } else if ($unit == 3) {
                    $namaUnit = "Pemberdayaan TIK";
                }
                $pegawais = $this->User_model->getPegawaisUnit($unit);
                foreach ($pegawais as $pegawai) {
                    if($type == 'Cuti'){
                        $total = $this->Cuti_model->getCountCutisIndividu($pegawai['nip'], $month, $year);
                    }
                    else if($type == 'Dinas%20Luar'){
                        $total = $this->Cuti_model->getCountDinasLuarIndividu   ($pegawai['nip'], $month, $year);
                    }
                    else if($type == 'Tidak%20Masuk'){
                        $total = $this->Kehadiran_model->getCountNotPresent($pegawai['nip'], $month, $year) - $this->Cuti_model->getCountCutisIndividu($pegawai['nip'], $month, $year) - $this->Cuti_model->getCountDinasLuarIndividu($pegawai['nip'], $month, $year);
                    }
                    else if($type == 'Terlambat'){
                        $total = $this->Kehadiran_model->getCountLate($pegawai['nip'], $month, $year);
                    }
                    else if($type == 'Tepat%20Waktu'){
                        $total = $this->Kehadiran_model->getCountPresent($pegawai['nip'], $month, $year) - $this->Kehadiran_model->getCountLate($pegawai['nip'], $month, $year);
                    }
                    if($total == 0){
                        continue;
                    }
                    else{
                        $data[$i]['id'] = $pegawai['nip'];
                        $data[$i]['nama'] = $pegawai['nama'];
                        $data[$i]['total'] = $total;
                        $i++;
                    }
                }
            }

            $result = [
                'nama_unit' => $namaUnit,
                'data' => $data
            ];

            echo json_encode($result);
        }
    }

    public function getDatesKehadiran($nip)
    {
        if ($this->session->has_userdata('user')) {
            $this->load->model('Kehadiran_model');
            $this->load->model('Cuti_model');
            $this->load->model('Libur_model');
            $firstUpdate = $this->Kehadiran_model->getDateFirstUpdate();
            $lastUpdate = $this->Kehadiran_model->getDateLastUpdate();
            $kehadiran = $this->Kehadiran_model->getDatesKehadiran($nip);
            $cuti = $this->Cuti_model->getDatesCuti($nip);
            $dinasLuar = $this->Cuti_model->getDatesDinasLuar($nip);
            $libur = $this->Libur_model->getDatesLiburs();

            $i = 0;
            $result = [];
            foreach ($kehadiran as $k) {
                $result[$i]['title'] = $k['jam_masuk'];
                $result[$i]['tanggal'] = $k['tanggal'];
                $result[$i + 1]['title'] = $k['jam_keluar'];
                $result[$i + 1]['tanggal'] = $k['tanggal'];
                if (strtotime($k['jam_masuk']) > strtotime('07:00:00')) {
                    $result[$i]['status'] = 'terlambat';
                } else {
                    $result[$i]['status'] = 'hadir';
                }
                $result[$i + 1]['status'] = 'hadir';
                $i += 2;
            }

            foreach ($cuti as $c) {
                $result[$i]['title'] = $c['jenis'];
                $result[$i]['tanggal'] = $c['tanggal'];
                $result[$i]['status'] = 'cuti';
                $i++;
            }

            foreach ($dinasLuar as $d) {
                $result[$i]['title'] = $d['jenis'];
                $result[$i]['tanggal'] = $d['tanggal'];
                $result[$i]['status'] = 'dl';
                $i++;
            }

            foreach ($libur as $l) {
                $result[$i]['title'] = $l['nama_hari_libur'];
                $result[$i]['tanggal'] = $l['tanggal'];
                $result[$i]['status'] = 'libur';
                $i++;
            }

            if ($result) {
                echo '["' . $firstUpdate . '","' . $lastUpdate . '",' . json_encode($result) . ']';
            } else {
                echo '["' . $firstUpdate . '","' . $lastUpdate . '",' . '[]]';
            }
        }
    }
}

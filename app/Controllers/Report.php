<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\KelasModel;
use App\Models\SantriModel;
use App\Models\SPPModel;
use App\Models\TempSPPModel;

use Dompdf\Dompdf;

class Report extends BaseController
{
    protected $adminModel, $kelasModel, $santriModel, $sppModel, $tempsppModel, $db;

    public function __construct()
    {
        $this->adminModel   = new AdminModel();
        $this->kelasModel   = new KelasModel();
        $this->santriModel  = new SantriModel();
        $this->sppModel     = new SPPModel();
        $this->tempsppModel = new TempSPPModel();
        $this->db           = db_connect();
    }

    public function index()
    {
        $data = [
            'title'     => 'Report Data',
            'kelas'     => $this->kelasModel->findAll()
        ];
        // dd($this->kelasModel->findAll());
        return view('report/index', $data);
    }

    public function reportKelas()
    {
        $req_kelas = $this->request->getVar('nama_kelas');
        $kelas = $this->kelasModel->where('id_kelas', $req_kelas)->first();
        
        $filename = 'Rekap Kelas '.$kelas['nama_kelas'].' '.date('d M Y');

        $data = [
            'siswa' => $this->santriModel->where('id_kelas', $req_kelas)->findAll(),
            'title' => $filename,
            'kelas' => $kelas
        ];

        $dompdf = new Dompdf();

        $dompdf->loadHtml(view('report/kelas-report.php', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename, array("Attachment" => false));
    }

    public function reportSPP()
    {
        $bulan = $this->request->getVar('bulan');
        $kelas = $this->request->getVar('kelas');

        $bulan = date('m', strtotime($bulan));
        if($bulan == '01'){
            $bulan = 1;
        }elseif($bulan == '02'){
            $bulan = 2;
        }elseif($bulan == '03'){
            $bulan = 3;
        }elseif($bulan == '04'){
            $bulan = 4;
        }elseif($bulan == '05'){
            $bulan = 5;
        }elseif($bulan == '06'){
            $bulan = 6;
        }elseif($bulan == '07'){
            $bulan = 7;
        }elseif($bulan == '08'){
            $bulan = 8;
        }elseif($bulan == '09'){
            $bulan = 9;
        }

        $santri = $this->santriModel->where('id_kelas', $kelas)->findAll();
        $kelas = $this->kelasModel->where('id_kelas', $kelas)->first();

        $filename = 'Rekap SPP '.$kelas['nama_kelas'].' '.date('d M Y');

        $data = [
            'santri'    => $santri,
            'title'     => $filename,
            'kelas'     => $kelas,
            'bulan'     => $bulan,
            'db'  => $this->db
        ];

        $dompdf = new Dompdf();

        $dompdf->loadHtml(view('report/spp-report.php', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename, array("Attachment" => false));
        
    }
}

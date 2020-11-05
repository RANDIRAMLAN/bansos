<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\BansosModel;
use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use App\Models\DataBansosModel;
use App\Models\KodePosModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    protected $MenuModel;
    protected $BansosModel;
    protected $KeluargaModel;
    protected $AnggotaKeluargaModel;
    protected $DataBansosModel;
    protected $KodePosModel;
    public function __construct()
    {
        $this->MenuModel = new MenuModel();
        $this->BansosModel = new BansosModel();
        $this->KeluargaModel = new KeluargaModel();
        $this->AnggotaKeluargaModel = new AnggotaKeluargaModel();
        $this->DataBansosModel = new DataBansosModel();
        $this->KodePosModel = new KodePosModel();
    }
    // dashboard
    public function dashboard()
    {
        $roleId = session()->get('roleId');
        $nama =  session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $data = [
            'judul' => 'JGK - Dashboard',
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama,
            'jumlahKeluarga' => $this->KeluargaModel->jumlahKeluarga(),
            'jumlahWarga' => $this->AnggotaKeluargaModel->jumlahWarga(),
            'jumlahDataBansos' => $this->DataBansosModel->jumlahDataBansos(),
            'jumahperimaBansos' => $this->BansosModel->jumahperimaBansos()
        ];
        return view('Admin/dashboard', $data);
    }
    // persetujuan
    public function persetujuan()
    {
        $roleId = session()->get('roleId');
        $nama =  session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $data = [
            'judul' => 'JGK - Persetujuan',
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama,
            'persetujuan' => $this->KeluargaModel->getKeluargaUntukDisetujui()

        ];
        return view('Admin/persetujuan', $data);
    }
    // konfirmasi data keluarga
    public function konfirmasi()
    {
        $status = $this->request->getVar('status');
        $noKK = $this->request->getVar('noKK');
        $this->KeluargaModel->ubahStatusKeluarga($status, $noKK);
        return redirect()->to('/Admin/persetujuan');
    }
    // data keluarga
    public function data($page = 5)
    {
        $roleId = session()->get('roleId');
        $nama = session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $currentPage = $this->request->getVar('page_keluarga') ? $this->request->getVar('page_keluarga') : 1;
        $cari = $this->request->getVar('cari');
        if ($cari) {
            $keluarga = $this->KeluargaModel->cari($cari);
        } else {
            $keluarga = $this->KeluargaModel;
        }
        $data = [
            'judul' => 'JGK - Data Keluarga',
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama,
            'page' => $page,
            'keluarga' => $keluarga->paginate($page, 'keluarga'),
            'pager' => $this->KeluargaModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/Admin/data', $data);
    }
    // export data keluarga
    public function export_data_keluarga()
    {
        $spreadsheet = new Spreadsheet();
        $currentData = $this->KeluargaModel->findAll();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No. KK')
            ->setCellValue('B1', 'Kepala Keluarga')
            ->setCellValue('C1', 'Jumlah Anggota Keluarga')
            ->setCellValue('D1', 'Alamat')
            ->setCellValue('E1', 'Kabupaten/Kota')
            ->setCellValue('F1', 'Kecamatan')
            ->setCellValue('G1', 'Desa/Kelurahan')
            ->setCellValue('H1', 'Status');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($currentData as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['noKK'])
                ->setCellValue('B' . $column, $data['kepalaKeluarga'])
                ->setCellValue('C' . $column, $data['jumlahAnggotaKeluarga'])
                ->setCellValue('D' . $column, $data['alamat'])
                ->setCellValue('E' . $column, $data['kabKota'])
                ->setCellValue('F' . $column, $data['kecamatan'])
                ->setCellValue('G' . $column, $data['desaKelurahan'])
                ->setCellValue('H' . $column, $data['status']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Keluarga';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    // data anggota keluarga
    public function anggota_keluarga($noKK)
    {
        $roleId = session()->get('roleId');
        $nama = session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $data = [
            'judul' => 'JGK - Anggota Keluarga',
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama,
            'anggotaKeluarga' => $this->AnggotaKeluargaModel->getAnggotaKeluarga($noKK)
        ];
        return view('/Admin/anggota_keluarga', $data);
    }
    // export data anggota Keluarga
    public function export_data_anggota_keluarga()
    {
        $spreadsheet = new Spreadsheet();
        $currentData = $this->AnggotaKeluargaModel->findAll();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No. KK')
            ->setCellValue('B1', 'No. KTP')
            ->setCellValue('C1', 'Nama')
            ->setCellValue('D1', 'Tempat Lahir')
            ->setCellValue('E1', 'Tanggal Lahir')
            ->setCellValue('F1', 'Jenis Kelamin')
            ->setCellValue('G1', 'Status Perkawinan')
            ->setCellValue('H1', 'Pendidikan')
            ->setCellValue('I1', 'Pekerjaan')
            ->setCellValue('J1', 'Catatan');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($currentData as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['noKK'])
                ->setCellValue('B' . $column, $data['noKTP'])
                ->setCellValue('C' . $column, $data['nama'])
                ->setCellValue('D' . $column, $data['tempatLahir'])
                ->setCellValue('E' . $column, $data['tanggalLahir'])
                ->setCellValue('F' . $column, $data['jenisKelamin'])
                ->setCellValue('G' . $column, $data['statusPerkawinan'])
                ->setCellValue('H' . $column, $data['pendidikan'])
                ->setCellValue('I' . $column, $data['pekerjaan'])
                ->setCellValue('J' . $column, $data['catatan']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Anggota Keluarga';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    // bansos
    public function bansos()
    {
        $roleId = session()->get('roleId');
        $nama = session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $data = [
            'judul' => 'JGK - Bansos',
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama
        ];
        return view('/Admin/bansos', $data);
    }
    // export data bansos
    public function export_data_bansos()
    {
        $spreadsheet = new Spreadsheet();
        $currentData = $this->DataBansosModel->findAll();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID Bansos')
            ->setCellValue('B1', 'Nama Bansos')
            ->setCellValue('C1', 'Kategori')
            ->setCellValue('D1', 'Pendamping')
            ->setCellValue('E1', 'Nominal')
            ->setCellValue('F1', 'Tipe Bansos');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($currentData as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['idBansos'])
                ->setCellValue('B' . $column, $data['namaBansos'])
                ->setCellValue('C' . $column, $data['kategori'])
                ->setCellValue('D' . $column, $data['pendamping'])
                ->setCellValue('E' . $column, $data['nominal'])
                ->setCellValue('F' . $column, $data['tipeBansos']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Bansos';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    // export data penerima bansos
    public function penerima_data_bansos()
    {
        $spreadsheet = new Spreadsheet();
        $currentData = $this->BansosModel->findAll();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No. KK')
            ->setCellValue('B1', 'Kepala Keluarga')
            ->setCellValue('C1', 'ID Bansos')
            ->setCellValue('D1', 'Nama Bansos')
            ->setCellValue('E1', 'Kategori')
            ->setCellValue('F1', 'Pendamping')
            ->setCellValue('G1', 'Nominal')
            ->setCellValue('H1', 'Status Anggota');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($currentData as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['noKK'])
                ->setCellValue('B' . $column, $data['kepalaKeluarga'])
                ->setCellValue('C' . $column, $data['idBansos'])
                ->setCellValue('D' . $column, $data['namaBansos'])
                ->setCellValue('E' . $column, $data['kategori'])
                ->setCellValue('F' . $column, $data['pendamping'])
                ->setCellValue('G' . $column, $data['nominal'])
                ->setCellValue('H' . $column, $data['statusAnggota']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Penerima Bansos';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    // cari data keluarga(autocomplete)
    function keluarga_autocomplete()
    {
        $auto = $this->request->getVar('term');
        $keluarga = $this->KeluargaModel->autocomplete($auto);
        $w = array();
        foreach ($keluarga as $k) {
            $w[] = [
                "label" => $k['noKK'],
                "kepalaKeluarga" => $k['kepalaKeluarga'],
            ];
        }
        echo json_encode($w);
    }
    // cari data bansos (autocomplate)
    public function bansos_autocomplete()
    {
        $cari = $this->request->getVar('term');
        $bansos = $this->DataBansosModel->cari($cari);
        $w = array();
        foreach ($bansos as $b) {
            $w[] = [
                "label" => $b['idBansos'],
                "namaBansos" => $b['namaBansos'],
                "kategori" => $b['kategori'],
                "pendamping" => $b['pendamping'],
                "nominal" => $b['nominal']
            ];
        }
        echo json_encode($w);
    }
    // simpan data penerima bansos
    public function simpan_data_penerima_bansos()
    {
        $noKK = $this->request->getVar('noKK');
        $kepalaKeluarga = $this->request->getVar('kepalaKeluarga');
        $idBansos = $this->request->getVar('idBansos');
        $namaBansos = $this->request->getVar('namaBansos');
        $kategori = $this->request->getVar('kategori');
        $pendamping = $this->request->getVar('pendamping');
        $nominal = $this->request->getVar('nominal');
        $jumlahData = count($noKK);
        $jumlahBerhasil = 0;
        $jumlahGagal = 0;
        $jumlahTerdaftar = 0;
        $jumlahDataKKTidakDitemukan = 0;
        $jumlahDataBansosTidakDitemukan = 0;
        $jumlahBelumDisetujui = 0;
        for ($i = 0; $i < $jumlahData; $i++) {
            // cek apakah fieldnya kosong
            if ($noKK[$i] == 0 || $idBansos[$i] == 0) {
                $jumlahGagal++;
            } else {
                // cek pada database apakah data KK tersebut ada
                $dataKeluarga = $this->KeluargaModel->where('noKK', $noKK[$i])->first();
                if ($dataKeluarga) {
                    // cek pada  database apakah data bansos ada
                    $dataBansos = $this->DataBansosModel->where('idBansos', $idBansos[$i])->first();
                    if ($dataBansos) {
                        // cek apakah data keluarga sudah
                        $status = 'Disetujui';
                        $disetujui = $this->KeluargaModel->where('noKK', $noKK[$i])->where('status', $status)->first();
                        if ($disetujui) {
                            // cek data peserta apakah sudah terdaftar
                            $pesertaBansos = $this->BansosModel->where('noKK', $noKK[$i])->where('idBansos', $idBansos[$i])->first();
                            if ($pesertaBansos) {
                                $jumlahTerdaftar++;
                            } else {

                                $this->BansosModel->save([
                                    'noKK'              => $noKK[$i],
                                    'kepalaKeluarga'    => $kepalaKeluarga[$i],
                                    'idBansos'          => $idBansos[$i],
                                    'namaBansos'        => $namaBansos[$i],
                                    'kategori'          => $kategori[$i],
                                    'pendamping'        => $pendamping[$i],
                                    'nominal'           => $nominal[$i],
                                    'statusAnggota'     => 'Aktif'
                                ]);
                                $jumlahBerhasil++;
                            }
                        } else {
                            $jumlahBelumDisetujui++;
                        }
                    } else {
                        $jumlahDataBansosTidakDitemukan++;
                    }
                } else {
                    $jumlahDataKKTidakDitemukan++;
                }
            }
        }
        session()->setFlashdata('pesan', '' . $jumlahBerhasil . ' Berhasil Disimpan, ' . $jumlahTerdaftar . ' Telah Terdaftar, ' . $jumlahDataKKTidakDitemukan . ' Data KK Tidak Ditemukan, ' . $jumlahDataBansosTidakDitemukan . ' Data Bansos Tidak Ditemukan dan ' . $jumlahBelumDisetujui . ' Belum Disetujui');
        return redirect()->to('/Admin/penerima_bansos');
    }
    // penerima bansos
    public function penerima_bansos()
    {
        $roleId = session()->get('roleId');
        $nama = session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $data = [
            'judul' => 'JGK - Penerima Bansos',
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama

        ];
        return view('/Admin/penerima_bansos', $data);
    }
    // live search
    public function live_search()
    {
        if ($this->request->isAJAX()) {
            $cari = $this->request->getVar('cari');
            if ($cari) {
                $dataBansos = $this->BansosModel->cari($cari);
            } else {
                $dataBansos = $this->BansosModel->getBansos();
            }
            $output = '';
            // list bansos
            $output .= '           
                    <table class="table table-bordered">
            <thead>
                <tr>
                    <td class="text-center"></td>
                    <td><strong>No. KK</strong></td>
                    <td><strong>Kepala Keluarga</strong></td>
                    <td><strong>Nama Bansos</strong></td>
                    <td><strong>Kategori</strong></td>
                    <td><strong>Pendamping Bansos</strong></td>
                    <td><strong>Nominal</strong></td>
                    <td><strong>Status</strong></td>
                </tr>
            </thead>
            <tbody>
            ';
            foreach ($dataBansos as $row) {
                $output .= '
                <tr>
                <td width="43px" class="text-center checked">
                <input type="checkbox" name="id[]" class="check" value="' . $row['id'] . '">
                </td>
                <td>' . $row['noKK'] . '</td>
                <td>' . $row['kepalaKeluarga'] . '</td>
                <td>' . $row['namaBansos'] . '</td>
                <td>' . $row['kategori'] . '</td>
                <td>' . $row['pendamping'] . '</td>
                <td>' . $row['nominal'] . '</td>
                <td>' . $row['statusAnggota'] . '</td>
                </tr>
                ';
            }
            $output .= '</table>';
            //    echo $output;
            $callback = array(
                'data' => $output,
            );
            echo json_encode($callback);
        }
    }
    // ubah status peserta bansos
    public function ubah_data()
    {
        $id = $this->request->getVar('id');
        $jumlahAktif = 0;
        $jumlahTidakAktif = 0;
        if ($id) {
            $jumlahData = count($id);
            for ($i = 0; $i < $jumlahData; $i++) {
                $currentData = $this->BansosModel->where('id', $id[$i])->first();
                if ($currentData['statusAnggota'] == 'Aktif') {
                    $db      = \Config\Database::connect();
                    $builder = $db->table('bansos');
                    $builder->set('statusAnggota', 'Tidak Aktif');
                    $builder->where('id', $id[$i]);
                    $builder->update();
                    $jumlahTidakAktif++;
                } else {
                    $db      = \Config\Database::connect();
                    $builder = $db->table('bansos');
                    $builder->set('statusAnggota', 'Aktif');
                    $builder->where('id', $id[$i]);
                    $builder->update();
                    $jumlahAktif++;
                }
            }
        } else {
            session()->setFlashdata('gagal', 'Tidak Ada Data Yang Dipilih');
            return redirect()->to('/Admin/penerima_bansos');
        }
        session()->setFlashdata('pesan', '' . $jumlahAktif . ' Data Statusnya Dibuah Menjadi Aktif dan ' . $jumlahTidakAktif . ' Data Statusnya Diubah Menjadi Tidak Aktif');
        return redirect()->to('/Admin/penerima_bansos');
    }
    // tampil data bansos
    public function data_bansos()
    {
        $roleId = session()->get('roleId');
        $nama = session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $data = [
            'judul' => 'JGK - Data Bansos',
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama
        ];
        return view('/Admin/data_bansos', $data);
    }
    public function tampil_data()
    {
        $data = $this->DataBansosModel->findAll();

        echo json_encode($data);
    }
    // ubah data Basos
    public function ubah_data_bansos()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $idBansos = $this->request->getVar('idBansos');
            $currentData = $this->DataBansosModel->getById($idBansos);
            if ($currentData['idBansos'] == $idBansos) {
                $ruleIdBansos = 'required';
            } else {
                $ruleIdBansos = 'required|is_unique[data_bansos.idBansos]';
            }
            if (!$this->validate([
                'idBansos' => [
                    'rules' => $ruleIdBansos,
                    'errors' => [
                        'required' => 'ID Bansos Tidak Boleh Kosong',
                        'is_unique' => 'ID Bansos Tidak Boleh Sama'
                    ]
                ],
                'namaBansos' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Bansos Tidan Boleh Kosong'
                    ]
                ],
                'kategori' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Bansos Tidak Boleh Kosong'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'idBansos' => $validation->getError('idBansos'),
                        'namaBansos' => $validation->getError('namaBansos'),
                        'kategori' => $validation->getError('kategori')
                    ]
                ];
                echo json_encode($msg);
            } else {
                $id = $this->request->getVar('id');
                $idBansos = $this->request->getVar('idBansos');
                $namaBansos = $this->request->getVar('namaBansos');
                $kategori = $this->request->getVar('kategori');
                $kategoriLama = $this->request->getVar('kategoriLama');
                $pendamping = $this->request->getVar('pendamping');
                $nominal = $this->request->getVar('nominal');
                $tipeBansos = $this->request->getVar('tipeBansos');
                $tipeBansoslama = $this->request->getVar('tipeBansosLama');

                if ($kategori == false) {
                    $dataKategori = $kategoriLama;
                } else {
                    $dataKategori = $kategori;
                }
                if ($tipeBansos == false) {
                    $dataTipeBansos = $tipeBansoslama;
                } else {
                    $dataTipeBansos = $tipeBansos;
                }
                $this->DataBansosModel->ubah_data_bansos($id, $idBansos, $namaBansos, $dataKategori, $pendamping, $nominal, $dataTipeBansos);
                $msg = [
                    'pesan' => 'Data Berhasil DiUbah'
                ];
                echo json_encode($msg);
            }
        } else {
            return redirect()->to('/Admin/data_bansos');
        }
    }
    // simpan data bansos
    public function simpan_data_bansos()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'idBansos' => [
                    'rules' => 'required|is_unique[data_bansos.idBansos]',
                    'errors' => [
                        'required' => 'ID Bansos Tidak Boleh Kosong',
                        'is_unique' => 'ID Bansos Tidak Boleh Sama'
                    ]
                ],
                'namaBansos' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Bansos Tidan Boleh Kosong'
                    ]
                ],
                'kategori' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Bansos Tidak Boleh Kosong'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'idBansos' => $validation->getError('idBansos'),
                        'namaBansos' => $validation->getError('namaBansos'),
                        'kategori' => $validation->getError('kategori')
                    ]
                ];
                echo json_encode($msg);
            } else {
                $idBansos = $this->request->getVar('idBansos');
                $namaBansos = $this->request->getVar('namaBansos');
                $kategori = $this->request->getVar('kategori');
                $pendamping = $this->request->getVar('pendamping');
                $nominal = $this->request->getVar('nominal');
                $tipeBansos = $this->request->getVar('tipeBansos');

                $this->DataBansosModel->insert([
                    'idBansos'      => $idBansos,
                    'namaBansos'    => $namaBansos,
                    'kategori'      => $kategori,
                    'pendamping'    => $pendamping,
                    'nominal'       => $nominal,
                    'tipeBansos'    => $tipeBansos
                ]);
                $msg = [
                    'pesan' => 'Data Berhasil Disimpan'
                ];
                echo json_encode($msg);
            }
        } else {
            return redirect()->to('/Admin/data_bansos');
        }
    }

    public function hapus_data_bansos()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->DataBansosModel->hapusDataById($id);
            $msg = [
                'pesan' => 'Data Berhasil DiHapus'
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to('/Admin/data_bansos');
        }
    }
    public function import($page = 10)
    {
        $roleId = session()->get('roleId');
        $nama =  session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $currentPage = $this->request->getVar('page_kode_pos');
        if (!$currentPage) {
            $num = 1;
        } else {
            $num = $this->request->getVar('page_kode_pos');
        }
        $data = [
            'judul' => 'JGK - Import Data',
            'validation' => \Config\Services::validation(),
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama,
            'page' => $page,
            'kodepos' => $this->KodePosModel->paginate($page, 'kode_pos'),
            'pager' => $this->KodePosModel->pager,
            'currentPage' => $num
        ];
        return view('/Admin/import', $data);
    }

    // import data excel
    public function import_data()
    {
        if (!$this->validate([
            'import' => [
                'rules' => 'uploaded[import]|ext_in[import,xls,xlsx]',
                'errors' => [
                    'uploaded' => 'File Harus Diisi',
                    'ext_in' => 'Ekstensi File Tidak Sesuai(xlsx)'
                ]
            ]
        ])) {
            return redirect()->to('Admin/import')->withInput();
        }
        $file = $this->request->getFile('import');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        // lokasi file excel
        $spreadsheet = $reader->load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $sheet = $worksheet->toArray();
        $jumlahSukses = 0;
        $jumlahGagal = 0;
        //looping untuk mengambil data
        foreach ($sheet as $x => $row) {
            if ($x == 0) {
                continue;
            }
            $posDesaKelurahan = $row[0];
            $kodePos = $row[1];
            $desaKelurahan = $row[2];
            $kecamatan = $row[3];
            $kabKota = $row[4];
            $currentData = $this->KodePosModel->getData($posDesaKelurahan);
            if ($currentData) {
                $jumlahGagal++;
            } else {
                $this->KodePosModel->save([
                    'posDesaKelurahan' => $posDesaKelurahan,
                    'kodePos' => $kodePos,
                    'desaKelurahan' => $desaKelurahan,
                    'kecamatan' => $kecamatan,
                    'kabKota' => $kabKota
                ]);
                $jumlahSukses++;
            }
        }
        // }
        session()->setFlashdata('pesan', '' . $jumlahSukses . ' Sukses Diimport dan ' . $jumlahGagal . ' Gagal Diimport');
        return redirect()->to('/Admin/import');
    }

    // export data excel
    public function export_data()
    {
        $spreadsheet = new Spreadsheet();
        $currentData = $this->KodePosModel->findAll();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Pos Desa/Kelurahan')
            ->setCellValue('B1', 'Kode Pos')
            ->setCellValue('C1', 'Kelurahan')
            ->setCellValue('D1', 'Kecamatan')
            ->setCellValue('E1', 'Kabupaten');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($currentData as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['posDesaKelurahan'])
                ->setCellValue('B' . $column, $data['kodePos'])
                ->setCellValue('C' . $column, $data['desaKelurahan'])
                ->setCellValue('D' . $column, $data['kecamatan'])
                ->setCellValue('E' . $column, $data['kabKota']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Kode Pos';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    // hapus data kodepos(banyak)
    public function hapus_banyak()
    {
        $posDesaKelurahan = $this->request->getVar('posDesaKelurahan');
        $jumlahHapus = 0;
        if ($posDesaKelurahan) {
            $jumlahData = count($posDesaKelurahan);
            for ($i = 0; $i < $jumlahData; $i++) {
                $db      = \Config\Database::connect();
                $builder = $db->table('kode_pos');
                $builder->where('posDesaKelurahan', $posDesaKelurahan[$i]);
                $builder->delete();
                $jumlahHapus++;
            }
        } else {
            session()->setFlashdata('gagal', 'Data Gagal Hapus. Pilih Data Terlebih Dahulu');
            return redirect()->to('/Admin/import');
        }
        session()->setFlashdata('pesan', '' . $jumlahHapus . ' Data Berhasil Dihapus');
        return redirect()->to('/Admin/import');
    }
    // tambah data kode Pos(banyak)
    public function tambah_data()
    {
        $roleId = session()->get('roleId');
        $nama = session()->get('nama');
        $noKK = session()->get('noKK');
        if ($noKK) {
            $segment = $this->request->uri->getSegment(1);
            $menu = $this->MenuModel->userMenu($segment);
            $menuId = $menu[0]['id'];
            $akses = $this->MenuModel->getAkses($roleId, $menuId);
            if (!$akses) {
                if ($roleId == 2) {
                    return redirect()->to('/User/index');
                } else {
                    return redirect()->to('/Admin/dashboard');
                }
            }
        } else {
            return redirect()->to('/');
        }
        $data = [
            'judul' => 'JGK - Bansos',
            'validation' => \Config\Services::validation(),
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama
        ];
        return view('/Admin/tambah_data', $data);
    }
    // simpan banyak data
    public function tambah_banyak()
    {
        $posDesaKelurahan = $this->request->getVar('posDesaKelurahan');
        $kodePos = $this->request->getVar('kodePos');
        $desaKelurahan = $this->request->getVar('desaKelurahan');
        $kecamatan = $this->request->getVar('kecamatan');
        $kabKota = $this->request->getVar('kabKota');
        $jumlahData = count($posDesaKelurahan);
        $jumlahGagal = 0;
        $jumlahBerhasil = 0;
        $jumlahTerdaftar = 0;
        for ($i = 0; $i < $jumlahData; $i++) {
            if ($posDesaKelurahan[$i] == 0 || $kodePos[$i] == 0 || $desaKelurahan[$i] == 0 || $kecamatan[$i] == 0 || $kabKota[$i] == 0) {
                $jumlahGagal++;
            } else {
                $currentData = $this->KodePosModel->where('posDesaKelurahan', $posDesaKelurahan[$i])->first();
                if ($currentData) {
                    $jumlahTerdaftar++;
                } else {
                    $this->KodePosModel->save([
                        'posDesaKelurahan' => $posDesaKelurahan[$i],
                        'kodePos' => $kodePos[$i],
                        'desaKelurahan' => $desaKelurahan[$i],
                        'kecamatan' => $kecamatan[$i],
                        'kabKota' => $kabKota[$i]
                    ]);
                    $jumlahBerhasil++;
                }
            }
        }
        session()->setFlashdata('pesan', '' . $jumlahBerhasil . ' Berhasil Disimpan, ' . $jumlahGagal . ' Gagal Disimpan dan ' . $jumlahTerdaftar . ' Sudah Terdaftar');
        return redirect()->to('/Admin/import');
    }
}

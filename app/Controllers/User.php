<?php

namespace App\Controllers;

use App\Models\AnggotaKeluargaModel;
use App\Models\KeluargaModel;
use App\Models\MenuModel;
use App\Models\KodePosModel;
use App\Models\BansosModel;

class User extends BaseController
{

    protected $KeluargaModel;
    protected $AnggotaKeluargaModel;
    protected $MenuModel;
    protected $KodePosModel;
    protected $BansosModel;
    public function __construct()
    {
        $this->KeluargaModel = new KeluargaModel();
        $this->AnggotaKeluargaModel = new AnggotaKeluargaModel();
        $this->MenuModel = new MenuModel();
        $this->KodePosModel = new KodePosModel();
        $this->BansosModel = new BansosModel();
    }
    // menampilkan data 
    public function index()
    {
        //mengambil data dari session
        $noKK = session()->get('noKK');
        $roleId = session()->get('roleId');
        $nama =  session()->get('nama');
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
            'validation' => \Config\Services::validation(),
            'judul' => 'JGK - DataKu',
            'keluarga' => $this->KeluargaModel->getKeluarga($noKK)->findAll(),
            'anggotakeluarga' => $this->AnggotaKeluargaModel->getAnggotaKeluarga($noKK),
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama

        ];
        return view('/User/index', $data);
    }
    // buat data keluarga
    public function buat_data_keluarga()
    {
        //mengambil data dari session
        $noKK = session()->get('noKK');
        $roleId = session()->get('roleId');
        $nama =  session()->get('nama');
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
            'judul' => 'JGK - Tambah Data',
            'validation' => \Config\Services::validation(),
            'user' =>  $noKK,
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama,
            'keluarga' => $this->KeluargaModel->getKeluarga($noKK)->findAll(),
            'kabKota' => $this->KodePosModel->getKabKota()
        ];
        if ($data['keluarga']) {
            session()->setFlashdata('pesan', 'Data Keluarga Telah Dibuat.');
            return redirect()->to('/User/index');
        } else {
            return view('/User/buat_data_keluarga', $data);
        }
    }
    // menampilkan data kecamatan berdasarkan kabupaten
    public function kecamatan()
    {
        if ($this->request->isAJAX()) {
            $kabKota = $this->request->getVar('kabKota');
            $listKecamatan  = $this->KodePosModel->getKecamatan($kabKota);
            $lists = "<option value=''>-- Pilih Kecamatan --</option>";
            foreach ($listKecamatan as $data) {
                $lists .= "<option value='" . $data['kecamatan'] . "'>" . $data['kecamatan'] . "</option>";
            }
            $callback = array('kecamatan' => $lists);
            echo json_encode($callback);
        }
    }
    // menampilkan data kelurahan berdasarkan kecamatan
    public function desa_kelurahan()
    {
        if ($this->request->isAJAX()) {
            $kecamatan = $this->request->getVar('kecamatan');
            $listDesaKelurahan = $this->KodePosModel->getDesaKelurahan($kecamatan);
            $lists = "<option value=''>-- Pilih Desa/Kelurahan --</option>";
            foreach ($listDesaKelurahan as $data) {
                $lists .= "<option value='" . $data['desaKelurahan'] . "'>" . $data['desaKelurahan'] . "</option>";
            }
            $callback = array('desaKelurahan' => $lists);
            echo json_encode($callback);
        }
    }
    // simpan data keluarga
    public function simpan()
    {
        // validasi data
        if (!$this->validate([
            'noKK' => [
                'rules' => 'required|is_unique[keluarga.noKK]',
                'errors' => [
                    'required' => ' No. KK harus Diisi',
                    'is_unique' => 'NO. KK Sudah Terdaftar'
                ]
            ],
            'kepalaKeluarga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ' Kepala Keluarga Harus Diisi'
                ]
            ],
            'jumlahAnggotaKeluarga' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Jumlah Anggota Keluarga Harus Diisi',
                    'integer' => ' Jumlah Anggota Keluarga Hanya Diisi Angka '
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus Diisi'
                ]
            ],
            'kabKota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kabupaten/Kota Harus Diisi'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kecamatan Harus Diisi'
                ]
            ],
            'desaKelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Desa/Kelurahan Harus Diisi'
                ]
            ],
            'fotoKK' => [
                'rules' => 'uploaded[fotoKK]|is_image[fotoKK]|mime_in[fotoKK,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto Kartu Keluarga Harus Diisi',
                    'is_image' => 'Hanya Untuk Upload Foto',
                    'mime_in' => 'Format Foto Harus jpeg, jpg dan png'
                ]
            ]

        ])) {
            return redirect()->to('/User/buat_data_keluarga')->withInput();
        }
        // ambil foto KTP dengan randome name
        $filefotoKK = $this->request->getFile('fotoKK');
        $namaFotoKK = $filefotoKK->getRandomName();
        $filefotoKK->move('img/KK', $namaFotoKK);
        $this->KeluargaModel->save([
            'noKK'                  => $this->request->getVar('noKK'),
            'kepalaKeluarga'        => $this->request->getVar('kepalaKeluarga'),
            'jumlahAnggotaKeluarga' => $this->request->getVar('jumlahAnggotaKeluarga'),
            'alamat'                => $this->request->getVar('alamat'),
            'kabKota'               => $this->request->getVar('kabKota'),
            'kecamatan'             => $this->request->getVar('kecamatan'),
            'desaKelurahan'         => $this->request->getVar('desaKelurahan'),
            'status'                => $this->request->getVar('status'),
            'fotoKK'                => $namaFotoKK
        ]);

        session()->setFlashdata('pesan', 'Data Keluarga Berhasil Disimpan');
        return redirect()->to('/User/index');
    }

    public function ubah_data_keluarga()
    {
        //mengambil data dari session
        $noKK = session()->get('noKK');
        $roleId = session()->get('roleId');
        $nama =  session()->get('nama');
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
            'judul' => 'JGK - Ubah Data',
            'keluarga' => $this->KeluargaModel->getKeluarga($noKK)->first(),
            'validation' => \Config\Services::validation(),
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama
        ];
        if (empty($data['keluarga'])) {
            session()->setFlashdata('gagal', 'Data Keluarga Tidak Ditemukan.');
            return redirect()->to('/User/index');
        }
        return view('/User/ubah_data_keluarga', $data);
    }
    // ubah data keluarga
    public function ubah($id)
    {
        if (!$this->validate([
            'jumlahAnggotaKeluarga' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Jumlah Anggota Keluarga Harus Diisi',
                    'integer' => ' Jumlah Anggota Keluarga Hanya Diisi Angka '
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus Diisi'
                ]
            ],
            'fotoKK' => [
                'rules' => 'is_image[fotoKK]|mime_in[fotoKK,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Hanya Untuk Upload Foto',
                    'mime_in' => 'Format Foto Harus jpeg, jpg dan png'
                ]
            ]
        ])) {

            return redirect()->to('/User/ubah_data_keluarga/' . $this->request->getVar('noKK'))->withInput();
        }

        //Cek Perubahan Gambar
        $filefotoKK = $this->request->getFile('fotoKK');

        if ($filefotoKK->getError() == 4) {
            $namaFotoKK = $this->request->getVar('fotoKKLama');
        } else {
            $namaFotoKK = $filefotoKK->getRandomName();
            $filefotoKK->move('img/KK', $namaFotoKK);
            unlink('img/KK/' . $this->request->getVar('fotoKKLama'));
        }

        $this->KeluargaModel->save([

            'id'                    => $id,
            'noKK'                  => $this->request->getVar('noKK'),
            'kepalaKeluarga'        => $this->request->getVar('kepalaKeluarga'),
            'jumlahAnggotaKeluarga' => $this->request->getVar('jumlahAnggotaKeluarga'),
            'alamat'                => $this->request->getVar('alamat'),
            'kabKota'               => $this->request->getVar('kabKota'),
            'kecamatan'             => $this->request->getVar('kecamatan'),
            'desaKelurahan'         => $this->request->getVar('desaKelurahan'),
            'status'                => $this->request->getVar('status'),
            'fotoKK'                => $namaFotoKK
        ]);
        session()->setFlashdata('pesan', 'Data Keluarga Berhasil Diubah');
        return redirect()->to('/User/index');
    }
    public function buat_data_anggota_keluarga()
    {
        // mengambil data dari session
        $noKK = session()->get('noKK');
        $roleId = session()->get('roleId');
        $nama =  session()->get('nama');
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
            'judul' => ' JGK - Tamba Data',
            'validation' => \Config\Services::validation(),
            'keluarga' => $this->KeluargaModel->getKeluarga($noKK)->first(),
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama

        ];
        if (empty($data['keluarga'])) {
            session()->setFlashdata('gagal', 'Data Keluarga Tidak Ditemukan.');
            return redirect()->to('/User/index');
        }
        return view('/User/buat_data_anggota_keluarga', $data);
    }
    // simpan data anggota keluarga
    public function simpan2()
    {
        // validasi data
        if (!$this->validate([
            'noKK' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Buatlah Data Keluarga Terlebih Dahulu Sebelum Membuat Data Anggota Keluarga',
                ]
            ],
            'noKTP' => [
                'rules' => 'required|is_unique[anggotakeluarga.noKTP]',
                'errors' => [
                    'required' => 'NO. KTP Harus Diisi',
                    'is_unique' => 'No KTP Sudah Terdaftar'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Harus Diisi'
                ]
            ],
            'tempatLahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat Lahir Harus Diisi'
                ]
            ],
            'tanggalLahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir Harus Diisi'
                ]
            ],
            'jenisKelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Harus Diisi'
                ]
            ],
            'fotoKTP' => [
                'rules' => 'uploaded[fotoKTP]|is_image[fotoKTP]|mime_in[fotoKTP,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto KTP Harus Diisi',
                    'is_image' => 'Hanya Untuk Upload Foto',
                    'mime_in' => 'Format Foto Harus jpeg, jpg dan png'
                ]
            ]
        ])) {
            return redirect()->to('/User/buat_data_anggota_keluarga/' . $this->request->getVar('noKK'))->withInput();
        }
        // ambil foto KTP dengan randome name
        $fileFotoKTP = $this->request->getFile('fotoKTP');
        $namaFotoKTP = $fileFotoKTP->getRandomName();
        $fileFotoKTP->move('img/KTP', $namaFotoKTP);
        $this->AnggotaKeluargaModel->save([
            'noKK'                  => $this->request->getVar('noKK'),
            'noKTP'                 => $this->request->getVar('noKTP'),
            'nama'                  => $this->request->getVar('nama'),
            'tempatLahir'           => $this->request->getVar('tempatLahir'),
            'tanggalLahir'          => $this->request->getVar('tanggalLahir'),
            'jenisKelamin'          => $this->request->getVar('jenisKelamin'),
            'statusPerkawinan'      => $this->request->getVar('statusPerkawinan'),
            'pendidikan'            => $this->request->getVar('pendidikan'),
            'pekerjaan'             => $this->request->getVar('pekerjaan'),
            'catatan'               => $this->request->getVar('catatan'),
            'fotoKTP'               => $namaFotoKTP

        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Disimpan');
        return redirect()->to('/User/index');
    }

    // ubah data anggota keluarga
    public function ubah2($id)
    {
        if (!$this->validate([
            'fotoKTP' => [
                'rules' => 'is_image[fotoKTP]|mime_in[fotoKTP,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Hanya Untuk Upload Foto',
                    'mime_in' => 'Format Foto Harus jpeg, jpg dan png'
                ]
            ]
        ])) {
            session()->setFlashdata('gagal', 'Data Gagal Diubah, Periksa Data Yang Salah');
            return redirect()->to('/User/index')->withInput();
        }
        //cek Perubahan gambar
        $filefotoKTP = $this->request->getFile('fotoKTP');
        if ($filefotoKTP->getError() == 4) {
            $namaFotoKTP = $this->request->getVar('fotoKTPLama');
        } else {
            $namaFotoKTP = $filefotoKTP->getRandomName();
            $filefotoKTP->move('img/KTP', $namaFotoKTP);
            unlink('img/KTP/' . $this->request->getVar('fotoKTPLama'));
        }

        $this->AnggotaKeluargaModel->save([
            'id'                    => $id,
            'noKK'                  => $this->request->getVar('noKK'),
            'noKTP'                 => $this->request->getVar('noKTP'),
            'nama'                  => $this->request->getVar('nama'),
            'tempatLahir'           => $this->request->getVar('tempatLahir'),
            'tanggalLahir'          => $this->request->getVar('tanggalLahir'),
            'jenisKelamin'          => $this->request->getVar('jenisKelamin'),
            'statusPerkawinan'      => $this->request->getVar('statusPerkawinan'),
            'pendidikan'            => $this->request->getVar('pendidikan'),
            'pekerjaan'             => $this->request->getVar('pekerjaan'),
            'catatan'               => $this->request->getVar('catatan'),
            'fotoKTP'               => $namaFotoKTP
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/User/index');
    }
    // hapus data anggota keluarga
    public function hapus_data_anggota_keluarga($id)
    {
        $anggotaKeluarga = $this->AnggotaKeluargaModel->find($id);
        unlink('img/KTP/' . $anggotaKeluarga['fotoKTP']);
        $this->AnggotaKeluargaModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/User/index');
    }
    // keluar aplikasi
    public function keluar()
    {
        session()->destroy();
        return redirect()->to('/');
    }
    // bansos yang diterima
    public function bansosku()
    {
        $noKK = session()->get('noKK');
        $roleId = session()->get('roleId');
        $nama =  session()->get('nama');
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
            'judul' => 'JGK - Bansosku',
            'menu' => $this->MenuModel->getMenu($roleId),
            'submenu' => $this->MenuModel->getSubMenu($roleId),
            'nama' => $nama,
            'bansosku' => $this->BansosModel->getByNoKK($noKK)
        ];
        return view('User/bansosku', $data);
    }
}

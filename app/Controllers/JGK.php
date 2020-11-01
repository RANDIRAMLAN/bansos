<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\UserTokenModel;


class JGK extends BaseController
{
    protected $UserModel;
    protected $UserTokenModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->UserTokenModel = new UserTokenModel();
    }

    // masuk aplikasi
    public function masuk()
    {
        $data = [
            'judul' => 'JGK - Masuk',
            'validation' => \Config\Services::validation()
        ];
        return view('JGK/masuk', $data);
    }

    public function masuk_aplikasi()
    {


        if (!$this->validate([
            'noKK' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. KK Balum Diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Belum Diisi'
                ]
            ]
        ])) {

            return redirect()->to('/JGK/masuk')->withInput();
        }
        // validasi data saat login
        $noKK = $this->request->getVar('noKK');
        $password = $this->request->getVar('password');
        $user = $this->UserModel->getUserByNoKK($noKK);

        if ($user) {
            if ($user['isActive'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'noKK' => $user['noKK'],
                        'roleId' => $user['roleId'],
                        'nama' => $user['nama']
                    ];
                    // data dikirim menggunakan session
                    if ($user['roleId'] == 1) {
                        session()->set($data);
                        return redirect()->to('/admin/dashboard');
                    } else {
                        session()->set($data);
                        return redirect()->to('/user/index');
                    }
                } else {
                    session()->setFlashdata('gagal', 'Password Yang Diinput Salah');
                    return redirect()->to('/');
                }
            } else {
                session()->setFlashdata('gagal', 'Akun Anda Belum Aktif');
                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('gagal', 'No. KK Belum Terdaftar');
            return redirect()->to('/');
        }
    }

    // Pendaftaran
    public function daftar()
    {
        $data = [
            'judul' => 'JGK - Daftar',
            'validation' => \Config\Services::validation()

        ];
        return view('JGK/daftar', $data);
    }
    // daftar
    public function simpan_data_user()
    {
        if (!$this->validate([
            'noKK' => [
                'rules' => 'required|is_unique[user.noKK]',
                'errors' => [
                    'required' => 'Nama Pengguna Harus Diisi',
                    'is_unique' => 'Nomor KK Sudah Terdaftar'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pengguna Harus Diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'Email Harus Diisi',
                    'valid_email' => 'Format Email Salah',
                    'is_unique' => 'Alamat Email Sudah Terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|matches[password2]',
                'errors' => [
                    'required' => 'Kata Sandi Harus Diisi',
                    'matches' => 'Kata sandi Harus Sama Dengan Konfirmasi Kata Sandi'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Kata Sandi Harus Diisi',
                    'matches' => 'Konfirmasi Kata Sandi Tidak Sama Dengan Kata Sandi'
                ]
            ]
        ])) {
            return redirect()->to('/JGK/daftar')->withInput();
        }
        $email = $this->request->getVar('email');
        $token = base64_encode(random_bytes(32));
        // simpan data user
        $this->UserModel->save([
            'noKK'              => $this->request->getVar('noKK'),
            'nama'              => $this->request->getVar('nama'),
            'email'             => $email,
            'fotoProfil'        => 'default.jpg',
            'password'          => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'roleId'            => 2,
            'isActive'          => 0

        ]);
        // simpan data token
        $this->UserTokenModel->save([
            'email' => $email,
            'token' => $token
        ]);
        // kirim email aktivasi
        $this->_sendEmail($token, 'verify');
        session()->setFlashdata('pesan', 'Akun Berhasil Dibuat');
        return redirect()->to('/');
    }

    // verifikasi
    public function verifikasi()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        $user = $this->UserModel->getUserByEmail($email);
        if ($user) {
            $user_token  = $this->UserTokenModel->getTokenByToken($token);
            if ($user_token) {
                if (strtotime(time()) - strtotime($user_token['created_at']) < (60 * 60 * 24)) {
                    // update status active user
                    $this->UserModel->ubahStatusAktifUser($email);
                    // hapus Token Jika berhasil verifikasi
                    $this->UserTokenModel->hapusToken($email);
                    session()->setFlashdata('pesan', 'Proses Aktivasi Berhasil');
                    return redirect()->to('/');
                } else {
                    // hapus Token yang kadaluarsa
                    $this->UserTokenModel->hapusToken($email);
                    // hapus user yang kadaluarsa
                    $this->UserModel->hapusDatauser($email);
                    session()->setFlashdata('gagal', 'Proses Aktivasi Gagal. Waktu Tunngu Untuk Verifikasi Lebih Dari 24 Jam. Silahkan Mendaftar Ulang');
                    return redirect()->to('/');
                }
            } else {
                session()->setFlashdata('gagal', 'Proses Aktivasi Gagal. Data Token Tidak Ditemukan');
                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('gagal', 'Proses Aktivasi Gagal. Terdapat Kesalahan Pada Email');
            return redirect()->to('/');
        }
    }

    // email lupa kata sandi
    public function lupa_sandi()
    {
        $data = [
            'judul' => 'JGK - Lupa Sandi',
            'validation' => \Config\Services::validation()
        ];
        return view('/JGK/lupa_sandi', $data);
    }
    public function ganti_sandi()
    {
        $token = base64_encode(random_bytes(32));
        $email = $this->request->getVar('email');
        $user = $this->UserModel->getUserByEmail($email);
        if ($user) {
            $this->_sendEmail($token, 'forget');
            session()->setFlashdata('pesan', 'Permintaan Ganti Kata Sandi Berhasil Dikirim');
            return redirect()->to('/');
        } else {
            session()->setFlashdata('gagal', 'Email Yang Anda Masukkan Tidak Terdaftar');
            return redirect()->to('/JGK/lupa_sandi');
        }
    }

    // buat sandi baru
    public function buat_sandi_baru()
    {
        $email = $this->request->getVar('email');
        $data = [
            'judul' => 'JGK - Sandi Baru',
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUserByEmail($email)
        ];
        return view('/JGK/buat_sandi_baru', $data);
    }

    public function sandi_baru()
    {
        $db      = \Config\Database::connect();
        if (!$this->validate([
            'password' => [
                'rules' => 'required|matches[password2]',
                'errors' => [
                    'required' => 'Kata Sandi Harus Diisi',
                    'matches' => 'Kata sandi Baru Harus Sama Dengan Konfirmasi Kata Sandi'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Kata Sandi Harus Diisi',
                    'matches' => 'Konfirmasi Kata Sandi Baru Tidak Sama Dengan Kata Sandi'
                ]
            ]
        ])) {
            return redirect()->to('/JGK/buat_sandi_baru')->withInput();
        }

        $email = $this->request->getVar('email');
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $user = $this->UserModel->getUserByEmail($email);
        if ($user) {
            // update user
            $builder = $db->table('user');
            $builder->set('password', $password);
            $builder->where('email', $email);
            $builder->update();
            session()->setFlashdata('pesan', 'Kata Sandi Berhasil Diganti');
            return redirect()->to('/');
        } else {
            session()->setFlashdata('gagal', 'Email Tidak Ditemukan');
            return redirect()->to('/');
        }
    }


    //  email verifikasi saat aktivasi dan lupa sandi
    private function _sendEmail($token, $type)
    {

        $email = \Config\Services::email();
        $email->setFrom('jgkbersatu@gmail.com', ' JGK Aplikasi');
        $email->setTo($this->request->getVar('email'));
        if ($type == 'verify') {
            $email->setSubject('Activasi Akun');
            $email->setMessage('Klik link berikut untuk activasi akun anda : <a href = "' . \base_url() . '/JGK/verifikasi?email=' . $this->request->getVar('email') . '&token=' . \urlencode($token) . '">Verifikasi</a>');
        }
        if ($type == 'forget') {
            $email->setSubject('Ganti Kata Sandi');
            $email->setMessage('Klik link berikut untuk mengganti kata sandi : <a href = "' . \base_url() . '/JGK/buat_sandi_baru?email=' . $this->request->getVar('email') . '&token=' . \urlencode($token) . '">Ganti Kata Sandi</a>');
        }
        if ($email->send(false)) {
            $email->printDebugger();
        } else {
            $email->send();
        }
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'noKK',
        'nama',
        'email',
        'fotoProfil',
        'password',
        'roleId',
        'isActive'
    ];
    // tampil data user by noKK
    public function getUserByNoKK($noKK)
    {
        return $this->where(['noKK' => $noKK])->first();
    }
    // tampil data user by email
    public function getUserByEmail($email)
    {
        return $this->where(['email' => $email])->first();
    }
    // ubah status activ user
    public function ubahStatusAktifUser($email)
    {
        return $this->set('isActive', 1)
            ->where(['email' => $email])
            ->update();
    }
    // hapus data user jika link aktivasi kadaluarsa
    public function hapusDatauser($email)
    {
        return $this->where(['email' => $email])
            ->delete();
    }
}

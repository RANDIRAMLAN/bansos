<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTokenModel extends Model
{
    protected $table      = 'user_token';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'email',
        'token'
    ];
    // tampil data token berdasarkan nomor token
    public function getTokenByToken($token)
    {
        return $this->where(['token' => $token])->first();
    }
    // hapus token
    public function hapusToken($email)
    {
        return $this->where(['email' => $email])
            ->delete();
    }
}

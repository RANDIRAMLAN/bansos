<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaKeluargaModel extends Model
{
    protected $table      = 'anggotakeluarga';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'noKK',
        'noKTP',
        'nama',
        'tempatLahir',
        'tanggalLahir',
        'jenisKelamin',
        'statusPerkawinan',
        'pendidikan',
        'pekerjaan',
        'catatan',
        'fotoKTP'
    ];

    public function getAnggotaKeluarga($noKK)
    {
        return $this->where(['noKK' => $noKK])->findAll();
    }

    public function getAnggotaKeluargaByKTP($noKTP)
    {
        return $this->where(['noKTP' => $noKTP])->first();
    }

    public function jumlahWarga()
    {
        return $this->selectCount('noKTP')->countAll();
    }
}

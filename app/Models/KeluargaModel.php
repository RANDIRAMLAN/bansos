<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table      = 'keluarga';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'noKK',
        'kepalaKeluarga',
        'jumlahAnggotaKeluarga',
        'alamat',
        'kabKota',
        'kecamatan',
        'desaKelurahan',
        'status',
        'fotoKK'
    ];
    // cari data keluarga by noKK
    public function getKeluarga($noKK)
    {
        return $this->where(['noKK' => $noKK]);
    }
    // ubah status data keluarga setelah disetujui
    public function ubahStatusKeluarga($status, $noKK)
    {
        return $this->set('status', $status)
            ->where(['noKK' => $noKK])
            ->update();
    }
    // cari data keluarga yang statusnya masih pengajuan
    public function getKeluargaUntukDisetujui()
    {
        return $this->where(['status' => 'pengajuan'])->findAll();
    }
    // cari data keluarga untuk ditampilkan dalam bentuk pagination
    public function cari($cari)
    {
        return $this->like('noKK', $cari)->orLike('kepalaKeluarga', $cari)->findAll();
    }

    public function autocomplete($auto)
    {
        return $this->where(['status' => 'Disetujui'])->like('noKK', $auto)->orLike('kepalaKeluarga', $auto)->findAll();
    }
}

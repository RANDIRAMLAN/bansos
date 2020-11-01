<?php

namespace App\Models;

use CodeIgniter\Model;

class BansosModel extends Model
{
    protected $table      = 'bansos';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'noKK',
        'kepalaKeluarga',
        'idBansos',
        'namaBansos',
        'kategori',
        'pendamping',
        'nominal',
        'statusAnggota'
    ];

    public function getBansos()
    {
        return $this->findAll();
    }
    public function  cari($cari)
    {
        return $this->like(['noKK' => $cari])
            ->orlike(['kepalaKeluarga' => $cari])
            ->orlike(['idBansos' => $cari])
            ->orlike(['namaBansos' => $cari])
            ->orlike(['kategori' => $cari])
            ->orlike(['pendamping' => $cari])
            ->orlike(['statusAnggota' => $cari])
            ->findAll();
    }

    public function getByNoKK($noKK)
    {
        return $this->where(['noKK' => $noKK])->where(['statusAnggota' => 'Aktif'])->orderby('created_at', 'DESC')->findAll();
    }
}

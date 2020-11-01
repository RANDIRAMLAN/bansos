<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBansosModel extends Model
{
    protected $table      = 'data_bansos';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'idBansos',
        'namaBansos',
        'kategori',
        'pendamping',
        'nominal',
        'tipeBansos'
    ];

    public function cari($cari)
    {
        return $this->like('idBansos', $cari)->orLike('namaBansos', $cari)->findAll();
    }

    public function getById($idBansos)
    {
        return $this->where(['idBansos' => $idBansos])->first();
    }

    public function ubah_data_bansos($id, $idBansos, $namaBansos, $dataKategori, $pendamping, $nominal, $dataTipeBansos)
    {
        return $this
            ->set('idBansos', $idBansos)
            ->set('namaBansos', $namaBansos)
            ->set('kategori', $dataKategori)
            ->set('pendamping', $pendamping)
            ->set('nominal', $nominal)
            ->set('tipeBansos', $dataTipeBansos)
            ->where(['id' => $id])
            ->update();
    }

    public function hapusDataById($id)
    {
        return $this->where(['id' => $id])
            ->delete();
    }
}

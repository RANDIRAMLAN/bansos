<?php

namespace App\Models;

use CodeIgniter\Model;

class KodePosModel extends Model
{
    protected $table      = 'kode_pos';
    protected $allowedFields = [
        'posDesaKelurahan',
        'kodePos',
        'desaKelurahan',
        'kecamatan',
        'kabKota',
    ];

    public function getData($posDesaKelurahan)
    {
        return $this->where(['posDesaKelurahan' => $posDesaKelurahan])->first();
    }
    public function getKabKota()
    {
        return $this->select('kabKota')->distinct()->orderby('kabKota', 'ASC')->findAll();
    }
    public function getKecamatan($kabKota)
    {
        return $this->select('kecamatan')->distinct()->where(['kabKota' => $kabKota])->orderby('kecamatan', 'ASC')->findAll();
    }
    public function getDesaKelurahan($kecamatan)
    {
        return $this->select('desaKelurahan')->distinct()->where(['kecamatan' => $kecamatan])->orderby('desaKelurahan', 'ASC')->findAll();
    }
}

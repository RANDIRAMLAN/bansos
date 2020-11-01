<?php

use CodeIgniter\Filters\CSRF;
?>
<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container box margin-top">
    <div class="card">
        <div class="card-body">
            <div class="modal-header text-center">
                <h3 class="ml-auto mr-auto">Ubah Data Keluarga</h3>
            </div>
            <form action="/user/ubah/<?= $keluarga['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" id="fotoKK" name="fotoKKLama" value="<?= $keluarga['fotoKK']; ?>">
                <div class="form-group mt-3">
                    <label for="noKK">No. Kartu Keluarga</label>
                    <input type="text" class="form-control" id="noKK" name="noKK" readonly value="<?= $keluarga['noKK']; ?>" />
                </div>
                <div class="form-group">
                    <label for="kepalaKeluarga">Kepala Keluarga</label>
                    <input type="text" class="form-control" id="kepalaKeluarga" name="kepalaKeluarga" readonly value="<?= (old('kepalaKeluarga')) ? old('kepalaKeluarga') : $keluarga['kepalaKeluarga']; ?>">
                </div>
                <div class="form-group">
                    <label for="jumlahanggota">Jumlah Anggota Keluarga</label>
                    <input type="text" class="form-control <?= ($validation->hasError('jumlahAnggotaKeluarga')) ? 'is-invalid' : ''; ?>" id="jumlahanggota" name="jumlahAnggotaKeluarga" value="<?= (old('jumlahAnggotaKeluarga')) ? old('jumlahAnggotaKeluarga') : $keluarga['jumlahAnggotaKeluarga']; ?>" />
                    <div id="validationServer04Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlahAnggotaKeluarga'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" cols="30" rows="3"><?= (old('alamat')) ? old('alamat') : $keluarga['alamat']; ?></textarea>
                    <div id="validationServer04Feedback" class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kabKota">Kabupaten/Kota</label>
                    <input type="text" class="form-control" id="kabKota" name="kabKota" readonly value="<?= $keluarga['kabKota']; ?>">
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" id="kecamatan" name="kecamatan" class="form-control" readonly value="<?= $keluarga['kecamatan']; ?>">
                </div>
                <div class="form-group">
                    <label for="desaKelurahan">Desa/Keluarhan</label>
                    <input type="text" id="desaKelurahan" name="desaKelurahan" class="form-control" readonly value="<?= $keluarga['desaKelurahan']; ?>">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" id="status" name="status" class="form-control" readonly value="<?= $keluarga['status']; ?>">
                </div>
                <div class="form-group">
                    <label for="fotoKK">Foto Kartu Keluarga</label>
                    <input type="file" id="fotoKK" name="fotoKK" class="form-control-file <?= ($validation->hasError('fotoKK')) ? 'is-invalid' : ''; ?>">
                    <div id="validationServer04Feedback" class="invalid-feedback">
                        <?= $validation->getError('fotoKK'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-light btn-registrasi button"><strong>Ubah Data</strong></button>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
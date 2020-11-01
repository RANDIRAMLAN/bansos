<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container box margin-top">
    <div class="card">
        <div class="card-body">
            <div class="modal-header text-center">
                <h3 class="ml-auto mr-auto">Buat Data Keluarga</h3>
            </div>
            <form action="/user/simpan" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group mt-3">
                    <label for="noKK">No. Kartu Keluarga</label>
                    <input type="hidden" value="<?= old('noKK'); ?>">
                    <input type="text" class="form-control <?= ($validation->hasError('noKK')) ? 'is-invalid' : ''; ?>" id="noKK" name="noKK" value="<?= $user; ?>" readonly />
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('noKK'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kepalakk">Kepala Keluarga</label>
                    <input type="text" class="form-control <?= ($validation->hasError('kepalaKeluarga')) ? 'is-invalid' : ''; ?>" id="kepalakk" name="kepalaKeluarga" value="<?= old('kepalaKeluarga'); ?>" placeholder="Isi dengan nama kepala keluarga" autocomplete="off" />
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('kepalaKeluarga'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jumlahanggota">Jumlah Anggota Keluarga</label>
                    <input type="text" class="form-control <?= ($validation->hasError('jumlahAnggotaKeluarga')) ? 'is-invalid' : ''; ?>" id="jumlahanggota" name="jumlahAnggotaKeluarga" value="<?= old('jumlahAnggotaKeluarga'); ?>" placeholder="Isi sesuai jumlah keluarga" autocomplete="off" />
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlahAnggotaKeluarga'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" cols="30" rows="3" placeholder="Isi dengan alamat lengkap"><?= old('alamat'); ?></textarea>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kabKota">Kabupaten/Kota</label>
                    <select name="kabKota" id="kabKota" class="form-control <?= ($validation->hasError('kabKota')) ? 'is-invalid' : ''; ?>">
                        <option value="<?= old('kabKota'); ?>"><?= (old('kabKota')) ? old('kabKota') : '-- Pilih Kabupaten/Kota --'; ?></option>
                        <?php foreach ($kabKota as $kk) { ?>
                            <option value="<?= $kk['kabKota']; ?>"><?= $kk['kabKota']; ?></option>
                        <?php }; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('kabKota'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>">
                        <option value="<?= old('kecamatan'); ?>"><?= (old('kecamatan')) ? old('kecamatan') : '-- Pilih Kecamatan ---'; ?></option>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('kecamatan'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desaKelurahan">Desa/Kelurahan</label>
                    <select name="desaKelurahan" id="desaKelurahan" class="form-control <?= ($validation->hasError('desaKelurahan')) ? 'is-invalid' : ''; ?>">
                        <option value="<?= old('desaKelurahan'); ?>"><?= (old('desaKelurahan')) ? old('desaKelurahan') : '--- Pilih Desa/Kelurahan ---'; ?></option>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('desaKelurahan'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Pengajuan">Pengajuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fotokk">Foto Kartu Keluarga</label>
                    <input type="file" name="fotoKK" id="fotokk" class="form-control-file <?= ($validation->hasError('fotoKK')) ? 'is-invalid' : ''; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('fotoKK'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-light btn-registrasi button"><strong>Simpan Data</strong></button>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
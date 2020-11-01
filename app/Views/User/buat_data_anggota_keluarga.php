<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container box margin-top">
    <?php if (session()->getFlashdata('simpan')) { ?>
        <div class="alert alert-success text-center" role="alert">
            <?= session()->getFlashdata('simpan'); ?>
        </div>
    <?php }; ?>
    <div class="card">
        <div class="card-body">
            <div class="modal-header text-center">
                <h3 class="ml-auto mr-auto">Buat Data Anggota Keluarga</h3>
            </div>
            <form action="/user/simpan2" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group mt-3">
                    <label for="noKK">No. Kartu Keluarga</label>
                    <input type="text" class="form-control <?= ($validation->hasError('noKK')) ? 'is-invalid' : ''; ?>" id="noKK" name="noKK" value="<?= $keluarga['noKK']; ?>" readonly />
                    <div class="invalid-feedback">
                        <?= $validation->getError('noKK'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="noKTP">No. Kartu Tanda Penduduk</label>
                    <input type="text" class="form-control <?= ($validation->hasError('noKTP')) ? 'is-invalid' : ''; ?>" id="noKTP" name="noKTP" placeholder="Isi dengan nomor KTP" autocomplete="off" value="<?= old('noKTP'); ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('noKTP'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Sesuai KTP</label>
                    <input type="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Isi nama lengkap sesuai KTP" autocomplete="off" value="<?= old('nama'); ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input type="text" class="form-control <?= ($validation->hasError('tempatLahir')) ? 'is-invalid' : ''; ?>" id="tempatLahir" name="tempatLahir" placeholder="Isi tempat lahir sesuai KTP" autocomplete="off" value="<?= old('tempatLahir'); ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('tempatLahir'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input type="date" class="form-control <?= ($validation->hasError('tanggalLahir')) ? 'is-invalid' : ''; ?>" id="tanggalLahir" name="tanggalLahir" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggalLahir'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jenisKelamin">Jenis Kelamin</label>
                </div>
                <div class="form-group mt-n3 ml-3">

                    <input class="form-check-input <?= ($validation->hasError('jenisKelamin')) ? 'is-invalid' : ''; ?>" type="radio" name="jenisKelamin" id="jenisKelamin" value="Laki-Laki">
                    <label class="form-check-label" for="jenisKelamin">Laki-Laki </label>

                    <input class="form-check-input ml-4 <?= ($validation->hasError('jenisKelamin')) ? 'is-invalid' : ''; ?>" type="radio" name="jenisKelamin" id="jenisKelamin" value="Perempuan">
                    <label class="form-check-label ml-5" for="jenisKelamin">Perempuan</label>

                    <div class="invalid-feedback">
                        <?= $validation->getError('jenisKelamin'); ?>
                    </div>

                </div>
                <div class="form-group">
                    <label for="statuskawin">Status Perkawinan</label>
                    <select name="statusPerkawinan" id="stauskawin" class="form-control">
                        <option value="<?= old('statusPerkawinan'); ?>"><?= old('statusPerkawinan'); ?></option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Cerai">Cerai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pendidikan">Pendidikan Terakhir</label>
                    <select name="pendidikan" id="pendidikan" class="form-control">
                        <option value="<?= old('pendidikan'); ?>"><?= old('pendidikan'); ?></option>
                        <option value="Sederajat">Sederajat</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Strata1">Strata 1</option>
                        <option value="Strata2">Strata 2</option>
                        <option value="Strata3">Strata 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <select id="pekerjaan" name="pekerjaan" class="form-control">
                        <option value="<?= old('pekerjaan'); ?>"><?= old('pekerjaan'); ?></option>
                        <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                        <option value="Pegawai NON PNS">Pegawai NON PNS</option>
                        <option value="Karyawan Swasta/BUMN/BUMD">Karyawan Swasta/BUMN/BUMD</option>
                        <option value="Pengusaha">Pengusaha</option>
                        <option value="Wirausaha">Wirausaha</option>
                        <option value="Buruh">Buruh</option>
                        <option value="Tidak Bekerja">Tidak Bekerja</option>
                        <option value="Pelajar">Pelajar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <select name="catatan" id="catatan" class="form-control">
                        <option value="<?= old('catatan'); ?>"><?= old('catatan'); ?></option>
                        <option value="Kepala Keluarga">Kepala Keluarga</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fotoKTP">Foto Kartu Tanda Penduduk</label>
                    <input type="file" name="fotoKTP" id="fotoKTP" class="form-control-file <?= ($validation->hasError('fotoKTP')) ? 'is-invalid' : ''; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('fotoKTP'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <small><strong>* Periksa kelengkapan dan kecocokan dokumen sebelum disimpan </strong></small>
                </div>
                <button type="submit" class="btn btn-light btn-registrasi button"><strong>Simpan Data</strong></button>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('Layout/template_welcome'); ?>
<?= $this->section('content'); ?>
<div class="container box margin-top">
    <div class="card">
        <div class="card-body">
            <div class="modal-header text-center">
                <h3 class="ml-auto mr-auto"><strong>Daftar</strong></h3>
            </div>
            <form action="/JGK/simpan_data_user" method="post">
                <?= csrf_field(); ?>
                <div class="form-group mt-3">
                    <label for="noKK">No. Kartu Keluarga</label>
                    <input type="hidden" value="<?= old('noKK'); ?>">
                    <input type="text" id="noKK" name="noKK" class="form-control <?= ($validation->hasError('noKK')) ? 'is-invalid' : ''; ?>" value="<?= old('noKK'); ?>" autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $validation->getError('noKK'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Pengguna</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autocomplete="off" value="<?= old('nama'); ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" value="<?= old('email'); ?>" autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" id="password2" name="password2" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('password2'); ?>
                    </div>
                </div>
        </div>
        <div class="modal-footer text-center">
            <button type="submit" class="btn btn-light button"><strong>Daftar</strong></button>
            <small><i><a href="/JGK/masuk" class="button mt-2">Klik Disini Untu Masuk</a> </i></small>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
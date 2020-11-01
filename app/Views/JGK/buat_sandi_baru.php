<?= $this->extend('Layout/template_welcome'); ?>
<?= $this->section('content'); ?>
<div class="container box margin-top">
    <div class="card">
        <div class="card-body">
            <div class="modal-header text-center">
                <h3 class="ml-auto mr-auto"><strong>Kata Sandi Baru</strong></h3>
            </div>
            <form action="/JGK/sandi_baru" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="email" value="<?= $user['email']; ?>">
                <div class="form-group mt-3">
                    <label for="password">Kata Sandi Baru</label>
                    <input type="hidden" value="<?= old('password'); ?>">
                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" id="password2" name="password2" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('password2'); ?>
                    </div>
                </div>
        </div>
        <div class="modal-footer text-center">
            <button type="submit" class="btn btn-light button"><strong>Simpan</strong></button>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
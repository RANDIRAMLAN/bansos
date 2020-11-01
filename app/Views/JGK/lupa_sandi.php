<?= $this->extend('Layout/template_welcome'); ?>
<?= $this->section('content'); ?>
<div class="container box margin-top">
    <?php if (session()->getFlashdata('gagal')) { ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= session()->getFlashdata('gagal'); ?>
        </div>
    <?php }; ?>
    <div class="card">
        <div class="card-body">
            <div class="modal-header text-center">
                <h5 class="ml-auto mr-auto"><Strong>Permintaan Ganti Kata Sandi</Strong></h5>
            </div>
            <form action="/JGK/ganti_sandi" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="hidden" value="<?= old('email'); ?>">
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>" autocomplete="off" />
                        <small class="invalid-feedback"><?= $validation->getError('email'); ?></small>
                    </div>
                    <button type="submit" name="submit" class="btn btn-light button">
                        <strong>Kirim</strong>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?= $this->endSection(); ?>
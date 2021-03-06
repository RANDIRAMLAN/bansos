<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container margin-top">
    <div class="row">
        <?php foreach ($bansosku as $b) { ?>
            <div class="col col-md-4 mt-2">
                <div class="card border-info">
                    <div class="card-header text-center bg-info text-white"><?= $b['namaBansos']; ?></div>
                    <div class="card-body text-center bg-light">
                        <h5 class="card-title"><?= $b['noKK']; ?> / <?= $b['kepalaKeluarga']; ?></h5>
                    </div>
                </div>
            </div>
        <?php }; ?>
    </div>
</div>
<?= $this->endSection(); ?>
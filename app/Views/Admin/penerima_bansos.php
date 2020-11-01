<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col col-md-12 margin-top">
    <?php if (session()->getFlashdata('pesan')) { ?>
        <div class="alert alert-info text-center" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php }; ?>
    <?php if (session()->getFlashdata('gagal')) { ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= session()->getFlashdata('gagal'); ?>
        </div>
    <?php }; ?>
    <form action="/admin/ubah_data" method="post" class="delete-all">
        <?= csrf_field(); ?>
        <!-- live search -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td width="43px" class="text-center"><input type="checkbox" class="check-all mt-2"></td>
                    <td width="43px" class="text-center"> <button type="submit" class="btn fas fa-edit button-sm select-delete" data-toggle="tooltip" data-placement="top" title="Ubah Status Peserta">
                        </button></td>
                    <td colspan="6">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control mt-n1 mb-n4" id="cari" placeholder="Cari Data Peserta Bansos">
                            </div>
                        </form>
                    </td>
                </tr>
            </thead>
        </table>
        <div id="tampil-data">
        </div>
    </form>
</div>
<?= $this->endSection(); ?>
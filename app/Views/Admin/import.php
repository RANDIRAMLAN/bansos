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
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <form action="/admin/import_data" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <td colspan=" 2">
                        <input type="hidden" value="<?= old('import'); ?>">
                        <input type="file" class="form-control-file <?= ($validation->haserror('import')) ? 'is-invalid' : ''; ?>" id="import" name="import">
                        <div class="invalid-feedback">
                            <?= $validation->getError('import'); ?>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="submit" class="btn fas fa-arrow-circle-up button-sm" data-toggle="tooltip" data-placement="top" title="Unggah Data"></button>
                    </td>
                </form>
                <td class="text-center">
                    <form action="/admin/export_data" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <button type="submit" class="fas fa-arrow-circle-down btn button-sm" data-toggle="tooltip" data-placement="top" title="Unduh Data">
                        </button>
                    </form>
                </td>
                <td class="text-center">
                    <a href="/admin/tambah_data" class="fas fa-plus-square btn button-sm" data-toggle="tooltip" data-placement="top" title="Tambah Data"></a>
                </td>
                <form action="/admin/hapus_banyak" method="post" class="delete-all">
                    <?= csrf_field(); ?>
                    <td class="text-center">
                        <button type="button" class="btn fas fa-trash button-sm" data-toggle="modal" data-target="#hapus">
                        </button>
                        <!-- Modal untuk pop up konfirmasi -->
                        <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin Ingin Menghapus Data ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Hapus Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
            </tr>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col">Kode Pos</th>
                <th scope="col">Desa/Kelurahan</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Kabupaten/Kota</th>
                <th scope="col" class="text-center"><input type="checkbox" class="check-all"></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + ($page * ($currentPage - 1)); ?>
            <?php foreach ($kodepos as $kp) { ?>
                <tr>
                    <td class="text-center"><?= $i; ?></td>
                    <td><?= $kp['kodePos']; ?></td>
                    <td><?= $kp['desaKelurahan']; ?></td>
                    <td><?= $kp['kecamatan']; ?></td>
                    <td><?= $kp['kabKota']; ?></td>
                    <td class="text-center checked">
                        <input type="checkbox" name="posDesaKelurahan[]" class="check" value="<?= $kp['posDesaKelurahan']; ?>">
                    </td>
                </tr>
                <?php $i++; ?>
            <?php }; ?>
            </form>
        </tbody>
    </table>
    <?= $pager->links('kode_pos', 'kode_pos_pagination') ?>
</div>

<?= $this->endSection(); ?>
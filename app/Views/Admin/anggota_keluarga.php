<?= $this->extend('Layout/Template'); ?>
<?= $this->section('content'); ?>
<div class="col col-md-12 margin-top">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">No. KK</th>
                <th scope="col">No. KTP</th>
                <th scope="col">Nama</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Status</th>
                <th scope="col">Pendidikan</th>
                <th scope="col">Pekerjaan</th>
                <th scope="col">Catatan</th>
                <th scope="col">Foto KTP</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($anggotaKeluarga as $k) { ?>
                <tr>
                    <td class="text-center"><?= $i; ?></td>
                    <td><?= $k['noKK']; ?></td>
                    <td><?= $k['noKTP']; ?></td>
                    <td><?= $k['nama']; ?></td>
                    <td><?= $k['tempatLahir']; ?></td>
                    <td><?= $k['tanggalLahir']; ?></td>
                    <td><?= $k['statusPerkawinan']; ?></td>
                    <td><?= $k['pendidikan']; ?></td>
                    <td><?= $k['pekerjaan']; ?></td>
                    <td><?= $k['catatan']; ?></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal<?= $i; ?>" class="btn btn-light btn-sm button-sm"><strong>Foto KTP</strong></a>
                    </td>
                    <!-- modal foto anggota keluarga -->
                    <div class="modal fade" id="exampleModal<?= $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title ml-auto mr-auto" id="exampleModalLabel">
                                        Foto Kartu Tanda Penduduk
                                    </h5>
                                </div>
                                <div class="modal-body ml-auto mr-auto">
                                    <div class="card">
                                        <img src="/img/KTP/<?= $k['fotoKTP']; ?>" class="card-img-top" alt="Randi Ramlan" />
                                        <div class="card-body">
                                            <p class="card-textn text-center"><?= $k['noKTP']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light button" data-dismiss="modal">
                                        <strong>Tutup</strong>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                <?php $i++; ?>
            <?php }; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>
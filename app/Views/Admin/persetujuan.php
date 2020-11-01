<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row margin-top">
    <div class="col-md-12">
        <!-- Persetujuan -->
        <div class="card border-light mb-3">
            <div class="card mb-3">
                <div class="card-header bg-transparent text-dark">
                    <h5><i class="fas fa-thumbs-up"></i> <strong>Persetujuan</strong></h5>
                </div>
                <div class="card-body text-dark">
                    <h5 class="card-title">Daftar Pengajuan Persetujuan</h5>
                    <p class="card-text">
                        <!-- loping disini -->
                        <?php $i = 1; ?>
                        <?php foreach ($persetujuan as $p) { ?>
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <a href="" class="button-sm" data-toggle="collapse" data-target="#collapseOne<?= $i; ?>" aria-expanded="true" aria-controls="collapseOne">
                                            Bapak/Ibu <strong><?= $p['kepalaKeluarga']; ?></strong> meminta persetujuan untuk mendapatkan
                                            bantuan sosial<i class="fas fa-info-circle ml-3"></i>
                                        </a>
                                    </div>
                                    <div id="collapseOne<?= $i; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <table class="table table-bordered col-md-6">
                                                <tr>
                                                    <th>No. KK</th>
                                                    <td><?= $p['noKK']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Kepala Keluarga</th>
                                                    <td><?= $p['kepalaKeluarga']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td><?= $p['alamat']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Desa</th>
                                                    <td><?= $p['desaKelurahan']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Anggota Keluarga</th>
                                                    <td><?= $p['jumlahAnggotaKeluarga']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Foto KK</th>
                                                    <td>
                                                        <button type="submit" class="btn btn-light btn-sm button-sm" data-toggle="modal" data-target="#exampleModal1">
                                                            <strong>Lihat Foto
                                                            </strong>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <form action="/Admin/konfirmasi" method="post">
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="hidden" name="noKK" value="<?= $p['noKK']; ?>">
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="Disetujui">Disetujui</option>
                                                                    <option value="Ditolak">Ditolak</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-light button mt-0">
                                                                <strong>Kirim</strong>
                                                            </button>
                                                        </td>
                                                    </form>
                                                </tr>
                                            </table>
                                            <!-- Model Tampil Foto -->
                                            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title ml-auto mr-auto" id="exampleModalLabel">
                                                                Foto Kartu Keluarga
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body ml-auto mr-auto">
                                                            <div class="card">
                                                                <img src="/img/KK/<?= $p['fotoKK']; ?>" class="card-img-top" alt="Randi Ramlan" />
                                                                <div class="card-body">
                                                                    <p class="card-textn text-center">
                                                                        <?= $p['noKK']; ?>
                                                                    </p>
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
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php }; ?>
                            <!--end looping  -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
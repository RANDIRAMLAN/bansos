<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col col-md-12 margin-top">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <td colspan="11">
          <form action="" method="post" class="form-inline my-2 my-lg-0">
            <?= csrf_field(); ?>
            <input class="form-control mr-sm-2" type="text" name="cari" autocomplete="off" />
            <button class="btn btn-light button-sm my-2 my-sm-0" type="submit">
              <strong>Cari</strong>
            </button>
          </form>
        </td>
      </tr>
      <tr>
        <th scope="col">No</th>
        <th scope="col">No. KK</th>
        <th scope="col">Kepala Keluarga</th>
        <th scope="col">Alamat</th>
        <th scope="col">Desa</th>
        <th scope="col">Kecamatan</th>
        <th scope="col">Kabupaten</th>
        <th scope="col">Anggota Keluarga</th>
        <th scope="col">Status Data</th>
        <th class="text-center" colspan="2" scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1 + ($page * ($currentPage - 1)); ?>
      <?php foreach ($keluarga as $k) { ?>
        <tr>
          <td class="text-center"><?= $i;  ?></td>
          <td><?= $k['noKK']; ?></td>
          <td><?= $k['kepalaKeluarga']; ?></td>
          <td><?= $k['alamat']; ?></td>
          <td><?= $k['desaKelurahan']; ?></td>
          <td><?= $k['kecamatan']; ?></td>
          <td><?= $k['kabKota']; ?></td>
          <td><?= $k['jumlahAnggotaKeluarga']; ?></td>
          <td><?= $k['status']; ?></td>
          <td class="text-center">
            <a href="/admin/anggota_keluarga/<?= $k['noKK']; ?>" target="_blank" class="btn btn-light btn-sm button-sm"><strong>Anggota</strong></a>
          </td>
          <td class="text-center">
            <a href="" data-toggle="modal" data-target="#exampleModal<?= $i; ?>" class="btn btn-light btn-sm button-sm"><strong>Foto KK</strong></a>
          </td>
          <!-- modal foto anggota keluarga -->
          <div class="modal fade" id="exampleModal<?= $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title ml-auto mr-auto" id="exampleModalLabel">
                    Foto Kartu Keluarga
                  </h5>
                </div>
                <div class="modal-body ml-auto mr-auto">
                  <div class="card">
                    <img src="/img/KK/<?= $k['fotoKK']; ?>" class="card-img-top" alt="Randi Ramlan" />
                    <div class="card-body">
                      <p class="card-textn text-center"><?= $k['noKK']; ?></p>
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
  <?= $pager->links('keluarga', 'keluarga_pagination') ?>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row margin-top">
    <div class="col col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-header"><i class="fas fa-house-user"></i> Data Keluarga</div>
            <div class="card-body">
                <h5 class="card-title">Total Keluarga Terdaftar</h5>
                <h1><strong><?= $jumlahKeluarga; ?></strong></h1>
            </div>
        </div>
    </div>
    <div class="col col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header"><i class="fas fa-male"></i> Data Warga</div>
            <div class="card-body">
                <h5 class="card-title">Total Data Warga</h5>
                <h1><strong><?= $jumlahWarga; ?></strong></h1>
            </div>
        </div>
    </div>
    <div class="col col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header"><i class="fas fa-people-carry"></i> Data Bansos</div>
            <div class="card-body">
                <h5 class="card-title">Total Data Bansos</h5>
                <h1><strong><?= $jumlahDataBansos; ?></strong></h1>
            </div>
        </div>
    </div>
    <div class="col col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header"><i class="fas fa-hands-helping"></i> Data Penerima Bansos</div>
            <div class="card-body">
                <h5 class="card-title">Total Penerima Bansos</h5>
                <h1><strong><?= $jumahperimaBansos; ?></strong></h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
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
                <tr>
                    <td>2011-111-111</td>
                    <td>2011-111-111</td>
                    <td>Burhan</td>
                    <td>Taeng</td>
                    <td>01-10-2020</td>
                    <td>Kawin</td>
                    <td>SMA</td>
                    <td>Buruh</td>
                    <td>Anak</td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-light btn-sm button-sm"><strong>Foto KTP</strong></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- modal foto anggota keluarga -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-auto mr-auto" id="exampleModalLabel">
                            Foto Kartu Tanda Penduduk
                        </h5>
                    </div>
                    <div class="modal-body ml-auto mr-auto">
                        <div class="card">
                            <img src="img/foto1.jpg" class="card-img-top" alt="Randi Ramlan" />
                            <div class="card-body">
                                <p class="card-textn text-center">Nomor KTP</p>
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
<?= $this->endSection(); ?>
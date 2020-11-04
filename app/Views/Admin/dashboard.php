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
                    <th width="10px" class="text-center" scope="col">Nomor</th>
                    <th scope="col">Nama Data</th>
                    <th scope="col">Jumlah Data</th>
                    <th width="150px" class="text-center" scope="col">Detail Data</th>
                    <th width="150px" class="text-center" scope="col">Export Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Data Keluarga Terdaftar</td>
                    <td><?= $jumlahKeluarga; ?></td>
                    <td class="text-center"><a href="/Admin/data" class="btn btn-info btn-sm">Detail</a></td>
                    <form action="/admin/export_data_keluarga" method="post">
                        <td class="text-center"><button class="btn btn-info btn-sm">Export</button></td>
                    </form>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Data Warga</td>
                    <td><?= $jumlahWarga; ?></td>
                    <td class="text-center"> - </td>
                    <td class="text-center"><button class="btn btn-info btn-sm">Export</button></td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Data Bansos</td>
                    <td><?= $jumlahDataBansos; ?></td>
                    <td class="text-center"><a href="/Admin/data_bansos" class="btn btn-info btn-sm">Detail</a></td>
                    <td class="text-center"><button class="btn btn-info btn-sm">Export</button></td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Data Penerima Bansos</td>
                    <td><?= $jumahperimaBansos; ?></td>
                    <td class="text-center"><a href="/Admin/data_bansos" class="btn btn-info btn-sm">Detail</a></td>
                    <td class="text-center"><button class="btn btn-info btn-sm">Export</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
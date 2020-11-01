<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col col-md-12 margin-top">
    <p id="pesan" class="alert-info text-center" role="alert">
    </p>
    <button class="btn btn-light btn-sm button-sm" data-toggle="modal" data-target="#tambah_data_bansos"><strong>Tambah Data</strong></button>
    <!-- Modal tambah data -->
    <div class="modal fade" id="tambah_data_bansos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="simpan_data" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="idBansos">Id Bansos</label>
                            <input type="text" class="form-control" id="idBansos" name="idBansos" placeholder="ex: 001" autocomplete="off">
                            <small class="errorIdBansos invalid-feedback"></small>
                        </div>
                        <div class="form-group">
                            <label for="namaBansos">Nama Bansos</label>
                            <input type="text" class="form-control" id="namaBansos" name="namaBansos" placeholder="ex: PHK - Program Keluarga Harapan" autocomplete="off">
                            <small class="errorNamaBansos invalid-feedback"></small>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">--- Pilih Kategori ---</option>
                                <option value="MKM - Masyarakat Kurang Mampu">MKM - Masyarakat Kurang Mampu</option>
                                <option value="Umum">Umum</option>
                                <option value="Lansia">Lansia</option>
                                <option value="Balita">Balita</option>
                                <option value="Janda">Janda</option>
                            </select>
                            <small class="errorKategori invalid-feedback"></small>
                        </div>
                        <div class="form-group">
                            <label for="pendamping">Pendamping</label>
                            <input type="text" class="form-control" id="pendamping" name="pendamping" placeholder="ex: Basuki" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal Bansos</label>
                            <input type="text" class="form-control" id="nominal" name="nominal" placeholder="ex: 100000" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="tipeBansos">Tipe Bansos</label>
                            <select name="tipeBansos" id="tipeBansos" class="form-control">
                                <option value="">--- Pilih Tipe Bansos ---</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Sembako">Sembako</option>
                                <option value="Non Tunai Lainnya">Non Tunai Lainnya</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-light button-sm btn-sm"><strong>Simpan Data</strong></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <table id="data_bansos" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Bansos</th>
                <th scope="col">Kategori</th>
                <th scope="col">Pendamping</th>
                <th scope="col">Nominal</th>
                <th scope="col">Tipe Bansos</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody id="daftar_data_bansos">
            <!-- data bansos -->
        </tbody>
    </table>
    <!-- Modal Edit data -->
    <div class="modal fade" id="ubah_data_bansos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ubah_data" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" class="form-control" id="idUbah" name="id">
                        <input type="hidden" class="form-control" id="kategoriLama" name="kategoriLama">
                        <input type="hidden" class="form-control" id="tipeBansosLama" name="tipeBansosLama">
                        <div class="form-group">
                            <label for="idBansos">Id Bansos</label>
                            <input type="text" class="form-control" id="idBansosUbah" name="idBansos" autocomplete="off">
                            <small class="errorIdBansos invalid-feedback"></small>
                        </div>
                        <div class="form-group">
                            <label for="namaBansos">Nama Bansos</label>
                            <input type="text" class="form-control" id="namaBansosUbah" name="namaBansos" autocomplete="off">
                            <small class="errorNamaBansos invalid-feedback"></small>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategoriUbah" class="form-control">
                                <option value="">--- Pilih Kategori Bansos ---</option>
                                <option value="MKM - Masyarakat Kurang Mampu">MKM - Masyarakat Kurang Mampu</option>
                                <option value="Umum">Umum</option>
                                <option value="Lansia">Lansia</option>
                                <option value="Balita">Balita</option>
                                <option value="Janda">Janda</option>
                            </select>
                            <small class="errorKategori invalid-feedback"></small>
                        </div>
                        <div class="form-group">
                            <label for="pendamping">Pendamping</label>
                            <input type="text" class="form-control" id="pendampingUbah" name="pendamping" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal Bansos</label>
                            <input type="text" class="form-control" id="nominalUbah" name="nominal" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="tipeBansos">Tipe Bansos</label>
                            <select name="tipeBansos" id="tipeBansosUbah" class="form-control">
                                <option value="">--- Pilih Tipe Bansos ---</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Sembako">Sembako</option>
                                <option value="Non Tunai Lainnya">Non Tunai Lainnya</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-light button-sm btn-sm"><strong>Ubah Data</strong></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal hapus data -->
    <form id="hapus_data" method="post">
        <div class="modal fade" id="hapus_data_bansos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Bansos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda Yakin Ingin Menghapus Data ?
                        <input type="hidden" class="form-control" id="idHapus" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col col-md-12 margin-top">
    <form action="/admin/simpan_data_penerima_bansos" action="post">
        <?= csrf_field(); ?>
        <button type="submit" class="btn btn-light btn-sm button-sm mb-2"><Strong>Simpan Data</Strong></button>
        <a href="/admin/penerima_bansos" class="btn btn-light btn-sm button-sm mb-2"><Strong>Data Penerima</Strong></a>
        <a href="/admin/data_bansos" class="btn btn-light btn-sm button-sm mb-2 "><Strong>Data Bansos</Strong></a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td class="text-center"><strong>No. KK</strong></td>
                    <td class="text-center"><strong>Kepala Keluarga</strong></td>
                    <td class="text-center"><strong>ID Bansos</strong></td>
                    <td class="text-center"><strong>Nama Bansos</strong></td>
                    <td class="text-center"><strong>Kategori</strong></td>
                    <td class="text-center"><strong>Pendamping Bansos</strong></td>
                    <td class="text-center"><strong>Nominal Bansos</strong></td>
                </tr>
            </thead>
            <tbody>
                <!-- baris 1 -->
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder=" Cari Data KK" id="noKK1" name="noKK[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" id="kepalaKeluarga1" name="kepalaKeluarga[]" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="Cari Data Bansos" name="idBansos[]" id="idBansos1" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="namaBansos[]" id="namaBansos1" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="kategori[]" id="kategori1" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="pendamping[]" id="pendamping1" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="nominal[]" id="nominal1" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                </tr>
                <!-- baris 2 -->
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder=" Cari Data KK" id="noKK2" name="noKK[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" id="kepalaKeluarga2" name="kepalaKeluarga[]" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="Cari Data Bansos" name="idBansos[]" id="idBansos2" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="namaBansos[]" id="namaBansos2" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="kategori[]" id="kategori2" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="pendamping[]" id="pendamping2" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="nominal[]" id="nominal2" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                </tr>
                <!-- baris 3 -->
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder=" Cari Data KK" id="noKK3" name="noKK[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" id="kepalaKeluarga3" name="kepalaKeluarga[]" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="Cari Data Bansos" name="idBansos[]" id="idBansos3" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="namaBansos[]" id="namaBansos3" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="kategori[]" id="kategori3" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="pendamping[]" id="pendamping3" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="nominal[]" id="nominal3" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                </tr>
                <!-- baris 4 -->
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder=" Cari Data KK" id="noKK4" name="noKK[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" id="kepalaKeluarga4" name="kepalaKeluarga[]" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="Cari Data Bansos" name="idBansos[]" id="idBansos4" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="namaBansos[]" id="namaBansos4" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="kategori[]" id="kategori4" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="pendamping[]" id="pendamping4" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="nominal[]" id="nominal4" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                </tr>
                <!-- baris 5 -->
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder=" Cari Data KK" id="noKK5" name="noKK[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" id="kepalaKeluarga5" name="kepalaKeluarga[]" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="Cari Data Bansos" name="idBansos[]" id="idBansos5" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="namaBansos[]" id="namaBansos5" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" name="kategori[]" id="kategori5" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="pendamping[]" id="pendamping5" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="nominal[]" id="nominal5" class="form-control mt-n2 mb-n4" readonly>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?= $this->endSection(); ?>
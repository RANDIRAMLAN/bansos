<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col col-md-12 margin-top">
    <form action="/admin/tambah_banyak" action="post">
        <?= csrf_field(); ?>
        <button type="submit" class="btn btn-light btn-sm button-sm mb-2"><Strong>Simpan Data</Strong></button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td class="text-center"><strong>Kode Pos-Kelurahan</strong></td>
                    <td class="text-center"><strong>Kode Pos </strong></td>
                    <td class="text-center"><strong>Desa/Kelurahan</strong></td>
                    <td class="text-center"><strong>Kecamatan</strong></td>
                    <td class="text-center"><strong>Kabupaten/Kota</strong></td>
                </tr>
            </thead>
            <tbody class="tambah">
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="ex: 92111-Somba Opu" id="posDesaKelurahan" name="posDesaKelurahan[]" autocomplete="off">

                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="ex: 92111" id="kodePos" name="kodePos[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="ex: Sungguminasa" id="desaKelurahan" name="desaKelurahan[]" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control mt-n2 mb-n4" placeholder="ex: Somba Opu" name="kecamatan[]">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="kabKota[]" class="form-control mt-n2 mb-n4" placeholder="ex: Gowa">
                        </div>
                    </td>
                    <td class="text-center">
                        <i class="fas fa-plus-circle button-sm btn-add-form"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?= $this->endSection(); ?>
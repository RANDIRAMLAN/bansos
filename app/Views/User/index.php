<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row box-index">
    <div class="card col-md-12 margin-top">
        <?php if (session()->getFlashdata('pesan')) { ?>
            <div class="alert alert-success text-center" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php }; ?>
        <?php if (session()->getFlashdata('gagal')) { ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= session()->getFlashdata('gagal'); ?>
            </div>
        <?php }; ?>
        <div class="card-header bg-transparent">
            <a href="/user/buat_data_keluarga"><i class="fa-2x fas fa-address-book" data-toggle="tooltip" data-placement="top" title="Buat Data Keluarga"></i></a>
            <a href="/user/ubah_data_keluarga"><i class="fa-2x fas fa-user-edit ml-3" data-toggle="tooltip" data-placement="top" title="Ubah Data Keluarga"></i></a>
            <a href="/user/buat_data_anggota_keluarga"><i class="fa-2x fas fa-user-plus ml-3" data-toggle="tooltip" data-placement="top" title="Tambah Anggota Keluarga"></i></a>
        </div>
        <div class="card-body text-dark">
            <?php foreach ($keluarga as $keluarga) { ?>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>No Kartu Keluarga</label>
                        <input class="form-control" type="text" readonly value="<?= $keluarga['noKK']; ?>" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Alamat</label>
                        <input class="form-control" type="text" readonly value="<?= $keluarga['alamat']; ?>" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Kecamatan</label>
                        <input class="form-control" type="text" readonly value="<?= $keluarga['kecamatan']; ?>" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Kepala Keluarga</label>
                        <input class="form-control" type="" readonly value="<?= $keluarga['kepalaKeluarga']; ?>" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Kabupaten/Kota</label>
                        <input class="form-control" type="text" readonly value="<?= $keluarga['kabKota']; ?>" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Desa/Kelurahan</label>
                        <input class="form-control" type="text" readonly value="<?= $keluarga['desaKelurahan']; ?>" />
                    </div>
                    <div class="form-group col-md-2">
                        <label>Jumlah Anggota Keluarga</label>
                        <input class="form-control" type="text" readonly value="<?= $keluarga['jumlahAnggotaKeluarga']; ?>" />
                    </div>
                    <div class="form-group col-md-2">
                        <label>Status</label>
                        <input class="form-control" type="text" readonly value="<?= $keluarga['status']; ?>" />
                    </div>
                    <div class="form-group col-md-2">
                        <a href="" data-toggle="modal" data-target="#exampleModalKK" class="btn btn-light btn-sm button-sm  btn-margin"><strong>Lihat Foto</strong></a>
                    </div>
                    <!-- Modal Keluarga -->
                    <div class="modal fade" id="exampleModalKK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title ml-auto mr-auto" id="exampleModalLabel">
                                        Foto Kartu Keluarga
                                    </h5>
                                </div>
                                <div class="modal-body ml-auto mr-auto">
                                    <div class="card">
                                        <img src="/img/KK/<?= $keluarga['fotoKK']; ?>" class="card-img-top" alt="<?= $keluarga['kepalaKeluarga']; ?>" />
                                        <div class="card-body">
                                            <p class="card-textn text-center"><strong><?= $keluarga['noKK']; ?></strong></p>
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
    <?php }; ?>
    </div>
    <!-- index Anggota keluarga -->
    <?php $i = 1; ?>
    <?php foreach ($anggotakeluarga as $ak) { ?>

        <div class="card col-md-4 mt-5">
            <div class="card-header bg-transparent text-center">
                <strong>Anggota ke <?= $i; ?> - <?= $ak['nama']; ?></strong>
            </div>
            <div class="card-body text-dark">
                <div class="form-group">
                    <label>No. Kartu Keluarga</label>
                    <input class="form-control" type="text" readonly value="<?= $ak['noKK']; ?>" />
                </div>
                <div class="form-group">
                    <label>No. Kartu Tanda Penduduk</label>
                    <input class="form-control" type="text" readonly value="<?= $ak['noKTP']; ?>" />
                </div>
                <div class="form-group">
                    <label>Nama Sesuai KTP</label>
                    <input class="form-control" type="text" readonly value="<?= $ak['nama']; ?>" />
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input class="form-control" type="text" readonly value="<?= $ak['tempatLahir']; ?>" />
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input class="form-control" type="text" readonly value="<?= $ak['tanggalLahir']; ?>" />
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input class="form-control" type="text" readonly value="<?= $ak['jenisKelamin']; ?>" />
                </div>
                <form action=/user/ubah2/<?= $ak['id']; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" name="noKK" value="<?= $ak['noKK']; ?>">
                        <input type="hidden" name="noKTP" value="<?= $ak['noKTP']; ?>">
                        <input type="hidden" name="nama" value="<?= $ak['nama']; ?>">
                        <input type="hidden" name="tempatLahir" value="<?= $ak['tempatLahir']; ?>">
                        <input type="hidden" name="tanggalLahir" value="<?= $ak['tanggalLahir']; ?>">
                        <input type="hidden" name="jenisKelamin" value="<?= $ak['jenisKelamin']; ?>">
                        <input type="hidden" name="catatan" value="<?= $ak['catatan']; ?>">
                        <input type="hidden" name="fotoKTPLama" value="<?= $ak['fotoKTP']; ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="statuskawin">Status Perkawinan</label>
                        <select name="statusPerkawinan" id="stauskawin" class="form-control">
                            <option value="<?= $ak['statusPerkawinan']; ?>"><?= $ak['statusPerkawinan']; ?></option>
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Kawin">Kawin</option>
                            <option value="Cerai">Cerai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan Terakhir</label>
                        <select name="pendidikan" id="pendidikan" class="form-control">
                            <option value="<?= $ak['pendidikan']; ?>"><?= $ak['pendidikan']; ?></option>
                            <option value="Sederajat">Sederajat</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Strata1">Strata 1</option>
                            <option value="Strata2">Strata 2</option>
                            <option value="Strata3">Strata 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <select id="pekerjaan" name="pekerjaan" class="form-control">
                            <option value="<?= $ak['pekerjaan']; ?>"><?= $ak['pekerjaan']; ?></option>
                            <option value="Sederajat">Pegawai Negeri Sipil</option>
                            <option value="SMP">Pegawai NON PNS</option>
                            <option value="SMA">Karyawan Swasta/BUMN/BUMD</option>
                            <option value="Diploma">Pengusaha</option>
                            <option value="Strata1">Wirausaha</option>
                            <option value="Strata2">Buruh</option>
                            <option value="Strata3">Tidak Bekerja</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fotoKTP">Foto Kartu Tanda Penduduk</label>
                        <input type="hidden" value="<?= old('fotoKTP'); ?>" />
                        <input type="file" id="fotoKTP" name="fotoKTP" class=" <?= ($validation->hasError('fotoKTP')) ? 'is-invalid' : ''; ?>">
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('fotoKTP'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-light btn-registrasi button"><strong>Ubah Data</strong></button>
                </form>
            </div>
            <div class="card-footer bg-transparent text-center">
                <table class="ml-auto mr-auto">
                    <tr>
                        <td>
                            <a href="" data-toggle="modal" data-target="#exampleModal<?= $i; ?>" class="btn btn-light btn-sm button-sm"><strong>Lihat
                                    Foto</strong></a>
                            <!-- Modal Anggota Keluarga -->
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
                                                <img src="/img/KTP/<?= $ak['fotoKTP']; ?>" class=" card-img-top" alt="<?= $ak['nama']; ?>" />
                                                <div class="card-body">
                                                    <p class="card-textn text-center"><strong><?= $ak['noKTP']; ?></strong></p>
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
                        </td>
                        <td>
                            <a href="" class="btn btn-light btn-sm button-sm " data-toggle="modal" data-target="#hapus<?= $i; ?>"><strong>Hapus Data</strong></button></a>
                            <!-- Modal -->
                            <div class="modal fade" id="hapus<?= $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Yakin Ingin Menghapus Data ?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/user/hapus_data_anggota_keluarga/<?= $ak['id']; ?>" method="post">
                                                <button type="submit" class="btn btn-danger">Hapus Data</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <?php $i++; ?>
    <?php }; ?>
    <?= $this->endSection(); ?>
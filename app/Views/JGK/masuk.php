 <?= $this->extend('Layout/template_welcome'); ?>
 <?= $this->section('content'); ?>
 <div class="container box margin-top">
     <!-- pesan sukses -->
     <?php if (session()->getFlashdata('pesan')) { ?>
         <div class="alert alert-success text-center" role="alert">
             <?= session()->getFlashdata('pesan'); ?>
         </div>
     <?php }; ?>
     <!-- pesan gagal -->
     <?php if (session()->getFlashdata('gagal')) { ?>
         <div class="alert alert-danger text-center" role="alert">
             <?= session()->getFlashdata('gagal'); ?>
         </div>
     <?php }; ?>
     <div class="card">
         <div class="card-body">
             <div class="modal-header text-center">
                 <h4 class="ml-auto mr-auto"><Strong>Masuk</Strong></h4>
             </div>
             <form action="/JGK/masuk_aplikasi" method="post">
                 <?= csrf_field(); ?>
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="noKK">No. Kartu Keluarga</label>
                         <input type="hidden" value="<?= old('noKK'); ?>">
                         <input type="text" class="form-control <?= ($validation->hasError('noKK')) ? 'is-invalid' : ''; ?>" id="noKK" name="noKK" value="<?= old('noKK'); ?>" autocomplete="off" />
                         <small class="invalid-feedback"><?= $validation->getError('noKK'); ?></small>
                     </div>
                     <div class="form-group">
                         <label for="password">Kata Sandi</label>
                         <div class="input-group mb-2">
                             <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" />
                             <div class="input-group-prepend">
                                 <div class="input-group-text">
                                     <i class="fas fa-eye-slash"></i>
                                     <i class="fas fa-eye"></i>
                                 </div>
                             </div>
                             <small class="invalid-feedback"><?= $validation->getError('password'); ?></small>
                         </div>
                     </div>
                     <button type="submit" name="submit" class="btn btn-light button">
                         <strong>Masuk</strong>
                     </button>
                 </div>
             </form>
             <div class="modal-footer text-center">
                 <a href="/JGK/lupa_sandi" class="button btn btn-light mt-n1"><small>Lupa Kata Sandi</small></a>
                 <a href="/jgk/daftar" class="button btn btn-light mt-0 mb-n4"><small>Daftar</small></a>
             </div>
         </div>
     </div>
     <?= $this->endSection(); ?>
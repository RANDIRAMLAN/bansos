  <?php foreach ($menu as $m) { ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
          <a class="navbar-brand navbar-navbar" href="<?= $m['tujuan']; ?>"><strong><?= $m['nama']; ?></strong></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav ml-auto mr-4">
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-primary " id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <strong class="user"><?= $nama; ?></strong>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <?php foreach ($submenu as $sm) { ?>
                              <a class="dropdown-item button-sm" href="<?= $sm['url']; ?>"><?= $sm['judul']; ?></a>
                              <div class="dropdown-divider"></div>
                          <?php }; ?>
                          <a class="dropdown-item button-sm" href="/user/keluar"><strong>Keluar</strong></a>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link mb-n1">
                          <h5><i class="fas fa-user-circle"></i></h5>
                      </a>
                  </li>
              </ul>
          </div>
      </nav>
  <?php }; ?>
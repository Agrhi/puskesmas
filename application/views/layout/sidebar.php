<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="<?= base_url('dashboard') ?>">
      <img src="<?= base_url('') ?>/assets/img/logo.png" class="navbar-brand-img h-100 rounded-circle" alt="main_logo">
      <span class="ms-1 font-weight-bold">Puskesmas</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?= ($title === "Dashboard") ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($title === "Registrasi" || $title === 'Rekamedis Pasien' || $title === "Update Data") ? 'active' : '' ?>" href="<?= base_url('registrasi') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-collection text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Registrasi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($title === "Data Pasien") ? 'active' : '' ?>" href="<?= base_url('pasien') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Data Pasien</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($title === "Data Diagnosa") ? 'active' : '' ?>" href="<?= base_url('diagnosa') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-sound-wave text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Data Diagnosa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($title === "Data Penyakit") ? 'active' : '' ?>" href="<?= base_url('penyakit') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-atom text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Data Penyakit</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($title === "Rekamedis") ? 'active' : '' ?>" href="<?= base_url('rekamedis') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-book-bookmark text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Rekamedis</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($title === "Data Latih") ? 'active' : '' ?>" href="<?= base_url('datalatih') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-bullet-list-67 text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Data Latih</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link <?= ($title === "Seleksi") ? 'active' : '' ?>" href="<?= base_url('seleksi') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-chart-pie-35 text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Seleksi</span>
        </a>
      </li>       -->
      <li class="nav-item">
        <a class="nav-link <?= ($title === "Klasifikasi") ? 'active' : '' ?>" href="<?= base_url('klasifikasi') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-watch-time text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Klasifikasi</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link <?= ($title === "Kontak Person") ? 'active' : '' ?>" href="<?= base_url('contact') ?>">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-collection text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Kontak Person</span>
        </a>
      </li> -->
      <?php if ($this->session->userdata('level') == 1) { ?>
        <li class="nav-item">
          <a class="nav-link <?= ($title === "Management User") ? 'active' : '' ?>" href="<?= base_url('management_user') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-settings-gear-65 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Management User</span>
          </a>
        </li>
      <?php } ?>
      <li class="nav-item">
        <div class="nav-link">
        <h6>Light/Dark</h6>
        <div class="col form-check form-switch ps-0 ms-auto my-auto">
          <input class="form-check-input ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
        </div>
        </div>
      </li>
    </ul>
  </div>
</aside>
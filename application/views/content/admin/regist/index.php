<section class="section">
    <div class="card">
        <div class="card-header">
            <h3><?= $title; ?></h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= ($active === "Registrasi") ? 'active' : '' ?>" aria-current="page" href="<?= base_url('registrasi/index/regist') ?>">Registrasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active === "Penapisan") ? 'active' : '' ?>" href="<?= base_url('registrasi/index/penapisan') ?>">Penapisan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active === "Rekamedis") ? 'active' : '' ?>" href="<?= base_url('registrasi/index/rekamedis') ?>">Rekamedis</a>
                </li>
            </ul>
            <div class="mt-3">
                <h5>Cari Data Berdasarkan Nomor Registrasi atau NIK Pasien</h5>
                <form action="<?= base_url('registrasi/getDataPasien/') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="noRegist" name="noRegist" aria-describedby="noRegist">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
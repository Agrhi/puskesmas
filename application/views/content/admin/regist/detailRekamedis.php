<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="biodata">
                <a href="<?= base_url('registrasi/getDataRekamedisPasien/') . $data['noRegist'] ?>" class="btn bg-success text-white btn-sm">Kembali</a>
                <h6>Detail Rekamedis Pasien</h6>
                <div class="row">
                    <div class="col">Nomor Registrasi Pasien</div>
                    <div class="col">: <?= $data['noRegist'] ?></div>
                </div>
                <div class="row">
                    <div class="col">N I K</div>
                    <div class="col">: <?= $data['nik'] ?></div>
                </div>
                <div class="row">
                    <div class="col">Nama Pasien</div>
                    <div class="col">: <?= $data['nama'] ?></div>
                </div>
                <div class="row">
                    <div class="col">Umur</div>
                    <div class="col">: <?= $data['umur'] ?></div>
                </div>
                <div class="row">
                    <div class="col">Alamat</div>
                    <div class="col">: <?= $data['alamat'] ?></div>
                </div>
                <div class="row">
                    <div class="col">Jenis Kelamin</div>
                    <div class="col">: <?php if ($data['jk'] == '1') {
                                            echo 'Laki-Laki';
                                        } else {
                                            echo 'Perempuan';
                                        } ?></div>
                </div>
                <div class="row">
                    <div class="col">Nomor HP</div>
                    <div class="col">: <?= $data['nohp']; ?></div>
                </div>
                <div class="row">
                    <div class="col">Poli Tujuan</div>
                    <div class="col">: <?= $data['poli']; ?></div>
                </div>
                <div class="row">
                    <div class="col">Keluhan</div>
                    <div class="col">: <?= $data['keluhan']; ?></div>
                </div>
                <div class="row">
                    <div class="col">Diagnosa</div>
                    <div class="col">: <?= $data['kelompok']; ?></div>
                </div>
                <div class="row">
                    <div class="col">Keterangan</div>
                    <div class="col">: <?= $data['keterangan']; ?></div>
                </div>
            </div>
        </div>
    </div>

</section>
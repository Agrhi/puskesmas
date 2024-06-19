<section class="section">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <!-- <li class="nav-item">
                    <a class="nav-link active" href="#registrasi" onclick="toggleTab('registrasi')">Registrasi</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" href="#rekamedis" onclick="toggleTab('rekamedis')">Rekamedis</a>
                </li>
            </ul>
            <div class="tab-content mt-3">
                <!-- <div class="tab-pane active" id="registrasi">
                    <h5>Cari Data Pasien</h5>
                    <form action="<?= base_url('registrasi/getDataPasien/') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="noRegist" name="noRegist" aria-describedby="noRegist" placeholder="Nomor Registrasi atau NIK">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="tab-pane active" id="rekamedis">
                    <!-- <h5>Cari Data Rekamedis Pasien</h5>
                    <form action="<?= base_url('registrasi/getDataRekamedisPasien') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="noRegist" name="noRegist" aria-describedby="noRegist" placeholder="Nomor Registrasi atau NIK">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form> -->

                    <!-- new form -->
                    <h5>Tambah Data Rekamedis Pasien</h5>
                    <form action="<?= base_url('registrasi/addRekamedisPasien') ?>" method="post">
                        <div class="row g-2">
                            <div class="col-sm-5">
                                <label for="nik">N I K</label>
                                <input type="text" class="form-control" name="nik" id="nik" value="<?= set_value('nik') ?>">
                                <?= form_error('nik', '<div id="nik" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <div class="col-sm-7">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama') ?>">
                                <?= form_error('nama', '<div id="nama" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <div class="col-sm-4">
                                <label for="umur">Umur</label>
                                <input type="number" class="form-control" name="umur" id="umur" value="<?= set_value('umur') ?>">
                                <?= form_error('umur', '<div id="umur" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <div class="col-sm-4">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="1" <?= set_select('jk', '1') ?>>Laki - Laki</option>
                                    <option value="0" <?= set_select('jk', '0') ?>>Perempuan</option>
                                </select>
                                <?= form_error('jk', '<div id="jk" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <div class="col-sm-4">
                                <label for="nohp">No BPJS</label>
                                <input type="text" class="form-control" name="nohp" id="nohp" value="<?= set_value('nohp') ?>">
                                <?= form_error('nohp', '<div id="nohp" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <div class="col-sm-7">
                                <label for="alamat">Alamat</label>
                                <select class="form-control" name="alamat">
                                    <option value="">-- Pilih Alamat --</option>
                                    <option value="Kotaraya Timur" <?= set_select('alamat', 'Kotaraya Timur') ?>>Kotaraya Timur</option>
                                    <option value="Kotaraya Barat" <?= set_select('alamat', 'Kotaraya Barat') ?>>Kotaraya Barat</option>
                                    <option value="Kotaraya Selatan" <?= set_select('alamat', 'Kotaraya Selatan') ?>>Kotaraya Selatan</option>
                                    <option value="Kotaraya Induk" <?= set_select('alamat', 'Kotaraya Induk') ?>>Kotaraya Induk</option>
                                    <option value="Kotaraya Tenggara" <?= set_select('alamat', 'Kotaraya Tenggara') ?>>Kotaraya Tenggara</option>
                                    <option value="Kayu Agung" <?= set_select('alamat', 'Kayu Agung') ?>>Kayu Agung</option>
                                    <option value="Sumber Agung" <?= set_select('alamat', 'Sumber Agung') ?>>Sumber Agung</option>
                                    <option value="Maranti" <?= set_select('alamat', 'Maranti') ?>>Maranti</option>
                                    <option value="Ogomolos" <?= set_select('alamat', 'Ogomolos') ?>>Ogomolos</option>
                                    <option value="Ogotion" <?= set_select('alamat', 'Ogotion') ?>>Ogotion</option>
                                    <option value="Ogobayas" <?= set_select('alamat', 'Ogobayas') ?>>Ogobayas</option>
                                    <option value="Moubang" <?= set_select('alamat', 'Moubang') ?>>Moubang</option>
                                    <option value="Mensung" <?= set_select('alamat', 'Mensung') ?>>Mensung</option>
                                    <option value="Mepanga" <?= set_select('alamat', 'Mepanga') ?>>Mepanga</option>
                                    <option value="Bugis Utara" <?= set_select('alamat', 'Bugis Utara') ?>>Bugis Utara</option>
                                    <option value="Bugis" <?= set_select('alamat', 'Bugis') ?>>Bugis</option>
                                    <option value="Malalan" <?= set_select('alamat', 'Malalan') ?>>Malalan</option>
                                    <option value="Gurinda" <?= set_select('alamat', 'Gurinda') ?>>Gurinda</option>
                                </select>
                                <?= form_error('alamat', '<div id="alamat" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <div class="col-sm-5">
                                <label for="layanan">Layanan</label>
                                <select name="layanan" id="layanan" class="form-control">
                                    <option value="">-- Pilih Layanan --</option>
                                    <option value="Rawat Inap" <?= set_select('layanan', 'Rawat Inap') ?>>Rawat Inap</option>
                                    <option value="Rawat Jalan" <?= set_select('layanan', 'Rawat Jalan') ?>>Rawat Jalan</option>
                                </select>
                                <?= form_error('layanan', '<div id="layanan" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <!-- <div class="col-sm-6">
                                <label for="keluhan">Keluhan</label>
                                <textarea type="text" class="form-control" rows="3" name="keluhan" id="keluhan" value="<?= set_value('keluhan') ?>"></textarea>
                                <?= form_error('keluhan', '<div id="keluhan" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <div class="col-sm-6">
                                <label for="keterangan">Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" rows="3" id="keterangan" value="<?= set_value('keterangan') ?>"></textarea>
                                <?= form_error('keterangan', '<div id="keterangan" class="form-text text-danger text-left">', '</div>'); ?>
                            </div> -->
                            <div class="col-sm-12">
                                <label for="diagnosa">Diagnosa</label>
                                <select class="form-control" name="diagnosa" id="diagnosa">
                                    <option value="">-- Pilih Diagnosa --</option>
                                    <?php foreach ($diagnosa as $d) { ?>
                                        <option value="<?= $d->kodepenyakit ?>" <?= set_select('diagnosa', $d->kode) ?>>
                                            <?= $d->diagnosa ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?= form_error('diagnosa', '<div id="diagnosa" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                            <button type="submit" class="btn btn-success mt-5">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    $(document).ready(function() {
        $('#diagnosa').select2();
    });

    function toggleTab(tabId) {
        document.querySelector('.nav-link.active').classList.remove('active');
        document.querySelector('.tab-pane.active').classList.remove('active');

        document.querySelector(`a[href="#${tabId}"]`).classList.add('active');
        document.querySelector(`#${tabId}`).classList.add('active');
    }
</script>
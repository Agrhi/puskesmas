<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="biodata">
                <a href="<?= base_url('registrasi') ?>" class="btn bg-success text-white btn-sm">Kembali</a>
                <h6>Biodata Pasien</h6>
                <div class="row">
                    <div class="col">Nomor Registrasi Pasien</div>
                    <div class="col">: <?= $pasien->noRegist; ?></div>
                </div>
                <div class="row">
                    <div class="col">N I K</div>
                    <div class="col">: <?= $pasien->nik; ?></div>
                </div>
                <div class="row">
                    <div class="col">Nama Pasien</div>
                    <div class="col">: <?= $pasien->nama; ?></div>
                </div>
                <div class="row">
                    <div class="col">Alamat</div>
                    <div class="col">: <?= $pasien->alamat; ?></div>
                </div>
                <div class="row">
                    <div class="col">Jenis Kelamin</div>
                    <div class="col">: <?php if ($pasien->jk == '1') {
                                            echo 'Laki-Laki';
                                        } else {
                                            echo 'Perempuan';
                                        } ?></div>
                </div>
                <div class="row">
                    <div class="col">Nomor HP</div>
                    <div class="col">: <?= $pasien->nohp; ?></div>
                </div>
                <div style="text-align: right;">
                    <a onclick="registrasi()" class="btn bg-success text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrasi">Registrasi</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-bordered" id="daftar">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Regist</th>
                            <th>NIK</th>
                            <th>Nama Pasien</th>
                            <th>Poli</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($rekamedis as $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['noRegist'] ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['poli'] ?></td>
                                <td><?= $value['tgl'] ?></td>
                                <td>
                                    <?php if ($value['status'] == '1') {
                                        echo 'Registed';
                                    } else if ($value['status'] == '2') {
                                        echo 'Selesai';
                                    } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<!-- Modal Data -->
<div class="modal fade" id="updatePoliPasien" tabindex="-1" role="dialog" aria-labelledby="updatePoliPasienID" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePoliPasienID">Update Poli</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('registrasi/registHariIni') ?>" method="POST">
                    <input type="hidden" name="noreg" value="<?= $pasien->noRegist ?>">
                    <div class="row g-2">
                        <div class="col-sm-12">
                            <label for="poli">Poli</label>
                            <select name="poli" id="poli" class="form-control">
                                <option value="">-- Pilih Poli Tujuan --</option>
                                <option value="Poli Umum">Poli Umum</option>
                                <option value="Poli Gigi">Poli Gigi</option>
                                <option value="Poli KIA">Poli KIA</option>
                                <option value="Poli Gizi">Poli Gizi</option>
                            </select>
                            <?= form_error('poli', '<div id="poli" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-gradient-primary">Save</button>
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function registrasi() {
        $('#updatePoliPasien').modal('show');
    }
</script>
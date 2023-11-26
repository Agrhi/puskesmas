<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="biodata">
                <h6 class="mt-3">Data <?= $title; ?></h6>
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
                    <a href="<?= base_url('registrasi/registHariIni/' . $pasien->noRegist) ?>" class="btn bg-success text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrasi">Registrasi</a>
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
                            <th>Action</th>
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
                                        echo 'Penapisan';
                                    } else if ($value['status'] == '3') {
                                        echo 'Rekemedis Done';
                                    } ?>
                                </td>
                                <td>
                                    <?php if ($value['status'] == '1') { ?>
                                        <a href="<?= base_url('registrasi/loadViewUpdate/penapisan/' . $value['idRekamedis']) ?>" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Penapisan"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <?php } else if ($value['status'] == '2') { ?>
                                        <a href="<?= base_url('registrasi/loadViewUpdate/rekamedis/' . $value['idRekamedis']) ?>" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Rekemedis"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <?php } else if ($value['status'] == '3') { ?>
                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Rekemedis Selesai"><i class="fa fa-check-circle" aria-hidden="true"></i></div>                                        
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
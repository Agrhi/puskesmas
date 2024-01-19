<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table caption-top" id="pasien">
                    <caption>
                        <div class="row">
                            <div>
                                Data <?= $title; ?>
                            </div>
                            <div style="text-align: right;">
                                <button class="btn bg-success text-white btn-sm" onclick="addDataBro()" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= base_url('/assets/format_data_pasien.csv'); ?>">Format Import</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#importdata">Import Data</a></li>
                                    </ul>
                                </div>

                                <a href="<?= base_url('Pasien/export') ?>" class="btn bg-primary text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Data"><i class="fa fa-upload" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nomor Registrasi</td>
                            <td>NIK</td>
                            <td>Nama</td>
                            <td>Alamat</td>
                            <td>Jenis Kelamin</td>
                            <td>Nomor Hp</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pasien as $value) { ?>
                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td><?= $value['noRegist'] ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?php if ($value['jk'] == '1') {
                                        echo 'Laki - Laki';
                                    } else if ($value['jk'] == '2') {
                                        echo 'Perempuan';
                                    } else {
                                        echo 'Lainnya';
                                    } ?></td>
                                <td><?= $value['nohp'] ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="updateDataMhs('<?= $value['noRegist']; ?>', '<?= $value['nik']; ?>', '<?= $value['nama']; ?>', '<?= $value['alamat']; ?>', '<?= $value['jk']; ?>','<?= $value['nohp']; ?>')" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Data"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<!-- Modal Add Data -->
<div class="modal fade" id="addPasien" add="<?= $showModal == "add" ? "true" : "false" ?>" tabindex="-1" role="dialog" aria-labelledby="addPasienID" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPasienID">Tambah Data</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pasien/add') ?>" method="POST">
                    <div class="row g-2">
                        <div class="col-sm-12">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama') ?>">
                            <?= form_error('nama', '<div id="nama" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="nik">N I K</label>
                            <input type="text" class="form-control" name="nik" id="nik" value="<?= set_value('nik') ?>">
                            <?= form_error('nik', '<div id="nik" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="<?= set_value('alamat') ?>">
                            <?= form_error('alamat', '<div id="alamat" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="1" <?= set_select('jk', '1') ?>>Laki - Laki</option>
                                <option value="0" <?= set_select('jk', '0') ?>>Perempuan</option>
                            </select>
                            <?= form_error('jk', '<div id="jk" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="nohp">No HP</label>
                            <input type="text" class="form-control" name="nohp" id="nohp" value="<?= set_value('nohp') ?>">
                            <?= form_error('nohp', '<div id="nohp" class="form-text text-danger text-left">', '</div>'); ?>
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

<!-- Modal Update Data -->
<div class="modal fade" id="modaledit" edit="<?= $showModal == "edit" ? "true" : "false" ?>" tabindex="-1" role="dialog" aria-labelledby="editPasienID" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePasienID">Update Data</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pasien/update') ?>" method="POST">
                    <div class="row g-2">
                        <div class="col-sm-12">
                            <label for="noRegist">Nomor Registrasi</label>
                            <input type="text" class="form-control" name="noRegist" id="ednoRegist" value="<?= set_value('noRegist') ?>" readonly>
                            <?= form_error('noRegist', '<div id="noRegist" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="ednama" value="<?= set_value('nama') ?>">
                            <?= form_error('nama', '<div id="nama" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="nik">N I K</label>
                            <input type="text" class="form-control" name="nik" id="ednik" value="<?= set_value('nik') ?>">
                            <?= form_error('nik', '<div id="nik" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="edalamat" class="form-control" value="<?= set_value('alamat') ?>">
                            <?= form_error('alamat', '<div id="alamat" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="edjk" class="form-control">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="1" <?= set_select('jk', '1') ?>>Laki - Laki</option>
                                <option value="0" <?= set_select('jk', '0') ?>>Perempuan</option>
                            </select>
                            <?= form_error('jk', '<div id="jk" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="nohp">No HP</label>
                            <input type="text" class="form-control" name="nohp" id="ednohp" value="<?= set_value('nohp') ?>">
                            <?= form_error('nohp', '<div id="nohp" class="form-text text-danger text-left">', '</div>'); ?>
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


<!-- modal import -->
<div class="modal fade" id="importdata" tabindex="-1" role="dialog" aria-labelledby="importdata" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importdata">Import Data</h5>
            </div>
            <form action="<?= base_url('Pasien/import') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="file" class="form-control" name="upload-data-pasien" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
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
    $(document).ready(function() {
        $('#pasien').DataTable();
    });

    // on click Add data
    function addDataBro() {
        $('#addPasien').modal('show');
    }

    function updateDataMhs(noRegist, nik, nama, alamat, jk, nohp) {
        $('#ednoRegist').val(noRegist);
        $('#ednik').val(nik);
        $('#ednama').val(nama);
        $('#edalamat').val(alamat);
        $('#edjk').val(jk);
        $('#ednohp').val(nohp);

        $('#modaledit').modal('show');
    }
</script>
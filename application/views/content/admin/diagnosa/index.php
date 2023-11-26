<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table caption-top" id="diagnosa">
                    <caption>
                        <div class="row">
                            <div>
                                Data <?= $title; ?>
                            </div>
                            <div style="text-align: right;">
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-success text-white btn-sm" data-bs-toggle="modal" data-bs-target="#addDiagnosa"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-secondary text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Import Data"><i class="fa fa-download" aria-hidden="true"></i></a>
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-primary text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Data"><i class="fa fa-upload" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kode</td>
                            <td>Diagnosa</td>
                            <td>Kode Penyakit</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($diagnosa as $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['kode'] ?></td>
                                <td><?= $value['diagnosa'] ?></td>
                                <td><?= $value['kodepenyakit'] ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="updateData('<?= $value['kode']; ?>', '<?= $value['diagnosa']; ?>', '<?= $value['kodepenyakit']; ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('diagnosa/deleteData/') . $value['kode'] ?>" class="btn btn-danger btn-sm btn-act-trash" onclick="" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
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
<div class="modal fade" id="addDiagnosa" add="<?= $showModal == "add" ? "true" : "false" ?>" tabindex="-1" role="dialog" aria-labelledby="addDiagnosaOk" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDiagnosaOk">Tambah Data</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('diagnosa/addData') ?>" method="POST">
                    <div class="row">
                        <input type="hidden" name="id_pendaftar" id="id_pendaftar">
                        <div class="col-sm-12">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode" value="<?= set_value('kode') ?>" placeholder="Masukkan Kode Diagnosa">
                            <?= form_error('kode', '<div id="kode" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="diagnosa">Diagnosa</label>
                            <input type="text" class="form-control" name="diagnosa" id="diagnosa" value="<?= set_value('diagnosa') ?>" placeholder="Masukkan Diagnosa">
                            <?= form_error('diagnosa', '<div id="diagnosa" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="kodePenyakit">Kode Penyakit</label>
                            <select name="kodePenyakit" id="kodePenyakit" class="form-control">
                                <option value="">-- Pilih Kode Penyakit --</option>
                                <?php foreach ($penyakit as $key => $value) { ?>
                                    <option value="<?= $value['kode'] ?>" <?= set_select('kodePenyakit', $value['kode']) ?>><?= $value['kode'] . ' | ' . $value['kelompok'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('kodePenyakit', '<div id="kodePenyakit" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-success text-white">Simpan</button>
                <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Data -->
<div class="modal fade" id="editDiagnosa" edit="<?= $showModal == "edit" ? "true" : "false" ?>" tabindex="-1" role="dialog" aria-labelledby="editDiagnosaOk" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDiagnosaOk">Update Data</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('diagnosa/updateData') ?>" method="POST">
                    <div class="row">
                        <input type="hidden" name="id_pendaftar" id="id_pendaftar">
                        <div class="col-sm-12">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" name="kode" id="edkode" value="<?= set_value('kode') ?>" readonly>
                            <?= form_error('kode', '<div id="kode" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="diagnosa">Diagnosa</label>
                            <input type="text" class="form-control" name="diagnosa" id="eddiagnosa" value="<?= set_value('diagnosa') ?>">
                            <?= form_error('diagnosa', '<div id="diagnosa" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="edkodePenyakit">Kode Penyakit</label>
                            <select name="kodePenyakit" id="edkodePenyakit" class="form-control">
                                <option value="">-- Pilih Kode Penyakit --</option>
                                <?php foreach ($penyakit as $key => $value) { ?>
                                    <option value="<?= $value['kode'] ?>" <?= set_select('kodePenyakit', $value['kode']) ?>><?= $value['kode'] . ' | ' . $value['kelompok'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('kodePenyakit', '<div id="kodePenyakit" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-success text-white">Update</button>
                <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#diagnosa').DataTable();
    });

    function updateData(kode, diagnosa, kodepenyakit) {
        // tampilkan modal edit data
        $('#editDiagnosa').modal('show');

        // kirim data ke input
        $('#edkode').val(kode);
        $('#eddiagnosa').val(diagnosa);
        
        $('#edkodePenyakit').val(kodepenyakit);
    }
</script>
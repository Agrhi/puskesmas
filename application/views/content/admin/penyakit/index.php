<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table caption-top" id="penyakit">
                    <caption>
                        <div class="row">
                            <div>
                                Data <?= $title; ?>
                            </div>
                            <div style="text-align: right;">
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-success text-white btn-sm" data-bs-toggle="modal" data-bs-target="#addPenyakit"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-secondary text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Import Data"><i class="fa fa-download" aria-hidden="true"></i></a>
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-primary text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Data"><i class="fa fa-upload" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kode</td>
                            <td>Kelompok</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($penyakit as $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['kode'] ?></td>
                                <td><?= $value['kelompok'] ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="updateData('<?= $value['kode']; ?>', '<?= $value['kelompok']; ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('penyakit/deleteData/') . $value['kode'] ?>" class="btn btn-danger btn-sm btn-act-trash" onclick="" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
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
<div class="modal fade" id="addPenyakit" add="<?= $showModal == "add" ? "true" : "false" ?>" tabindex="-1" role="dialog" aria-labelledby="addPenyakitOk" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPenyakitOk">Tambah Data</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('penyakit/addData') ?>" method="POST">
                    <div class="row">
                        <input type="hidden" name="id_pendaftar" id="id_pendaftar">
                        <div class="col-sm-12">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode" value="<?= set_value('kode') ?>" placeholder="Masukkan Kode">
                            <?= form_error('kode', '<div id="kode" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="kelompok">Penyakit</label>
                            <input type="text" class="form-control" name="kelompok" id="kelompok" value="<?= set_value('kelompok') ?>" placeholder="Masukkan kelompok">
                            <?= form_error('kelompok', '<div id="kelompok" class="form-text text-danger text-left">', '</div>'); ?>
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
<div class="modal fade" id="editPenyakit" edit="<?= $showModal == "edit" ? "true" : "false" ?>" tabindex="-1" role="dialog" aria-labelledby="editPenyakitOk" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPenyakitOk">Update Data</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('penyakit/updateData') ?>" method="POST">
                    <div class="row">
                        <input type="hidden" name="id_pendaftar" id="id_pendaftar">
                        <div class="col-sm-12">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" name="kode" id="edkode" value="<?= set_value('kode') ?>" readonly>
                            <?= form_error('kode', '<div id="kode" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-12">
                            <label for="kelompok">Kelompok</label>
                            <input type="text" class="form-control" name="kelompok" id="edkelompok" value="<?= set_value('kelompok') ?>">
                            <?= form_error('kelompok', '<div id="kelompok" class="form-text text-danger text-left">', '</div>'); ?>
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
        $('#penyakit').DataTable();
    });

    function updateData(kode, kelompok) {
        // tampilkan modal edit data
        $('#editPenyakit').modal('show');

        // kirim data ke input
        $('#edkode').val(kode);
        $('#edkelompok').val(kelompok);
    }
</script>
<section class="section">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url('registrasi/getDataRekamedisPasien/') . $rekamedis['noRegist'] ?>" class="btn bg-success text-white btn-sm">Kembali</a> <br>

            <?= $title . ' dengan Nomor Registrasi ( ' . $rekamedis['noRegist'] . ' )' ?>

            <form action="<?= base_url('registrasi/updateDataRekamedis/') ?>" method="POST">
                <div class="row">
                    <input type="hidden" name="noRegist" value="<?= $rekamedis['noRegist']; ?>">
                    <input type="hidden" name="idRekamedis" value="<?= $rekamedis['idRekamedis']; ?>">
                    <div class="col-sm-6">
                        <label for="poli">Poli</label>
                        <input type="text" disabled class="form-control" name="poli" id="poli" value="<?= $rekamedis['poli'] ?>">
                        <?= form_error('poli', '<div id="poli" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                    <div class="col-sm-6">
                        <label for="umur">Umur</label>
                        <input type="number" class="form-control" name="umur" id="umur" value="<?= set_value('umur') ?>" required>
                        <?= form_error('umur', '<div id="umur" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                    <div class="col-sm-12">
                        <label for="keluhan">Keluhan</label>
                        <textarea type="text" class="form-control" rows="3" name="keluhan" id="keluhan" value="<?= set_value('keluhan') ?>" required></textarea>
                        <?= form_error('keluhan', '<div id="keluhan" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                    <div class="col-sm-12">
                        <label for="diagnosa">Diagnosa</label>
                        <select class="diagnosa" name="diagnosa" id="diagnosa" required>
                            <option value="">-- Pilih Diagnosa --</option>
                            <?php foreach ($penyakit as $p) { ?>
                                <option value="<?= $p['kode'] ?>" <?php echo $rekamedis['diagnosa'] === $p['kode'] ? 'selected' : ''; ?>>
                                    <?= $p['kelompok'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label for="keterangan">Keterangan</label>
                        <textarea type="text" class="form-control" name="keterangan" rows="3" id="keterangan" value="<?= set_value('keterangan') ?>"></textarea>
                        <?= form_error('keterangan', '<div id="keterangan" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success mt-3">Save</button>
                </div>
            </form>
        </div>
    </div>

</section>

<script>
    $(document).ready(function() {
        $('#diagnosa').select2();
    });
</script>
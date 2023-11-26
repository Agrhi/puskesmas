<section class="section">
    <div class="card">
        <div class="card-body">
            <?= $title ?>

            <form action="<?= base_url('registrasi/updateData/') ?>" method="POST">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="keluhan">Keluhan</label>
                        <?php if ($act === 'rekamedis') { ?>
                            <textarea type="text" class="form-control" rows="3" name="keluhan" id="keluhan" value="<?= set_value('keluhan') ?>"></textarea>
                        <?php } ?>
                        <textarea type="text" class="form-control" rows="3" name="keluhan" id="keluhan" value="<?= set_value('keluhan') ?>"></textarea>
                        <?= form_error('keluhan', '<div id="keluhan" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                    <div class="col-sm-4">
                        <label for="tensi">Tensi</label>
                        <input type="text" name="tensi" id="tensi" class="form-control" value="<?= set_value('tensi') ?>">
                        <?= form_error('tensi', '<div id="tensi" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                    <div class="col-sm-4">
                        <label for="bb">Berat Badan</label>
                        <input type="text" name="bb" id="bb" class="form-control" value="<?= set_value('bb') ?>">
                        <?= form_error('bb', '<div id="bb" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                    <div class="col-sm-4">
                        <label for="tb">Tinggi Badan</label>
                        <input type="text" name="tb" id="tb" class="form-control" value="<?= set_value('tb') ?>">
                        <?= form_error('tb', '<div id="tb" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                    <div class="col-sm-12">
                        <label for="keterangan">Keterangan</label>
                        <textarea type="text" class="form-control" name="keterangan" rows="3" id="keterangan" value="<?= set_value('keterangan') ?>"></textarea>
                        <?= form_error('keterangan', '<div id="keterangan" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                    <div class="col-sm-6">
                        <label for="poli">Poli</label>
                        <input type="text" class="form-control" name="poli" id="poli" value="<?= set_value('poli') ?>">
                        <?= form_error('poli', '<div id="poli" class="form-text text-danger text-left">', '</div>'); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
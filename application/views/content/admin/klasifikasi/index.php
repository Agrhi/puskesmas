<section class="section">
    <div class="card">
        <div class="card-header">
            <h3><?= $title; ?></h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('#') ?>">Data Latih</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('#') ?>">Data Now</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('#') ?>">Pohon Keputusan</a>
                </li>
            </ul>
            <div class="mt-3">
                <h5>Pengelompokkan Data</h5>
                <form action="<?= base_url('Klasifikasi/tabelCalculate') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="alamat" name="alamat" aria-describedby="alamat" placeholder="Alamat" value="<?= set_value('alamat') ?>">
                                <?= form_error('alamat', '<div id="alamat" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <select name="jk" id="jk" class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="1" <?= set_select('jk', '1') ?>>Laki - Laki</option>
                                    <option value="0" <?= set_select('jk', '0') ?>>Perempuan</option>
                                </select>
                                <?= form_error('jk', '<div id="jk" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <select name="umur" id="umur" class="form-control">
                                    <option value="">-- Pilih Kategori Umur --</option>
                                    <option value="Bayi dan Anak-anak" <?= set_select('umur', 'Bayi dan Anak-anak') ?>>Bayi dan Anak-anak</option>
                                    <option value="Muda dan Dewasa" <?= set_select('umur', 'Muda dan Dewasa') ?>>Muda dan Dewasa</option>
                                    <option value="Tua" <?= set_select('umur', 'Tua') ?>>Tua</option>
                                </select>
                                <?= form_error('umur', '<div id="umur" class="form-text text-danger text-left">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="all" value="false" id="submit-with-filter" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <button type="submit" name="all" value="true" id="submit-all" class="btn btn-success">All</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<script>
    $(document).ready(function() {
        $('#submit-with-filter').prop('disabled', true);
        $('#submit-all').prop('disabled', false);

        // Pantau perubahan nilai input
        $('input, select').on('input change', function() {
            // Periksa apakah semua input memiliki nilai
            var allInputsFilled = $('input[type="text"]').filter(function() {
                    return $(this).val() !== '';
                }).length === $('input[type="text"]').length &&
                $('select').filter(function() {
                    return $(this).val() !== '';
                }).length === $('select').length;

            // Atur properti tombol berdasarkan kondisi
            if (allInputsFilled) {
                $('#submit-with-filter').prop('disabled', false);
                $('#submit-all').prop('disabled', true);
            } else {
                $('#submit-with-filter').prop('disabled', true);
                $('#submit-all').prop('disabled', false);
            }
        });
    });
</script>
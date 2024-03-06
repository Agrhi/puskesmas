<section class="section">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#klasifikasi" onclick="toggleTab('klasifikasi')">Klasifikasi C45</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pohonkeputusan" onclick="toggleTab('pohonkeputusan')">Pohon Keputusan</a>
                </li>
            </ul>

            <div class="tab-content bg-white" style="padding: 12px 0;">
                <div class="tab-pane active" id="klasifikasi">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select name="alamat" id="alamat" class="form-control">
                                        <option value="">-- Pilih Alamat --</option>
                                        <?php foreach ($alamat as $a) { ?>
                                            <option value="<?= $a['alamat'] ?>"><?= $a['alamat'] ?></option>
                                        <?php } ?>
                                    </select>
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
                                <button type="submit" value="false" id="submit-klasifikasi-c45" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="border border-success text-black fw-bold p-3 rounded mt-3" id="hasil-klasifikasi"></div>
                </div>
                <div class="tab-pane" id="pohonkeputusan">
                    <button type="button" value="false" id="btn-build-tree" class="btn btn-success"><i class="fa fa-tree me-2" aria-hidden="true"></i> Build Tree</button>
                    <div class="border border-success text-black fs-5 fw-bold p-3 rounded mt-3" id="hasil-build-tree"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#hasil-klasifikasi').hide();
        $('#hasil-build-tree').hide();
        $('#submit-klasifikasi-c45').click(function(e) {
            e.preventDefault();

            var alamat = $('#alamat').val();
            var jk = $('#jk').val();
            var umur = $('#umur').val();

            $.ajax({
                type: 'POST',
                url: `<?= base_url('Klasifikasi/classify') ?>`,
                data: {
                    alamat: alamat,
                    jk: jk,
                    umur: umur
                },
                success: function(response) {
                    $('#hasil-klasifikasi').show();
                    $('#hasil-klasifikasi').html(`Hasil = ${response}`);
                },
                error: function(xhr, status, error) {
                    $('#hasil-klasifikasi').hide();
                    console.error(xhr.responseText);
                }
            });
        });

        $('#btn-build-tree').click(function() {
            $.ajax({
                type: 'GET',
                url: `<?= base_url('Klasifikasi/tree') ?>`,
                success: function(response) {
                    $('#hasil-build-tree').show();
                    $('#hasil-build-tree').html('<pre>' + JSON.stringify(JSON.parse(response), null, 4) + '</pre>');
                },
                error: function(xhr, status, error) {
                    $('#hasil-build-tree').hide();
                    console.log(xhr.responseText);
                }
            })
        });
    });

    function toggleTab(tabId) {
        var currentTab = document.querySelector('.nav-link.active');
        currentTab.classList.remove('active');
        event.target.classList.add('active');

        document.querySelector('.tab-pane.active').classList.remove('active');
        document.getElementById(tabId).classList.add('active');
    }
</script>
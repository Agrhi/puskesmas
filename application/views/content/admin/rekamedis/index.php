<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table caption-top" id="seleksi">
                    <caption>
                        <div class="row">
                            <div>
                                Data <?= $title; ?>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nomor Regist</td>
                            <td>NIK</td>
                            <td>Nama Pasien</td>
                            <td>Poli</td>
                            <td>Tanggal</td>
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
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#seleksi').DataTable();
    });
</script>
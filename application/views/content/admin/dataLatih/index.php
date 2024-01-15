<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="syarat">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Alamat</td>
                            <td>Jenis Kelamin</td>
                            <td>Umur</td>
                            <td>Kode Diagnosa</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataLatih as $dL) { ?>
                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td><?= $dL['alamat'] ?></td>
                                <td><?= $dL['jk'] == 0 ? 'Perempuan' : 'Laki-laki' ?></td>
                                <td><?= $dL['umur'] ?></td>
                                <td><?= $dL['class'] ?></td>
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
        $('#syarat').DataTable();
    });
</script>
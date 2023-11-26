<section class="section">
    <div class="card">
        <div class="card-body">
        <table class="table" id="syarat">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Isi</td>
                        <td>Jenis Seleksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($syarat as $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['isi'] ?></td>
                            <td><?= $value['seleksi'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>

<script>
    $(document).ready(function() {
        $('#syarat').DataTable();
    });
</script>
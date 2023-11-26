<section class="section">
    <div class="card">
        <div class="card-body">
            <table class="table" id="user">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Username</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($user as $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['username'] ?></td>
                            <td>
                                <?php if ($value['active'] == 1) { ?>
                                    <a href="<?= base_url('management_user/status/nonaktif/') . $value['iduser'] ?>" class="btn btn-outline-primary btn-sm">Aktif</a>
                                <?php } else { ?>
                                    <a href="<?= base_url('management_user/status/aktif/') . $value['iduser'] ?>" class="btn btn-outline-danger btn-sm">Tidak Aktif</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>

<script>
    $(document).ready(function() {
        $('#user').DataTable();
    });
</script>
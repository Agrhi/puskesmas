<section class="section">
    <div class="card">
        <div class="card-body">
            <table class="table caption-top" id="user">
                <caption>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modaladd">Add User</button>
                </caption>
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Username</td>
                        <td>Status</td>
                        <td>Action</td>
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
                            <td>
                                <button class="btn btn-success btn-sm" onclick="updateData('<?= $value['iduser']; ?>', '<?= $value['nama']; ?>', '<?= $value['username']; ?>', '<?= $value['password']; ?>')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('management_user/deleteData/') . $value['iduser'] ?>" class="btn btn-danger btn-sm btn-act-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>


<!-- Modal Tambah User -->
<div class="modal fade" add="<?= $showModal == "add" ? "true" : "false" ?>" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modaladdid" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaladdid">Add User</h5>
            </div>
            <form action="<?= base_url('management_user') ?>/add" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="namauser">Nama user</label>
                            <input type="text" class="form-control" name="namauser" id="namauser" placeholder="Nama User" value="<?= set_value('namauser') ?>">
                            <?= form_error('namauser', '<div id="namauser" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= set_value('username') ?>">
                            <?= form_error('username', '<div id="username" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control showpass" name="password" id="password" placeholder="Password" value="<?= set_value('password') ?>">
                            <?= form_error('password', '<div id="password" class="form-text text-danger text-left">', '</div>'); ?>
                            <input type="checkbox" class="form-checkbox">
                            <label>Tampilkan password</label>
                        </div>
                        <div class="form">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal Edit User -->
<div class="modal fade" edit="<?= $showModal == "edit" ? "true" : "false" ?>" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditid" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditid">Edit User</h5>
            </div>
            <form action="<?= base_url('management_user') ?>/update" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="namauser">Nama user</label>
                            <input type="hidden" class="form-control" name="iduser" id="ediduser" value="<?= set_value('iduser') ?>">
                            <?php if ($this->session->userdata('idpetani') == '') { ?>
                                <input type="text" class="form-control" name="namauser" id="ednamauser" placeholder="Nama User" value="<?= set_value('namauser') ?>">
                            <?php } else { ?>
                                <input type="text" class="form-control" name="namauser" id="ednamauser" placeholder="Nama User" value="<?= set_value('namauser') ?>" readonly>
                            <?php } ?>
                            <?= form_error('namauser', '<div id="namauser" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="edusername" placeholder="Username" value="<?= set_value('username') ?>">
                            <?= form_error('username', '<div id="username" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control showpass" name="password" id="edpassword" placeholder="Password" value="<?= set_value('password') ?>">
                            <?= form_error('password', '<div id="password" class="form-text text-danger text-left">', '</div>'); ?>
                            <input type="checkbox" class="form-checkbox">
                            <label>Tampilkan password</label>
                        </div>
                        <div class="form">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<script>
    $(document).ready(function() {
        $('#user').DataTable();
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.showpass').attr('type', 'text');
            } else {
                $('.showpass').attr('type', 'password');
            }
        });
    });

    function updateData(iduser, nama, username, password) {
        // tampilkan modal edit data
        $('#modaledit').modal('show');

        $('#ediduser').val(iduser);
        $('#ednamauser').val(nama);
        $('#edusername').val(username);
        $('#edpassword').val(password);
    }
</script>
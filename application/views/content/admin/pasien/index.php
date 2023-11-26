<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table caption-top" id="daftar">
                    <caption>
                        <div class="row">
                            <div>
                                Data <?= $title; ?>
                            </div>
                            <div style="text-align: right;">
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-success text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-secondary text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Import Data"><i class="fa fa-download" aria-hidden="true"></i></a>
                                <a href="<?= base_url('mhs/ganti') ?>" class="btn bg-primary text-white btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Data"><i class="fa fa-upload" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nomor Registrasi</td>
                            <td>NIK</td>
                            <td>Nama</td>
                            <td>Alamat</td>
                            <td>Jenis Kelamin</td>
                            <td>Nomor Hp</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pasien as $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['noRegist'] ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['jk'] ?></td>
                                <td><?= $value['nohp'] ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="updateDataMhs('<?= $value['noRegist']; ?>')" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Data"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" onclick="updateDataMhs('<?= $value['noRegist']; ?>')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<!-- Modal Update Data -->
<div class="modal fade" id="modalUpdateDataMhs" edit="<?= $showModal == "edit" ? "true" : "false" ?>" tabindex="-1" role="dialog" aria-labelledby="modalUpdateDataMhs" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaladdid">Update Data</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('mhs/updateDataMhs') ?>" method="POST">
                    <div class="row">
                        <input type="hidden" name="id_pendaftar" id="id_pendaftar">
                        <div class="col-sm-6">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama') ?>">
                            <?= form_error('nama', '<div id="nama" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                            <?= form_error('email', '<div id="email" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="<?= set_value('alamat') ?>">
                            <?= form_error('alamat', '<div id="alamat" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="1" <?= set_select('jk', '1') ?>>Laki - Laki</option>
                                <option value="0" <?= set_select('jk', '0') ?>>Perempuan</option>
                            </select>
                            <?= form_error('jk', '<div id="jk" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" value="<?= set_value('asal_sekolah') ?>">
                            <?= form_error('asal_sekolah', '<div id="asal_sekolah" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="jurusan">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-control">
                                <option value="">-- Pilih Jurusan --</option>
                                <?php foreach ($jurusan as $key => $value) { ?>
                                    <option value="<?= $value['id_jurusan'] ?>" <?= set_select('jurusan', $value['id_jurusan']) ?>><?= $value['jurusan'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('jurusan', '<div id="jurusan" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?= set_value('no_hp') ?>">
                            <?= form_error('no_hp', '<div id="no_hp" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="pin">PIN</label>
                            <input type="text" class="form-control" name="pin" id="pin" value="<?= set_value('pin') ?>">
                            <?= form_error('pin', '<div id="pin" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <label class="mt-3">Data Orang Tua</label>
                        <div class="col-sm-6">
                            <label for="nama_ortu">Nama Orang Tua</label>
                            <input type="text" class="form-control" name="nama_ortu" id="nama_ortu" value="<?= set_value('nama_ortu') ?>">
                            <?= form_error('nama_ortu', '<div id="nama_ortu" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                            <input type="text" class="form-control" name="pekerjaan_ortu" id="pekerjaan_ortu" value="<?= set_value('pekerjaan_ortu') ?>">
                            <?= form_error('pekerjaan_ortu', '<div id="pekerjaan_ortu" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="alamat_ortu">Alamat Orang Tua</label>
                            <input type="text" class="form-control" name="alamat_ortu" id="alamat_ortu" value="<?= set_value('alamat_ortu') ?>">
                            <?= form_error('alamat_ortu', '<div id="alamat_ortu" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="no_hp_ortu">No HP Orang Tua</label>
                            <input type="text" class="form-control" name="no_hp_ortu" id="no_hp_ortu" value="<?= set_value('no_hp_ortu') ?>">
                            <?= form_error('no_hp_ortu', '<div id="no_hp_ortu" class="form-text text-danger text-left">', '</div>'); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-gradient-primary">Update</button>
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#daftar').DataTable();
    });

    // on click update data
    function updateDataMhs(id_pendaftar) {
        $.ajax({
            url: "<?= base_url('mhs/getDataMhs') ?>",
            type: "POST",
            data: {
                id_pendaftar: id_pendaftar
            },
            dataType: "JSON",
            success: function(data) {
                $('#modalUpdateDataMhs').modal('show');
                $('#id_pendaftar').val(data.id_pendaftar);
                $('#nama').val(data.nama);
                $('#email').val(data.email);
                $('#alamat').val(data.alamat);
                $('#jk').val(data.jk);
                $('#asal_sekolah').val(data.asalsekolah);
                $('#jurusan').val(data.jurusan);
                $('#tahun_lulus').val(data.tahunlulus);
                $('#nama_ortu').val(data.namaortu);
                $('#pekerjaan_ortu').val(data.pekerjaanortu);
                $('#no_hp_ortu').val(data.nohportu);
                $('#alamat_ortu').val(data.alamatortu);
                $('#no_hp').val(data.nohp);
                $('#pin').val(data.pin);
            }
        });
    }
</script>
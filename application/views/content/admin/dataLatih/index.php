<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table caption-top" id="datalatih">
                    <caption>
                        <div class="row">
                            <div class="text-end">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= base_url('/assets/format_data.csv'); ?>">Format Excel</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#importdatalatih">Import Data</a></li>
                                    </ul>
                                </div>
                                <a href="<?= base_url('Datalatih/deleteAll') ?>" class="btn bg-danger text-white btn-sm btn-act-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete All Data"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </caption>
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

    <!-- modal -->
    <div class="modal fade" id="importdatalatih" tabindex="-1" role="dialog" aria-labelledby="importdatalatih" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importdatalatih">Update Data</h5>
                </div>
                <form action="<?= base_url('Datalatih/import') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="file" class="form-control" name="upload-data-latih" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
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

</section>

<script>
    $(document).ready(function() {
        $('#datalatih').DataTable();
    });
</script>
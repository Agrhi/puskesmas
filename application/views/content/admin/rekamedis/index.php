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
                            <td>Layanan</td>
                            <!-- <td>Tanggal</td> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($rekamedis as $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" nik="<?= $value['nik']; ?>" nama="<?= $value['nama']; ?>" alamat="<?= $value['alamat']; ?>" nohp="<?= $value['nohp']; ?>" noRegist="<?= $value['noRegist']; ?>" diagnosa="<?= $value['diagnosa']; ?>" kelompok="<?= $value['kelompok']; ?>" tgl="<?= $value['tgl']; ?>"><?= $value['noRegist'] ?></button>
                                </td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['layanan'] ?></td>
                                <!-- <td><?= $value['tgl'] ?></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        NIK
                    </div>
                    <div class="col">
                        <div class="row" id="detailnik">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Nama
                    </div>
                    <div class="col">
                        <div class="row" id="detailnama">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Nomor Regist
                    </div>
                    <div class="col">
                        <div class="row" id="detailnoRegist">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        alamat
                    </div>
                    <div class="col">
                        <div class="row" id="detailalamat">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Nomor Hp
                    </div>
                    <div class="col">
                        <div class="row" id="detailnohp">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Diagnosa
                    </div>
                    <div class="col">
                        <div class="row" id="detaildiagnosa">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Kelompok
                    </div>
                    <div class="col">
                        <div class="row" id="detailkelompok">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Tanggal
                    </div>
                    <div class="col">
                        <div class="row" id="detailtgl">tgl
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#seleksi').DataTable();
    });

    const exampleModal = document.getElementById('exampleModal')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            
            const nik = button.getAttribute('nik');
            const nama = button.getAttribute('nama');
            const noRegist = button.getAttribute('noRegist');
            const alamat = button.getAttribute('alamat');
            const nohp = button.getAttribute('nohp');
            const diagnosa = button.getAttribute('diagnosa');
            const kelompok = button.getAttribute('kelompok');
            const tgl = button.getAttribute('tgl');
            
            $('#detailnik').text(': ' + nik);
            $('#detailnama').text(': ' + nama);
            $('#detailalamat').text(': ' + alamat);
            $('#detailnohp').text(': ' + nohp);
            $('#detailnoRegist').text(': ' + noRegist);
            $('#detailkelompok').text(': ' + kelompok);
            $('#detaildiagnosa').text(': ' + diagnosa);
            $('#detailtgl').text(': ' + tgl);
        })
    }
</script>
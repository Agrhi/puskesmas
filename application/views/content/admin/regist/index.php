<section class="section">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#registrasi" onclick="toggleTab('registrasi')">Registrasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#rekamedis" onclick="toggleTab('rekamedis')">Rekamedis</a>
                </li>
            </ul>
            <div class="tab-content mt-3">
                <div class="tab-pane active" id="registrasi">
                    <h5>Cari Data Pasien</h5>
                    <form action="<?= base_url('registrasi/getDataPasien/') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="noRegist" name="noRegist" aria-describedby="noRegist" placeholder="Nomor Registrasi atau NIK">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="rekamedis">
                    <h5>Cari Data Rekamedis Pasien</h5>
                    <form action="<?= base_url('registrasi/getDataRekamedisPasien') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="noRegist" name="noRegist" aria-describedby="noRegist" placeholder="Nomor Registrasi atau NIK">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    function toggleTab(tabId) {
        document.querySelector('.nav-link.active').classList.remove('active');
        document.querySelector('.tab-pane.active').classList.remove('active');

        document.querySelector(`a[href="#${tabId}"]`).classList.add('active');
        document.querySelector(`#${tabId}`).classList.add('active');
    }
</script>
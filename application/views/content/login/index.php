<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card bg-success shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <h4 class="text-white">SIMATAEMAS</h4>
                    <h2 class="text-white">LOGIN</h2>
                </div>
                <form role="form" action="<?= base_url('login/prosses'); ?>" method="post">
                    <div class="form-group mb-3">
                        <!-- <label for="username" class="text-white">Username</label> -->
                        <div class="input-group input-group-alternative">
                            <input class="form-control" placeholder="Username" id="username" name="username" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label for="pass" class="text-white">Password</label> -->
                        <div class="input-group input-group-alternative">
                            <input class="form-control" placeholder="Password" id="pass" name="password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-select" aria-label="Default select example">
                            <option value="">Pilih Akses</option>
                            <option value="1">Dokter</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-light">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
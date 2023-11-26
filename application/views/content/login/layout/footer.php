</div>
</div>
</div>
<footer class="py-3 bg-success">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-white">
                    2023
                    &copy; Copyright
                    <a href="https://www.instagram.com/agrhi_/" class="font-weight-bold text-white" target="_blank">Creative Software Engineer</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</body>

<script>
    <?php
    if (isset($this->session->swetalert)) {
    ?>
        Swal.fire(<?= $this->session->swetalert ?>);
    <?php
    }
    ?>
</script>

</html>
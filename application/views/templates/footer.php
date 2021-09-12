<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<script src="<?= base_url('assets/') ?>js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // event ketika keyword di tulis
        $('#cari-barang').on('keyup', () => {

            // $.get()
            $.get('<?= base_url() ?>products/searchproduct?cari-barang=' + $('#cari-barang').val(), function(data) {
                $('#result').html(data);
                // console.log(data);
            });
        });

    });
</script>

</body>

</html>
<section class="main">
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6">
                <h3 class="mb-3">Ubah Data Barang</h3>
                <form method="post">
                    <div class="mb-3">
                        <label for="product_barang" class="form-label">Nama Barang</label>
                        <input type="email" class="form-control" id="product_barang" placeholder="TESTING" name="product_barang" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga Barang</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="price" name="price" placeholder="5000">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="Makanan">
                            <label class="form-check-label" for="Makanan">
                                Makanan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="Minuman">
                            <label class="form-check-label" for="Minuman">
                                Minuman
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <div class="row">
                            <div class="col-2">
                                <img src="<?= base_url('assets/') ?>img/tes.jpg" class="img-thumbnail" width="100" height="100">
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
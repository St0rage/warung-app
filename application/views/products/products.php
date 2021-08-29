<!-- BODY -->
<section class="main">
    <div class="container">
        <!-- Search Button -->
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Barang">
                    <button class="btn btn-primary " type="button" id="button-addon2">Button</button>
                </div>
            </div>
        </div>
        <!-- End Search Button -->

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="categories-title">
                    <h6>Categories</h6>
                </div>
                <div class="badge-categories">
                    <a href="<?= base_url() ?>" class="badge bg-primary text-decoration-none">All</a>
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?= base_url('products/category/') ?><?= $category['id'] ?>" class="badge bg-danger text-decoration-none"><?= $category['category_name'] ?></a>
                    <?php endforeach; ?>
                    <a href="<?= base_url('products/addcategory') ?>" class="badge bg-secondary text-decoration-none">Tambah Kategori</a>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6">
                <div class="product-list-title">
                    <h6>Product List</h6>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col" style="width: 150px">Kategori</th>
                            <th scope="col">Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <span>Monde Snack Gold</span>
                                <div class="product-action">
                                    <a href="" class="badge bg-primary text-decoration-none">Ubah</a>
                                    <a href="" class="badge bg-danger text-decoration-none">Hapus</a>
                                </div>
                            </td>
                            <td>Rp. 5000</td>
                            <td>
                                <a href="" class="badge bg-success text-decoration-none">Makanan</a>
                                <a href="" class="badge bg-success text-decoration-none">Snack</a>
                            </td>
                            <td><img src="<?= base_url('assets/') ?>img/tes.jpg" width="80" height="80"></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Roma Kelapa</td>
                            <td>Rp. 12000</td>
                            <td>
                                <a href="" class="badge bg-success text-decoration-none">Makanan</a>
                                <a href="" class="badge bg-success text-decoration-none">Biskuit</a>
                                <a href="" class="badge bg-success text-decoration-none">Makanan</a>
                                <a href="" class="badge bg-success text-decoration-none">Biskuit</a>
                                <a href="" class="badge bg-success text-decoration-none">Makanan</a>
                                <a href="" class="badge bg-success text-decoration-none">Biskuit</a>
                                <a href="" class="badge bg-success text-decoration-none">Biskuit</a>
                            </td>
                            <td><img src="<?= base_url('assets/') ?>img/tes.jpg" width="80" height="80"></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Floridina</td>
                            <td>Rp. 5000</td>
                            <td>
                                <a href="" class="badge bg-success text-decoration-none">Minuman</a>
                            </td>
                            <td><img src="<?= base_url('assets/') ?>img/tes.jpg" width="80" height="80"></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Floridina</td>
                            <td>Rp. 5000</td>
                            <td>
                                <a href="" class="badge bg-success text-decoration-none">Minuman</a>
                            </td>
                            <td><img src="<?= base_url('assets/') ?>img/tes.jpg" width="80" height="80"></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Floridina</td>
                            <td>Rp. 5000</td>
                            <td>
                                <a href="" class="badge bg-success text-decoration-none">Minuman</a>
                            </td>
                            <td><img src="<?= base_url('assets/') ?>img/tes.jpg" width="80" height="80"></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Floridina</td>
                            <td>Rp. 5000</td>
                            <td>
                                <a href="" class="badge bg-success text-decoration-none">Minuman</a>
                            </td>
                            <td><img src="<?= base_url('assets/') ?>img/tes.jpg" width="80" height="80"></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Floridina</td>
                            <td>Rp. 5000</td>
                            <td>
                                <a href="" class="badge bg-success text-decoration-none">Minuman</a>
                            </td>
                            <td><img src="<?= base_url('assets/') ?>img/tes.jpg" width="80" height="80"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Product List -->
    </div>
</section>
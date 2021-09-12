<!-- BODY -->
<section class="main">
    <div class="container">
        <!-- Search Button -->
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6">
                <form action="<?= base_url('products/searchproduct') ?>">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="cari-barang" placeholder="Cari Barang.." name="keyword">
                        <button class="btn btn-primary " type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Search Button -->

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="categories-title">
                    <h6>Categories</h6>
                </div>
                <div class="badge-categories">
                    <a href="<?= base_url() ?>" class="badge bg-<?= isset($id) ? 'danger' : 'primary' ?> text-decoration-none">All</a>
                    <?php foreach ($categories as $category) : ?>
                        <?php if ($id == $category['id']) : ?>
                            <a href="<?= base_url('products/category/') ?><?= $category['id'] ?>" class="badge bg-primary text-decoration-none"><?= $category['category_name'] ?></a>
                        <?php else : ?>
                            <a href="<?= base_url('products/category/') ?><?= $category['id'] ?>" class="badge bg-danger text-decoration-none"><?= $category['category_name'] ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <a href="<?= base_url('products/addcategory') ?>" class="badge bg-success text-dark text-decoration-none">Tambah Kategori</a>
                    <a href="<?= base_url('products/deletecategory') ?>" class="badge bg-warning text-dark text-decoration-none">Hapus Kategori</a>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6 col-sm">
                <div class="product-list-title">
                    <h6 class="tes">Product List</h6>
                </div>
                <?= $this->session->flashdata('message');  ?>
                <?php $this->session->sess_destroy(); ?>
                <div id="result">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr class="d-flex">
                                <th scope="col">#</th>
                                <th scope="col" class="col-4">Nama Barang</th>
                                <th scope="col" class="col-3">Harga</th>
                                <th scope="col" class="col-3">Kategori</th>
                                <th scope="col" class="col-2">Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($products as $product) : ?>
                                <?php
                                $productCategories = $this->product->getProductCategory($product['id']);
                                ?>

                                <tr class="d-flex">
                                    <th scope="row"><?= $i++; ?></th>
                                    <td class="col-4">
                                        <span><?= $product['product_name'] ?></span>
                                        <div class="product-action">
                                            <a href="<?= base_url() ?>products/updateproduct/<?= $product['id'] ?>" class="badge bg-primary text-decoration-none">Ubah</a>
                                            <a onclick="return confirm('Yakin?')" href="<?= base_url() ?>products/deleteproduct/<?= $product['id'] ?>" class="badge bg-danger text-decoration-none">Hapus</a>
                                        </div>
                                    </td>
                                    <td class="col-3">Rp <?= $product['price'] ?></td>
                                    <td class="col-3">
                                        <?php foreach ($productCategories as $productCategory) : ?>
                                            <a href="" class="badge bg-success text-decoration-none"><?= $productCategory['category_name'] ?></a>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="col-2"><img src="<?= base_url('assets/') ?>img/<?= $product['image'] ?>" class="img-fluid"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Product List -->
    </div>
</section>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Detail Product Section -->
<section class="section2">

    <div class="page-content page-details">
        <!-- breadcrumbs section -->
        <section class="detail-breadcrumbs" data-aos="fade-up" data-aos-duration="2000">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('/produk'); ?>">Produk Kami</a>
                                </li>
                                <li class="breadcrumb-item">
                                    Detail
                                </li>
                                <li class="breadcrumb-item active">
                                    <?= $product['product'][0]->nama_produk; ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-gallery aos-init aos-animate">
            <!-- Image Section -->
            <div class="container" data-aos="fade-up" data-aos-duration="2000">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="product-thumbnail">
                            <img src="<?= base_url(); ?>/uploaded/images/<?= $product['product'][0]->path_gambar_cover; ?>" class="xzoom" id="xzoom-default" xoriginal="<?= base_url(); ?>/uploaded/images/<?= $product['product'][0]->path_gambar_cover; ?>">
                        </div>
                    </div>
                    <div class="col-lg-2 img-wrapper">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0">
                                <a href="<?= base_url(); ?>/uploaded/images/<?= $product['product'][0]->path_gambar_cover; ?>">
                                    <div class="product-preview xzoom-gallery" xpreview="<?= base_url(); ?>/uploaded/images/<?= $product['product'][0]->path_gambar_cover; ?>">
                                        <img src="<?= base_url(); ?>/uploaded/images/<?= $product['product'][0]->path_gambar_cover; ?>" alt="Gambar Produk">
                                    </div>
                                </a>
                            </div>
                            <?php foreach ($product['images'] as $image) : ?>
                                <div class="col-3 col-lg-12 mt-2 mt-lg-0">
                                    <a href="<?= base_url(); ?>/uploaded/images/<?= $image->path_gambar; ?>">
                                        <div class="product-preview xzoom-gallery" xpreview="<?= base_url(); ?>/uploaded/images/<?= $image->path_gambar; ?>">
                                            <img src="<?= base_url(); ?>/uploaded/images/<?= $image->path_gambar; ?>" alt="Gambar Produk">
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="container description-product">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="products-text"><?= $product['product'][0]->nama_produk; ?></div>
                        <div class="products-price">Mulai dari <?= $product['product'][0]->harga_terendah; ?>/hari</div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center mt-4 mt-lg-0">
                        <a href="https://api.whatsapp.com/send?phone=<?= $product['phone']; ?>" class="btn btn-kontakwa d-flex align-items-center" target="_blank">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            Kontak Untuk Peminjaman
                        </a>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-8">
                        <h6>Daftar Paket yang Tersedia:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">Harga Paket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; ?>
                                <?php foreach ($packages as $pakcage) : ?>
                                    <tr>
                                        <!-- bagian ini isi dengan nomor paket -->
                                        <th scope="row"><?= $index++; ?></th>
                                        <!-- bagian ini isi dengan nama paket -->
                                        <th><?= $pakcage->nama_paket; ?></th>
                                        <!-- bagian ini isi dengan harga paket -->
                                        <th><?= $pakcage->harga; ?></th>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (!$packages) : ?>
                                    <tr>
                                        <!-- bagian ini isi dengan nomor paket -->
                                        <th scope="row"><?= $index; ?></th>
                                        <!-- bagian ini isi dengan nama paket -->
                                        <th>Paket belum didefinisikan</th>
                                        <!-- bagian ini isi dengan harga paket -->
                                        <th>Paket belum didefinisikan</th>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="text-description-product">
                            <?= $product['product'][0]->detail_produk; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    AOS.init();
    $(document).ready(function() {
        xzoom();
    });
</script>
<?= $this->endSection(); ?>
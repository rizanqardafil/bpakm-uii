<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Search Section -->
<section class="section2">

    <?php
    date_default_timezone_set('UTC'); 

    $date = date('Y-m-d H:i:s');
    ?>
    <!-- Search Card Section -->
    <form action="<?= base_url('/produk'); ?>" class="container mx-auto mb-5 pt-5" data-aos="fade-up" data-aos-duration="2000">
        <div class="row d-flex searchbox-custom">
            <div class="col-md-3 d-flex align-items-end space" style="border-right: 1px solid #ddd;">
                <div class="d-flex align-items-center search-mobile">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-search"></i>
                    </span>
                    <input type="search" class="form-control" id="pencarianProduk" name="nama_produk" placheck="true" placeholder="Cari Produk..." value="<?= $search_input['nama_produk'] ?>">
                </div>
            </div>
            <div class="col-md-3 space" style="border-right: 1px solid #ddd;">
                <label for="inputtanggalpeminjaman" class="form-label">Tanggal Peminjaman</label>
                <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggal_pinjam" min=<?= $date; ?> value="<?= $search_input['tanggal_pinjam']; ?>">
            </div>
            <div class="col-md-3 space noborder-mobile">
                <label for="inputtanggalpengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="tanggalPengembalian" name="tanggal_kembali" min=<?= $date; ?> value="<?= $search_input['tanggal_kembali']; ?>">
            </div>
            <div class="col-md-3 d-flex align-item-stretch p-0">
                <button type="submit" class="btn btn-primary btn-block">Cari Produk</button>
            </div>
        </div>
    </form>

    <!-- List of products -->
    <section class="container pt-3" data-aos="fade-up" data-aos-duration="2000">
        <!-- Bagian title & Description -->
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 col-md-6">
                <h2 class="display-7 mb-0 pt-3 me-2 title">Produk Kami</h2>
            </div>
        </div>

        <!-- Product Card -->
        <div class="row mt-5">
            <?php foreach ($products as $product) : ?>
                <div class="col-12 col-md-4 col-lg-4 pr-2">
                    <a href="<?= base_url('/produk/detail/' . $product->slug_produk); ?>" class="component-products d-block">
                        <div class="products-thumbnail">
                            <span class="notify-badges-<?= ($product->status === 'TERSEDIA') ? 'available' : 'notavailable' ?>"><?= $product->status; ?></span>
                            <div class="products-image zoom" style="background-image: url('<?= base_url() ?>/uploaded/images/<?= $product->path_gambar_cover ?>');">
                            </div>
                        </div>
                        <div class="products-text"><?= $product->nama_produk; ?></div>
                        <div class="products-price">Mulai dari <?= $product->harga_terendah; ?>/hari</div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <?= $pager->makeLinks($current_page, 6, $total, 'user_pagination') ?>

    </section>

</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    AOS.init();
    $(document).ready(function() {
        date();
    });
</script>
<?= $this->endSection(); ?>
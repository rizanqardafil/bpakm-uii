<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Section Bagian Galeri -->
<section class="section2">
    <section class="container pt-5" data-aos="fade-up" data-aos-duration="2000">
        <!-- breadcrumbs section -->
        <section class="detail-breadcrumbs" data-aos="fade-up" data-aos-duration="2000">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('/galeri'); ?>">Galeri</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Galeri Foto
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bagian title & Description -->
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 col-md-6">
                <h2 class="display-5 mb-0 pt-3 me-2 title">Galeri Foto</h2>
            </div>
        </div>

        <!-- Bagian Card Galeri-->
        <div class="row p-4" data-aos="zoom-in-up" data-aos-duration="2000">
            <?php foreach ($images as $image) : ?>
                <div class="col-sm-4 d-flex align-items-stretch">
                    <div class="card-galeri" style="margin-top: 60px">
                        <a id="modal-btn" data-id="<?= $image->slug_album; ?>">
                            <div class="component-galeri">
                                <div class="galeri-thumbnail">
                                    <div class="products-galeri" style="background-image: url(<?= base_url() ?>/uploaded/images/<?= $image->path_cover ?>);">
                                    </div>
                                </div>
                                <div class="card-bodygaleri">
                                    <h5 class="card-titlegaleri"><?= $image->nama_album ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?= $pager->makeLinks($current_page, $per_page, $total_image, 'user_pagination') ?>

    </section>

    <?php foreach ($images as $image) : ?>
        <div id="my-modal-<?= $image->slug_album; ?>" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><?= $image->nama_album ?></h2>
                    <span class="close" id="close-<?= $image->slug_album; ?>">&times;</span>
                </div>
                <div class="modal-body">
                    <?php if (isset($image->path_gambar_album)) : ?>
                        <?php foreach ($image->path_gambar_album as $i => $img) : ?>
                            <div class="col-md-4 col-lg-4">
                                <div class="list-foto">
                                <a class="a-<?= $image->slug_album; ?>" href="<?= base_url(); ?>/uploaded/images/<?= $img; ?>" title="<?= $image->nama_gambar_album[$i]; ?>">
                                    <img src="<?= base_url(); ?>/uploaded/images/<?= $img; ?>" alt="Detail gambar">
                                </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- <div class="list-foto">
                        <a href="../images/artikel1.jpg">
                            <img src="../images/artikel1.jpg" alt="">
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- <div id="my-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><?= $image->nama_album ?></h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="list-foto">
                    <a href="../images/artikel1.jpg" title="foto 1">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg" title="foto 1">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg" title="foto 1">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
                <div class="list-foto">
                    <a href="../images/artikel1.jpg">
                        <img src="../images/artikel1.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div> -->

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
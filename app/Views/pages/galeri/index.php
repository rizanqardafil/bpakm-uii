<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Section Bagian Galeri -->
<section class="section2">
    <section class="container pt-5" data-aos="fade-up" data-aos-duration="2000">
        <!-- Bagian title Foto & Button Lihat semua -->
        <div class="row d-flex align-items-center">
            <div class="col-xs-7 col-sm-6 col-lg-8">
                <h2 class="display-5 mb-0 title">Galeri Foto</h2>
            </div>
            <div class="col-xs-5 col-sm-6 col-lg-4">
                <div class="btnlihatsemua">
                    <a href="<?= base_url('/galeri/foto'); ?>">
                        <p class="description" style="color:#044BD9; font-weight: bold;">Lihat Semua &#8594;</p>
                    </a>
                </div>
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
    </section>

    <!-- Section Bagian Video -->
    <section class="container pt-5" data-aos="fade-up" data-aos-duration="2000">
        <!-- Bagian title Video & Description -->
        <div class="row d-flex align-items-center">
            <div class="col-xs-7 col-sm-6 col-lg-8">
                <h2 class="display-5 mb-0 pt-3 me-2 title">Galeri Video</h2>
            </div>
            <div class="col-xs-5 col-sm-6 col-lg-4">
                <div class="btnlihatsemua">
                    <a href="<?= base_url('/galeri/video'); ?>">
                        <p class="description" style="color:#044BD9; font-weight: bold;">Lihat Semua &#8594;</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bagian Card Video -->
        <div class="row p-4" style="margin-top: 60px">
            <?php foreach ($videos as $video) : ?>
                <div class="col-12 col-md-4 col-lg-4">
                    <a href="#" class="d-block">
                        <div class="video-thumbnail">
                            <div class="products-video">
                                <iframe width="300px" height="200px" src="https://www.youtube.com/embed/<?= $video->path_video; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
                            </div>
                        </div>
                    </a>
                    <div class="row-titlevideo">
                        <div class="text-titlevideo"><?= $video->nama_video; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

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

<script>
    AOS.init();
    $(document).ready(function() {
        date();
    });
</script>
<?= $this->endSection(); ?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Section Bagian Video -->
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
                                    Galeri Video
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
                <h2 class="display-5 mb-0 pt-3 me-2 title">Galeri Video</h2>
            </div>
        </div>

        <!-- <iframe width="1424" height="620" src="https://www.youtube.com/embed/cfxG01c5Aa8" title="YouTube video player" 
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen></iframe> -->

        <!-- Bagian Card Video -->
        <div class="row p-4" style="margin-top: 60px">
            <?php foreach ($videos as $video) : ?>
                <div class="col-12 col-md-4 col-lg-4 pr-2">
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
            <!-- <div class="col-12 col-md-4 col-lg-4 pr-2">
                <a href="#" class="d-block">
                    <div class="video-thumbnail">
                        <div class="products-video">
                            <iframe width="300px" height="200px" src="https://www.youtube.com/embed/cfxG01c5Aa8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
                        </div>
                    </div>
                </a>
                <div class="row-titlevideo">
                    <div class="text-titlevideo">Digital Branding Dalam Eksistensi Ekonomi Kreatif</div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 pr-2">
                <a href="#" class="d-block">
                    <div class="video-thumbnail">
                        <div class="products-video">
                            <iframe width="300px" height="200px" src="https://www.youtube.com/embed/cfxG01c5Aa8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
                        </div>
                    </div>
                </a>
                <div class="row-titlevideo">
                    <div class="text-titlevideo">Digital Branding Dalam Eksistensi Ekonomi Kreatif</div>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 pr-2">
                <a href="#" class="d-block">
                    <div class="video-thumbnail">
                        <div class="products-video">
                            <iframe width="300px" height="200px" src="https://www.youtube.com/embed/cfxG01c5Aa8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
                        </div>
                    </div>
                </a>
                <div class="row-titlevideo">
                    <div class="text-titlevideo">Digital Branding Dalam Eksistensi Ekonomi Kreatif</div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 pr-2">
                <a href="#" class="d-block">
                    <div class="video-thumbnail">
                        <div class="products-video">
                            <iframe width="300px" height="200px" src="https://www.youtube.com/embed/cfxG01c5Aa8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
                        </div>
                    </div>
                </a>
                <div class="row-titlevideo">
                    <div class="text-titlevideo">Digital Branding Dalam Eksistensi Ekonomi Kreatif</div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 pr-2">
                <a href="#" class="d-block">
                    <div class="video-thumbnail">
                        <div class="products-video">
                            <iframe width="300px" height="200px" src="https://www.youtube.com/embed/cfxG01c5Aa8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> </iframe>
                        </div>
                    </div>
                </a>
                <div class="row-titlevideo">
                    <div class="text-titlevideo">Digital Branding Dalam Eksistensi Ekonomi Kreatif</div>
                </div>
            </div> -->
        </div>

        <?= $pager->makeLinks($current_page, $per_page, $total_video, 'user_pagination') ?>

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
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Detail Product Section -->
<section class="section2">

    <!-- Section Struktur Organisasi -->
    <section class="container pt-5" data-aos="fade-up" data-aos-duration="2000">
        <div class="row">
            <!-- title-section -->
            <div class="col-lg-6 col-md-6 struktur-organisasi">
                <h2 class="display-5 mb-0 title">
                    <span>Struktur Organisasi</span>
                    BPA KM UII
                </h2>
            </div>
            <!-- image section struktur organisasi BPA KM UII -->
            <div class="previewimage" style="margin-top: 60px">
                <img src="<?= base_url(); ?>/uploaded/images/<?= $org[0]->image; ?>" alt="Struktur Organisasi BPA KM UII">
            </div>
            <!-- Description Section -->
            <div class="col-lg-12">
                <div class="description-strukturorganisasi pt-5">
                    <?= $org[0]->keterangan; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Laporan Pertanggung Jawaban -->
    <section class="container pt-5">
        <div class="row">
            <!-- title-section -->
            <div class="col-lg-8 col-md-8 struktur-organisasi">
                <h2 class="display-5 mb-0 pt-3 me-2 title">
                    <span>Laporan Pertanggung</span>
                    Jawaban BPA KM UII
                </h2>
            </div>
            <div class="col-lg-4 col-md-4 d-flex align-items-center justify-content-end">
                <a href="<?= $config[0]['link_drive_laporan']; ?>" target="_blank">
                    <p class="pt-3 description" style="color:#044BD9; font-weight: bold;">Lihat Semua Laporan &#8594;</p>
                </a>
            </div>
        </div>
        <div class="row">
            <?php foreach ($reports as $report) : ?>
                <div class="col-lg-3 col-md-3 carousel-laporan">
                    <div id="carouselExampleControls<?= $report->slug_laporan; ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <span class="notify-badges-<?= ($report->path_laporan) ? 'available' : 'notavailable'; ?>"><?= ($report->path_laporan) ? 'Tersedia' : 'Tidak Tersedia'; ?></span>
                            <?php $i = 0; ?>
                            <?php foreach ($report->gambar_path as $image) : ?>
                                <div class="carousel-item <?= ($i) ? '' : 'active'; ?>">
                                    <img src="<?= base_url(); ?>/uploaded/images/<?= $image ?>" class="d-block w-100" alt="<?= $report->nama_gambar[$i++]; ?>">
                                </div>
                            <?php endforeach; ?>
                            <?php if (!$report->gambar_path) : ?>
                                <div class="carousel-item active">
                                    <img src="<?= base_url(); ?>/uploaded/images/default.png" class="d-block w-100" alt="Gambar Default">
                                </div>
                            <?php endif; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?= $report->slug_laporan; ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?= $report->slug_laporan; ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="products-text"><?= $report->nama_laporan; ?></div>
                    <form action="<?= base_url('/investor/download'); ?>" method="post">
                        <input type="hidden" name="path_laporan" value="<?= $report->path_laporan; ?>">
                        <button class="btn btn-<?= ($report->path_laporan) ? 'primary' : 'secondary'; ?>" <?= ($report->path_laporan) ? '' : 'disabled'; ?>>Download Laporan</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    AOS.init();
</script>
<?= $this->endSection(); ?>
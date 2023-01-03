<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Section Tentang Kami -->
<section class="section2">
    <section class="container pt-5" data-aos="fade-up" data-aos-duration="2000">
        <!-- Bagian Filosofi BPA KM UII -->
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="featuretentangkami">
                    <div class="row" style="align-items: center;">
                        <div class="col-lg-6 col-md-12">
                            <div class="contentfeaturetk">
                                <div class="titletk">Filosofi Logo BPA KM UII</div>
                                <div class="textisitk"><?= $sejarah[0]['isi_logo']; ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="featuretkimage">
                                <img src="<?= base_url(); ?>/uploaded/images/<?= $sejarah[0]['path_gambar_logo']; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Visi BPA KM UII -->
            <div class="col-lg-12 col-md-6">
                <div class="featuretentangkami">
                    <div class="row" style="align-items: center;">
                        <div class="col-lg-6 col-md-12">
                            <div class="featuretkimage-visi">
                                <img src="<?= base_url(); ?>/uploaded/images/<?= $visi_misi[0]['path_gambar_visi']; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="contentfeaturetk">
                                <div class="titletk">Visi BPA KM UII</div>
                                <div class="textisitk"><?= $visi_misi[0]['isi_visi']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Misi BPA KM UII -->
            <div class="col-lg-12 col-md-6">
                <div class="featuretentangkami">
                    <div class="row" style="align-items: center;">
                        <div class="col-lg-6 col-md-12">
                            <div class="contentfeaturetk">
                                <div class="titletk">Misi BPA KM UII</div>
                                <div class="textisitk">
                                    <?= $visi_misi[0]['isi_misi']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="featuretkimage">
                                <img src="<?= base_url(); ?>/uploaded/images/<?= $visi_misi[0]['path_gambar_misi']; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Sejarah BPA KM UII -->
            <div class="col-lg-12 col-md-6 mb-5 mt-5">
                <div class="titletk">Sejarah BPA KM UII</div>
                <div class="featuretkimage">
                    <img src="<?= base_url(); ?>/uploaded/images/<?= $sejarah[0]['path_gambar_sejarah']; ?>" alt="">
                </div>
                <div class="contentfeaturetk pt-4">
                    <div class="textisitk">
                        <?= $sejarah[0]['isi_sejarah']; ?>
                    </div>
                </div>
            </div>
        </div>
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
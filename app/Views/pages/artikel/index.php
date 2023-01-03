<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Section Artikel -->
<section class="section2">
    <section class="container pt-5" data-aos="fade-up" data-aos-duration="2000">
        <!-- Bagian Terbaru / Feature -->
        <div class="row">
            <?php if ($current_page == 1) : ?>
                <div class="col-lg-12 col-md-6">
                    <div class="featureartikel">
                        <a href="<?= base_url('artikel/detail/' . $newest_article->slug_artikel); ?>">
                            <div class="row" style="align-items: center;">
                                <div class="col-lg-7 col-md-12">
                                    <div class="featureimage">
                                        <img src="<?= base_url(); ?>/uploaded/images/<?= ($newest_article->cover) ?: 'default.png'; ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12 mt-3">
                                    <div class="contentfeatureartikel">
                                        <div class="textdatefeature"><?= $newest_article->tanggal_terbit; ?></div>
                                        <div class="titleartikelfeature"><?= $newest_article->judul_artikel; ?></div>
                                        <div class="textbodyartikel">
                                            <?php $content = substr($newest_article->isi_artikel, 0, (strlen($newest_article->isi_artikel) < 300) ? strlen($newest_article->isi_artikel) : 300); ?>
                                            <?= $result = (substr($content, -1) === " ") ? trim($content) : substr($content, 0, strrpos($content, ' ')); ?>
                                            <span style="color: blue;"><?= (strlen($newest_article->isi_artikel) < 300) ? '' : '...'; ?></span>
                                        </div>
                                        <div class="d-flex author-section">
                                            <div class="d-flex flex-row align-items-center">
                                                <div class="image">
                                                    <img src="<?= base_url(); ?>/uploaded/images/<?= $newest_article->gambar_penulis; ?>" alt="Foto Penulis" class="rounded-circle">
                                                </div>
                                                <div class="ms-2 c-details">
                                                    <h6 class="mb-0"><?= $newest_article->nama_penulis; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Bagian List -->
            <?php foreach ($articles as $article) : ?>
                <div class="col-md-6 col-lg-4">
                    <div class="listartikel">
                        <a href="<?= base_url('artikel/detail/' . $article->slug_artikel); ?>">
                            <div class="listartikel-thumbnail">
                                <div class="listartikel-image" style="background-image: url(<?= base_url(); ?>/uploaded/images/<?= ($article->cover) ?: 'default.png'; ?>);"> </div>
                            </div>
                            <div class="contentlistartikel">
                                <div class="textdatefeature"><?= $article->tanggal_terbit; ?></div>
                                <div class="titlelist"><?= $article->judul_artikel; ?></div>
                                <div class="textbodylist">
                                    <?php $content = substr($article->isi_artikel, 0, (strlen($article->isi_artikel) < 150) ? strlen($article->isi_artikel) : 150); ?>
                                    <?= $result = (substr($content, -1) === " ") ? trim($content) : substr($content, 0, strrpos($content, ' ')); ?>
                                    <span style="color: blue;"><?= (strlen($article->isi_artikel) < 150) ? '' : '...'; ?></span>
                                </div>
                                <div class="d-flex author-section">
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="image">
                                            <img src="<?= base_url(); ?>/uploaded/images/<?= $article->gambar_penulis; ?>" alt="Foto Penulis" class="rounded-circle">
                                        </div>
                                        <div class="ms-2 c-details">
                                            <h6 class="mb-0"><?= $article->nama_penulis; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- Pagination page -->
        <?= $pager->makeLinks($current_page, $per_page, $total_article, 'user_pagination') ?>

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
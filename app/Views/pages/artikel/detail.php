<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Section Artikel -->
<section class="section2">
    <section class="container p-4" data-aos="fade-up" data-aos-duration="2000">
        <!-- breadcrumbs section -->
        <section class="detail-breadcrumbs" data-aos="fade-up" data-aos-duration="2000">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('/artikel'); ?>">Artikel</a>
                                </li>
                                <li class="breadcrumb-item">
                                    Detail
                                </li>
                                <li class="breadcrumb-item active">
                                    <?= $article[0]->judul_artikel; ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bagian Terbaru / Feature -->
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="featureartikel" style="margin-top: 40px;">
                    <div class="col-lg-12 col-md-12">
                        <div class="contentfeatureartikel">
                            <div class="textdatefeature"><?= $article[0]->tanggal_terbit; ?></div>
                            <div class="titleartikeldetail display-1"><?= $article[0]->judul_artikel; ?></div>
                            <div class="d-flex author-section">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="image">
                                        <img src="<?= base_url(); ?>/uploaded/images/<?= $article[0]->gambar_penulis; ?>" alt="Foto Penulis" class="rounded-circle">
                                    </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0"><?= $article[0]->nama_penulis; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="separatorsection"> ... </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="isiartikel">
                <?= $article[0]->isi_artikel; ?>
                <!-- <div class="subjudulartikel"> 1. Tidak semua elemen harus ditampilkan </div>
                <div class="textartikel"> Saat membuat design responsive, jangan terpaku pada mindset untuk menampilkan
                    semua hal yang ada pada versi desktop di versi mobile atau versi layar yang lebih kecil. Jika memang tidak
                    mungkin untuk ditampilkan, jangan dipaksakan. Fokus untuk menampilkan hal hal yang paling penting saja.
                </div>
                <div class="subjudulartikel"> 2. Tidak semua elemen harus ditampilkan </div>
                <div class="textartikel"> Saat membuat design responsive, jangan terpaku pada mindset untuk menampilkan
                    semua hal yang ada pada versi desktop di versi mobile atau versi layar yang lebih kecil. Jika memang tidak
                    mungkin untuk ditampilkan, jangan dipaksakan. Fokus untuk menampilkan hal hal yang paling penting saja.
                </div>
                <div class="subjudulartikel"> 3. Tidak semua elemen harus ditampilkan </div>
                <div class="textartikel"> Saat membuat design responsive, jangan terpaku pada mindset untuk menampilkan
                    semua hal yang ada pada versi desktop di versi mobile atau versi layar yang lebih kecil. Jika memang tidak
                    mungkin untuk ditampilkan, jangan dipaksakan. Fokus untuk menampilkan hal hal yang paling penting saja.
                </div>
                <div class="subjudulartikel"> 4. Tidak semua elemen harus ditampilkan </div>
                <div class="textartikel"> Saat membuat design responsive, jangan terpaku pada mindset untuk menampilkan
                    semua hal yang ada pada versi desktop di versi mobile atau versi layar yang lebih kecil. Jika memang tidak
                    mungkin untuk ditampilkan, jangan dipaksakan. Fokus untuk menampilkan hal hal yang paling penting saja.
                </div> -->
                <div class="linenextartikel"></div>
            </div>
            <div class="row">
                <div class="btnbackartikel">
                    <a href="<?= base_url('/artikel'); ?>">
                        <img src="<?= base_url(); ?>/images/TombolKembali.svg">
                    </a>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta Description of this web -->
    <meta name="description" content="<?= $config[0]['metatext']; ?>">
    <meta name="keywords" content="<?= $config[0]['keyword']; ?>" />
    <!-- Meta Author -->
    <meta name="author" content="GAS Development Team">
    <title><?= $titles; ?></title>
    <!-- Icon on tabbar -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/uploaded/images/<?= $config[0]['icon']; ?>">
    <!-- Poppins Font -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <!-- xzoom file -->
    <link rel="stylesheet" href="/css/xzoom/xzoom.css">
    <!-- Bootstrap file -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <!-- Custom css file -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>

    <div>

        <!-- Header Code -->
        <section class="section1">

            <?= $this->include('layout/navbar'); ?>

            <?= $this->renderSection('content_header'); ?>
        </section>

        <?= $this->renderSection('content'); ?>

        <!-- Footer Section -->
        <div class="footer-bg">
            <footer class="footer-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer-left text-left">
                                <div class="footer-logo">
                                    <a href="<?= base_url('/beranda'); ?>">
                                        <img src="<?= base_url(); ?>/uploaded/images/<?= $config[0]['logo']; ?>" alt="">
                                    </a>
                                </div>
                                <div class="footer-desc-bpa">
                                    BPA (Badan Pengelola Aset ) KM UII adalah sebuah organisasi yang telah berkembang
                                    yang
                                    awal
                                    mulanya disebut Tim Kerja Pengelola Aset SCC UII yang pertama kali dibentuk tahun
                                    2014.
                                </div>
                                <div class="footer-social">
                                    <a href="https://www.linkedin.com/company/badan-pengelola-aset-km-uii/mycompany/" target="_blank">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                    <a href="https://www.instagram.com/bpakmuii/?hl=en" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="https://www.youtube.com/channel/UClZUs0gjl1W3kqyTLQbo0Gw/featured" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 offset-lg-1">
                            <div class="footer-widget text-left">
                                <h5>Information</h5>
                                <ul>
                                    <li><a href="<?= base_url('/beranda'); ?>">Beranda</a></li>
                                    <li><a href="<?= base_url('/produk'); ?>">Produk Kami</a></li>
                                    <li><a href="<?= base_url('/investor'); ?>">Investor</a></li>
                                    <li><a href="<?= base_url('/galeri'); ?>">Galeri</a></li>
                                    <li><a href="<?= base_url('/artikel'); ?>">Artikel</a></li>
                                    <li><a href="<?= base_url('/tentang'); ?>">Tentang Kami</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $phone_number = $config[0]['telepon'];
                        $ina_id = '62';

                        if ($phone_number[0] === '0') {
                            $phone_number = ltrim($phone_number, '0');
                            $phone_number = $ina_id . $phone_number;
                        }
                        ?>
                        <div class="col-lg-4">
                            <div class="footer-widget text-left">
                                <h5>Kontak Kami</h5>
                                <ul>
                                    <li><a class="inactiveLink" href="">Jalan Ngipiksari, Hargobinangun, Kec. Pakem, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55582</a></li>
                                    <li><a class="inactiveLink" href=""><?= 'Telepon: +' . $phone_number; ?></a></li>
                                    <li><a class="inactiveLink" href="#"><?= 'Email: ' . $config[0]['email']; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-reserved">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="copyright-text">Copyright &copy; <?= date('Y'); ?> Badan Pengelola Aset KM UII |
                                    Development
                                    with <span> &#9829; </span> by <span> GAS </span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script src="/css/xzoom/xzoom.min.js"></script>
    <script type="text/javascript" src="/js/style.js"></script>

    <?= $this->renderSection('scripts'); ?>

</body>

</html>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container" data-aos="fade-down" data-aos-duration="2000">
        <a href="/beranda" class="navbar-brand">
            <img class="img-fluid" src="<?= base_url(); ?>/uploaded/images/<?= $config[0]['logo']; ?>" alt="Logo BPA KM UII" width="150">
        </a>

        <!-- Hamburger button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        $uri = service('uri');
        ?>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="<?= base_url('/beranda'); ?>" class="nav-link <?= ($uri->getSegment(1) == 'beranda') ? 'active' : '' ?> ">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/produk'); ?>" class="nav-link <?= ($uri->getSegment(1) == 'produk') ? 'active' : '' ?> ">Produk Kami</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/investor'); ?>" class="nav-link <?= ($uri->getSegment(1) == 'investor') ? 'active' : '' ?> ">Investor</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/galeri'); ?>" class="nav-link <?= ($uri->getSegment(1) == 'galeri') ? 'active' : '' ?> ">Galeri</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/artikel'); ?>" class="nav-link <?= ($uri->getSegment(1) == 'artikel') ? 'active' : '' ?> ">Artikel</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/tentang'); ?>" class="nav-link <?= ($uri->getSegment(1) == 'tentang') ? 'active' : '' ?> ">Tentang Kami</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
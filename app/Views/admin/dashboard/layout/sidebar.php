<nav class="navbar-default navbar-side" role="navigation">
    <?php
    $uri = service('uri');
    ?>
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li><a class="<?= ($uri->getSegment(2) == 'dashboard') ? 'active' : '' ?> " href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a class="<?= ($uri->getSegment(2) == 'users') ? 'active' : '' ?> " href="<?php echo base_url('admin/users') ?>"><i class="fa fa-users"></i> Data User</a></li>
            <li><a href="#"><i class="fa fa-wrench"></i>Pengaturan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="<?= ($uri->getSegment(2) == 'config') ? 'active' : '' ?> " href="<?php echo base_url('admin/config') ?>">Pengaturan Umum</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'logo-config') ? 'active' : '' ?> " href="<?php echo base_url('admin/logo-config') ?>">Logo</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'icon-config') ? 'active' : '' ?> " href="<?php echo base_url('admin/icon-config') ?>">Ikon</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-cubes"></i>Produk Kami<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="<?= ($uri->getSegment(2) == 'produk') ? 'active' : '' ?> " href="<?php echo base_url('admin/produk') ?>">Produk</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'gambar') ? 'active' : '' ?> " href="<?php echo base_url('admin/gambar') ?>">Gambar Produk</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'paket') ? 'active' : '' ?> " href="<?php echo base_url('admin/paket') ?>">Paket</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'pesanan') ? 'active' : '' ?> " href="<?php echo base_url('admin/pesanan') ?>">Pesanan</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-money"></i>Investor<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="<?= ($uri->getSegment(2) == 'organisasi') ? 'active' : '' ?> " href="<?php echo base_url('admin/organisasi') ?>">Organisasi</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'laporan') ? 'active' : '' ?> " href="<?php echo base_url('admin/laporan') ?>">Laporan</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'gambar_laporan') ? 'active' : '' ?> " href="<?php echo base_url('admin/gambar_laporan') ?>">Gambar Laporan</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-user"></i>Tentang Kami<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="<?= ($uri->getSegment(2) == 'tentang-kami') ? 'active' : '' ?> " href="<?php echo base_url('admin/tentang-kami') ?>">Visi-Misi</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'sejarah') ? 'active' : '' ?> " href="<?php echo base_url('admin/sejarah') ?>">Sejarah</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-image"></i> Galeri<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="<?= ($uri->getSegment(2) == 'foto') ? 'active' : '' ?> " href="<?php echo base_url('admin/foto') ?>">Foto</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'album') ? 'active' : '' ?> " href="<?php echo base_url('admin/album') ?>">Album</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'video') ? 'active' : '' ?> " href="<?php echo base_url('admin/video') ?>">Video</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-book"></i> Artikel<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="<?= ($uri->getSegment(2) == 'artikel') ? 'active' : '' ?> " href="<?php echo base_url('admin/artikel') ?>">Artikel</a></li>
                    <li><a class="<?= ($uri->getSegment(2) == 'penulis') ? 'active' : '' ?> " href="<?php echo base_url('admin/penulis') ?>">Penulis</a></li>
                </ul>
            </li>
            <li><a class="<?= ($uri->getSegment(2) == 'kegiatan-kami') ? 'active' : '' ?> " href="<?php echo base_url('admin/kegiatan-kami') ?>"><i class="fa fa-clipboard"></i> Kegiatan Kami</a></li>
            <!-- <li><a href=""><i class="fa fa-plus-square"></i> Kegiatan</a></li>
            <li><a href=""><i class="fa fa-calendar"></i> Jadwal</a></li> -->
            <!-- <li><a href=""><i class="fa fa-users"></i> Struktur Organisasi</a></li>
            <li><a href=""><i class="fa fa-film"></i> Slider</a></li>
            <li><a href=""><i class="fa fa-envelope-o"></i> Kontak</a></li> -->
            <li><a class="<?= ($uri->getSegment(2) == 'logout') ? 'active' : '' ?> " href="<?= base_url('admin/logout'); ?>" onClick="return confirm('Apakah anda yakin?')" ><i class="fa fa-close"></i> Keluar</a></li>

        </ul>
    </div>

</nav>
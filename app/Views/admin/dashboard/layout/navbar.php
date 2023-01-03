<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('admin/dashboard') ?>"><b>ADMINISTRATOR</b> | Badan Pengelola Aset KM UII</a>
    </div>
    <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $tgl_sekarang = date('d F Y');
        echo $tgl_sekarang;

        ?>
        &nbsp;
        <a href="<?php echo base_url('admin/users') ?>" class="btn btn-warning square-btn-adjust"><i class="fa fa-user"></i> <?php echo session()->get('username') ?></a>
        <a href="<?php echo base_url('admin/logout') ?>" class="btn btn-warning square-btn-adjust" onClick="return confirm('Apakah anda yakin?')"><i class="fa fa-sign-out"></i> Keluar</a>
        <a href="<?php echo base_url('/beranda') ?>" class="btn btn-warning square-btn-adjust" target="_blank"><i class="fa fa-home"></i> Beranda</a>
    </div>
</nav>
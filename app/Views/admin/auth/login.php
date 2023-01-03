<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title; ?></title>

    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/uploaded/images/<?= $config[0]['icon']; ?>">
    <!-- BOOTSTRAP STYLES-->
    <link href="<?= base_url(); ?>/admin/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="<?= base_url(); ?>/admin/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <!-- CUSTOM STYLES-->
    <link href="<?= base_url(); ?>/admin/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="<?= base_url(); ?>/admin/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br>
                <h2><img src="<?= base_url(); ?>/admin/images/bpa.png" width="250px"></h2>
                <br>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">
                        <strong>Login Administrator</strong>
                    </div>
                    <div class="panel-body">
                        <?php if (session()->getFlashdata('message')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('message'); ?>
                            </div>
                        <?php endif; ?>
                        <form role="form" action="<?= base_url('/admin/auth'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Username " value="<?= old('username'); ?>" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" value="<?= old('password'); ?>" />
                            </div>

                            <input type="submit" name="submit" value="Login Now" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?= base_url(); ?>/admin/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?= base_url(); ?>/admin/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?= base_url(); ?>/admin/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="<?= base_url(); ?>/admin/js/custom.js"></script>

</body>

</html>
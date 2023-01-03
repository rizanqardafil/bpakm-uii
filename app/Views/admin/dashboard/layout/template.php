<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator | BPA KM UII</title>
    <!-- BOOTSTRAP STYLES-->
    <!-- Icon on tabbar -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/uploaded/images/<?= $config[0]['icon']; ?>">
    <link href="<?= base_url(); ?>/admin/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="<?= base_url(); ?>/admin/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <!-- CUSTOM STYLES-->
    <link href="<?= base_url(); ?>/admin/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <!-- <link href="<?= base_url(); ?>/admin/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/datatables.min.css" />

</head>

<body>
    <div id="wrapper">
        <!-- /. NAV TOP  -->
        <?= $this->include('/admin/dashboard/layout/navbar'); ?>

        <!-- /. SIDE BAR  -->
        <?= $this->include('/admin/dashboard/layout/sidebar'); ?>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?= $this->renderSection('content'); ?>
                    </div>
                </div>
                <!-- /. ROW  -->
            </div>

        </div>
        <!-- /. PAGE INNER  -->
    </div>

    <!-- /. PAGE WRAPPER  -->
    <!-- /. WRAPPER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script type="text/javascript">
        function previewImage() {
            const sampul = document.querySelector('#file');
            const imgPreview = document.querySelector('.img-preview');

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        function previewImage2() {
            const sampul = document.querySelector('#file2');
            const imgPreview = document.querySelector('.img-preview2');

            const fileSampul2 = new FileReader();
            fileSampul2.readAsDataURL(sampul.files[0]);

            fileSampul2.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        function previewDocs() {
            const sampul = document.querySelector('#file');
            const sampulLabel = document.querySelector('.document-label');
            const imgPreview = document.querySelector('.img-preview');

            sampulLabel.textContent = sampul.files[0].name;

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?= base_url(); ?>/admin/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?= base_url(); ?>/admin/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/datatables.min.js"></script>
    <!-- <script src="<?= base_url(); ?>/admin/js/dataTables/jquery.dataTables.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/admin/js/dataTables/dataTables.bootstrap.js"></script> -->
    <!-- CKEDITOR -->
    <script src="<?= base_url(); ?>/admin/ckeditor/ckeditor/ckeditor.js"></script>
    <!-- style JS -->
    <script src="<?= base_url(); ?>/admin/js/style.js"></script>

    <?= $this->renderSection('scripts'); ?>

    <!-- CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });

        CKEDITOR.replace('detail_produk');
        CKEDITOR.replace('isi_artikel');
        CKEDITOR.replace('isi_visi');
        CKEDITOR.replace('isi_misi');
        CKEDITOR.replace('isi_sejarah');
        CKEDITOR.replace('isi_logo');
    </script>


</body>

</html>
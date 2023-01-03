<?= $this->extend('admin/dashboard/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2><?= $title; ?></h2>
    </div>
    <div class="panel-body">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>

        <a href="<?php echo base_url('/admin/produk/tambah') ?>" class="btn btn-primary spacing"><i class="fa fa-plus"></i> Tambah Produk</a>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="150px">Cover Produk</th>
                    <th width="150px">Nama Produk</th>
                    <th>Detail Produk</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach ($products as $product) : ?>
                    <tr class="odd gradeX">
                        <td>
                            <?= $index++; ?>
                        </td>
                        <td>
                            <!-- Isi dengan Cover Produk -->
                            <img class="img-thumbnail" src="<?= base_url(); ?>/uploaded/images/<?= $product->path_gambar_cover; ?>" width="150px">
                        </td>
                        <td>
                            <!-- Isi dengan Nama Produk -->
                            <?= $product->nama_produk; ?>
                        </td>
                        <td>
                            <!-- Isi dengan Detail Produk -->
                            <?php $content = substr($product->detail_produk, 0, (strlen($product->detail_produk) < 150) ? strlen($product->detail_produk) : 150); ?>
                            <?= $result = (substr($content, -1) === " ") ? trim($content) : substr($content, 0, (strrpos($content, ' ') ?: strlen($content))); ?>
                            <span style="color: blue;"><?= (strlen($product->detail_produk) < 150) ? '' : '...'; ?></span>
                        </td>
                        <td class="center">
                            <a href="<?php echo base_url('/admin/produk/edit/' . $product->slug_produk); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <form action="<?= base_url('/admin/produk/delete/' . $product->id_produk); ?>" method="post" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onClick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<?= $this->endSection(); ?>
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

        <a href="<?php echo base_url('/admin/foto/tambah') ?>" class="btn btn-primary spacing"><i class="fa fa-plus"></i> Tambah Foto </a>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th>Nama Foto</th>
                    <th>Kategori Album</th>
                    <th width="150px">Foto</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach ($images as $image) : ?>
                    <tr class="odd gradeX">
                        <td>
                            <?= $index++; ?>
                        </td>
                        <td>
                            <?= $image->nama_foto; ?>
                        </td>
                        <td>
                            <?= $image->nama_album; ?>
                        </td>
                        <td>
                            <img class="img-thumbnail" src="<?= base_url(); ?>/uploaded/images/<?= $image->path_foto ?>" width="150px">
                        </td>
                        <td class="center">
                            <a href="<?php echo base_url('/admin/foto/edit/' . $image->slug_galeri_foto); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <form action="<?= base_url('/admin/foto/delete/' . $image->id_galeri_foto); ?>" method="post" style="display: inline-block;">
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
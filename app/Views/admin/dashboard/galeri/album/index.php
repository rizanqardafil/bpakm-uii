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

        <a href="<?php echo base_url('/admin/album/tambah') ?>" class="btn btn-primary spacing"><i class="fa fa-plus"></i> Tambah Album </a>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th>Nama Album</th>
                    <th width="150px">Cover Album</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach ($albums as $album) : ?>
                    <tr class="odd gradeX">
                        <td>
                            <?= $index++; ?>
                        </td>
                        <td>
                            <?= $album['nama_album']; ?>
                        </td>
                        <td>
                        <img class="img-thumbnail" src="<?= base_url(); ?>/uploaded/images/<?= $album['path_cover']; ?>" width="150px">
                        </td>
                        <td class="center">
                            <a href="<?php echo base_url('/admin/album/edit/' . $album['slug_album']); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <form action="<?= base_url('/admin/album/delete/' . $album['id_album']); ?>" method="post" style="display: inline-block;">
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
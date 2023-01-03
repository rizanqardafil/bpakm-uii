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

        <a href="<?php echo base_url('/admin/artikel/tambah') ?>" class="btn btn-primary spacing"><i class="fa fa-plus"></i> Tambah Artikel </a>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th width="120px">Nama Penulis</th>
                    <th width="120px">Judul Artikel</th>
                    <th>Isi Artikel</th>
                    <th width="150px">Cover Artikel</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach ($articles as $article) : ?>
                    <tr class="odd gradeX">
                        <td>
                            <?= $index++; ?>
                        </td>
                        <td>
                            <?= $article->nama_penulis; ?>
                        </td>
                        <td>
                            <?= $article->judul_artikel; ?>
                        </td>
                        <td>
                            <?php $content = substr($article->isi_artikel, 0, (strlen($article->isi_artikel) < 300) ? strlen($article->isi_artikel) : 300); ?>
                            <?= $result = (substr($content, -1) === " ") ? trim($content) : substr($content, 0, strrpos($content, ' ')); ?>
                            <span style="color: blue;"><?= (strlen($article->isi_artikel) < 300) ? '' : '...'; ?></span>
                        </td>
                        <td>
                            <img class="img-thumbnail" src="<?= base_url(); ?>/uploaded/images/<?= $article->cover; ?>" width="150px">
                        </td>
                        <td class="center">
                            <a href="<?php echo base_url('/admin/artikel/edit/' . $article->slug_artikel); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <form action="<?= base_url('/admin/artikel/delete/' . $article->id_artikel); ?>" method="post" style="display: inline-block;">
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
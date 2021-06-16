<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('menu/edit/') . $menu_edit['id']; ?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="menu_edit" name=" menu_edit" value="<?php echo $menu_edit['menu']; ?>">
                </div>
                <a href="<?= base_url('menu') ?>" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Edit</button>
            </form>


        </div>
    </div>




    <!-- /.container-fluid -->
    <!-- End of Main Content -->
    <!-- Button trigger modal -->


    <!-- Modal -->




    <!-- Modal -->

</div>
</div>
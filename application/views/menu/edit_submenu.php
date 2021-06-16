<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('menu/editSubMenu/') . $edit_sub_menu['id']; ?>" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $edit_sub_menu['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="menu_id">Menu</label>
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option value="<?php echo $edit_sub_menu['menu_id']; ?>"><?php echo $edit_sub_menu['menu']; ?></option>
                        <option value="">Select Menu</option>
                        <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="url">Url</label>

                    <input type="text" class="form-control" id="url" name="url" value="<?php echo $edit_sub_menu['url']; ?>">
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>

                    <input type="text" class="form-control" id="icon" name="icon" value="<?php echo $edit_sub_menu['icon']; ?>">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                    <label class="form-check-label" for="is_active">
                        Active
                    </label>
                </div>

                <a href="<?= base_url('menu/submenu'); ?>" class="btn btn-secondary">Back</a>
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
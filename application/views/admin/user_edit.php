<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('name', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('role_id', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('admin/edit_user/') . $user_ingfo['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="title">Nisn</label>
                    <input type="text" class="form-control" readonly name="nisn" id="nisn" value="<?php echo $user_ingfo['nisn']; ?>">
                </div>
                <div class="form-group">
                    <label for="url">Nama</label>

                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user_ingfo['name']; ?>">

                </div>

                <div class="form-group">
                    <label for="menu_id">Role</label>
                    <select name="role_id" id="role_id" class="form-control">

                        <option value="<?= $user_ingfo['role_id'] ?>"><?= $user_ingfo['role']; ?></option>
                        <?php foreach ($role as $r) : ?>
                            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>


                        <?php endforeach; ?>
                    </select>

                </div>


                <div class="form-group">
                    <label for="icon">Email</label>

                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $user_ingfo['email']; ?>">
                </div>


                <a href="<?= base_url('admin/user_list'); ?>" class="btn btn-secondary">Back</a>
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
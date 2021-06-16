<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('name', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('role_id', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('admin/edit_pay/') . $pay_info['id']; ?>" method="POST">
              
                <div class="form-group">
                    <label for="url">Nama</label>

                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pay_info['nama']; ?>">

                </div>
                  <div class="form-group">
                    <label for="url">Besar Iuran</label>

                    <input type="text" class="form-control" id="besar_iuran" name="besar_iuran" value="<?php echo $pay_info['besar_iuran']; ?>">

                </div>
                  <div class="form-group">
                    <label for="url">Tenggat</label>

                    <input type="date" class="form-control" id="tenggat" name="tenggat" value="<?php echo $pay_info['tenggat']; ?>">

                </div>

               


                <a href="<?= base_url('admin/user_list') ; ?>" class="btn btn-secondary">Back</a>
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
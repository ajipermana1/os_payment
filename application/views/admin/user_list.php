<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addNewUserModal">Add New User</a>


    <?= form_error('name', '<div class="alert alert-danger text-center">', '</div>'); ?>


    <?= $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0;
                        foreach ($user_list as $ul) : $i++; ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $ul['name']; ?></td>
                                <td><?= $ul['email']; ?></td>
                                <td><?= $ul['role']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/user_detail/') . $ul['id']; ?> " class="btn btn-info btn-circle">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="<?= base_url('admin/edit_user/') . $ul['id']; ?>" class="btn btn-success btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/delete_user/') . $ul['id']; ?>" onclick="return confirm('Yakin?')" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>






    <!-- /.container-fluid -->
    <!-- End of Main Content -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewUserModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/user_list'); ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">Select Role</option>
                                <?php foreach ($role as $r) :   ?>
                                    <option value="<?= base64_encode($r['id']); ?>"><?= $r['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('role_id', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">

                            </div>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked="">
                            <label class="form-check-label" for="is_active">
                                Active Status
                            </label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDataExcelModal">Add Data Excel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Excel Modal -->
    <div class="modal fade" id="addDataExcelModal" tabindex="-1" aria-labelledby="addDataExcelModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataExcelModal">Add Data Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('admin/importExcel'); ?>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="excel" name="excel">
                        <label class="custom-file-label" for="file">Choose file</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">

                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td><?= $info_user['name']; ?></td>

                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?= $info_user['email']; ?></td>

                            </tr>
                            <tr>
                                <th scope="row">Role</th>

                                <td><?= $info_user['role']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Join Sejak</th>

                                <td> <?= date('d m Y', $info_user['date_created']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
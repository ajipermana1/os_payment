<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Detail User</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th scope="row">Nama</th>
                    <td><?= $detail_user['name']; ?></td>

                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?= $detail_user['email']; ?></td>

                </tr>
                <tr>
                    <th scope="row">Role</th>

                    <td><?= $detail_user['role']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Join Sejak</th>

                    <td> <?= date('d m Y', $detail_user['date_created']); ?></td>
                </tr>
                <tr>
                    <th scope="row"> <a href="<?= base_url('admin/user_list'); ?>" class="btn btn-secondary">Back</a></th>


                </tr>
            </tbody>
        </table>
    </div>
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail User</h6>
             <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPembayaranModal">Tambah Pembayaran</a>
        </div>
    <div class="card-body">
     <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tenggat</th>
                            <th class="text-center">Besar Iuran</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($kartu as $k) :
                            $i++; ?>

                            <tr>
                                <td class="text-center"><?= $i; ?></td>
                                <td class="text-center"><?= $k['nama']; ?></td>
                                <td class="text-center"><?= $k['tenggat']; ?></td>
                                <td class="text-center"><?= "Rp " . number_format($k['besar_iuran'], 0, ',', '.');  ?></td>
                                <td class="text-center"><?php if( $k['status'] == 'Lunas'): ?> <span class="btn btn-success">Lunas</span><?php elseif($k['status'] == 'Belum') : ?><span class="btn btn-primary">Belum</span><?php else:?><span class="btn btn-danger">Nunggak</span> <?php endif; ?></td>
                                <td class="text-center">
                                
                                <a href="<?= base_url('admin/edit_pay/') . $k['id']; ?>" class="btn btn-success btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/delete_pay/') . $k['id']; ?>" onclick="return confirm('Yakin?')" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    
                                </td>

                            </tr>
                        <?php endforeach; ?>



                    </tbody>
                </table>
            </div>
            </div>




    <!-- /.container-fluid -->
    <!-- End of Main Content -->
    <!-- Button trigger modal -->


    <!-- Modal -->




    <!-- Modal -->

</div>
</div>
<div class="modal fade" id="addPembayaranModal" tabindex="-1" aria-labelledby="addPembayaranModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPembayaranModal">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/user_detail/') . $user_id; ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Pembayaran" value="<?= set_value('nama'); ?>">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" id="bsr_iuran" name="bsr_iuran" placeholder="Besar Iuran" value="<?= set_value('bsr_iuran'); ?>">
                            <?= form_error('bsr_iuran', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                       
                        <div class="form-group">
                         
                                <input type="date" class="form-control form-control-user" id="tenggat" name="tenggat" placeholder="Tenggat">
                                <?= form_error('tenggat', '<small class="text-danger pl-3">', '</small>'); ?>
                          
                           
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
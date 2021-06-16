<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Info Keramaian TU</h6> <a href="" data-toggle="modal" data-target="#updateInfoModal" class=" btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="text">Update Info</span>
            </a>
        </div>
        <div class="card-body">
            <div class="col-lg-5 mb-4">
                <?php if ($info[0]['butup'] == 'BUKA') : ?>
                    <div class="card bg-success text-white shadow">
                    <?php else : ?>
                        <div class="card bg-danger text-white shadow">
                        <?php endif; ?>
                        <div class="card-body">
                            <?= $info[0]['butup']; ?>
                            <div class="text-white-50 small"><?= $info[0]['keramaian']; ?></div>
                        </div>
                        </div>
                    </div>
                    <h4 class="small font-weight-bold"><?= $info[0]['status']; ?> <?php if ($info[0]['status'] == 'NORMAL') : ?><span class="float-right">50%</span>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><?php else : ?><span class="float-right">100%</span>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><?php endif; ?>
                    </h4>


            </div>
        </div>




    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<div class="modal fade" id="updateInfoModal" tabindex="-1" aria-labelledby="updateInfoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateInfoModal">Update Info TU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin'); ?>" method="POST">
                    <div class="form-group">
                        <select name="info_buka" id="info_buka" class="form-control">
                            <option value="<?php echo $info[0]['butup']; ?>"><?php echo $info[0]['butup']; ?></option>
                            <option value="BUKA">BUKA</option>
                            <option value="TUTUP">TUTUP</option>

                        </select>

                        <?= form_error('role_id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <textarea name="keterangan" id="keterangan" class="form-control" aria-label="With textarea" placeholder="Keterangan"><?php echo $info[0]['keramaian']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <select name="info_keramaian" id="info_keramaian" class="form-control">
                            <option value="<?php echo $info[0]['status']; ?>"><?php echo $info[0]['status']; ?></option>
                            <option value="NORMAL">NORMAL</option>
                            <option value="PENUH">PENUH</option>

                        </select>

                        <?= form_error('role_id', '<small class="text-danger pl-3">', '</small>'); ?>
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
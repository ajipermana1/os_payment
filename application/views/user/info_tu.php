<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Info Keramaian TU</h6>

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
                            </div>
                        <?php endif; ?>
                    </h4>

            </div>
        </div>




    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
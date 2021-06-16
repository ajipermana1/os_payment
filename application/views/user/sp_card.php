<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h2 mb-4 text-gray-800"><?= $title; ?></h1>
    <h3 class="h4 mb-4 text-gray-800">Kartu SPP</h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kartu SPP</h6>
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
                                <td class="text-center"><a href="<?= base_url('user/pay/') . $k['id']; ?>" class="btn btn-outline-success btn-sm">Bayar</a>
                                   
                                </td>

                            </tr>
                        <?php endforeach; ?>



                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
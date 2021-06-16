<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('name', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('role_id', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>


            <form id="payment-form" method="post" action="<?= base_url() ?>/snap/finish/<?= $id_spp;?>">
                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">



                <div class="form-group">
                    <label for="title">Nama</label>
                    <input type="text" class="form-control" readonly name="name" id="name" value="<?php echo $detail_pay['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="url">Kelas</label>

                    <input type="text" class="form-control" readonly id="kelas" name="kelas" value="<?php echo $detail_pay['kelas']; ?>">

                </div>
                <div class="form-group">
                    <label for="url">Nisn</label>

                    <input type="text" class="form-control" readonly id="nisn" name="nisn" value="<?php echo $detail_pay['nisn']; ?>">

                </div>
                <div class="form-group">
                    <label for="url">Pembayaran</label>

                    <input type="text" class="form-control" readonly id="nama" name="nama" value="<?php echo $detail_pay['nama']; ?>">

                </div>
                <div class="form-group">
                    <label for="url">Besar Iuran</label>

                    <input type="text" class="form-control" readonly id="bsr_iuran" name="bsr_iuran" value="<?= $detail_pay['besar_iuran'];  ?>">

                </div>
                <div class="form-group">
                    <label for="icon">Email</label>

                    <input type="text" class="form-control" readonly id="email" name="email" value="<?php echo $detail_pay['email']; ?>">
                </div>


                <a href="<?= base_url('user/sp_card'); ?>" class="btn btn-secondary">Back</a>
                <button id="pay-button" class="btn btn-success">Bayar!</button>
            </form>


        </div>
        <script type="text/javascript">
            $('#pay-button').click(function(event) {
                event.preventDefault();
                $(this).attr("disabled", "disabled");

                var name = $("#name").val();
                var kelas = $("#kelas").val();
                var nisn = $("#nisn").val();
                var nama = $("#nama").val();
                var bsr_iuran = $("#bsr_iuran").val();
                var email = $("#email").val();

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>snap/token',
                    cache: true,
                    data: {
                        name: name,
                        kelas: kelas,
                        nisn: nisn,
                        nama: nama,
                        bsr_iuran: bsr_iuran,
                        email: email

                    },

                    success: function(data) {
                        //location = data;

                        console.log('token = ' + data);

                        var resultType = document.getElementById('result-type');
                        var resultData = document.getElementById('result-data');

                        function changeResult(type, data) {
                            $("#result-type").val(type);
                            $("#result-data").val(JSON.stringify(data));
                            //resultType.innerHTML = type;
                            //resultData.innerHTML = JSON.stringify(data);
                        }

                        snap.pay(data, {

                            onSuccess: function(result) {
                                changeResult('success', result);
                                console.log(result.status_message);
                                console.log(result);
                                $("#payment-form").submit();
                            },
                            onPending: function(result) {
                                changeResult('pending', result);
                                console.log(result.status_message);
                                $("#payment-form").submit();
                            },
                            onError: function(result) {
                                changeResult('error', result);
                                console.log(result.status_message);
                                $("#payment-form").submit();
                            }
                        });
                    }
                });
            });
        </script>
    </div>




    <!-- /.container-fluid -->
    <!-- End of Main Content -->
    <!-- Button trigger modal -->


    <!-- Modal -->




    <!-- Modal -->

</div>
</div>
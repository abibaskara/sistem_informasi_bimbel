
<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Riwayat Pembayaran SPP</h4>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Bulan</th>
                                        <th>Jumlah Yang Dibayarkan</th>
                                        <th>Sisa Bayar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach ($pembayaran as $val) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td> <?= $val->nama_user ?> </td>
                                            <td> <?= $val->kelas ?> </td>
                                            <td> <?= $val->bulan ?> </td>
                                            <td> <?= $val->grandtotal ?> </td>
                                            <td> <?= $val->sisa_bayar ?> </td>
                                            <td>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_show<?= $val->id_pembayaran ?>"><i class="fa fa-plus-circle"></i> Detail</a>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_edit<?= $val->id_pembayaran ?>"><i class="fa fa-plus-circle"></i> Edit</a>
                                                <a class="waves-effect waves-dark btn modal-trigger mb-2 mr-1" href="#modal_delete<?= $val->id_pembayaran ?>"><i class="fa fa-plus-circle"></i> Delete</a>
                                            </td>
                                            
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RIGHT SIDEBAR NAV -->
</div>


<script src="<?= base_url() ?>app-assets/js/vendors.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/formatter/jquery.formatter.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/dropify/js/dropify.min.js"></script>
<script>
    
$(function() {
});
</script>
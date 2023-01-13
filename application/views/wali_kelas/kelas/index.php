
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
                    <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_add"><i class="fa fa-plus-circle"></i> Bayar SPP</a>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach ($kelas as $val) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td> <?= $val->kelas ?> </td>
                                            <td>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_show<?= $val->id_kelas ?>"><i class="fa fa-plus-circle"></i> Detail</a>
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

<?php foreach ($kelas as $val) { 
    
    $detail = $this->db->select('*')
        ->from('detail_kelas')
        ->join('matpel', 'detail_kelas.id_matpel=matpel.id_matpel')
        ->where('id_kelas', $val->id_kelas)->get()->result();
?>
<div id="modal_show<?= $val->id_kelas ?>" class="modal">
    <div class="modal-content">
        <h4>Detail Kelas - <?= $val->kelas ?></h4>
            <div class="row">
                <table class="bordered mt-2" style="text-align: center; width: 100%;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; border-collapse: collapse;">No</th>
                            <th style="border: 1px solid black; border-collapse: collapse;">Nama Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($detail as $d) {
                        ?>
                            <tr>
                                <td style="border: 1px solid black; border-collapse: collapse;"><?= $no++; ?></td>
                                <td style="border: 1px solid black; border-collapse: collapse;"><?= $d->matpel ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
            </div>
        </div>
</div>
<?php } ?>


<script src="<?= base_url() ?>app-assets/js/vendors.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/formatter/jquery.formatter.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/dropify/js/dropify.min.js"></script>
<script>
    
$(function() {
});
</script>
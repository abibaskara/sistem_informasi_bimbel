
<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Prestasi</h4>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama</th>
                                        <th>Rata Rata</th>
                                        <th>Peringkat Ke</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    $rank = 1;
                                    foreach ($siswa as $val) { 
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td> <?= $val->nik ?> </td>
                                            <td> <?= $val->username ?> </td>
                                            <td> <?= round($val->jumlah) ?> </td>
                                            <td> Peringkat Ke - <?= $rank++ ?> </td>
                                            <td>
                                                <a class="waves-effect waves-light btn mb-2 mr-1" href="<?= base_url("wali_kelas/print_prestasi/$val->id_user") ?>"><i class="fa fa-plus-circle"></i> Print</a>
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

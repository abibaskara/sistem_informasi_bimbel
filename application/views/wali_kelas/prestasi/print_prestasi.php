
<style>
    .no-border {
        border:none;
    }
    .test, th, td {
        border: none;
        border-collapse: none;
    }
</style>
<div class="container">
    <!-- app invoice View Page -->
    <section class="invoice-view-wrapper section">
        <div class="row">
            <!-- invoice view page -->
            <div class="col xl9 m8 s12">
                <div class="card">
                    <div class="card-content invoice-print-area">
                        <div style="text-align:center">
                            <h6><strong>Laporan Nilai</strong></h6>
                            <h6>Bimba Smart Kidz Taman Kutabumi 1 Tangerang</h6>
                            <h6>Tahun Ajaran 2023/2024</h6>
                        </div>
                        <hr>
                        <div class="divider mb-3 mt-3"></div>
                        <!-- invoice address and contact -->
                        <div class="row invoice-info">
                            <div class="col m6 s12">
                                <!-- <h6 class="invoice-from">Invoice From</h6> -->
                                <div class="col m6 s12">
                                    <div class="invoice-address">
                                        <span>Nama Siswa</span>
                                    </div>
                                    <div class="invoice-address">
                                        <span>Kelas</span>
                                    </div>
                                </div>
                                <div class="col m6 s12">
                                    <div class="invoice-address">
                                        <span>: <?= $user->username ?></span>
                                    </div>
                                    <div class="invoice-address">
                                        <span>: <?= $user->kelas ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
                                <div class="col m6 s12">
                                    <div class="invoice-address">
                                        <span>Semester</span>
                                    </div>
                                    <div class="invoice-address">
                                        <span>Tahun Pelajaran</span>
                                    </div>
                                </div>
                                <div class="col m6 s12">
                                    <div class="invoice-address">
                                        <span>: 1 Ganjil</span>
                                    </div>
                                    <div class="invoice-address">
                                        <span>: 2023/2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider mb-3 mt-3"></div>
                        <!-- product details table-->
                        <div class="invoice-product-details">
                            <table class="striped responsive-table">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">No</th>
                                        <th style="text-align:center">Nama Siswa</th>
                                        <th style="text-align:center">Mata Pelajaran</th>
                                        <th style="text-align:center">Absensi</th>
                                        <th style="text-align:center">Tugas</th>
                                        <th style="text-align:center">UTS</th>
                                        <th style="text-align:center">UAS</th>
                                        <th style="text-align:center">Hasil Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach($nilai as $row) { ?> 
                                        <tr>
                                            <td style="text-align:center">
                                                <?= $no++ ?>
                                            </td>
                                            <td style="text-align:center">
                                                <?= $row->username ?>
                                            </td>
                                            <td style="text-align:center">
                                                <?= $row->matpel ?>
                                            </td>
                                            <td style="text-align:center">
                                                <?= $row->absensi ?>
                                            </td>
                                            <td style="text-align:center">
                                                <?= $row->tugas ?>
                                            </td>
                                            <td style="text-align:center">
                                                <?= $row->uts ?>
                                            </td>
                                            <td style="text-align:center">
                                                <?= $row->uas ?>
                                            </td>
                                            <td style="text-align:center">
                                                <?= $row->hasil ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col m8 s12"></div>
                                <div class="col m4 s12">
                                    <div style="float:right" class="mt-2">
                                    <h6>Tanggerang, <?= date('d-m-Y') ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="test">
                                    <tr>
                                        <td style="text-align:center">Mengetahui,</td>
                                        <td style="text-align:center">Wali Kelas</td>
                                        <td style="text-align:center">Kepala Bimba</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center">Orang Tua/Wali</td>
                                        <td style="text-align:center"></td>
                                        <td style="text-align:center"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center"></td>
                                        <td style="text-align:center"></td>
                                        <td style="text-align:center"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center"></td>
                                        <td style="text-align:center"></td>
                                        <td style="text-align:center"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center">(.......................)</td>
                                        <td style="text-align:center">(.......................)</td>
                                        <td style="text-align:center">(.......................)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- invoice subtotal -->
                        <div class="divider mt-3 mb-3"></div>
                        <div class="invoice-subtotal">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- invoice action  -->
            <div class="col xl3 m4 s12">
                <div class="card invoice-action-wrapper">
                    <div class="card-content">
                        <div class="invoice-action-btn">
                            <a href="#" class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
                                <span>Print</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?= base_url() ?>app-assets/js/vendors.min.js"></script>
<!-- <script src="<?= base_url() ?>app-assets/js/scripts/app-invoice.js"></script> -->
<script>
    
$(function() {
    if ($(".invoice-print").length > 0) {
        $(".invoice-print").on("click", function () {
        window.print();
        })
        $(".test").css({ 'border-collapse' : ''});
    };
})
</script>
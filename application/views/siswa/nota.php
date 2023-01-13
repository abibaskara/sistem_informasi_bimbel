
<?php $mount = new NumberFormatter("IND", NumberFormatter::SPELLOUT); ?>
<div class="container">
    <!-- app invoice View Page -->
    <section class="invoice-view-wrapper section">
        <div class="row">
            <!-- invoice view page -->
            <div class="col xl9 m8 s12">
                <div class="card">
                    <div class="card-content invoice-print-area">
                        <!-- header section -->
                        <div class="row invoice-date-number">
                            <div class="col xl4 s12">
                                <span class="invoice-number mr-1">Invoice#</span>
                                <span>000<?= $id ?></span>
                            </div>
                            <div class="col xl8 s12">
                            </div>
                        </div>
                        <!-- logo and title -->
                        <!-- <div class="row mt-3 invoice-logo-title">
                            <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                                <img src="<?= base_url() ?>app-assets/images/gallery/pixinvent-logo.png" alt="logo" height="46" width="164">
                            </div>
                            <div class="col m6 s12 pull-m6">
                                <h4 class="indigo-text">Invoice</h4>
                                <span>Software Development</span>
                            </div>
                        </div> -->
                        <div class="divider mb-3 mt-3"></div>
                        <!-- invoice address and contact -->
                        <div class="row invoice-info">
                            <div class="col m6 s12">
                                <h6 class="invoice-from">Invoice From</h6>
                                <div class="invoice-address">
                                    <span>Bimba Smart Kidz Taman Kutabumi 1 Tangerang</span>
                                </div>
                                <div class="invoice-address">
                                    <span>Tangerang, Indonesia, Banten</span>
                                </div>
                                <div class="invoice-address">
                                    <span>marketingbimbelsmart@gmail.com</span>
                                </div>
                                <div class="invoice-address">
                                    <span>0878-2868-4308</span>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
                                <h6 class="invoice-to">Bill To</h6>
                                <div class="invoice-address">
                                    <span><?= $user->username ?></span>
                                </div>
                                <div class="invoice-address">
                                    <span><?= $user->kelas ?></span>
                                </div>
                                <div class="invoice-address">
                                    <span><?= $user->nik ?></span>
                                </div>
                                <div class="invoice-address">
                                    <span><?= $user->phone ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="divider mb-3 mt-3"></div>
                        <!-- product details table-->
                        <div class="invoice-product-details">
                            <table class="striped responsive-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Grand Total</th>
                                        <th>Sisa Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    $total = 0;
                                    foreach($pembayaran as $val) { ?> 
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>Rp. <?= number_format($val->grandtotal) . ' (' . ucfirst($mount->format($val->grandtotal)) . ' rupiah)'; ?></td>
                                            <td><?= number_format($val->sisa_bayar) . ' (' . ucfirst($mount->format($val->sisa_bayar)) . ' rupiah)'; ?></td>
                                            <td><?= $val->status ?></td>
                                        </tr>
                                    <?php $total += $val->sisa_bayar;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- invoice subtotal -->
                        <div class="divider mt-3 mb-3"></div>
                        <div class="invoice-subtotal">
                            <div class="row">
                                <div class="col m5 s12">
                                    <p>Thanks for your business.</p>
                                </div>
                                <div class="col xl4 m7 s12 offset-xl3">
                                    <ul>
                                        <li class="display-flex justify-content-between">
                                            <span class="invoice-subtotal-title">Total Sisa Bayar</span>
                                            <h6 class="invoice-subtotal-value">Rp. <?= number_format($total); ?></h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
    };
})
</script>
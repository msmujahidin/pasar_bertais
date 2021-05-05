<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_theme_uri('images/bg_1.jpg'); ?>');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span> <span></span>
                </p>
                <h1 class="mb-0 bread">Terimakasih Telah Melakukan Pemesanan</h1>
                <h2 class="mb-0 bread">Kami Akan Segera Memproses Pesanan Anda</h2>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-Keranjang Belanja">
    <div class="container">
        <center>
            <a class="btn btn-primary" href="<?php echo base_url(''); ?>" role="button">Pesan Kembali</a>
        </center>
    </div>
</section>
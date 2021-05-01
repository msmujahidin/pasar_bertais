<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
input[type="number"] {
    -webkit-appearance: textfield;
    -moz-appearance: textfield;
    appearance: textfield;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
}

.number-input {
    border: 2px solid #ddd;
    display: inline-flex;
}

.number-input,
.number-input * {
    box-sizing: border-box;
}

.number-input button {
    outline: none;
    -webkit-appearance: none;
    background-color: transparent;
    border: none;
    align-items: center;
    justify-content: center;
    width: 2.2rem;
    height: 1.8rem;
    cursor: pointer;
    margin: 0;
    position: relative;
}

.number-input button:after {
    display: inline-block;
    position: absolute;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: '\f077';
    transform: translate(-50%, -50%) rotate(180deg);
    ;
}

.number-input button.plus:after {
    transform: translate(-50%, -50%) rotate(0deg);
}

.number-input input[type=number] {
    font-family: sans-serif;
    max-width: 3rem;
    padding: .5rem;
    border: solid #ddd;
    border-width: 0 2px;
    font-size: 1.1rem;
    height: 1.8rem;
    text-align: center;
}
</style>
<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(<?php echo get_theme_uri('images/'.$foto1); ?>);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2">Kami Menjual Hanya Sayuran dan Buah Terbaik</h1>
                        <h2 class="subheading mb-4">Sayur dan Buah Segar Langsung dari Kebun</h2>
                        <p><a href="#products" class="btn btn-primary">Belanja Sekarang</a></p>
                    </div>

                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image: url(<?php echo get_theme_uri('images/'.$foto2); ?>);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-sm-12 ftco-animate text-center">
                        <h1 class="mb-2">100% Sayur dan Buah Segar</h1>
                        <h2 class="subheading mb-4">Sayur dan Buah Segar Langsung dari Kebun</h2>
                        <p><a href="#products" class="btn btn-primary">Belanja Sekarang</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section" id="products">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Gratis Ongkir</h3>
                        <span>Belanja minimal Rp
                            <?php echo format_rupiah(get_settings('min_shop_to_free_shipping_cost')); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-diet"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Selalu Segar</h3>
                        <span>Dipetik Langsung dari Kebun</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Kualitas Terbaik</h3>
                        <span>Kualitas dari Pertanian Terbaik</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Bantuan</h3>
                        <span>Bantuan 24/7 Selalu Online</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Produk Terbaru</span>
                <h2 class="mb-4"><?php echo get_store_name(); ?></h2>
                <p><?php echo get_settings('store_tagline'); ?></p>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="float-right">
                        <span>Kategori</span>
                        <select name="" id="" class="select-kategori">
                            <option value="1">Buah</option>
                            <option value="1">Sayur</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Buah dan Sayur</h5>
                        <?php foreach ($products as $product) : ?>
                        <div class="row my-4">
                            <div class="col-12 col-md-6">
                                <div class="float-left mr-2">
                                    <img width="100" class="img-fluid" src="<?php echo base_url('assets/uploads/products/'. $product->picture_name); ?>" alt="<?php echo $product->name; ?>" srcset="">
                                </div>
                                <div class="my-1">
                                    <div>
                                        <strong><?php echo $product->name; ?></strong>
                                    </div>
                                    <div>
                                        <span class="mr-2"><span class="price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 my-auto">
                                <div class="float-right">
                                    <div class="number-input">
                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                            class="minus"></button>
                                        <input class="quantity" min="0" name="quantity" value="0" type="number">
                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                            class="plus"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="text-center">
                            <button class="btn btn-sm btn-primary">Tampilkan Lebih Banyak</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <center>
            <a class="btn btn-primary" href="<?php echo site_url('shop/cart'); ?>" role="button">Pesan Sekarang</a>
            <!-- <button type="button" class="btn btn-success" href="#" > Success</button> -->
        </center>
    </div>
</section>

<section class="ftco-section img" style="background-image: url(<?php echo get_theme_uri('images/bg_3.jpg'); ?>);">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate  ">
                <span class="subheading">Produk dengan Harga Terbaik</span>
                <h2 class="mb-4">Deal of the day</h2>
                <p><?php echo $best_deal->description; ?></p>
                <h3><a href="#"><?php echo $best_deal->name; ?></a></h3>
                <span class="price">Rp <?php echo format_rupiah($best_deal->price); ?> <a href="#">sekarang hanya Rp
                        <?php echo format_rupiah($best_deal->price - $best_deal->current_discount); ?></a></span>
                <div id="timer" class="d-flex mt-5">
                    <div class="time pl-3">
                        <a href="#" class="btn btn-primary add-cart" data-sku="<?php echo $best_deal->sku; ?>"
                            data-name="<?php echo $best_deal->name; ?>"
                            data-price="<?php echo ($best_deal->current_discount > 0) ? ($best_deal->price - $best_deal->current_discount) : $best_deal->price; ?>"
                            data-id="<?php echo $best_deal->id; ?>"><i class="ion-ios-cart"></i></a>
                    </div>
                    <div class="time pl-3">
                        <a class="btn btn-info"
                            href="<?php echo site_url('shop/product/'. $best_deal->id .'/'. $best_deal->sku .'/'); ?>"
                            class="buy-now d-flex justify-content-center align-items-center text-center">
                            <span><i class="ion-ios-menu text-white"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
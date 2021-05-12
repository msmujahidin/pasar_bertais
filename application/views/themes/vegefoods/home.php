<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?> | <?php echo get_store_name(); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="icon" href="<?php echo base_url('assets/uploads/sites/Logo.png'); ?>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo get_theme_uri('css/open-iconic-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/animate.css'); ?>">

    <link rel="stylesheet" href="<?php echo get_theme_uri('css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/magnific-popup.css'); ?>">

    <link rel="stylesheet" href="<?php echo get_theme_uri('css/aos.css'); ?>">

    <link rel="stylesheet" href="<?php echo get_theme_uri('css/ionicons.min.css'); ?>">
    <link rel="stylesheet"
        href="<?php echo get_theme_uri('js/plugins/@fortawesome/fontawesome-free/css/all.min.css', 'argon'); ?>">

    <link rel="stylesheet" href="<?php echo get_theme_uri('css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/jquery.timepicker.css'); ?>">

    <link rel="stylesheet" href="<?php echo get_theme_uri('css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/icomoon.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/style.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css'); ?>">

    <script src="<?php echo get_theme_uri('js/jquery.min.js'); ?>"></script>
    <script src="<?php echo get_theme_uri('js/jquery-migrate-3.0.1.min.js'); ?>"></script>
    <style>

    </style>
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
</head>

<body class="goto-here">
    <div id="app">
        <div class="py-1 bg-primary d-none d-md-block">
            <div class="container">
                <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                    <div class="col-lg-12 d-block">
                        <div class="row d-flex">
                            <div class="col-md pr-4 d-flex topper align-items-center">
                                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                        class="icon-phone2"></span></div>
                                <span class="text"><?php echo get_settings('store_phone_number'); ?></span>
                            </div>
                            <div class="col-md pr-4 d-flex topper align-items-center">
                                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                        class="icon-paper-plane"></span></div>
                                <span class="text"><?php echo get_settings('store_email'); ?></span>
                            </div>
                            <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                                <span class="text"><?php echo get_settings('store_tagline'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand d-none d-md-block"
                    href="<?php echo base_url(); ?>"><?php echo get_store_name(); ?></a>
                <div class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                        v-model="search_input" v-on:input="searchProducts()">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="button"
                        @click="searchProducts()">Search</button>
                </div>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Akun</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown05">
                                <?php if ( is_login() && is_customer()) : ?>
                                <a class="dropdown-item" href="<?php echo site_url('customer'); ?>">Akun saya</a>
                                <a class="dropdown-item" href="<?php echo site_url('customer/orders'); ?>">Order</a>
                                <div class="divider"></div>
                                <a class="dropdown-item" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
                                <?php else : ?>
                                <a class="dropdown-item" href="<?php echo site_url('auth/login'); ?>">Masuk Log</a>
                                <a class="dropdown-item" href="<?php echo site_url('auth/register'); ?>">Daftar</a>
                                <?php endif; ?>
                            </div>

                        </li>
                        <li class="nav-item cta cta-colored">
                            <a href="<?php echo site_url('shop/cart'); ?>" class="nav-link">
                                <span class="icon-shopping_cart"></span>
                                [<span class="cart-item-total">0</span>]</a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
        <!-- END nav -->
        <section id="home-section" class="hero">
            <div class="home-slider owl-carousel">
                <div class="slider-item" style="background-image: url(<?php echo get_theme_uri('images/'.$foto1); ?>);">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text justify-content-center align-items-center"
                            data-scrollax-parent="true">

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
                        <div class="row slider-text justify-content-center align-items-center"
                            data-scrollax-parent="true">

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
            <div class="px-0">
                <div class="row mb-5" v-if="!s_container">
                    <div class="col-md-12 mb-2" v-for="category in product_category">
                        <div class="bg-light">&nbsp;</div>
                        <div class="container pr-3 py-4">
                            <div class="">
                                <h5 class="card-title mx-3 mb-4 mt-2"><strong>{{category.name}}</strong></h5>
                                <template v-for="(product, index) in all_products[category.id]">
                                    <div class="row my-4">
                                        <div class="col-12 col-md-6">
                                            <div class="float-left mr-2">
                                                <img width="100" class="img-fluid"
                                                    v-bind:src="img_url+product.picture_name" v-bind:alt="product.name"
                                                    srcset="">
                                            </div>
                                            <div class="my-1">
                                                <div>
                                                    <strong>{{product.name }}</strong>
                                                </div>
                                                <div>
                                                    <span class="mr-2"><span class="price-sale">Rp
                                                            {{formatNumber(product.price)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 my-auto">
                                            <div class="float-right">
                                                <div class="number-input">
                                                    <button v-on:click="orderDecrement(index, product.category_id)"
                                                        class="minus"></button>
                                                    <input class="quantity" min="0" name="quantity"
                                                        v-model="product.jumlah_order" type="number">
                                                    <button v-on:click="orderIncrement(index, product.category_id)"
                                                        class="plus"></button>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="float-right">
                                                    <button class="btn btn-primary"
                                                        v-on:click="addCart(index, product.category_id)">
                                                        <i class="ion-ios-cart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <div class="text-center" v-if="more[category.id]">
                                    <button class="btn btn-sm btn-outline-success rounded-3" style="font-size: 0.8em;"
                                        v-on:click="fetchProducts(category.id)">Tampilkan
                                        Lebih
                                        Banyak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light">&nbsp;</div>

                </div>
                <div class="row mb-5" v-if="s_container">
                    <div class="bg-light">&nbsp;</div>
                    <div class="container pr-3 py-4">

                        <h4>Hasil Pencarian: {{hasil_pencarian}}</h4>
                        <template v-for="(product, index) in filterProducts">
                            <div class="row my-4">
                                <div class="col-12 col-md-6">
                                    <div class="float-left mr-2">
                                        <img width="100" class="img-fluid" v-bind:src="img_url+product.picture_name"
                                            v-bind:alt="product.name" srcset="">
                                    </div>
                                    <div class="my-1">
                                        <div>
                                            <strong>{{product.name }}</strong>
                                        </div>
                                        <div>
                                            <span class="mr-2"><span class="price-sale">Rp
                                                    {{formatNumber(product.price)}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 my-auto">
                                    <div class="float-right">
                                        <div class="number-input">
                                            <button v-on:click="orderDecrement(index, product.category_id)"
                                                class="minus"></button>
                                            <input class="quantity" min="0" name="quantity"
                                                v-model="product.jumlah_order" type="number">
                                            <button v-on:click="orderIncrement(index, product.category_id)"
                                                class="plus"></button>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="float-right">
                                            <button class="btn btn-primary"
                                                v-on:click="addCart(index, product.category_id)">
                                                <i class="ion-ios-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <center>
                    <a class="btn btn-primary" style="font-size: 1em;" href="<?php echo site_url('shop/cart'); ?>"
                        role="button">Pesan
                        Sekarang</a>
                </center>
            </div>
        </section>
    </div>
    <script src="https://unpkg.com/vue@3.0.5"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous"></script>
    <script>
    const app = Vue.createApp({
        data() {
            return {
                search_input: "",
                hasil_pencarian: "",
                s_container: false,
                img_url: '<?php echo base_url('assets/uploads/products/'); ?>',
                api_url: '<?= site_url('home/api'); ?>',
                products: JSON.parse('<?= json_encode($products) ?>'),
                limit: "<?= $limit ?>",
                all_products: JSON.parse('<?= json_encode($all_products) ?>'),
                product_category: JSON.parse('<?= json_encode($product_category) ?>'),
                filterProducts: [],
                category: JSON.parse('<?= json_encode($category) ?>'),
                total_products: JSON.parse('<?= json_encode($total_products) ?>'),
                more: [],
            }
        },
        mounted() {
            this.$nextTick(function() {
                if (this.products.length > 0) {
                    let more = [];
                    for (let i = 0; i < this.product_category.length; i++) {
                        more[this.product_category[i].id] = true;
                    }
                    this.more = more;
                    const category_id = this.products[0].category_id;
                    this.checkTotalProducts(category_id);
                    this.products = this.all_products[category_id];
                    console.log(this.more);
                }
            })
        },
        methods: {
            searchProducts: function() {
                const search = this.hasil_pencarian = this.search_input;
                if (search != "") {
                    this.s_container = true;
                } else {
                    this.s_container = false;
                }
                axios.post("<?= site_url('home/search'); ?>", {
                        search,
                    })
                    .then((response) => {
                        this.filterProducts = response.data;
                    }, (error) => {
                        console.log(error);
                    });

            },
            fetchProducts: function(category_id) {
                const limit = this.limit;
                const start = this.all_products[category_id].length;
                axios.post("<?= site_url('home/api'); ?>", {
                        category_id,
                        limit,
                        start
                    })
                    .then((response) => {
                        this.all_products[category_id] = this.all_products[category_id].concat(
                            response
                            .data);
                        this.checkTotalProducts(category_id);
                    }, (error) => {
                        console.log(error);
                    });
            },
            checkTotalProducts: function(category_id) {
                if (this.all_products[category_id].length == this.total_products[category_id]) {
                    this.more[category_id] = false;
                } else {
                    this.more[category_id] = true;
                }
            },
            onCategoryChange: function() {
                const category_id = this.category.id;
                this.products = this.all_products[category_id];
                this.checkTotalProducts(category_id);
            },
            formatNumber(number) {
                return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            },
            orderIncrement: function(index, category_id) {
                if (this.s_container) {
                    this.products = this.filterProducts;
                } else {
                    this.products = this.all_products[category_id];
                }
                this.products[index].jumlah_order++;
            },
            orderDecrement: function(index, category_id) {
                if (this.s_container) {
                    this.products = this.filterProducts;
                } else {
                    this.products = this.all_products[category_id];
                }
                if (this.products[index].jumlah_order > 0) {
                    this.products[index].jumlah_order--;
                }
            },
            addCart: function(index, category_id) {
                if (this.s_container) {
                    this.products = this.filterProducts;
                } else {
                    this.products = this.all_products[category_id];
                }
                const product = this.products[index];
                let qty = product.jumlah_order;
                if (qty == 0) {
                    qty = 1;
                }
                axios.post("<?= site_url('home/cart_api'); ?>", {
                        id: product.id,
                        sku: product.sku,
                        qty,
                        price: product.price,
                        picture_name: product.picture_name,
                        name: product.name,
                        action: 'add_item'
                    })
                    .then((response) => {
                        console.log(response);
                        if (response.status == 200) {
                            const totalItem = response.data.total_item;

                            $('.cart-item-total').text(totalItem);

                            toastr.info('Item ditambahkan dalam keranjang');
                        } else {
                            console.log('Terjadi kesalahan');
                        }
                    }, (error) => {
                        console.log(error);
                    });
            }
        }
    })
    app.mount('#app')
    </script>
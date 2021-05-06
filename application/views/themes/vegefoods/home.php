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
    <div id="app" class="container px-0">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="float-right">
                            <span>KATEGORI: </span>
                            <select class="select-kategori" v-model="category" @change="onCategoryChange()">
                                <option v-for="category in product_category"
                                    v-bind:value="{ id: category.id, name: category.name }">{{category.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mx-3 mb-4 mt-2">{{category.name}}</h5>
                        <template v-for="(product, index) in products">
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
                                            <button v-on:click="orderDecrement(index)" class="minus"></button>
                                            <input class="quantity" min="0" name="quantity"
                                                v-model="product.jumlah_order" type="number">
                                            <button v-on:click="orderIncrement(index)" class="plus"></button>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="float-right">
                                            <button class="btn btn-primary" v-on:click="addCart(index)">
                                                <i class="ion-ios-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div class="text-center" v-if="more">
                            <button class="btn btn-sm btn-primary" v-on:click="fetchProducts()">Tampilkan Lebih
                                Banyak</button>
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
<script src="https://unpkg.com/vue@3.0.5"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
    integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
    crossorigin="anonymous"></script>
<script>
const app = Vue.createApp({
    data() {
        return {
            img_url: '<?php echo base_url('assets/uploads/products/'); ?>',
            api_url: '<?= site_url('home/api'); ?>',
            products: JSON.parse('<?= json_encode($products) ?>'),
            limit: "<?= $limit ?>",
            all_products: JSON.parse('<?= json_encode($all_products) ?>'),
            product_category: JSON.parse('<?= json_encode($product_category) ?>'),
            category: JSON.parse('<?= json_encode($category) ?>'),
            total_products: JSON.parse('<?= json_encode($total_products) ?>'),
            more: true,
        }
    },
    mounted() {
        this.$nextTick(function() {
            if (this.products.length > 0) {
                const category_id = this.products[0].category_id;
                this.checkTotalProducts(category_id);
                this.products = this.all_products[category_id];
            }
        })
    },
    methods: {
        fetchProducts: function() {
            const limit = this.limit;
            const start = this.products.length;
            const category_id = this.category.id;
            axios.post("<?= site_url('home/api'); ?>", {
                    category_id,
                    limit,
                    start
                })
                .then((response) => {
                    this.products = this.products.concat(response.data);
                    this.all_products[category_id] = this.products;
                    this.checkTotalProducts(category_id);
                }, (error) => {
                    console.log(error);
                });
        },
        checkTotalProducts: function(category_id) {
            if (this.products.length == this.total_products[category_id]) {
                this.more = false;
            } else {
                this.more = true;
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
        orderIncrement: function(index) {
            this.products[index].jumlah_order++;
        },
        orderDecrement: function(index) {
            if (this.products[index].jumlah_order > 0) {
                this.products[index].jumlah_order--;
            }
        },
        addCart: function(index) {
            // const category_id = this.products[index].category_id;
            const product = this.products[index];
            let qty = product.jumlah_order;
            if(qty == 0){
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
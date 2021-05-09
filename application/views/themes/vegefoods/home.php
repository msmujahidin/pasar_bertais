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
            <div class="col-md-12 mb-5" v-for="category in product_category" >
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mx-3 mb-4 mt-2">{{category.name}}</h5>
                        <template v-for="(product, index) in all_products[category.id]">
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
                                            <button v-on:click="orderDecrement(index, product.category_id)" class="minus"></button>
                                            <input class="quantity" min="0" name="quantity"
                                                v-model="product.jumlah_order" type="number">
                                            <button v-on:click="orderIncrement(index, product.category_id)" class="plus"></button>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="float-right">
                                            <button class="btn btn-primary" v-on:click="addCart(index, product.category_id)">
                                                <i class="ion-ios-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div class="text-center" v-if="more[category.id]">
                            <button class="btn btn-sm btn-primary" v-on:click="fetchProducts(category.id)">Tampilkan Lebih
                                Banyak</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <center>
            <a class="btn btn-primary" href="<?php echo site_url('shop/cart'); ?>" role="button">Pesan Sekarang</a>
        </center>
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
            more: [],
        }
    },
    mounted() {
        this.$nextTick(function() {
            if (this.products.length > 0) {
                let more = [];
                for(let i=0; i< this.product_category.length; i++){
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
        fetchProducts: function(category_id) {
            const limit = this.limit;
            const start = this.all_products[category_id].length;
            axios.post("<?= site_url('home/api'); ?>", {
                    category_id,
                    limit,
                    start
                })
                .then((response) => {
                    this.all_products[category_id] = this.all_products[category_id].concat(response.data);
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
            this.products = this.all_products[category_id];
            this.products[index].jumlah_order++;
        },
        orderDecrement: function(index, category_id) {
            this.products = this.all_products[category_id];
            if (this.products[index].jumlah_order > 0) {
                this.products[index].jumlah_order--;
            }
        },
        addCart: function(index, category_id) {
            this.products = this.all_products[category_id];
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
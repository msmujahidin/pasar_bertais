<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Order #<?php echo $data->order_number; ?></h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin/orders'); ?>">Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#<?php echo $data->order_number; ?></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">

      <div class="row">
        <div class="col-md-12">
          <div class="card-wrapper">
            
            <div class="card card-primary" id="pesanan">
                    <div class="card-header">
                        <h3 class="mb-0">Pilih Produk</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Produk</th>
                                <th scope="col">Harga</th>
                                <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($products as $item) : ?>
                            <tr id="item-id-<?= $item->id ?>">
                            <form action="<?php echo site_url('admin/orders/insert_order_item/'.$order_id); ?>" method="post">
                                <td class="text-center">
                                    <img class="img img-fluid rounded" style="width: 100px; height: 100px;" alt="<?php echo $item->name; ?>" 
                                    src="<?php echo base_url('assets/uploads/products/'. $item->picture_name); ?>">
                                    <h5 class="mb-0"><?php echo $item->name; ?></h5>
                                    <input type="hidden" name="product_id" value="<?= $item->id ?>">
                                    <input type="hidden" name="order_price" value="<?= $item->price ?>">
                                </td>
                                <td>Rp <?php echo format_rupiah($item->price); ?></td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i></button>
                              </td>
                              </form>
                            </tr>
                            
                          <?php endforeach; ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            
          </div>

        </div>
      </div>
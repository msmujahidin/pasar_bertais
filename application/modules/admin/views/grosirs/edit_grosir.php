<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Edit Harga Grosir</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin/products'); ?>">Produk</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <?php echo form_open_multipart('admin/grosir/edit_grosir'); ?>
      <input type="hidden" name="id" value="<?php echo $grosir->id; ?>">
      <input type="hidden" name="product_id" value="<?php echo $grosir->product_id; ?>">

      <div class="row">
        <div class="col-md-8">
          <div class="card-wrapper">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0">Harga Grosir</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                  
                    <div class="form-group">
                      <label class="form-control-label" for="jumlah_minimal">Jumlah Minimal:</label>
                      <input type="text" name="jumlah_minimal" value="<?php echo set_value('jumlah_minimal', $grosir->jumlah_minimal); ?>" class="form-control" id="jumlah_minimal">
                      <?php echo form_error('jumlah_minimal'); ?>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label" for="harga_satuan">Harga Satuan:</label>
                      <input type="text" name="harga_satuan" value="<?php echo set_value('harga_satuan', $grosir->harga_satuan); ?>" class="form-control" id="harga_satuan">
                      <?php echo form_error('harga_satuan'); ?>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label" for="harga_coret">Harga Coret:</label>
                      <input type="text" name="harga_coret" value="<?php echo set_value('harga_coret', $grosir->harga_coret); ?>" class="form-control" id="harga_coret">
                      <?php echo form_error('harga_coret'); ?>
                    </div>
                    <div class="card-footer text-right">
                      <input type="submit" value="Simpan" class="btn btn-primary">
                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

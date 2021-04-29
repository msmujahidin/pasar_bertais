<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Edit Gambar</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i
                                        class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin/gambar'); ?>">Gambar</a>
                            </li>
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

    <div class="row">
        <?php foreach($gambar as $image) : ?>
        
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <?php echo form_open_multipart('admin/gambar/edit_gambar'); ?>
            <input type="hidden" name="id" value="<?php echo $image->id; ?>">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            <h3 class="mb-0">Foto</h3>
                        </div>
                        <?php if ($image->foto) : ?>
                        <div class="col-8">
                            <ul class="nav nav-pills mb-3 float-right" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link p-1 active" id="pills-current-tab" data-toggle="pill"
                                        href="#pills-current<?php echo $image->id; ?>" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Current</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-1" id="pills-edit-tab" data-toggle="pill" href="#pills-edit<?php echo $image->id; ?>"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">Ganti</a>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($image->foto != NULL) : ?>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-current<?php echo $image->id; ?>" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="text-center">
                                <img alt="foto"
                                    src="<?php echo base_url('assets/themes/vegefoods/images/'. $image->foto); ?>"
                                    class="img img-fluid rounded">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-edit<?php echo $image->id; ?>" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="form-group">
                                <label class="form-control-label" for="pic">Foto:</label>
                                <input type="file" name="picture" class="form-control" id="pic">
                                <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                                <small class="newUploadText">Unggah file baru untuk mengganti foto saat ini.</small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-delete" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <p class="deleteText">Klik link dibawah untuk menghapus foto. Tindakan ini tidak dapat
                                dibatalkan.</p>
                            <div class="text-right">
                                <a href="#" class="deletePictureBtn btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <?php else : ?>
                    <div class="form-group">
                        <label class="form-control-label" for="pic">Foto:</label>
                        <input type="file" name="picture" class="form-control" id="pic">
                        <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-right">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </div>
            </form>
        </div>
        <?php endforeach; ?>
    </div>

    <script>
    // $('.deletePictureBtn').click(function(e) {
    //     e.preventDefault();

    //     $(this).html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

    //     $.ajax({
    //         method: 'POST',
    //         url: '<?php echo site_url('admin/products/product_api?action=delete_image'); ?>',
    //         data: {
    //             id: <?php echo $image->id; ?>
    //         },
    //         context: this,
    //         success: function(res) {
    //             if (res.code == 204) {
    //                 $('.deleteText').text(
    //                     'Gambar berhasil dihapus. Produk ini akan menggunakan gambar default jika tidak ada gambar baru yang diunggah'
    //                     );
    //                 $(this).html('<i class="fa fa-check"></i> Terhapus!');

    //                 setTimeout(function() {
    //                     $('.newUploadText').text(
    //                         'Pilih gambar baru untuk mengganti gambar yang dihapus');
    //                     $('#pills-delete, #pills-delete-tab, #pills-current, #pills-current-tab')
    //                         .hide('fade');
    //                     $('#pills-edit').tab('show');
    //                     $('#pills-edit-tab').addClass('active').text('Upload baru');
    //                 }, 3000);
    //             } else {
    //                 console.log('Terdapat kesalahan');
    //             }
    //         }
    //     })
    // });
    </script>
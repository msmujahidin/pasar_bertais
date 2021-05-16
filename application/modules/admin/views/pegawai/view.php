<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0"><?php echo $pegawai->name; ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><?php echo anchor('admin/pegawai', 'Pelanggan'); ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $pegawai->name; ?></li>
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
        <div class="col-md-6">
            <div class="card-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Data Pegawai</h3>
                        <?php if ($flash) : ?>
                        <span class="float-right text-success font-weight-bold"
                            style="margin-top: -30px;"><?php echo $flash; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-0">
                        <table class="table align-items-center table-flush table-hover">
                            <tr>
                                <td>Nama</td>
                                <td><b><?php echo $pegawai->name; ?></b></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><b><?php echo $pegawai->email; ?></b></td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td><b><?php echo $pegawai->phone_number; ?></b></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>
                                    <div style="white-space: initial;"><b><?php echo $pegawai->address; ?></b></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Terdaftar pada</td>
                                <td><b><?php echo get_formatted_date($pegawai->register_date); ?></b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="#" data-id="<?php echo $pegawai->id; ?>" class="btn btn-danger btn-sm btnDelete"><i
                                class="fa fa-trash"></i></a>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Hapus Pelanggan?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="#" id="deleteCustomer" method="POST">

                    <input type="hidden" name="id" value="" class="deleteID">

                    <div class="modal-body">
                        <p class="deleteText">Yakin ingin pelanggan ini? Semua data seperti data profil, order dan
                            pembayaran juga akan dihapus.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $(document).on('click', '.btnDelete', function() {
            var id = $(this).data('id');

            $('.deleteID').val(id);
            $('#deleteModal').modal('show');
        });

        $('#deleteCustomer').submit(function(e) {
            e.preventDefault();

            var id = $('.deleteID').val();
            var btn = $('.btn-delete');

            btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

            $.ajax({
                method: 'POST',
                url: '<?php echo site_url('admin/pegawai/api/delete'); ?>',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.code == 204) {
                        btn.html('<i class="fa fa-check"></i> Terhapus!');

                        setTimeout(() => {
                            $('.deleteText').html('Data berhasil dihapus');
                        }, 1000);
                        setTimeout(() => {
                            $('.deleteText').html(
                                '<i class="fa fa-spin fa-spinner"></i> Mengalihkan...'
                                );
                        }, 2500);
                        setTimeout(() => {
                            window.location =
                                '<?php echo site_url('admin/pegawai'); ?>';
                        }, 4000);
                    }
                }
            })
        });
    });
    </script>
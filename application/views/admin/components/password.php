<style>
    /* melengkungkan pinggiran modal*/
    .modal-content{
        border-radius: 1em !important;
    }
     /* melengkungkan pinggiran modal*/
    .modal-header{
        border-radius: 1em 1em 0 0;
    }
    /* memindahkan button submit di modal menjadi ke sebelah kanan ujung*/
    .modal-footer{
        flex: 1;
        display: flex;
        gap: 0;
        justify-content: flex-end;
    }
    /* memindahkan button tambah barang di modal menjadi ke sebelah kanan ujung*/
    .rights{
        flex: 1;
        display: flex;
        gap: 1em;
        justify-content: flex-end;
        padding-right: 1em;
    }
     /* pengaturan modal hapus */
     .changemdl{
        width: 30%;
    }
    .changemdl .modal-footer{
        padding-right: 1em;
    }
</style>
<?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Ditambahkan!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Gagal ubah passsword!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('edit')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Password berhasil diubah",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_edit')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Diedit!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('hapus')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Dihapus!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_hapus')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Dihapus !",
                icon: "error"
            });
        </script>
    <?php } ?>  
<!-- Modal -->
<div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog changemdl">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Change Password</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="<?=base_url();?>Akun/change_password" method="POST">
            <input type="hidden" name="idakun" id="idakun" hidden>
                <div class="form-group">
                    <label for="nama">Password Lama</label>
                    <input type="password" class="form-control" id="passwordlama" aria-describedby="passwordlama"
                        name="passwordlama" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="NRP">Password Baru</label>
                    <input type="password" class="form-control" id="passwordbaru" aria-describedby="passwordbaru"
                        name="passwordbaru" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="NRP">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="konfirpassword" aria-describedby="konfirpassword"
                        name="konfirpassword" required autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Save changes</button>
            </div>
        </div>
    </form>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    
</head>
<style>
    /* untuk mengatur tampilan aksi agar sejajar ke kanan samping */
    .btnlist{
        display: flex;
        gap: 0.5em;
        justify-content: center;
    }
    /* untuk pengaturan tampilan loading */
    .bg-custom{
        background: rgba(40,40,40,0.7);
        transition:  height 0.2s linear;
        transition-delay: 2s;
    }
      /* untuk menambahkan foto di loading */
    .bg-custom img {
        width: 50% !important;
        display: block;
    }
     /* agar tulisan yg ada pada tabel menjadi rata tengah */
    #example1 th, td{
        text-align: center;
    }
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
        padding-right: 0;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('edit')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Diedit!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_edit')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Diedit !",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('hapus')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Dihapus!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_hapus')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Dihapus !",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Status SK Berhasil Diubah!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_input')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Status SK Gagal Diubah!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center bg-custom">
            <img src="<?= base_url();?>assets/admin_lte/dist/img/Loading.svg"
                alt="AdminLTELogo" />
        </div>

        <!-- Navbar -->
       
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
     
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Departemen</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Departemen</li>
                            </ol>
                        </div><!-- /.col -->
                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                            data-target="#exampleModal">
                            + Tambah Departemen
                        </button>
                        <br>
                    </div><!-- /.row -->
                    <?= $this->session->flashdata('pesan'); ?>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Departemen Pegawai</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Nama Departemen</th>
                                            <th>Divisi</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                        foreach ($departemen as $row) : 
                                            $no++;
                                            $iddepartemen = $row['iddepartemen'];
                                            $namadepartemen = $row['namadepartemen'];
                                            $divisi = $row['divisi'];
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $namadepartemen ?></td>
                                                <td><?= $divisi ?></td>                                                
                                                <td>
                                                    <a href="<?php echo base_url('Departemen/edit/') . $iddepartemen ?>" data-toggle="modal" data-target="#edit<?= $iddepartemen ?>"class="btn btn-warning"><i class="fas fa-edit" title="Edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('Departemen/delete/') . $iddepartemen ?>" data-toggle="modal" data-target="#delete<?= $iddepartemen ?>" class="btn btn-danger"><i class="fas fa-trash" title="Hapus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Modal Hapus Data Departemen -->
                                        <div class="modal fade" id="delete<?= $iddepartemen ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-colored-header bg-danger">
                                                            <h4 class="modal-title" id="exampleModalLabel">Hapus Data
                                                                Departemen
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo base_url()?>Departemen/delete"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="iddepartemen"
                                                                            value="<?php echo $iddepartemen ?>" />
                                                                        <p>Apakah kamu yakin ingin menghapus data
                                                                            ini?</i></b></p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger ripple"
                                                                        data-dismiss="modal">Tidak</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success ripple save-category">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                             <!-- Modal Edit Departemen -->
                                             <div class="modal fade" id="edit<?=$iddepartemen?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-colored-header bg-warning">
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit
                                                                Akun</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form action="<?=base_url();?>Departemen/edit"
                                                                method="POST">
                                                                <input type="hidden" name="iddepartemen" id="iddepartemen"
                                                                    value="<?php echo $iddepartemen?>" hidden>
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama Departemen</label>
                                                                        <input type="text" class="form-control" id="nama" aria-describedby="namadepartemen"
                                                                            name="namadepartemen" value="<?=$namadepartemen?>" required autocomplete="off">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="divisi">Divisi</label>
                                                                        <input type="text" class="form-control" id="divisi" aria-describedby="divisi"
                                                                            name="divisi" value="<?=$divisi?>" required autocomplete="off">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                                <!-- /.card-body -->
                        </div>
                            <!-- /.card -->
                    </div>
                        <!-- /.col -->
                </div>
                    <!-- /.row -->
             </div><!-- /.container-fluid -->
        </section>
            <!-- /.content -->
            <!-- Modal Tambah Departemen -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Departemen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>Departemen/tambah" method="POST">
                                <div class="form-group">
                                    <label for="namadepartemen">Nama Departemen</label>
                                    <input type="text" class="form-control" id="namadepartemen" aria-describedby="namadepartemen"
                                        name="namadepartemen" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="divisi">Divisi</label>
                                    <input type="text" class="form-control" id="divisi" aria-describedby="divisi"
                                        name="divisi" required autocomplete="off">
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("master/components/js.php") ?>
</body>
<script>
     // pengaturan pada loading sistem //
    const img = document.querySelector('.preloader img')
    setTimeout(() => {
        img.style = 'display: block'
    },500)
    setTimeout(() => {
        img.style = 'display: none'
    },2200)
</script>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    
</head>
<style>
    /* untuk meratakan letak button aksi */
    .btnlist{
        display: flex;
        gap: 0.5em;
    }
    /* untuk mengedit tampilan loading */
    .bg-custom{
        background: rgba(40,40,40,0.7);
        transition:  height 0.2s linear;
        transition-delay: 2s;
    }
    /* untuk mengedit tampilan gambar loading */
    .bg-custom img {
        width: 50% !important;
        display: block;
    }
    /* agar tulisan di tabel body bisa menjadi rata tengah*/
    .tbody {
        text-align:justify;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center bg-custom">
            <img src="<?= base_url();?>assets/admin_lte/dist/img/Loading.svg"
                alt="AdminLTELogo" />
        </div>

        <!-- Navbar -->
  
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard | Admin
							</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                <h3><span id="totalpermohonan"></span></h3>
                                    <p>Laporan yang diajukan</p>
                                </div>
                                <div class="icon">
                                <span></span>
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a href="" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                <br><br>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                           <b> Laporan Yang Diajukan </b>
                        </div>
                    <div class="card-body tbody">
                        <p class="card-text">Yaitu data pengajuan proposal yang masih menunggu di Approval oleh Group Leader dan Section Head.</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("admin/components/js.php") ?>
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
    let data = JSON.parse('<?=$permohonan?>')
    $("#totalpermohonan").html(data.length)
</script>
</html>

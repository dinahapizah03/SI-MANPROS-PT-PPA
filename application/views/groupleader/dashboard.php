<!DOCTYPE html>
<html lang="en">

<head>
    
</head>
<style>
         /* untuk mengatur tampilan aksi agar sejajar ke kanan samping */
    .btnlist{
        display: flex;
        gap: 0.5em;
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
     /* agar tulisan di tabel body bisa menjadi rata tengah*/
    .tbody {
        text-align:justify;
    }
    /* untuk mengecilkan gambar dalam box dashboard */
    .images {
        width: 10em;
    }
    /* untuk mengatur luas box dashboard */
    .small-box{
        display: flex;
        justify-content: space-between;
        background: white;
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
                            <h1 class="m-0">Dashboard | Group Leader
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
                        <div class="col-lg-4 col-8">
                            <!-- small box -->
                            <div class="small-box ">
                                <div class="inner">
                                <h3><span id="totallaporan"></span></h3>
                                    <p>Laporan Baru</p>
                                    
                                </div>
                                <div class="icon">
                                    <img class="images" src="<?= base_url()?>assets/login/images/pengajuan.svg" alt="ilustration"/>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-8">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                <h3><span id="laporansetuju"></span></h3>
                                    <p>Laporan Disetujui</p>
                                </div>
                                <div class="icon">
                                    <img class="images" src="<?= base_url()?>assets/login/images/disetujui.svg" alt="ilustration"/>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-8">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                <h3><span id="laporantolak"></span></h3>
                                    <p>Laporan Ditolak</p>
                                </div>
                                <div class="icon">
                                    <img class="images" src="<?= base_url()?>assets/login/images/ditolak.svg" alt="ilustration"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                <br><br>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                         <b>  Laporan Baru </b>
                        </div>
                    <div class="card-body tbody">
                        <p class="card-text">Yaitu data pengajuan yang harus di approve oleh group leader.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                          <b>  Laporan Disetujui  </b>
                        </div>
                    <div class="card-body tbody">
                        <p class="card-text">Yaitu data pengajuan yang telah complete oleh group leader.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                        <b>    Laporan Ditolak  </b>
                        </div>
                    <div class="card-body tbody">
                        <p class="card-text">Yaitu data pengajuan yang telah ditolak oleh group leader.</p>
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

    <?php $this->load->view("groupleader/components/js.php") ?>
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

    let totallaporan = '<?=json_encode($laporan)?>'
    $('#totallaporan').html(JSON.parse(totallaporan).length)
    
    $('#laporansetuju').html(<?=$count_disetujui?>)
    $('#laporantolak').html(<?=$count_ditolak?>)
</script>
</html>

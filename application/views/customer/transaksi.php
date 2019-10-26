<section class="page-header page-header-classic">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="breadcrumb">
                    <li><a href="#/home">Home</a></li>
                    <li class="active">Transaksi</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col p-static">
                <h1 data-title-border>Riwayat Pesanan</h1>

            </div>
        </div>
    </div>
</section>

<div class="container py-2">
    <div class="row">
        <div class="col-md-12">
            <table class="table" id="t_transaksi">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Deskripsi</th>
                        <th>Tgl Transaksi</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    $(function(){
        transaksiController.init()
    })
</script>
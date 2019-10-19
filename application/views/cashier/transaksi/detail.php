<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a  href="#/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a  href="#/transaksi">Transaksi</a></li>
    <li class="breadcrumb-item active">Detail</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-'></i> Detail Transaksi
    </h1>
    <div class="subheader-block" id="action">
        
    </div>
</div>

<div class="container" id="print_detail">
    
</div>

<script>
    $.getScript(`${BASE_URL}src/cashier/transaksi/detail.js`)
</script>
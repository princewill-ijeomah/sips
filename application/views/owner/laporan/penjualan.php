<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a  href="#/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active">Laporan</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-'></i> Laporan Penjualan
    </h1>
</div>

<div class="row no_print">
    <div class="col-md-12">
        <div id="panel_report" class="panel">
            <div class="panel-hdr">
                <h2>
                    Filter Laporan
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <form id="form_laporan">
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tgl_awal" name="tgl_awal">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
                        </div>
                        <button type="submit" class="btn btn-info btn-block btn-md">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="print_report">
            
</div>
<div id="content_action" class="no_print">
    
</div>

<script>
    $.getScript(`${BASE_URL}src/owner/laporan/penjualan.js`)
</script>

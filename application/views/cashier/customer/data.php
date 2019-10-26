<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a  href="#/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active">Pelanggan</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-'></i> Pelanggan 
    </h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Data Pelanggan
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100" id="t_customer">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Jenis_Kelamin</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Tgl_Lahir</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Tgl_Registrasi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.getScript(`${BASE_URL}src/cashier/customer/data.js`)
</script>
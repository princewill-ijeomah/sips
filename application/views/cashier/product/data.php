<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a  href="#/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active">Product</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-'></i> Product 
    </h1>
    <div class="subheader-block">
        <a href="#/product/add" class="btn btn-info btn-md"><i class="fal fa-plus"></i> Tambah</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Data Product
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped w-100" id="t_product">
                            <thead>
                                <tr>
                                    <th>ProductID</th>
                                    <th>Nama</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Subkriteria</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="form_delete">
    <div id="modal_delete" class="modal modal-alert fade" id="example-modal-alert" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus product ini <code id="code_delete">...</code> ?
                    <input type="hidden" name="id_product" id="delete_id_product">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $.getScript(`${BASE_URL}src/cashier/product/data.js`)
</script>
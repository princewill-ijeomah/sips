<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a  href="#/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active">Kriteria</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-'></i> Kriteria 
    </h1>
    <div class="subheader-block">
        <button class="btn btn-info btn-md btn_add"><i class="fal fa-plus"></i> Tambah</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Data Kriteria
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100" id="t_kriteria">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kriteria</th>
                                <th>Subkriteria</th>
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

<form id="form_add">
    <div id="modal_add" class="modal fade" id="default-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">
                        Tambah Kritera
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add_nama_kriteria">Nama Kriteria</label>
                        <input type="text" class="form-control" name="nama_kriteria" id="add_nama_kriteria" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="form_subkriteria">
    <div id="modal_subkriteria" class="modal fade" id="default-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">
                        Tambah Sub
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kriteria</label>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" readonly name="id_kriteria" id="sub_id_kriteria">
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" readonly name="nama_kriteria" id="sub_nama_kriteria"> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Subkriteria</label>
                        <table class="table" id="t_sub">
                            <thead>
                                <th>Nama Subkriteria</th>
                                <th><button type="button" class="btn btn-sm btn-info btn_add_row"><i class="fal fa-plus"></i></button></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="form_delete">
    <div id="modal_delete" class="modal modal-alert fade" id="example-modal-alert" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus kriteria ini <code id="code_delete">...</code> ?
                    <input type="hidden" name="id_kriteria" id="delete_id_kriteria">
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
    $.getScript(`${BASE_URL}src/cashier/kriteria/data.js`)
</script>
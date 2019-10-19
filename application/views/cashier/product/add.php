<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#/product">Product</a></li>
    <li class="breadcrumb-item active">Tambah Product</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-'></i> Tambah Product 
    </h1>
</div>

<form id="form_add" enctype="multipart/form-data">
    <div class="row" id="form_container">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Informasi Product
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="form-group">
                            <label for="">Nama Product</label>
                            <input type="text" class="form-control" name="nama_product" id="nama_product">
                        </div>
                        <div class="form-group">
                            <label for="">Berat</label>
                            <input type="number" class="form-control" name="weight" id="weight">
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" class="form-control" name="harga" id="harga">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="panel_kriteria" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Kategori Product
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content" id="category_content">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="panel_submit" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <button type="submit" class="btn btn-info btn-md btn-block">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $.getScript(`${BASE_URL}src/cashier/product/add.js`)
</script>
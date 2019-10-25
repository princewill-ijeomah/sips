<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <aside class="sidebar">
                <h5 class="font-weight-bold pt-3">Kriteria</h5>
                <div id="">
                    <form id="form_product">
                        <div id="form_product_container"></div>
                        <button class="btn btn-block btn-info">Cari</button>
                    </form>
                </div>
            </aside>
        </div>
        <div class="col-lg-9" id="result_container">
           <div class="text-center mt-5">
                <h2 class="text-muted">Silahkan pilih kriteria suplemen yang anda inginkan.</h2>
                <h4 class="text-muted">Kami akan merekomendasikan suplemen yang sesuai dengan kebutuhan anda</h4>
           </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        productController.init()
    })
</script>
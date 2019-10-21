<div class="container">

    <div class="row" id="checkout_container">  
        <div class="col-lg-12">
            <div class="accordion accordion-modern" id="accordion">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title m-0">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                Review &amp; Pembelanjaan
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="collapse show">
                        <div class="card-body">
                            <table class="shop_table cart" id="t_detail">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">
                                            &nbsp;
                                        </th>
                                        <th class="product-name">
                                            Product
                                        </th>
                                        <th class="product-price">
                                            Harga
                                        </th>
                                        <th class="product-quantity">
                                            Qty
                                        </th>
                                        <th class="product-subtotal">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
            
                            <hr class="solid my-5">
            
                            <h4 class="text-primary">Cart Totals</h4>
                            <table class="cart-totals">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>
                                            <strong class="text-dark">Cart Subtotal</strong>
                                        </th>
                                        <td class="text-right">
                                            <strong class="text-dark"><span class="amount total">Rp. 0</span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Biaya Pengiriman
                                        </th>
                                        <td class="text-right">
                                            Gratis Pengiriman
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <strong class="text-dark">Order Total</strong>
                                        </th>
                                        <td class="text-right">
                                            <strong class="text-dark"><span class="amount total">Rp. 0</span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title m-0">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Konfirmasi Pembayaran
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="collapse show">
                        <div class="card-body">
                            <form id="form_checkout">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="font-weight-bold text-dark text-2">No Transaksi</label>
                                        <input type="text" name="no_transaksi" id="no_transaksi" value="" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="font-weight-bold text-dark text-2">Bank</label>
                                        <select class="form-control" name="bank" id="bank">
                                            <option value="">-</option>
                                            <option value=" BCA - 1791606298"> BCA - 1791606298</option>
                                            <option value="Mandiri - 123678121312">Mandiri - 123678121312</option>
                                            <option value="BRI - 103613953935">BRI - 103613953935</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-dark text-2">Bank Pengirim</label>
                                        <input type="text" name="bank_pengirim" id="bank_pengirim" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-dark text-2">No Rekening</label>
                                        <input type="number" name="no_rekening" id="no_rekening" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="font-weight-bold text-dark text-2">Nama Pengirim</label>
                                        <input type="text" name="nama_pengirim" id="nama_pengirim" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="font-weight-bold text-dark text-2">Tanggal Transfer </label>
                                        <input type="date" name="tgl_transfer" id="tgl_transfer" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="font-weight-bold text-dark text-2">Jumlah Transfer </label>
                                        <input type="number" name="jml_transfer" id="jml_transfer" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="font-weight-bold text-dark text-2">Foto </label>
                                        <input type="file" name="foto" id="foto" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn_cancel btn-danger btn-xl pr-4 pl-4 text-2 font-weight-semibold text-uppercase mb-2">Batalkan Transaksi</button>
                                        <input type="submit" value="Konfirmasi" class="btn btn-xl btn-info pr-4 pl-4 text-2 font-weight-semibold text-uppercase mb-2" data-loading-text="Loading...">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>

    <form id="form_cancel">
        <div class="modal fade" id="modal_cancel" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Batalkan Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="cancel_no_transaksi" name="no_transaksi">
                        Apakah Anda yakin membatalkan transaksi ini <span class="text-info cancel_text"></span> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    $(function(){
        checkoutController.init()
    })
</script>
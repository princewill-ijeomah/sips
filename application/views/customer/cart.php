<div class="container">

    <div class="row">
        <div class="col">

            <form id="form_transaksi">
                <div class="featured-boxes">
                    <div class="row">
                        <div class="col">
                            <div class="featured-box featured-box-primary text-left mt-2">
                                <div class="box-content">
                                    <table class="shop_table cart" id="t_cart">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">
                                                    &nbsp;
                                                </th>
                                                <th style="width: 5%" class="product-thumbnail">
                                                    &nbsp;
                                                </th>
                                                <th style="width: 30%">
                                                    Product
                                                </th>
                                                <th style="width: 20%" class="product-price">
                                                    Harga
                                                </th>
                                                <th style="width: 20%" class="product-quantity">
                                                    Qty
                                                </th>
                                                <th style="width: 20%" class="product-subtotal">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="featured-boxes">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="featured-box featured-box-primary text-left mt-3 mt-lg-4">
                                <div class="box-content">
                                    <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Informasi Pengiriman</h4>
                                    <div class="form-group">
                                        <label for="">Alamat Kirim</label>
                                        <textarea name="alamat_kirim" id="alamat_kirim" cols="30" rows="5" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Telepon</label>
                                        <input name="telepon" id="telepon" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="featured-box featured-box-primary text-left mt-3 mt-lg-4">
                                <div class="box-content">
                                    <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Total Keranjang</h4>
                                    <table class="cart-totals">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>
                                                    <strong class="text-dark">Total</strong>
                                                </th>
                                                <td>
                                                    <input type="hidden" name="total" id="total">
                                                    <strong class="text-dark"><span class="total">Rp. 0</span></strong>
                                                </td>
                                            </tr>
                                            <tr class="shipping">
                                                <th>
                                                    Biaya pengiriman
                                                </th>
                                                <td>
                                                    Gratis
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <strong class="text-info">Grand Total</strong>
                                                </th>
                                                <td>
                                                    <strong class="text-info"><span class="grand_total">Rp. 0</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="actions-continue">
                            <button type="submit" class="btn btn-primary btn-modern text-uppercase">Proceed to Checkout <i class="fas fa-angle-right ml-1"></i></button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>

<script>
    $(function(){
        cartController.init()
    })
</script>
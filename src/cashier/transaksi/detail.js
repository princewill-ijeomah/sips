console.log('Detail Payment is running...')

$(function () {

    const DOM = {
        container: '#print_detail',
        action: '#action',
        print: '#print'
    }

    const detailTransaksiUI = (() => {
        const { container, action } = DOM

        return {
            renderData: (data) => {
                let html = '';
                let no = 1;
                let grand_total = 0;
                let total_bayar = 0;

                let detail_product = data.detail.map(v => {
                    let detail_dom = ''
                    
                    detail_dom += `
                        <tr>
                            <td>${no++}</td>
                            <td>${v.product.id_product} - ${v.product.nama_product}</td>
                            <td class="text-right">Rp. ${parseInt(v.harga_satuan).toLocaleString(['ban', 'id'])}</td>
                            <td class="text-right">${v.qty}</td>
                            <td class="text-right">Rp. ${parseInt(v.total_harga).toLocaleString(['ban', 'id'])}</td>
                        </tr>
                    `
                    
                    grand_total += parseInt(v.total_harga)
                    return detail_dom;
                })

                let detail_pambayaran = data.pembayaran.map(v => {
                    let payment_dom = ''

                    payment_dom += `
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="py-5 text-primary">
                                    No Payment: ${v.no_konfirmasi}
                                    <br>
                                    ${v.bank_pengirim} - ${v.rekening_pengirim} To ${v.bank}
                                </h4>
                            </div>
                        </div>
                    `

                    total_bayar += parseInt(v.jml_transfer)
                    return payment_dom
                })

                html += `
                    <div data-size="A4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex align-items-center mb-5">
                                    <h2 class="keep-print-font fw-500 mb-0 text-primary flex-1 position-relative">
                                        Duta Gym
                                        <small class="text-muted mb-0 fs-xs">
                                            Jl. Blablabla
                                        </small>
                                        <!-- barcode demo only -->
                                    </h2>
                                </div>
                                <h3 class="fw-300 display-4 fw-500 color-primary-600 keep-print-font pt-4 l-h-n m-0">
                                    Transaksi
                                </h3>
                                <div class="text-dark fw-700 h1 mb-g keep-print-font">
                                    #${data.no_transaksi}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 d-flex">
                                <div class="table-responsive">
                                    <table class="table table-clean table-sm align-self-end">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Tgl Transaksi
                                                </td>
                                                <td>
                                                    ${data.tgl_transaksi}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Status
                                                </td>
                                                <td>
                                                    ${data.status}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-4 ml-sm-auto">
                                <div class="table-responsive">
                                    <table class="table table-sm table-clean text-right">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong>Customer:</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>${data.customer.nama_lengkap}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ${data.alamat_kirim}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-info">
                                                    ${data.customer.email}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ${data.customer.telepon}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0 table-scale-border-bottom fw-700">No</th>
                                                <th class="border-top-0 table-scale-border-bottom fw-700">Product</th>
                                                <th class="text-right border-top-0 table-scale-border-bottom fw-700">Harga Satuan</th>
                                                <th class="text-center border-top-0 table-scale-border-bottom fw-700">Qty</th>
                                                <th class="text-right border-top-0 table-scale-border-bottom fw-700">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${detail_product}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 ml-sm-auto">
                                <table class="table table-clean">
                                    <tbody>
                                        <tr class="table-scale-border-top border-left-0 border-right-0 border-bottom-0">
                                            <td class="text-left keep-print-font">
                                                <h4 class="m-0 fw-700 h2 keep-print-font color-primary-700">Total</h4>
                                            </td>
                                            <td class="text-right keep-print-font">
                                                <h4 class="m-0 fw-700 h2 keep-print-font">Rp. ${grand_total.toLocaleString(['ban', 'id'])}</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <strong>Dibayar</strong>
                                            </td>
                                            <td class="text-right">
                                                <strong>Rp. ${total_bayar.toLocaleString(['ban', 'id'])}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        ${detail_pambayaran}
                    </div>
                `

                $(container).html(html);
            },
            renderAction: () => {
                let html = '<button class="btn btn-block btn-info btn-md" data-action="app-print" id="print"><i class="fal fa-print"></i> Print</button>'

                $(action).html(html)
            },
            renderNoData: () => {
                let html = '<div class="text-center"> Data tidak ditemukan </div>'

                $(container).html(html);
            }
        }
    })()

    const detailTransaksiController = ((UI) => {

        const no_transaksi = location.hash.substr(12)

        const { container, print, action } = DOM

        const fetchTransaksi = () => {
            $.ajax({
                url: `${BASE_URL}int/transaksi`,
                data: { no_transaksi: no_transaksi },
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    $(container).block({
                        message: '<i class="fal fa-spinner fa-spin fa-2x"></i>',
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.8,
                            cursor: 'wait'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'transparent'
                        }
                    })
                },
                success: ({ data }) => {
                    console.log(data)
                    if (data.length === 1) {
                        data.map(v => {
                            UI.renderData(v)
                            UI.renderAction()
                        })
                    } else {
                        UI.renderNoData()
                    }
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                },
                complete: () => {
                    $(container).unblock()
                }
            })
        }

        const printDetail = () => {
            $(action).on('click', print, function () {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $(container).printArea(options);
            })
        }

        return {
            init: () => {
                fetchTransaksi()
                printDetail()
            }
        }
    })(detailTransaksiUI)

    detailTransaksiController.init();
})
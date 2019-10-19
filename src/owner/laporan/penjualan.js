console.log('Laporan is running...')

$(function(){
    const DOM = {
        content: '#print_report',
        action: '#content_action',
        input: {
            tgl_awal: '#tgl_awal',
            tgl_akhir: '#tgl_akhir'
        },
        form: '#form_laporan',
        panel: '#panel_report'
    }

    const laporanUI = (() => {
        const {content, action, input, form, panel} = DOM

        return {
            renderData: data => {
                let no = 1;
                let grand_total = 0;
                let tgl_awal = $(input.tgl_awal).val()
                let tgl_akhir = $(input.tgl_akhir).val()

                let row = data.map(v => {
                    let total_qty = v.detail.reduce((a, b) => a + parseInt(b.qty), 0)
                    let total_harga = v.detail.reduce((a, b) => a + parseInt(b.total_harga), 0)

                    grand_total += total_harga

                    let row_data = `
                        <tr>
                            <td>${no++}</td>
                            <td>${v.no_transaksi}</td>
                            <td>${v.customer.nama_lengkap}</td>
                            <td class="text-right">${total_qty}</td>
                            <td class="text-right">Rp. ${total_harga.toLocaleString(['ban', 'id'])}</td>
                        </tr>
                    `

                    return row_data
                })

                let html = `
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
                                    Laporan Penjualan
                                </h3>
                                <div class="text-dark fw-700 h1 mb-g keep-print-font">
                                    Periode ${tgl_awal} s/d ${tgl_akhir}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th class="text-center border-top-0 table-scale-border-bottom fw-700">No</th>
                                                <th class="border-top-0 table-scale-border-bottom fw-700">No TRX</th>
                                                <th class="border-top-0 table-scale-border-bottom fw-700">Customer</th>
                                                <th class="text-center border-top-0 table-scale-border-bottom fw-700">Qty</th>
                                                <th class="text-right border-top-0 table-scale-border-bottom fw-700">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${row}
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
                                                <h4 class="m-0 fw-700 h2 keep-print-font color-primary-700">Grand Total</h4>
                                            </td>
                                            <td class="text-right keep-print-font">
                                                <h5 class="m-0 fw-700 keep-print-font">Rp. ${grand_total.toLocaleString(['ban', 'id'])}</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="py-5 text-primary">
                                    Disetujui oleh,
                                    <br><br><br><br><br><br><br><br><br>
                                    ( ........................................................... )
                                </h4>
                            </div>
                        </div>
                    </div>
                `

                $(content).html(html)
            },
            renderAction: data => {
                let html = `
                    <button class="btn btn-block btn-info btn-md" data-action="app-print" id="print"><i class="fal fa-print"></i> Print</button>
                `
                $(action).html(html)
            },
            renderNoData: () => {
                let html = `
                    <center><h3>Data tidak tersedia</h3></center>
                `
                $(content).html(html)
            }
        }
    })()

    const laporanController = ((UI) => {
        const {content, input, form, panel} = DOM

        const submitLaporan = () => {
            $(form).validate({
                rules: {
                    tgl_awal: 'required',
                    tgl_akhir: 'required'
                },
                messages: {
                    tgl_awal: 'Tanggal awal harus diisi',
                    tgl_akhir: 'Tanggal akhir harus diisi'
                },
                submitHandler: form => {
                    $.ajax({
                        url: `${BASE_URL}int/transaksi/report`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $(form).serialize(),
                        beforeSend: xhr => {
                            xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                            xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                            $(panel).block({
                                message: '<i class="fal fa-spinner fa-spin fa-5x"></i>',
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
                        success: ({data}) => {
                            if(data.length !== 0){
                                UI.renderData(data)
                                UI.renderAction()
                            } else {
                                UI.renderNoData()
                            }
                        },
                        error: err => {
                            const { error } = err.responseJSON
                            toastr.error(error, 'Gagal')
                        },
                        complete: () => {
                            $(panel).unblock()
                        }
                    })
                }
            })
        }

        return {
            init: () => {
                submitLaporan()
            }
        }
    })(laporanUI)

    laporanController.init()
})
console.log('Dashboard is running..')

$(function () {
    const DOM = {
        count: {
            user: '#count_user',
            transaksi: '#count_transaksi'
        },
        chart: {
            transaksi_line: 'transaksi_line',
            transaksi_pie: 'transaksi_pie',
            user_doughnut: 'user_doughnut'
        },
        list: '#top_5'
    }

    const dashboardUI = (() => {
        const { list } = DOM

        return {
            renderData: (data) => {
                let html = '';

                if(data.length !== 0){
                    data.map(v => {
                        html += `
                            <div class="col-12">
                                <div class="row no-gutters row-grid align-items-stretch">
                                    <div class="col-md">
                                        <div class="p-3">
                                            <div class="d-flex">
                                                <span class="icon-stack display-4 mr-3 flex-shrink-0">
                                                    <a href="${v.foto}" target="__blank">
                                                        <span class="rounded-circle profile-image d-block" style="background-image:url('${v.foto}'); background-size: cover;"></span>
                                                    </a>
                                                </span>
                                                <div class="d-inline-flex flex-column">
                                                    <a href="javascript:void(0)" class="fs-lg fw-500 d-block">
                                                        ${v.id_product} - ${v.nama_product} <span class="badge badge-warning rounded">Terjual ${v.total_qty} qty</span>
                                                    </a>
                                                    <div class="d-block text-muted fs-sm">
                                                        Total terjual Rp. ${parseInt(v.total_terjual).toLocaleString(['ban', 'id'])}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                    })
                } else {
                    html += `
                        <center>
                            Data tidak tersedia
                        </center>
                    `
                }

                $(list).html(html)
            }
        }
    })()

    const dashboardController = ((UI) => {
        const { count, chart } = DOM

        const USER_DOUGHNUT = new Chart(document.getElementById(chart.user_doughnut).getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        "green",
                        "red"
                    ]
                }],
            },

            options: {
                legend: {
                    display: true,
                },
                responsive: true,
                tooltips: {
                    enabled: true,
                }
            }
        })

        const TRANSAKSI_PIE = new Chart(document.getElementById(chart.transaksi_pie).getContext('2d'), {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        "blue",
                        "yellow"
                    ]
                }],
            },

            options: {
                legend: {
                    display: true,
                },
                responsive: true,
                tooltips: {
                    enabled: true,
                }
            }
        })

        const TRANSAKSI_LINE = new Chart(document.getElementById(chart.transaksi_line).getContext('2d'), {
            type: 'line',
            data: {
                labels: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec',
                ],
                datasets: [{
                    label: 'Total Transaksi',
                    data: [],
                    borderColor: "rgba(0, 176, 228, 0.75)",
                    backgroundColor: "transparent",
                    pointBorderColor: "rgba(0, 176, 228, 0)",
                    pointBackgroundColor: "rgba(0, 176, 228, 0.9)",
                    pointBorderWidth: 1,
                },],
            },
            options: {
                responsive: true,
                legend: {
                    display: true,
                },
            },
        })

        const fetchUser = () => {
            $.ajax({
                url: `${BASE_URL}int/user`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({ data }) => {
                    let aktif = data.filter(v => v.aktif === 'Y').length
                    let nonaktif = data.filter(v => v.aktif === 'T').length

                    if (aktif !== 0) {
                        USER_DOUGHNUT.data.labels.push('Aktif');
                        USER_DOUGHNUT.data.datasets[0].data.push(aktif)
                    }

                    if (nonaktif !== 0) {
                        USER_DOUGHNUT.data.labels.push('Nonaktif');
                        USER_DOUGHNUT.data.datasets[0].data.push(nonaktif)
                    }

                    $(count.user).text(data.length)
                    USER_DOUGHNUT.update();
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                }
            })
        }

        const fetchProduct = () => {
            $.ajax({
                url: `${BASE_URL}int/product/statistic`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({ data }) => {
                    UI.renderData(data)
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                }
            })
        }

        const fetchTransaksi = () => {
            $.ajax({
                url: `${BASE_URL}int/transaksi`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({ data }) => {
                    let dibayar = data.filter(v => v.status === 'Dibayar').length
                    let belum_dibayar = data.filter(v => v.status === 'Belum Dibayar').length

                    if (dibayar !== 0) {
                        TRANSAKSI_PIE.data.labels.push('Dibayar');
                        TRANSAKSI_PIE.data.datasets[0].data.push(dibayar)
                    }

                    if (belum_dibayar !== 0) {
                        TRANSAKSI_PIE.data.labels.push('Belum Dibayar');
                        TRANSAKSI_PIE.data.datasets[0].data.push(belum_dibayar)
                    }

                    $(count.transaksi).text(data.length)
                    TRANSAKSI_PIE.update();
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                }
            })
        }

        const fetchStatistic = () => {
            $.ajax({
                url: `${BASE_URL}int/transaksi/statistic`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({ data }) => {
                    TRANSAKSI_LINE.data.datasets[0].data = data.total_transaksi;

                    TRANSAKSI_LINE.update();
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                }
            })
        }

        return {
            init: () => {
                fetchUser()
                fetchTransaksi()
                fetchProduct()
                fetchStatistic()
            }
        }
    })(dashboardUI)

    dashboardController.init()
})
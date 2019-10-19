console.log('Dashboard is running..')

$(function () {
    const DOM = {
        count: {
            customer: '#count_customer',
            transaksi: '#count_transaksi',
            product: '#count_product',
            konfirmasi: '#count_konfirmasi'
        },
        chart: {
            transaksi_line: 'transaksi_line',
            transaksi_pie: 'transaksi_pie',
        }
    }

    const dashboardController = (() => {
        const { count, chart } = DOM

        const TRANSAKSI_PIE = new Chart(document.getElementById(chart.transaksi_pie).getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        "cyan",
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
                url: `${BASE_URL}int/customer`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({ data }) => {
                    $(count.customer).text(data.length)
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                }
            })
        }

        const fetchKonfirmasi = () => {
            $.ajax({
                url: `${BASE_URL}int/konfirmasi`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({ data }) => {
                    $(count.konfirmasi).text(data.length)
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                }
            })
        }

        const fetchProduct = () => {
            $.ajax({
                url: `${BASE_URL}int/product`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({ data }) => {
                    $(count.product).text(data.length)
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
                fetchKonfirmasi()
                fetchTransaksi()
                fetchProduct()
                fetchStatistic()
            }
        }
    })()

    dashboardController.init()
})
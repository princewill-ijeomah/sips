console.log('Add Product is running...')

$(function(){
    const DOM = {
        kategori: {
            container: '#category_content'
        },
        panel: {
            add: '#panel-add'
        },
        form: {
            container: '#form_container'
        }
    }

    addProductUI = (() => {
        const { kategori } = DOM

        return {
            renderContainer: (data) => {
                let html = '';

                data.map(kriteria => {
                    html += `
                        <div class="form-group">
                            <label>${kriteria.nama_kriteria}</label>
                            <select class="form-control" name="id_subkategori[]" required>
                                <option value="">-</option>
                    `

                    kriteria.subkriteria.map(subkriteria => {
                        html += `<option value="${subkriteria.id_subkriteria}">${subkriteria.nama_subkriteria}</option>`
                    })

                    html += `
                            </select>
                        </div>
                    `;
                })

                $(kategori.container).html(html)
            }
        }
    })()

    addProductController = ((UI) => {
        const { panel } = DOM

        const fetchKriteria = () => {
            $.ajax({
                url: `${BASE_URL}int/kriteria`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                    $(panel.add).block({
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
                success: ({ data }) => {
                    UI.renderContainer(data)
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                },
                complete: () => {
                    $(panel.add).unblock()
                }
            })
        }

        return {
            init: () => {
                fetchKriteria()
            }
        }
    })(addProductUI)

    addProductController.init();
})
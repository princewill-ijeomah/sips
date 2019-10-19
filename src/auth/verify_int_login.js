if (INT_TOKEN) {
    $.ajax({
        url: `${BASE_URL}int/setting/verify_user`,
        type: 'GET',
        dataType: 'JSON',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
        },
        success: function (res) {
            if (res.data.length !== 0) {
                const { level, aktif } = res.data;

                if (aktif === 'Y') {
                    window.location.replace(`${BASE_URL}${level}/`)
                }
            } else {
                localStorage.removeItem('INT-SIPS-KEY')
            }

        },
        error: function (err) {
            localStorage.removeItem('INT-SIPS-KEY')
        }
    })
}
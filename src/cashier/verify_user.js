
const verifyUser = (() => {

    const DOM = {
        header: {
            name: '.header_name',
            email: '.header_email',
            level: '.header_level'
        },
        profile: {
            nama_lengkap: '#profile_nama_lengkap',
            alamat: '#profile_alamat',
            telepon: '#profile_telepon',
            jenis_kelamin: '#profile_jenis_kelamin',
            tgl_lahir: '#profile_tgl_lahir'
        }
    }

    const setSession = (data) => {
        const { header, profile } = DOM

        $(header.name).text(data.nama_lengkap)
        $(header.email).text(data.email)
        $(header.level).text(data.level)

        $(profile.nama_lengkap).val(data.nama_lengkap)
        $(profile.alamat).val(data.alamat)
        $(profile.tgl_lahir).val(data.tgl_lahir)
        $(profile.jenis_kelamin).val(data.jenis_kelamin)
        $(profile.telepon).val(data.telepon)
    }

    const cekUser = () => {
        if (!INT_TOKEN) {
            window.location.replace(`${BASE_URL}administrator`);
        } else {
            $.ajax({
                url: `${BASE_URL}int/setting/verify_user`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                },
                success: function (res) {
                    console.log(res)
                    if (res.status === true) {
                        const { level, aktif } = res.data;

                        if (aktif === 'T') {
                            localStorage.removeItem('INT-SIPS-KEY')
                            window.location.replace(`${BASE_URL}`)
                        } else {
                            if (level !== 'cashier') {
                                window.location.replace(`${BASE_URL}${level}/`)
                            } else {
                                setSession(res.data);
                            }
                        }
                    } else {
                        localStorage.removeItem('INT-SIPS-KEY')
                        window.location.replace(`${BASE_URL}administrator`)
                    }
                },
                error: function (err) {
                    localStorage.removeItem('INT-SIPS-KEY')
                    window.location.replace(`${BASE_URL}administrator`)
                }
            })
        }
    }

    return {
        init: () => {
            cekUser()
        }
    }
})()

verifyUser.init()
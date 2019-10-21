<section class="page-header page-header-classic">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="breadcrumb">
                    <li><a href="#/home">Home</a></li>
                    <li class="active">Setting</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col p-static">
                <h1 data-title-border>User Setting</h1>

            </div>
        </div>
    </div>
</section>

<div class="container py-2">

    <div class="row">
        <div class="col-lg-3 mt-4 mt-lg-0">

            <div class="d-flex justify-content-center mb-4">
                <div class="profile-image-outer-container">
                    <div class="profile-image-inner-container bg-color-primary">
                        <img src="<?= base_url() ?>assets/internal/dist/img/demo/avatars/avatar-m.png">
                    </div>
                </div>
            </div>

            <aside class="sidebar mt-2" id="sidebar">
                <ul class="nav nav-list flex-column mb-5">
                    <li class="nav-item"><a class="nav-link text-dark" id="link_profile" style="cursor: pointer">Edit Profile</a></li>
                    <li class="nav-item"><a class="nav-link" id="link_password" style="cursor: pointer">Ganti Password</a></li>
                </ul>
            </aside>

        </div>
        <div class="col-lg-9">
            <div id="edit_profile_container">
                <div class="overflow-hidden mb-1">
                    <h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">Edit</strong> Profile</h2>
                </div>
                <div class="overflow-hidden mb-4 pb-3">
                    <p class="mb-0">Edit profilemu agar datamu selalu terupdate.</p>
                </div>

                <form id="form_profile">
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Nama Lengkap</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="nama_lengkap" name="nama_lengkap" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Jenis Kelamin</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">-</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Tanggal Lahir</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="tgl_lahir" name="tgl_lahir" type="date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Alamat</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="alamat" name="alamat" type="text"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Telepon</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="telepon" name="telepon" type="number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-lg-3">
                            
                        </div>
                        <div class="form-group col-lg-9">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-modern btn-block">
                        </div>
                    </div>
                </form>
            </div>

            <div id="ganti_password_container" style="display: none">
                <div class="overflow-hidden mb-1">
                    <h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">Ganti</strong> Password</h2>
                </div>
                <div class="overflow-hidden mb-4 pb-3">
                    <p class="mb-0">Ganti password agar keamanan lebih terjaga.</p>
                </div>

                <form id="form_password">
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Password Lama</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="old_password" name="old_password" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Password Baru</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="new_password" name="new_password" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Konfirmasi Password</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="retype_password" name="retype_password" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="show_password">
                                <label class="custom-control-label text-2" for="show_password">Show Password</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(function(){
        settingController.init()
    })
</script>
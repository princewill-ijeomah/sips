<div class="alert alert-primary">
    <div class="d-flex flex-start w-100">
        <div class="mr-2 hidden-md-down">
            <span class="icon-stack icon-stack-lg">
                <i class="base base-6 icon-stack-3x opacity-100 color-primary-500"></i>
                <i class="base base-10 icon-stack-2x opacity-100 color-primary-300 fa-flip-vertical"></i>
                <i class="ni ni-blog-read icon-stack-1x opacity-100 color-white"></i>
            </span>
        </div>
        <div class="d-flex flex-fill">
            <div class="flex-fill">
                <span class="h5">Selamat Datang</span>
                <p class="m-0">
                    Anda login sebagai <b>Owner</b>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    <a id="count_user">...</a>
                    <small class="m-0 l-h-n">Total User</small>
                </h3>
            </div>
            <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
        </div>
        <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    <a id="count_transaksi">...</a>
                    <small class="m-0 l-h-n">Total Transaksi</small>
                </h3>
            </div>
            <i class="fal fa-file position-absolute pos-right pos-bottom opacity-15 mb-n1" style="font-size: 6rem;"></i>
        </div>
    </div>
    <div class="col-md-5">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    User
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <canvas id="user_doughnut" height="130"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Top 5 Product
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row no-gutters row-grid" id="top_5">
                    <!-- thread -->
                        
                    <!-- thread -->    
                    </div>
                </div>
            </div>
        </div>

        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Transaksi
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <canvas id="transaksi_pie" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Transaksi
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <canvas id="transaksi_line" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $.getScript(`${BASE_URL}src/owner/dashboard.js`)
</script>
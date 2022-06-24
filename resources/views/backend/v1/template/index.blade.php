<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title') - PENGADILAN AGAMA</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    @include('backend.v1.template.inc.head')
</head>

<body>
    <div class="wrapper">
        @include('backend.v1.template.inc.nav')
        @include('backend.v1.template.inc.side')
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                                <h5 class="text-white op-7 mb-2">
                                    Aplikasi Pengelolaan Perkara Pada Kantor Pengadilan Agama Negara Kelas II Kecamatan
                                    Daha Selatan
                                </h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                @yield('button')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    @if (session('success') || session('danger'))
                        <div class="alert alert-{{ session('success') ? 'primary' : 'danger' }}" role="alert">
                            <strong>{{ session('success') ? session('success') : session('danger') }}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            @include('backend.v1.template.inc.foot')
        </div>
    </div>

    @include('backend.v1.template.inc.script')
</body>

</html>

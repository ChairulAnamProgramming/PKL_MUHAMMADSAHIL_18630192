<!DOCTYPE html>
<html lang="en">
@include('template.inc.head')

<body>
    <div class="layer"></div>
    <!-- ! Body -->
    <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
    <div class="page-flex">
        @include('template.inc.side')
        <div class="main-wrapper">
            @include('template.inc.nav')
            <!-- ! Main -->
            <main class="main users chart-page" id="skip-target">
                <div class="container">
                    <h2 class="main-title">@yield('title')</h2>
                    @if (session('success') ||session('error'))
                    <div class="alert alert-{{session('success')?'primary':'danger'}}" role="alert">
                        <strong>{{session('success')?session('success') : session('error')}}</strong>
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
            </main>

            @include('template.inc.foot')
        </div>
    </div>
    @include('template.inc.script')

</body>

</html>
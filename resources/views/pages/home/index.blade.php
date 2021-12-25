@extends('template.index')

@section('title', 'Home')

@section('content')
    <div class="row stat-cards">
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                    <i data-feather="bar-chart-2" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">1478 286</p>
                    <p class="stat-cards-info__title">Total visits</p>
                    <p class="stat-cards-info__progress">
                        <span class="stat-cards-info__profit success">
                            <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                        </span>
                        Last month
                    </p>
                </div>
            </article>
        </div>
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
                <div class="stat-cards-icon warning">
                    <i data-feather="file" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">1478 286</p>
                    <p class="stat-cards-info__title">Total visits</p>
                    <p class="stat-cards-info__progress">
                        <span class="stat-cards-info__profit success">
                            <i data-feather="trending-up" aria-hidden="true"></i>0.24%
                        </span>
                        Last month
                    </p>
                </div>
            </article>
        </div>
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
                <div class="stat-cards-icon purple">
                    <i data-feather="file" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">1478 286</p>
                    <p class="stat-cards-info__title">Total visits</p>
                    <p class="stat-cards-info__progress">
                        <span class="stat-cards-info__profit danger">
                            <i data-feather="trending-down" aria-hidden="true"></i>1.64%
                        </span>
                        Last month
                    </p>
                </div>
            </article>
        </div>
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
                <div class="stat-cards-icon success">
                    <i data-feather="feather" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">1478 286</p>
                    <p class="stat-cards-info__title">Total visits</p>
                    <p class="stat-cards-info__progress">
                        <span class="stat-cards-info__profit warning">
                            <i data-feather="trending-up" aria-hidden="true"></i>0.00%
                        </span>
                        Last month
                    </p>
                </div>
            </article>
        </div>
    </div>

    @auth
        @if (Auth::user()->role === 'people')

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <form action="{{ route('user.update', Auth::user()->id) }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control"
                                        value="{{ Auth::user()->people->nik }}">
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="place_of_birth">Tempat Lahir</label>
                                            <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                                                value="{{ Auth::user()->people->place_of_birth }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="date_of_birth">Kandangan Lahir</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                                                value="{{ date('Y-m-d', strtotime(Auth::user()->people->date_of_birth)) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select class="form-control" name="gender">
                                        <option value="">Pilih</option>
                                        <option {{ Auth::user()->people->gender == 'male' ? 'selected' : '' }} value="male">
                                            Laki-laki
                                        </option>
                                        <option {{ Auth::user()->people->gender == 'female' ? 'selected' : '' }}
                                            value="female">
                                            Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone">No.Handphone</label>
                                    <input type="tel" name="phone" id="phone" class="form-control"
                                        value="{{ Auth::user()->people->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="ktp" class="d-block">Scane KTP</label>
                                    <img src="{{ url('storage') . '/' . Auth::user()->people->ktp }}" class="img-fluid"
                                        width="" alt="">
                                    <input type="file" name="ktp" id="ktp" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="kk" class="d-block">Scane KK</label>
                                    <img src="{{ url('storage') . '/' . Auth::user()->people->kk }}" class="img-fluid"
                                        width="" alt="">
                                    <input type="file" name="kk" id="kk" class="form-control">
                                </div>
                                <button class="btn btn-primary">
                                    <i class="fas fa-save fa-fw"></i>
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection

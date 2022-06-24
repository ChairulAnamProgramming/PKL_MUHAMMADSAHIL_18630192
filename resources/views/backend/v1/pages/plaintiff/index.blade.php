@extends('backend.v1.template.index')

@section('title', 'Data Semua Penggugat')

@section('content')
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#penggugat">
        <i class="fas fa-plus fa-fw"></i>
        Penggugat Baru
    </button> --}}
    <div class="card">
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-12 table-responsive">
                    <table class="table table-sm datatables rounded" width="100%">
                        <thead class="bg-primary ">
                            <tr class="users-table-info text-white">
                                <th>#</th>
                                <th>
                                    <i class="fas fa-cog fa-fw"></i>
                                </th>
                                <th>Tanggal</th>
                                <th>No.Perkara</th>
                                <th>Status</th>
                                <th>Nama & Foto</th>
                                <th>Email</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Tempat & Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Telpon</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($submissions as $submission)
                                @switch($submission->status)
                                    @case('proses')
                                        @php
                                            $valueStatus = 25;
                                        @endphp
                                    @break

                                    @case('payment')
                                        @php
                                            $valueStatus = 50;
                                        @endphp
                                    @break

                                    @case('scheduling')
                                        @php
                                            $valueStatus = 75;
                                        @endphp
                                    @break

                                    @case('success')
                                        @php
                                            $valueStatus = 100;
                                        @endphp
                                    @break

                                    @case('reject')
                                        @php
                                            $valueStatus = 0;
                                        @endphp
                                    @break
                                @endswitch
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                    </td>
                                    <td>{{ $submission->created_at }}</td>
                                    <td>{{ $submission->number }}</td>
                                    <td
                                        class="{{ $valueStatus === 100 ? 'text-success' : 'text-primary' }} {{ $valueStatus === 0 ? 'text-danger' : '' }}">
                                        {{ $submission->status }}
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped {{ $valueStatus === 100 ? 'bg-success' : '' }} {{ $valueStatus === 0 ? 'bg-danger' : '' }}"
                                                role="progressbar" style="width: {{ $valueStatus }}%" aria-valuenow="10"
                                                aria-valuemin="0" aria-valuemax="100">{{ $valueStatus }}%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <label class="users-table__checkbox">
                                            <div class="categories-table-img">
                                                <picture>
                                                    <img src="{{ $submission->user->profile_photo_url }}" alt=""
                                                        class="img-fluid rounded">
                                                </picture>
                                                {{ $submission->user->name }}
                                            </div>
                                        </label>
                                    </td>
                                    <td>{{ $submission->user->email }}</td>
                                    <td>{{ $submission->user->people->nik }}</td>
                                    <td>{{ $submission->user->people->address }}</td>
                                    <td>{{ $submission->user->people->place_of_birth . ', ' . date('d-m-Y', strtotime($submission->user->people->date_of_birth)) }}
                                    </td>
                                    <td>{{ $submission->user->people->gender }}</td>
                                    <td>{{ $submission->user->people->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="penggugat" tabindex="-1" aria-labelledby="penggugatLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form" action="{{ route('plaintiff.store') }}" method="POST">
                    @csrf
                    <div id="patch"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="penggugatLabel">
                            Tambah Penggugat Baru
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-label-wrapper">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-input" placeholder="Tulis nama penggugat disini">
                        </div>
                        <div class="form-label-wrapper">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-input" placeholder="Tulis email penggugat disini">
                        </div>
                        <div class="form-label-wrapper">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                                class="form-input" placeholder="Tulis nik penggugat disini">
                        </div>
                        <div class="form-label-wrapper">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea type="text" name="address" id="address" class="form-input" placeholder="Tulis alamat penggugat disini">{{ old('address') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-label-wrapper">
                                    <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                                    <input type="text" name="place_of_birth" id="place_of_birth"
                                        value="{{ old('place_of_birth') }}" class="form-input"
                                        placeholder="Tulis tempat lahir penggugat disini">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-label-wrapper">
                                    <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth"
                                        value="{{ old('date_of_birth') ? date('Y-m-d', strtotime(old('date_of_birth'))) : date('Y-m-d') }}"
                                        class="form-input" placeholder="Tulis tanggal lahir penggugat disini">
                                </div>
                            </div>
                        </div>
                        <div class="form-label-wrapper">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select name="gender" id="gender" value="{{ old('gender') }}" class="form-input">
                                <option value="">Pilih Jenis Kelamin penggugat</option>
                                <option value="male">Laki-Laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-label-wrapper">
                            <label for="phone" class="form-label">Telpon/Wa</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="form-input" placeholder="Tulis nomor telpon penggugat disini">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('after-js')
        <script>
            $('.btn-edit').on('click', function() {
                const url = $(this).data('url');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const nik = $(this).data('nik');
                const address = $(this).data('address');
                const place_of_birth = $(this).data('place_of_birth');
                const date_of_birth = $(this).data('date_of_birth');
                const gender = $(this).data('gender');
                const phone = $(this).data('phone');
                $('#penggugatLabel').html('Edit Penggugat ' + name)
                $('#name').val(name);
                $('#email').val(email);
                $('#email').prop('disabled', true);
                $('#nik').val(nik);
                $('#address').val(address);
                $('#place_of_birth').val(place_of_birth);
                $('#date_of_birth').val(date_of_birth);
                $('#gender').val(gender);
                $('#phone').val(phone);
                $('#form').attr('action', url);
                $('#patch').html(`<input type="hidden" name="_method" value="PATCH">`)
            })
        </script>
    @endpush







@endsection

@extends('backend.v1.template.index')

@section('title', 'Data Semua Karyawan')
@push('after-js')
    <script>
        $('.btn-edit').on('click', function() {
            const url = $(this).data('url');
            const name = $(this).data('name');
            const email = $(this).data('email');
            const nip = $(this).data('nip');
            const position = $(this).data('position');
            const golongan = $(this).data('golongan');
            const place_of_birth = $(this).data('place_of_birth');
            const date_of_birth = $(this).data('date_of_birth');
            const phone = $(this).data('phone');
            const address = $(this).data('address');
            $('#karyawanLabel').html('Edit Karyawan ' + name)
            $('#name').val(name);
            $('#email').val(email);
            $('#email').prop('disabled', true);
            $('#nip').val(nip);
            $('#position').val(position);
            $('#golongan').val(golongan);
            $('#place_of_birth').val(place_of_birth);
            $('#date_of_birth').val(date_of_birth);
            $('#phone').val(phone);
            $('#address').val(address);
            $('#form').attr('action', url);
            $('#patch').html(`<input type="hidden" name="_method" value="PATCH">`)
        })
    </script>
@endpush
@section('button')
    <button type="button" class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#karyawan">
        <i class="fas fa-plus fa-fw"></i>
        Karyawan Baru
    </button>
@endsection
@section('content')
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table table-sm datatables rounded" width="100%">
                        <thead class="bg-primary ">
                            <tr class="users-table-info text-white">
                                <th>#</th>
                                <th><i class="fas fa-cog fa-fw"></i></th>
                                <th>Nama & Foto</th>
                                <th>Email</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Golongan</th>
                                <th>Tempat & Tanggal Lahir</th>
                                <th>No.Telpon</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-light btn-edit" data-toggle="modal"
                                                data-target="#karyawan"
                                                data-url="{{ route('employee.update', $employee->id) }}"
                                                data-name="{{ $employee->user->name }}"
                                                data-email="{{ $employee->user->email }}"
                                                data-nip="{{ $employee->nip }}"
                                                data-position="{{ $employee->position }}"
                                                data-golongan="{{ $employee->golongan }}"
                                                data-place_of_birth="{{ $employee->place_of_birth }}"
                                                data-date_of_birth="{{ $employee->date_of_birth }}"
                                                data-phone="{{ $employee->phone }}"
                                                data-address="{{ $employee->address }}">
                                                <i class="fas fa-edit fa-fw"></i>
                                                Edit
                                            </button>
                                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-light text-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-times fa-fw"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <label class="users-table__checkbox">
                                            <div class="categories-table-img">
                                                <img src="{{ $employee->user->profile_photo_url }}" alt=""
                                                    class="img-fluid rounded-circle" width="40">
                                                <span class="d-block">
                                                    {{ $employee->user->name }}
                                                </span>
                                            </div>
                                        </label>
                                    </td>
                                    <td>{{ $employee->user->email }}</td>
                                    <td>{{ $employee->nip }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ $employee->golongan }}</td>
                                    <td>{{ $employee->place_of_birth . ',' . date('d-m-Y', strtotime($employee->date_of_birth)) }}
                                    </td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="karyawan" tabindex="-1" aria-labelledby="karyawanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form" action="{{ route('employee.store') }}" method="POST">
                    @csrf
                    <div id="patch"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="karyawanLabel">
                            Tambah Karyawan Baru
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control" placeholder="Tulis nama karyawan disini">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-control" placeholder="Tulis email karyawan disini">
                        </div>
                        <div class="form-group">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" id="nip" value="{{ old('nip') }}"
                                class="form-control" placeholder="Tulis nip karyawan disini">
                        </div>
                        <div class="form-group">
                            <label for="position" class="form-label">Jabatan</label>
                            <input type="text" name="position" id="position" value="{{ old('position') }}"
                                class="form-control" placeholder="Tulis jabatan karyawan disini">
                        </div>
                        <div class="form-group">
                            <label for="golongan" class="form-label">Golongan</label>
                            <input type="text" name="golongan" id="golongan" value="{{ old('golongan') }}"
                                class="form-control" placeholder="Tulis golongan karyawan disini">
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                                <input type="text" name="place_of_birth" id="place_of_birth"
                                    value="{{ old('place_of_birth') }}" class="form-control"
                                    placeholder="Tulis tempat lahir karyawan disini">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="date_of_birth" class="form-label">Tempat Lahir</label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ date('Y-m-d') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">No.Telpon</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="form-control" placeholder="Tulis telpon karyawan disini">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address" value="{{ old('address') }}" class="form-control"
                                placeholder="Tulis alamat lengkap karyawan disini"></textarea>
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
@endsection

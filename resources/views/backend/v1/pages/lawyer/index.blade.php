@extends('backend.v1.template.index')

@section('title', 'Data Semua Pengacara')
@section('button')
    <button type="button" class="btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#pengacara">
        <i class="fas fa-plus fa-fw"></i>
        Pengacara Baru
    </button>
@endsection
@push('after-js')
    <script>
        $('#nip').on('input', function() {
            $('#name').val('');
            $('#email').val('');
            $('#position').val('');
            $('#golongan').val('');
            $('#place_of_birth').val('');
            $('#date_of_birth').val('');
            $('#phone').val('');
            $('#address').val('');
            const nip = $(this).val();
            $.ajax({
                url: `{{ url('/check/${nip}/employee') }}`,
                type: 'GET',
                success: function(res) {
                    $('#name').val(res.user.name);
                    $('#email').val(res.user.email);
                    $('#position').val(res.position);
                    $('#golongan').val(res.golongan);
                    $('#place_of_birth').val(res.place_of_birth);
                    $('#date_of_birth').val(res.date_of_birth);
                    $('#phone').val(res.phone);
                    $('#address').val(res.address);
                }
            })
        });
    </script>
@endpush
@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('lawyer.destroy', $employee->id) }}" method="POST">
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
    <div class="modal fade" id="pengacara" tabindex="-1" aria-labelledby="pengacaraLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form" action="{{ route('lawyer.store') }}" method="POST">
                    @csrf
                    <div id="patch"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="hakimLabel">
                            Tambah Hakim Baru
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" id="nip" value="{{ old('nip') }}"
                                class="form-control" placeholder="Tulis nip pengacara disini">
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control" placeholder="Tulis nama karyawan disini" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-control" placeholder="Tulis email karyawan disini" readonly>
                        </div>
                        <div class="form-group">
                            <label for="position" class="form-label">Jabatan</label>
                            <input type="text" name="position" id="position" value="{{ old('position') }}"
                                class="form-control" placeholder="Tulis jabatan karyawan disini" readonly>
                        </div>
                        <div class="form-group">
                            <label for="golongan" class="form-label">Golongan</label>
                            <input type="text" name="golongan" id="golongan" value="{{ old('golongan') }}"
                                class="form-control" placeholder="Tulis golongan karyawan disini" readonly>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                                <input type="text" name="place_of_birth" id="place_of_birth"
                                    value="{{ old('place_of_birth') }}" class="form-control"
                                    placeholder="Tulis tempat lahir karyawan disini" readonly>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="date_of_birth" class="form-label">Tempat Lahir</label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ date('Y-m-d') }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">No.Telpon</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="form-control" placeholder="Tulis telpon karyawan disini" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address" value="{{ old('address') }}" class="form-control"
                                placeholder="Tulis alamat lengkap karyawan disini" readonly></textarea>
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

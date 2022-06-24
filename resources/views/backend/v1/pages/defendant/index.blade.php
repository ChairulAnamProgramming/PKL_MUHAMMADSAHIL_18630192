@extends('template.index')

@section('title','Daftar Semua Tergugat')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tergugat">
    <i class="fas fa-plus fa-fw"></i>
    Tergugat Baru
</button>
<div class="row mt-3">
    <div class="col-12">
        <table class="table table-sm datatables rounded" width="100%">
            <thead class="bg-primary ">
                <tr class="users-table-info text-white">
                    <th>#</th>
                    <th>Nama & Foto</th>
                    <th>Email</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th>Tempat & Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Telpon</th>
                    <th><span class="text-danger">*</span></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($peoples as $people)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <label class="users-table__checkbox">
                            <div class="categories-table-img">
                                <picture>
                                    <img src="{{$people->user->profile_photo_url}}" alt="" class="img-fluid rounded">
                                </picture>
                                {{$people->user->name}}
                            </div>
                        </label>
                    </td>
                    <td>{{$people->user->email}}</td>
                    <td>{{$people->nik}}</td>
                    <td>{{$people->address}}</td>
                    <td>{{$people->place_of_birth.', '.date('d-m-Y',strtotime($people->date_of_birth))}}</td>
                    <td>{{$people->gender}}</td>
                    <td>{{$people->phone}}</td>
                    <td>
                        <span class="p-relative">
                            <button class="dropdown-btn transparent-btn" type="button" title="More info">
                                <div class="sr-only">More info</div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-horizontal" aria-hidden="true">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </button>
                            <ul class="users-item-dropdown dropdown">
                                <li>
                                    <button class="btn btn-sm btn-light btn-edit" data-toggle="modal"
                                        data-target="#tergugat" data-url="{{route('defendant.update',$people->id)}}"
                                        data-name="{{$people->user->name}}" data-email="{{$people->user->email}}"
                                        data-nik="{{$people->nik}}" data-address="{{$people->address}}"
                                        data-place_of_birth="{{$people->place_of_birth}}"
                                        data-date_of_birth="{{$people->date_of_birth}}"
                                        data-gender="{{$people->gender}}" data-phone="{{$people->phone}}">Edit</button>
                                </li>
                                <li>
                                    <form action="{{route('defendant.destroy',$people->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tergugat" tabindex="-1" aria-labelledby="penggugatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form" action="{{route('defendant.store')}}" method="POST">
                @csrf
                <div id="patch"></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="penggugatLabel">
                        Tambah Tergugat Baru
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-label-wrapper">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-input"
                            placeholder="Tulis nama tergugat disini">
                    </div>
                    <div class="form-label-wrapper">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-input"
                            placeholder="Tulis email tergugat disini">
                    </div>
                    <div class="form-label-wrapper">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" id="nik" value="{{old('nik')}}" class="form-input"
                            placeholder="Tulis nik tergugat disini">
                    </div>
                    <div class="form-label-wrapper">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea type="text" name="address" id="address" class="form-input"
                            placeholder="Tulis alamat tergugat disini">{{old('address')}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-label-wrapper">
                                <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                                <input type="text" name="place_of_birth" id="place_of_birth"
                                    value="{{old('place_of_birth')}}" class="form-input"
                                    placeholder="Tulis tempat lahir tergugat disini">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-label-wrapper">
                                <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{old('date_of_birth')?date('Y-m-d',strtotime(old('date_of_birth'))):date('Y-m-d')}}"
                                    class="form-input" placeholder="Tulis tanggal lahir tergugat disini">
                            </div>
                        </div>
                    </div>
                    <div class="form-label-wrapper">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" id="gender" value="{{old('gender')}}" class="form-input">
                            <option value="">Pilih Jenis Kelamin tergugat</option>
                            <option value="male">Laki-Laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-label-wrapper">
                        <label for="phone" class="form-label">Telpon/Wa</label>
                        <input type="text" name="phone" id="phone" value="{{old('phone')}}" class="form-input"
                            placeholder="Tulis nomor telpon tergugat disini">
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
    $('.btn-edit').on('click',function(){
        const url = $(this).data('url');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const nik = $(this).data('nik');
        const address = $(this).data('address');
        const place_of_birth = $(this).data('place_of_birth');
        const date_of_birth = $(this).data('date_of_birth');
        const gender = $(this).data('gender');
        const phone = $(this).data('phone');
        $('#penggugatLabel').html('Edit Tergugat '+name)
        $('#name').val(name);
        $('#email').val(email);
        $('#email').prop('disabled', true);
        $('#nik').val(nik);
        $('#address').val(address);
        $('#place_of_birth').val(place_of_birth);
        $('#date_of_birth').val(date_of_birth);
        $('#gender').val(gender);
        $('#phone').val(phone);
        $('#form').attr('action',url);
        $('#patch').html(`<input type="hidden" name="_method" value="PATCH">`)
    })
</script>
@endpush







@endsection
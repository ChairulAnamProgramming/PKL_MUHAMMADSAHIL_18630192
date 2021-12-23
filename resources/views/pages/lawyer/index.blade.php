@extends('template.index')

@section('title','Daftar Semua Pengacara')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pengacara">
    <i class="fas fa-plus fa-fw"></i>
    Pengacara Baru
</button>
<div class="row mt-3">
    <div class="col-12">
        <table class="table table-sm datatables rounded" width="100%">
            <thead class="bg-primary ">
                <tr class="users-table-info text-white">
                    <th>#</th>
                    <th>Nama & Foto</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th><span class="text-danger">*</span></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($lawyers as $lawyer)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <label class="users-table__checkbox">
                            <div class="categories-table-img">
                                <picture>
                                    <img src="{{$lawyer->user->profile_photo_url}}" alt="" class="img-fluid rounded">
                                </picture>
                                {{$lawyer->user->name}}
                            </div>
                        </label>
                    </td>
                    <td>{{$lawyer->user->email}}</td>
                    <td>{{$lawyer->nip}}</td>
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
                                        data-target="#pengacara" data-url="{{route('lawyer.update',$lawyer->id)}}"
                                        data-name="{{$lawyer->user->name}}" data-email="{{$lawyer->user->email}}"
                                        data-nip="{{$lawyer->nip}}">Edit</button>
                                </li>
                                <li>
                                    <form action="{{route('lawyer.destroy',$lawyer->id)}}" method="POST">
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
<div class="modal fade" id="pengacara" tabindex="-1" aria-labelledby="pengacaraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form" action="{{route('lawyer.store')}}" method="POST">
                @csrf
                <div id="patch"></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="pengacaraLabel">
                        Tambah Pengacara Baru
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-label-wrapper">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-input"
                            placeholder="Tulis nama pengacara disini">
                    </div>
                    <div class="form-label-wrapper">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-input"
                            placeholder="Tulis email pengacara disini">
                    </div>
                    <div class="form-label-wrapper">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" name="nip" id="nip" value="{{old('nip')}}" class="form-input"
                            placeholder="Tulis nip pengacara disini">
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
        const nip = $(this).data('nip');
        $('#karyawanLabel').html('Edit Karyawan '+name)
        $('#name').val(name);
        $('#email').val(email);
        $('#email').prop('disabled', true);
        $('#nip').val(nip);
        $('#form').attr('action',url);
        $('#patch').html(`<input type="hidden" name="_method" value="PATCH">`)
    })
</script>
@endpush







@endsection
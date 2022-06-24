@extends('backend.v1.template.index')

@section('title', 'Data Ruangan')

@push('after-js')
    <script>
        $('.btn-edit').on('click', function() {
            const name = $(this).data('name');
            const url = $(this).data('url');

            $('#name').val(name);
            $('#form-room').attr('action', url);
            $('#method').html('<input type="hidden" name="_method" value="PATCH">');
        });
    </script>
@endpush
@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card border-0 rounded">
                <div class="card-body">
                    <form action="{{ route('room.store') }}" id="form-room" method="POST">
                        @csrf
                        <div id="method"></div>
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <button class="btn btn-primary">
                            <i class="fas fa-save fa-fw"></i>
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card border-0 rounded">
                <div class="card-body">
                    <table class="table-sm datatables" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>
                                    <span class="text-danger">*</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>
                                        <form action="{{ route('room.destroy', $room->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn text-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?');">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>
                                        <button class="btn text-secondary btn-sm btn-edit" data-name="{{ $room->name }}"
                                            data-url="{{ route('room.update', $room->id) }}">
                                            <i class="fas fa-edit fa-fw"></i>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

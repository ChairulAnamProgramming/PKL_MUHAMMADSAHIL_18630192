@extends('template.index')

@section('title', 'Pengajuan Perkara ' . $filingOfMatter->name)

@section('content')

    <div class="row">
        <div class="col-12 col-md-4">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" readonly>
                </div>
            </form>
        </div>
    </div>

@endsection

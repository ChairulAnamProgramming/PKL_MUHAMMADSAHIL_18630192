@extends('template.print')


@section('content')

    <table class="table table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Nama</th>
                <th>Perkara</th>
                <th>Nama Tergugat</th>
                <th>Nama Ayah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->number }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->filing_of_matter->name }}</td>
                    <td>{{ $item->defendant_name }}</td>
                    <td>{{ $item->father_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

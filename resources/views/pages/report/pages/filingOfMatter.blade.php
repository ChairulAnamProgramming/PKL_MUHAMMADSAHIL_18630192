@extends('template.print')

@section('content')

    @if ($status === 'proses')
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Number</th>
                    <th>Nama</th>
                    <th>Perkara</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->number }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->filing_of_matter->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

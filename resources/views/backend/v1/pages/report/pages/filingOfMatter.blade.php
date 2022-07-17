@extends('backend.v1.template.print')

@section('content')

    @if ($status === 'proses' || $status === 'reject' || $status === 'payment' || $status === 'scheduling')
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nomor</th>
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

    @if ($status === 'success')
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>Perkara</th>
                    <th>Jadwal Sidang</th>
                    <th>Jam Sidang</th>
                    <th>Ruangan</th>
                    <th>Nama Ayah</th>
                    <th>Nama Tergugat</th>
                    <th>Nama Saksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->number }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->filing_of_matter->name }}</td>
                        <td>{{ $item->timetable }}</td>
                        <td>{{ $item->time }}</td>
                        <td>
                            <ul>
                                @foreach ($item->rooms as $room)
                                    <li>{{ $room->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $item->father_name }}</td>
                        <td>{{ $item->defendant_name }}</td>
                        <td>
                            <ul>
                                <li>{{ $item->saksi_1 }}</li>
                                <li>{{ $item->saksi_2 }}</li>
                                <li>{{ $item->saksi_3 }}</li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

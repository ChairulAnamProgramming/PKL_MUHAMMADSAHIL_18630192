@extends('backend.v1.template.index')

@section('title', 'Pengajuan Perkara')

@push('after-css')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> --}}
@endpush
@push('after-js')
    <!-- Latest compiled and minified JavaScript -->
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('.selectpicker').selectpicker();
</script> --}}
@endpush
@section('content')


    <?php echo $title; ?>
    <div class="card border-0 rounded">
        <div class="card-body">
            {{-- <table class="table table-sm table-striped table-bordered datatables">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>#</th>
                        <th>Jenis Perkara</th>
                        <th>Status</th>
                        <th>Tanggal Permohonan</th>
                        <th><span class="text-danger">*</span></th>
                    </tr>
                </thead>
                <tbody>
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
                                <b>{{ $submission->filing_of_matter->name }}</b>
                            </td>
                            <td
                                class="{{ $valueStatus === 100 ? 'text-success' : 'text-primary' }} {{ $valueStatus === 0 ? 'text-danger' : '' }}">
                                {{ $submission->status }}
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped {{ $valueStatus === 100 ? 'bg-success' : '' }} {{ $valueStatus === 0 ? 'bg-danger' : '' }}"
                                        role="progressbar" style="width: {{ $valueStatus }}%" aria-valuenow="10"
                                        aria-valuemin="0" aria-valuemax="100">{{ $valueStatus }}%</div>
                                </div>
                            </td>
                            <td>{{ $submission->created_at }}</td>
                            <td>
                                @if ($submission->status === 'proses')
                                    <form action="{{ route('submission.destroy', $submission->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-danger"
                                            onclick="return confirm('Apakah anda yakin ingin membatalkan perkara ini?');">
                                            <i class="fas fa-times fa-fw"></i>
                                            Batalkan
                                        </button>
                                    </form>
                                @endif
                                @if ($submission->status === 'payment')
                                    <button class="btn text-secondary" data-toggle="modal"
                                        data-target="#modelPayment-{{ $submission->id }}">
                                        <i class="fas fa-money-bill-wave-alt fa-fw"></i>
                                        Bayar Pengajuan Perkara
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modelPayment-{{ $submission->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('submission.update', $submission->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Pembayaran {{ $submission->filing_of_matter->name }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-label-wrapper">
                                                            <label for="proof_of_payment" class="form-label">Upload
                                                                Bukti
                                                                Pembayaran
                                                            </label>
                                                            <input type="hidden" name="status" value="scheduling">
                                                            <input type="file" name="proof_of_payment"
                                                                id="proof_of_payment" class="form-input">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button class="btn btn-primary">Bayar Pengajuan
                                                            Perkara</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->status === 'scheduling')
                                    <button class="btn text-warning">
                                        <i class="fas fa-clock fa-fw"></i>
                                        Menunggu Jadwal
                                    </button>
                                @endif
                                @if (Auth::user()->role === 'admin')
                                    @if ($submission->status === 'proses')
                                        <a href="javascrypt:;" class="btn text-secondary" data-toggle="modal"
                                            data-target="#modalDetail-{{ $submission->id }}">
                                            <i class="fas fa-eye fa-fw"></i>
                                            Detail
                                        </a>
                                    @endif
                                    @if ($submission->status === 'payment')
                                        <button class="btn text-warning">
                                            <i class="fas fa-exclamation-triangle fa-fw"></i>
                                            Menunggu Pembayaran Penggugat
                                        </button>
                                    @endif
                                    @if ($submission->status === 'scheduling')
                                        <button class="btn text-primary" data-toggle="modal"
                                            data-target="#modelJadwal-{{ $submission->id }}">
                                            <i class="fas fa-calendar-alt fa-fw"></i>
                                            Buat Jadwal
                                        </button>
                                        <div class="modal fade" id="modelJadwal-{{ $submission->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('submission.update', $submission->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                Buat Jadwal {{ $submission->filing_of_matter->name }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-label-wrapper">
                                                                <label for="number" class="form-label">No.Perkara</label>
                                                                <input type="text" name="number" id="number"
                                                                    value="{{ $submission->number }}/PDT.{{ $submission->filing_of_matter->name }}/{{ date('Y') }}/NEGARA"
                                                                    class="form-input" readonly>
                                                                <input type="hidden" name="status" value="success">
                                                            </div>
                                                            <div class="form-label-wrapper">
                                                                <label for="timetable" class="form-label">Tanggal</label>
                                                                <input type="date" name="timetable" id="timetable"
                                                                    value="{{ date('Y-m-d') }}" class="form-input">
                                                            </div>
                                                            <div class="form-label-wrapper">
                                                                <label for="time" class="form-label">Waktu</label>
                                                                <input type="time" name="time" id="time"
                                                                    value="" class="form-input">
                                                            </div>
                                                            <div class="form-label-wrapper">
                                                                <label for="petugas" class="form-label">Petugas</label>
                                                                <select name="petugas[]" id="petugas"
                                                                    class="form-input" multiple>
                                                                    @foreach ($lawyers as $lawyer)
                                                                        <option value="{{ $lawyer->id }}">
                                                                            {{ $lawyer->user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-label-wrapper">
                                                                <label for="room" class="form-label">Ruangan</label>
                                                                <select class="form-input" name="room[]" multiple>
                                                                    @foreach ($rooms as $room)
                                                                        <option value="{{ $room->id }}">
                                                                            {{ $room->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-label-wrapper">
                                                                <label for="father_name" class="form-label">Nama
                                                                    Ayah</label>
                                                                <input type="text" name="father_name" id="father_name"
                                                                    value="" class="form-input">
                                                            </div>
                                                            <div class="form-label-wrapper">
                                                                <label for="defendant_name" class="form-label">
                                                                    Nama Tergugat
                                                                </label>
                                                                <input type="text" name="defendant_name"
                                                                    id="defendant_name"
                                                                    placeholder="Isi nama tergugat setelah itu isikan BIN/BINTI cth: user bin user"
                                                                    class="form-input">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button class="btn btn-primary">
                                                                Buat Jadwal
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if ($submission->status === 'success')
                                    <button class="btn text-success" data-toggle="modal"
                                        data-target="#modelSuccess-{{ $submission->id }}">
                                        <i class="fas fa-search e fa-fw"></i>
                                        Jadwal Sidang
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modelSuccess-{{ $submission->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Jadwal Sidang</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-label-wrapper">
                                                        <label for="name" class="form-label">No.Perkara</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $submission->number }}" class="form-input"
                                                            readonly>
                                                    </div>
                                                    <div class="form-label-wrapper">
                                                        <label for="name" class="form-label">Nama</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $submission->user->name }}" class="form-input"
                                                            readonly>
                                                    </div>
                                                    <div class="form-label-wrapper">
                                                        <label for="name" class="form-label">Tanggal</label>
                                                        <input type="date" name="name" id="name"
                                                            value="{{ date('Y-m-d', strtotime($submission->timetable)) }}"
                                                            class="form-input" readonly>
                                                    </div>
                                                    <div class="form-label-wrapper">
                                                        <label for="name" class="form-label">Waktu</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $submission->time }}" readonly
                                                            class="form-input">
                                                    </div>
                                                    <div class="form-label-wrapper">
                                                        <label for="name" class="form-label">Nama Ayah</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $submission->father_name }}" readonly
                                                            class="form-input">
                                                    </div>
                                                    <div class="form-label-wrapper">
                                                        <label for="name" class="form-label">Nama Tergugat</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $submission->defendant_name }}" readonly
                                                            class="form-input">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="modalDetail-{{ $submission->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content border-0">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">{{ $submission->filing_of_matter->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body border-0">

                                        <div class="form-label-wrapper">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ $submission->user->name }}" class="form-input">
                                        </div>
                                        <div class="form-label-wrapper">
                                            <label for="name" class="form-label">NIK</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ $submission->user->people->nik }}" class="form-input">
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-label-wrapper">
                                                    <label for="name" class="form-label">Tempat Lahir</label>
                                                    <input type="text" name="name" id="name"
                                                        value="{{ $submission->user->people->place_of_birth }}"
                                                        class="form-input">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-label-wrapper">
                                                    <label for="name" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" name="name" id="name"
                                                        value="{{ date('Y-m-d', strtotime($submission->user->people->date_of_birth)) }}"
                                                        class="form-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-label-wrapper">
                                            <label for="name" class="form-label">Alamat</label>
                                            <textarea type="text" name="name" id="name" class="form-input">{{ $submission->user->people->address }}</textarea>
                                        </div>
                                        <div class="form-label-wrapper">
                                            <label for="name" class="form-label">Telpon</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ $submission->user->people->phone }}" class="form-input">
                                        </div>
                                        <div class="form-label-wrapper">
                                            <label for="name" class="form-label">KTP</label>
                                            <img src="{{ url('storage') . '/' . $submission->user->people->ktp }}"
                                                class="img-fluid rounded" alt="KTP" width="50%">
                                        </div>
                                        <div class="form-label-wrapper">
                                            <label for="name" class="form-label">KK</label>
                                            <img src="{{ url('storage') . '/' . $submission->user->people->kk }}"
                                                class="img-fluid rounded" alt="KK" width="50%">
                                        </div>


                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <form action="{{ route('submission.update', $submission->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="reject">
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menolak pengajuan ini?');">
                                                Reject
                                            </button>
                                        </form>
                                        <form action="{{ route('submission.update', $submission->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="payment">
                                            <button class="btn btn-primary">
                                                Accept
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <br><br>
            <hr> --}}
            <h4>Menu Layanan Perkara</h6>
                <div class="row justify-content-center">
                    @foreach ($filingOfMatters as $filingOfMatter)
                        <div class="col-4 col-md-2 text-center">
                            <a href="javascrypt:;" data-toggle="modal" data-target="#modelId-{{ $filingOfMatter->id }}">
                                <img src="{{ url('storage') . '/' . $filingOfMatter->icon }}" class="img-fluid"
                                    alt="Folder">
                                <small><strong class="text-dark">{{ $filingOfMatter->name }}</strong></small>
                            </a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade " id="modelId-{{ $filingOfMatter->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <form action="{{ route('submission.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content  border-0">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">{{ $filingOfMatter->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-secondary">
                                            <h6 class="text-dark">Persyaratan yang harus di bawa :</h6>
                                            {!! $filingOfMatter->description !!}
                                            <br>
                                            <h5 class="text-danger">
                                                Total Biaya : Rp.{{ number_format($filingOfMatter->price, 2, ',', '.') }}
                                            </h5>
                                            <input type="hidden" name="filing_of_matter_id"
                                                value="{{ $filingOfMatter->id }}">
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button class="btn btn-sm btn-primary">
                                                Ajukan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

        </div>
    </div>



@endsection

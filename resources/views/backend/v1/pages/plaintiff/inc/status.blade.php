@push('after-css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
@endpush
@push('after-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>
@endpush
@if ($submission->status === 'proses')
    <form action="{{ route('submission.destroy', $submission->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn bg-gray btn-sm text-danger"
            onclick="return confirm('Apakah anda yakin ingin membatalkan perkara ini?');">
            <i class="fas fa-times fa-fw"></i>
            Batalkan
        </button>
    </form>
@endif
@if ($submission->status === 'payment')
    <button class="btn bg-gray text-secondary" data-toggle="modal" data-target="#modelPayment-{{ $submission->id }}">
        <i class="fas fa-money-bill-wave-alt fa-fw"></i>
        Konfirmasi Pembayaran
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modelPayment-{{ $submission->id }}" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('submission.update', $submission->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Pembayaran Perkara {{ $submission->filing_of_matter->name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-dark">
                            <b>
                                Rekening :
                                {{ $submission->filing_of_matter->name_rek . '-' . $submission->filing_of_matter->rek }}
                            </b>
                        </h4>
                        <h5 class="text-dark">
                            <b>
                                Total Pembayaran :
                                Rp.{{ number_format($submission->filing_of_matter->price, 2, ',', '.') }}
                            </b>
                        </h5>
                        <div class="form-group">
                            <label for="proof_of_payment">Upload
                                Bukti

                            </label>
                            <input type="hidden" name="status" value="scheduling">
                            <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-input">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-dismiss="modal">Tutup</button>
                        <button class="btn btn-sm btn-primary">
                            Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@if ($submission->status === 'scheduling')
    <button class="btn bg-gray text-warning">
        <i class="fas fa-clock fa-fw"></i>
        Menunggu Jadwal
    </button>
@endif
@if (Auth::user()->role === 'admin')
    @if ($submission->status === 'proses')
        <a href="javascrypt:;" class="btn btn-sm text-secondary" data-toggle="modal"
            data-target="#modalDetail-{{ $submission->id }}">
            <i class="fas fa-eye fa-fw"></i>
            Detail
        </a>
        <div class="modal fade" id="modalDetail-{{ $submission->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-uppercase">Perkara {{ $submission->filing_of_matter->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table-sm">
                            <tr>
                                <td>NAMA</td>
                                <td>:</td>
                                <td>
                                    <b>
                                        {{ @$submission->user->name }}
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>
                                    <b>
                                        {{ @$submission->user->people->nik }}
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>TEMPAT & TANGGAL LAHIR</td>
                                <td>:</td>
                                <td>
                                    <b>
                                        {{ @$submission->user->people->place_of_birth . ',' . date('d-m-Y', strtotime($submission->user->people->place_of_birth)) }}
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>ALAMAT</td>
                                <td>:</td>
                                <td>
                                    <b>
                                        {{ @$submission->user->people->address }}
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>TELPON</td>
                                <td>:</td>
                                <td>
                                    <b>
                                        {{ @$submission->user->people->phone }}
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>KTP</td>
                                <td>:</td>
                                <td>
                                    <img src="{{ url('storage') . '/' . $submission->user->people->ktp }}"
                                        class="img-fluid rounded border" alt="KTP" width="20%">
                                </td>
                            </tr>
                            <tr>
                                <td>KARTU KELUARGA (KK)</td>
                                <td>:</td>
                                <td>
                                    <img src="{{ url('storage') . '/' . $submission->user->people->kk }}"
                                        class="img-fluid rounded border" alt="KK" width="20%">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ route('submission.update', $submission->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="reject">
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah anda yakin ingin menolak pengajuan ini?');">
                                Tolak
                            </button>
                        </form>
                        <form action="{{ route('submission.update', $submission->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="payment">
                            <button class="btn btn-sm btn-primary">
                                Terima
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($submission->status === 'payment')
        <button class="btn btn-sm bg-gray text-warning">
            <i class="fas fa-exclamation-triangle fa-fw"></i>
            Menunggu Pembayaran Penggugat
        </button>
    @endif
    @if ($submission->status === 'scheduling')
        <button class="btn bg-gray btn-sm btn-block text-primary" data-toggle="modal"
            data-target="#modelJadwal-{{ $submission->id }}">
            <i class="fas fa-calendar-alt fa-fw"></i>
            Buat Jadwal
        </button>
        <div class="modal fade" id="modelJadwal-{{ $submission->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="{{ route('submission.update', $submission->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Buat Jadwal {{ $submission->filing_of_matter->name }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="number">No.Perkara</label>
                                <input type="text" class="form-control" name="number" id="number"
                                    value="{{ $submission->number }}/PDT.{{ $submission->filing_of_matter->name }}/{{ date('Y') }}/NEGARA"
                                    class="form-input" readonly>
                                <input type="hidden" name="status" value="success">
                            </div>
                            <div class="form-group">
                                <label for="timetable">Tanggal</label>
                                <input type="date" class="form-control" name="timetable" id="timetable"
                                    value="{{ date('Y-m-d') }}" class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="time">Waktu</label>
                                <input type="time" name="time" id="time" value=""
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="hakim">Hakim</label>
                                @php
                                    $hakim = App\Models\Judge::all();
                                @endphp
                                <select name="hakim[]" id="hakim" class="form-control selectpicker" multiple>
                                    <option value=""></option>
                                    @foreach ($hakim as $hak)
                                        <option value="{{ $hak->id }}">
                                            {{ @$hak->employee->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pengacara">Pengacara</label>
                                @php
                                    $pengacara = App\Models\lawyer::all();
                                @endphp
                                <select name="pengacara[]" id="pengacara" class="form-control selectpicker">
                                    <option value=""></option>
                                    @foreach ($pengacara as $pengac)
                                        <option value="{{ $pengac->id }}">
                                            {{ @$pengac->employee->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="room">Ruangan</label>
                                <select class="form-control selectpicker" name="room[]" multiple>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">
                                            {{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="father_name">
                                    Nama Ayah
                                </label>
                                <input type="text" class="form-control" name="father_name" id="father_name" valu>
                            </div>
                            <div class="form-group">
                                <label for="defendant_name">
                                    Nama Tergugat
                                </label>
                                <input type="text" class="form-control" name="defendant_name" id="defendant_name"
                                    placeholder="Isi nama tergugat setelah itu isikan BIN/BINTI cth: user bin user">
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="saksi_1">
                                            Saksi 1
                                        </label>
                                        <input type="text" class="form-control" name="saksi_1" id="saksi_1"
                                            valu>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="saksi_2">
                                            Saksi 2
                                        </label>
                                        <input type="text" class="form-control" name="saksi_2" id="saksi_2"
                                            valu>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="saksi_3">
                                            Saksi 3
                                        </label>
                                        <input type="text" class="form-control" name="saksi_3" id="saksi_3"
                                            valu>
                                    </div>
                                </div>
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
    <button class="btn bg-gray btn-sm text-success" data-toggle="modal"
        data-target="#modelSuccess-{{ $submission->id }}">
        <i class="fas fa-search e fa-fw"></i>
        Jadwal Sidang
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modelSuccess-{{ $submission->id }}" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Jadwal Sidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table-sm">
                        <tr>
                            <td>No.Perkara</td>
                            <td>:</td>
                            <td>
                                <b>{{ $submission->number }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Penggugat</td>
                            <td>:</td>
                            <td>
                                <b>{{ $submission->user->name }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Hakim</td>
                            <td>:</td>
                            <td>
                                @foreach (@$submission->judges as $judge)
                                    <b class="d-block">
                                        {{ @$judge->employee->user->name }}
                                    </b>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Pengacara</td>
                            <td>:</td>
                            <td>
                                @foreach (@$submission->lawyers as $lawyer)
                                    <b class="d-block">
                                        {{ @$lawyer->employee->user->name }}
                                    </b>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Ruangan</td>
                            <td>:</td>
                            <td>
                                @foreach (@$submission->rooms as $room)
                                    <b class="d-block">
                                        {{ @$room->name }}
                                    </b>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal & Jam</td>
                            <td>:</td>
                            <td>
                                <b class="text-primary">
                                    {{ date('Y-m-d', strtotime($submission->timetable)) }}
                                    -
                                    {{ $submission->time }}
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Ayah</td>
                            <td>:</td>
                            <td>
                                <b>
                                    {{ $submission->father_name }}
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Tergugat</td>
                            <td>:</td>
                            <td>
                                <b>
                                    {{ $submission->defendant_name }}
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Saksi</td>
                            <td>:</td>
                            <td>
                                <ul>
                                    <li>{{ $submission->saksi_1 }}</li>
                                    <li>{{ $submission->saksi_2 }}</li>
                                    <li>{{ $submission->saksi_3 }}</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endif

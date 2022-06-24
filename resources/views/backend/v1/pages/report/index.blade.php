@extends('backend.v1.template.index')

@section('title', 'List Laporan')

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <h4>Laporan Perkara</h4>
                    <ul class="mt-4">
                        @foreach ($filingOfMatters as $filingOfMatter)
                            <li class="mb-2">
                                <a href="javascrypt:;" class="text-primary" data-toggle="modal"
                                    data-target="#modelId-{{ $filingOfMatter->id }}">Laporan
                                    {{ $filingOfMatter->name }}</a>
                            </li>

                            <!-- Modal -->
                            <div class="modal fade" id="modelId-{{ $filingOfMatter->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form
                                        action="{{ route('report.filing_of_matter', Crypt::encrypt($filingOfMatter->id)) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Laporan {{ $filingOfMatter->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="firstDate" class="form-label">Tanggal Awal</label>
                                                    <input type="date" name="firstDate" id="firstDate"
                                                        value="{{ date('Y-m-d') }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastDate" class="form-label">Tanggal Ahir</label>
                                                    <input type="date" name="lastDate" id="lastDate"
                                                        value="{{ date('Y-m-d', strtotime('+30 days')) }}"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastDate" class="form-label">
                                                        Status
                                                    </label>
                                                    <select type="date" name="status" id="status"
                                                        value="{{ date('Y-m-d', strtotime('+30 days')) }}"
                                                        class="form-control">
                                                        <option value="proses">Proses</option>
                                                        <option value="reject">Ditolak</option>
                                                        <option value="payment">Proses Pembayaran</option>
                                                        <option value="scheduling">Proses Penjadwalan</option>
                                                        <option value="success">Selesai</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-search fa-fw"></i>
                                                    Buat Laporan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

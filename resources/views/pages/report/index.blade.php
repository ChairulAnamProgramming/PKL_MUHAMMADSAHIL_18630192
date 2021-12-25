@extends('template.index')

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
                                <a href="" class="text-primary">{{ $filingOfMatter->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection

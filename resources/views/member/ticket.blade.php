@extends('member.layout')

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="container-fluid p-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Ticket</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Ticket
                </li>
            </ol>
        </div>
        <hr>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">Ticket Baru
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Ticket Proses
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button"
                        role="tab" aria-controls="contact" aria-selected="false">Ticket Tutup
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="p-1">
                    <p class="font-weight-bold">Data Ticket Baru</p>
                    <hr>
                    @forelse($baru as $vBaru)
                        <div class="card mb-1">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="font-weight-bold mr-2">{{ $vBaru->no_ticket }}</span>
                                        <span style="font-size: 12px; color: grey;">({{ \Carbon\Carbon::parse($vBaru->tanggal)->format('d/m/Y') }})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold">No. Resi</span>
                                        <span class="font-weight-bold">:</span>
                                    </div>
                                    <div class="col-9">
                                        <span class="font-weight-bold">{{ $vBaru->no_resi }}</span>
                                    </div>
                                </div>
                                <hr>
                                <p class="text-justify">{{ $vBaru->deskripsi }}</p>
                            </div>
                        </div>
                    @empty
                        <div style="height: 200px;" class="w-100 d-flex justify-content-center align-items-center">
                            <p class="font-weight-bold">Tidak ada ticket</p>
                        </div>
                    @endforelse
                </div>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="p-1">
                    <p class="font-weight-bold">Data Ticket Proses</p>
                    <hr>
                    @forelse($proses as $vProses)
                        <div class="card mb-1">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="font-weight-bold mr-2">{{ $vProses->no_ticket }}</span>
                                        <span style="font-size: 12px; color: grey;">({{ \Carbon\Carbon::parse($vProses->tanggal)->format('d/m/Y') }})</span>
                                    </div>
                                    <a href="/ticket/{{ $vProses->id }}" class="btn btn-sm btn-primary">Detail</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold">No. Resi</span>
                                        <span class="font-weight-bold">:</span>
                                    </div>
                                    <div class="col-9">
                                        <span class="font-weight-bold">{{ $vProses->no_resi }}</span>
                                    </div>
                                </div>
                                <hr>
                                <p class="text-justify">{{ $vProses->deskripsi }}</p>
                            </div>
                        </div>
                    @empty
                        <div style="height: 200px;" class="w-100 d-flex justify-content-center align-items-center">
                            <p class="font-weight-bold">Tidak ada ticket</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="p-1">
                    <p class="font-weight-bold">Data Ticket Tutup</p>
                    <hr>
                    @forelse($tutup as $vTutup)
                        <div class="card mb-1">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="font-weight-bold mr-2">{{ $vTutup->no_ticket }}</span>
                                        <span style="font-size: 12px; color: grey;">({{ \Carbon\Carbon::parse($vTutup->tanggal)->format('d/m/Y') }})</span>
                                    </div>
                                    <a href="/ticket/{{ $vTutup->id }}" class="btn btn-sm btn-primary">Detail</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold">No. Resi</span>
                                        <span class="font-weight-bold">:</span>
                                    </div>
                                    <div class="col-9">
                                        <span class="font-weight-bold">{{ $vTutup->no_resi }}</span>
                                    </div>
                                </div>
                                <hr>
                                <p class="text-justify">{{ $vTutup->deskripsi }}</p>
                            </div>
                        </div>
                    @empty
                        <div style="height: 200px;" class="w-100 d-flex justify-content-center align-items-center">
                            <p class="font-weight-bold">Tidak ada ticket</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection

@extends('admin.layout')

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Ticket Tutup</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.ticket.closed') }}">Ticket Tutup</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data->no_ticket }}
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="card card-outline card-info">
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-3 d-flex align-items-center justify-content-between">
                        <span class="font-weight-bold">No. Ticket</span>
                        <span class="font-weight-bold">:</span>
                    </div>
                    <div class="col-9">
                        <span class="font-weight-bold">{{ $data->no_ticket }}</span>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3 d-flex align-items-center justify-content-between">
                        <span class="font-weight-bold">No. Resi</span>
                        <span class="font-weight-bold">:</span>
                    </div>
                    <div class="col-9">
                        <span class="font-weight-bold">{{ $data->no_resi }}</span>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3 d-flex align-items-center justify-content-between">
                        <span class="font-weight-bold">Tanggal</span>
                        <span class="font-weight-bold">:</span>
                    </div>
                    <div class="col-9">
                        <span class="font-weight-bold">{{ $data->tanggal }}</span>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3 d-flex align-items-center justify-content-between">
                        <span class="font-weight-bold">Deskripsi Ticket</span>
                        <span class="font-weight-bold">:</span>
                    </div>
                    <div class="col-9">
                        <span class="font-weight-bold">{{ $data->deskripsi }}</span>
                    </div>
                </div>
                <hr>
                @foreach($data->comments as $comment)
                    @if($comment->is_admin == true)
                        <div class="row mb-1">
                            <div class="col-2"></div>
                            <div class="col-10">
                                <div class="card" style="background-color: #f4f6f9">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-2" style="height: 50px; width: 50px;">
                                                <img src="{{ asset('/assets/chat-admin.png') }}" width="50" height="50"
                                                     class="rounded-circle">
                                            </div>
                                            <span class="font-weight-bold mr-2">{{ $comment->user->username }}</span>
                                            <span style="font-size: 12px; color: grey;">({{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i:s') }})</span>
                                        </div>
                                        <hr>
                                        <p class="text-justify">{{ $comment->comment }}</p>
                                        @if($comment->lampiran != null)
                                            <hr>
                                            <a href="{{ asset('/assets/comment'). '/' .$comment->lampiran }}"
                                               target="_blank">Lampiran</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mb-1">
                            <div class="col-10">
                                <div class="card" style="background-color: #a3cfbb">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-2" style="height: 50px; width: 50px;">
                                                <img src="{{ asset('/assets/chat-user.png') }}" width="50" height="50"
                                                     class="rounded-circle">
                                            </div>
                                            <span class="font-weight-bold mr-2">{{ $comment->user->username }}</span>
                                            <span style="font-size: 12px; color: grey;">({{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i:s') }})</span>
                                        </div>
                                        <hr>
                                        <p class="text-justify">{{ $comment->comment }}</p>
                                        @if($comment->lampiran != null)
                                            <hr>
                                            <a href="{{ asset('/assets/comment'). '/' .$comment->lampiran }}"
                                               target="_blank">Lampiran</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    @endif
                @endforeach
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

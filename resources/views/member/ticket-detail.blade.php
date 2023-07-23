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
                <li class="breadcrumb-item">
                    <a href="{{ route('ticket') }}">Ticket</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data->no_ticket }}
                </li>
            </ol>
        </div>
        <hr>
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
                @if($data->status == 1)
                    <hr>
                    <div class="d-flex align-items-center justify-content-end mb-2">
                        <a href="#" class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modalComment"><i
                                class="fa fa-comment mr-1"></i><span
                                class="font-weight-bold">Tanggapi</span></a>
                    </div>
                @endif
                <hr>
                @foreach($data->comments as $comment)
                    @if($comment->is_admin == true)
                        <div class="row mb-1">
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
                            <div class="col-2"></div>
                        </div>
                    @else
                        <div class="row mb-1">
                            <div class="col-2"></div>
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
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalComment" tabindex="-1" role="dialog" aria-labelledby="modalCommentLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCommentLabel">Tanggapi Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="form-comment">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                        <div class="w-100 mb-1">
                            <label for="comment" class="form-label">Tanggapan</label>
                            <textarea type="text" class="form-control" id="comment" placeholder="Tanggapan"
                                      name="comment"></textarea>
                        </div>
                        <div class="w-100 mb-1">
                            <label for="file" class="form-label">Lampiran</label>
                            <input type="file" class="form-control" id="file"
                                   name="file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button id="btn-save" type="button" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#btn-save').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin ingin menanggapi ticket?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        $('#form-comment').submit();
                    }
                });
            });
        });
    </script>
@endsection

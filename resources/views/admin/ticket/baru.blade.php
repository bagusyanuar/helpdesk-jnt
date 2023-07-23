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
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Ticket Baru</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Ticket Baru
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="card card-outline card-info">
            {{--            <div class="card-header">--}}
            {{--                <div class="text-right mb-2">--}}
            {{--                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd"><i--}}
            {{--                            class="fa fa-plus mr-1"></i><span--}}
            {{--                            class="font-weight-bold">Tambah</span></a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="card-body">
                <table id="table-data" class="display w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="12%">Member</th>
                        <th width="12%">Tanggal</th>
                        <th width="12%">No. Ticket</th>
                        <th width="12%">No. Resi</th>
                        <th>Deskripsi</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                        <input type="hidden" id="id" name="id" value="">
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
        var table;

        function clear() {
            $('#comment').val('');
            $('#id').val('');
        }

        function store() {
            let url = '{{ route('admin.ticket.baru') }}';
            let data = {
                id: $('#id').val(),
                comment: $('#comment').val(),
            };
            AjaxPost(url, data, function () {
                clear();
                $('#modalComment').modal('hide');
                SuccessAlert('Berhasil!', 'Berhasil menanggapi ticket...');
                reload();
            });
        }


        function reload() {
            table.ajax.reload();
        }

        function commentEvent() {
            $('.btn-comment').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                $('#id').val(id);
                $('#modalComment').modal('show');
            })
        }


        $(document).ready(function () {
            let url = '{{ route('admin.ticket.baru') }}';
            table = DataTableGenerator('#table-data', url, [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'user.username'},
                {data: 'tanggal'},
                {data: 'no_ticket'},
                {data: 'no_resi'},
                {data: 'deskripsi'},
                {
                    data: null, render: function (data) {
                        return '<a href="#" class="btn btn-sm btn-info btn-comment" data-id="' + data['id'] + '"><i class="fa fa-comment f12"></i></a>';
                    }
                },
            ], [
                {
                    targets: [0, 1, 2, 3, 4, 6],
                    className: 'text-center'
                },
            ], function (d) {
            }, {
                "fnDrawCallback": function (setting) {
                    commentEvent();
                }
            });

            $('#btn-save').on('click', function () {
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menanggapi ticket?",
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

            $('#modalComment').on('hidden.bs.modal', function (e) {
                clear();
            });

        });
    </script>
@endsection

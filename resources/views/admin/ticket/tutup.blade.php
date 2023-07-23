@extends('admin.layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Ticket Tutup</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Ticket Tutup
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="card card-outline card-info">
            <div class="card-body">
                <table id="table-data" class="display w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="12%">Member</th>
                        <th width="10%">Tanggal</th>
                        <th width="10%">No. Ticket</th>
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
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var table;

        function reload() {
            table.ajax.reload();
        }

        function detailEvent() {
            $('.btn-info').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                window.location.href = '{{ route('admin.ticket.closed') }}' + '/' + id;
            })
        }


        $(document).ready(function () {
            let url = '{{ route('admin.ticket.closed') }}';
            table = DataTableGenerator('#table-data', url, [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'user.username'},
                {data: 'tanggal'},
                {data: 'no_ticket'},
                {data: 'no_resi'},
                {data: 'deskripsi'},
                {
                    data: null, render: function (data) {
                        return '<a href="#" class="btn btn-sm btn-info btn-detail" data-id="' + data['id'] + '"><i class="fa fa-info f12"></i></a>';
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
                    detailEvent();
                }
            });
        });
    </script>
@endsection

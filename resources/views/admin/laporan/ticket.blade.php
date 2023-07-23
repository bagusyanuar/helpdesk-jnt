@extends('admin.layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Laporan Ticket</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Ticket
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="card card-outline card-info">
            <div class="card-body">
                <p class="font-weight-bold mb-0">Filter Tanggal</p>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center w-50">
                        <input type="date" class="form-control" name="tgl1" id="tgl1" value="{{ date('Y-m-d') }}">
                        <span class="font-weight-bold mr-2 ml-2">S/D</span>
                        <input type="date" class="form-control" name="tgl2" id="tgl2" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="text-right">
                        <a href="#" class="btn btn-success" id="btn-cetak">
                            <i class="fa fa-print mr-2"></i>
                            <span>Cetak</span>
                        </a>
                    </div>
                </div>
                <hr>
                <table id="table-data" class="display w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="12%">Member</th>
                        <th width="10%">Tanggal</th>
                        <th width="10%">No. Ticket</th>
                        <th width="12%">No. Resi</th>
                        <th>Deskripsi</th>
                        <th width="10%" class="text-center">Status</th>
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


        $(document).ready(function () {
            let url = '{{ route('admin.report.ticket') }}';
            table = DataTableGenerator('#table-data', url, [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'user.username'},
                {data: 'tanggal'},
                {data: 'no_ticket'},
                {data: 'no_resi'},
                {data: 'deskripsi'},
                {
                    data: null, render: function (data) {
                        let status = data['status'];
                        if (status === 1) {
                            return '<div class="pl-2 pr-2 pt-1 pb-1" style="border-radius: 5px; background-color: #ffc107; color: white; font-size: 12px;">Proses</div>';
                        } else if(status === 2) {
                            return '<div class="pl-2 pr-2 pt-1 pb-1" style="border-radius: 5px; background-color: #198754; color: white; font-size: 12px;">Tutup</div>';
                        }else {
                            return '<div class="pl-2 pr-2 pt-1 pb-1" style="border-radius: 5px; background-color: #007bff; color: white; font-size: 12px;">Baru</div>';
                        }
                    }
                },
            ], [
                {
                    targets: [0, 1, 2, 3, 4, 6],
                    className: 'text-center'
                },
            ], function (d) {
                d.tgl1 = $('#tgl1').val();
                d.tgl2 = $('#tgl2').val();
            }, {
                dom: 'ltipr',
                "fnDrawCallback": function (setting) {
                    // eventFinish();
                    // let data = this.fnGetData();
                    // let total = data.map(item => item['total']).reduce((prev, next) => prev + next, 0);
                    // $('#lbl-total').html('Rp. '+total.toLocaleString('id-ID'));
                }
            });

            $('#tgl1').on('change', function (e) {
                reload();
            });
            $('#tgl2').on('change', function (e) {
                reload();
            });

            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                let tgl1 = $('#tgl1').val();
                let tgl2 = $('#tgl2').val();
                window.open('/laporan-ticket/cetak?tgl1=' + tgl1 + '&tgl2=' + tgl2, '_blank');
            });
        });

    </script>
@endsection

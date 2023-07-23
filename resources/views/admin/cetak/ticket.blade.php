@extends('admin.cetak.index')

@section('content')
    <div class="text-center report-title">LAPORAN Ticket</div>
    <div class="text-center text-body font-weight-bold">Periode {{ $tgl1 }} - {{ $tgl2 }}</div>
    <hr>
    <table id="my-table" class="table display" style="margin-top: 10px">
        <thead>
        <tr>
            <th width="5%" class="text-center text-body-small">#</th>
            <th width="8%" class="text-center text-body-small ">Member</th>
            <th width="10%" class="text-center text-body-small">Tanggal</th>
            <th width="10%" class="text-center text-body-small">No. Ticket</th>
            <th width="15%" class="text-center text-body-small">No. Resi</th>
            <th class="text-body-small">Deskripsi</th>
            <th width="7%" class="text-center text-body-small">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center text-body-small">{{ $loop->index + 1 }}</td>
                <td class="text-center text-body-small">{{ $v->user->username }}</td>
                <td class="text-center text-body-small">{{ $v->tanggal }}</td>
                <td class="text-center text-body-small">{{ $v->no_ticket }}</td>
                <td class="text-center text-body-small">{{ $v->no_resi }}</td>
                <td class="text-body-small">{{ $v->deskripsi }}</td>
                <td class="text-center text-body-small">
                    @if($v->status === 1)
                        <span>Proses</span>
                    @elseif($v->status === 2)
                        <span>Tutup</span>
                    @else
                        <span>Baru</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="col-xs-8 f-bold report-header-sub-title" style="text-align: right;"></div>
        <div class="col-xs-3 f-bold text-body-small" style="text-align: center;">
            Surakarta, {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-8 f-bold report-header-sub-title" style="text-align: right;"></div>
        <div class="col-xs-3 f-bold text-body-small" style="text-align: center;">(Admin)</div>
    </div>
@endsection

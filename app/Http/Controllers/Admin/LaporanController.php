<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Ticket;

class LaporanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Ticket::with(['user.member'])
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->orderBy('created_at', 'ASC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.ticket');
    }

    public function cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Ticket::with(['user.member'])
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->orderBy('created_at', 'ASC')
            ->get();
        $html = view('admin.cetak.ticket')->with(['data' => $data, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}

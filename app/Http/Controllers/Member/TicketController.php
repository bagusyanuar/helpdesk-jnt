<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Comment;
use App\Models\Ticket;

class TicketController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $tickets = Ticket::with([])->where('user_id', '=', auth()->id())->orderBy('tanggal', 'DESC')->get();
        $baru = $tickets->where('status', '=', 0)->values();
        $proses = $tickets->where('status', '=', 1)->values();
        $tutup = $tickets->where('status', '=', 2)->values();
        return view('member.ticket')->with([
            'baru' => $baru,
            'proses' => $proses,
            'tutup' => $tutup
        ]);
    }

    public function detail($id)
    {
        if ($this->request->method() === 'POST') {
            try {
                $data_request = [
                    'ticket_id' => $this->postField('id'),
                    'user_id' => auth()->id(),
                    'comment' => $this->postField('comment'),
                    'lampiran' => null,
                    'is_admin' => false
                ];
                $lampiran = $this->generateImageName('file');
                if ($lampiran !== '') {
                    $data_request['lampiran'] = $lampiran;
                    $this->uploadImage('file', $lampiran, 'comment');
                }
                Comment::create($data_request);
                return redirect()->back()->with('success', 'Berhasil menanggapi ticket...');
            } catch (\Exception $e) {
                return redirect()->back()->with('failed', 'Terjadi Kesalahan Server...');
            }
        }
        $data = Ticket::with(['user.member', 'comments'])->where('id', '=', $id)->firstOrFail();
        return view('member.ticket-detail')->with([
            'data' => $data,
        ]);
    }
}

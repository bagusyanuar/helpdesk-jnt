<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Mail\SendMail;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TicketController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ticket_baru()
    {
        if ($this->request->method() === 'POST') {
            DB::beginTransaction();
            try {
                $ticket = Ticket::find($this->postField('id'));
                $ticket->update([
                    'status' => 1
                ]);
                $data_request = [
                    'ticket_id' => $this->postField('id'),
                    'user_id' => auth()->id(),
                    'comment' => $this->postField('comment'),
                    'lampiran' => null,
                    'is_admin' => true
                ];
                $lampiran = $this->generateImageName('file');
                if ($lampiran !== '') {
                    $data_request['lampiran'] = $lampiran;
                    $this->uploadImage('file', $lampiran, 'comment');
                }
                Comment::create($data_request);
                DB::commit();
                return redirect()->back()->with('success', 'Berhasil menanggapi ticket...');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('failed', 'Terjadi Kesalahan Server...');
            }
        }
        if ($this->request->ajax()) {
            $data = Ticket::with(['user.member'])->where('status', '=', 0)->get();
            return $this->basicDataTables($data);
        }
        return view('admin.ticket.baru');
    }

    public function ticket_process()
    {
        if ($this->request->ajax()) {
            $data = Ticket::with(['user.member'])->where('status', '=', 1)->get()->append(['last_reply']);
            return $this->basicDataTables($data);
        }
        return view('admin.ticket.proses');
    }

    public function ticket_process_detail($id)
    {
        if ($this->request->method() === 'POST') {
            try {
                $data_request = [
                    'ticket_id' => $this->postField('id'),
                    'user_id' => auth()->id(),
                    'comment' => $this->postField('comment'),
                    'lampiran' => null,
                    'is_admin' => true
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
        return view('admin.ticket.proses-detail')->with(['data' => $data]);
    }

    public function ticket_process_close($id)
    {
        try {
            $ticket = Ticket::with(['user'])->findOrFail($id);
            $ticket->update([
                'status' => 2
            ]);
            Mail::to('damn.john88@gmail.com')->send(new SendMail($ticket));
            return redirect()->route('admin.ticket.proses')->with('success', 'Berhasil menutup ticket...');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Terjadi Kesalahan Server...');
        }
    }

    public function ticket_closed()
    {
        if ($this->request->ajax()) {
            $data = Ticket::with(['user.member'])->where('status', '=', 2)->get()->append(['last_reply']);
            return $this->basicDataTables($data);
        }
        return view('admin.ticket.tutup');
    }

    public function ticket_closed_detail($id)
    {
        $data = Ticket::with(['user.member', 'comments'])->where('id', '=', $id)->firstOrFail();
        return view('admin.ticket.tutup-detail')->with(['data' => $data]);
    }
}

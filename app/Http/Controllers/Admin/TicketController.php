<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ticket_baru()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
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
                Comment::create($data_request);
                DB::commit();
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = Ticket::with(['user.member'])->where('status', '=', 0)->get();
            return $this->basicDataTables($data);
        }
        return view('admin.ticket.baru');
    }
}

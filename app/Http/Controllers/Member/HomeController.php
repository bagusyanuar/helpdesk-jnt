<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class HomeController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->method() === 'POST') {
            try {
                $data = [
                    'user_id' => auth()->id(),
                    'tanggal' => Carbon::now(),
                    'no_ticket' => 'TKT-'.Carbon::now()->format('YmdHis'),
                    'no_resi' => $this->postField('resi'),
                    'deskripsi' => $this->postField('deskripsi'),
                    'status' => 0
                ];
                Ticket::create($data);
                return redirect()->back()->with('success', 'Berhasil mengirimkan ticket...');
            }catch (\Exception $e) {
                return redirect()->back()->with('failed', 'terjadi kesalahan');
            }
        }
        return view('member.home');
    }

    public function track()
    {
        try {
            $awb = $this->field('awb');
            $url = 'https://api.binderbyte.com/v1/track';
            $response = Http::get($url, [
                'api_key' => '806c0b2d00d8bb91d9a425db2da57e234b2d4b65ad3439e385c7cef4fed35f4c',
                'courier' => 'jnt',
                'awb' => $awb
            ]);
            $body = json_decode($response->body(), true);
//            dd($body);
            return $this->jsonResponse('success', 200, $body);
        }catch (\Exception $e) {
//            dd($e->getMessage());
            return $this->jsonResponse('terjadi kesalahan...', 500);
        }
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Soc;
use App\Models\Kajian;
use App\Models\Pelayanan;
use App\Models\Kemitraan;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        if($this->isLoggedIn()){
            $url = 'https://sso.dapobud.kemdikbud.go.id/auth/logout?redirect_url=https://dss.borobudur.kemdikbud.go.id';
            $ch = curl_init();
            $ch = curl_setopt($ch, CURLOPT_URL, $url);
            curl_exec($ch);
            curl_close($ch);
        }
    }

    private function isLoggedIn(){
        if(isset($_COOKIE['DAPOBUDSSOSID'])){
            $url = config('oauth.url_base').'/json/session?code='.$_COOKIE['DAPOBUDSSOID'];
            $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                curl_setopt($ch,  CURLOPT_HTTPHEADER, array('Accept: application/json'));
            $result = curl_exec($ch);

            if(curl_error($ch)) {
                Log::error('SSO Curl : '.curl_error($ch));
            }

            curl_close($ch);

            $status = json_decode($result);

            return $status->is_loggedin;
        }

        return false;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $soc = DB::table('soc')
            ->select(DB::raw('max(YEAR(tanggal)) as max'), DB::raw('min(YEAR(tanggal)) as min'), DB::raw('count(id) as total'))
            ->get();
        $perawatan = DB::table('perawatan')
            ->select(DB::raw('max(YEAR(tanggal)) as max'), DB::raw('min(YEAR(tanggal)) as min'), DB::raw('count(id) as total'))
            ->get();
        $kajian = DB::table('kajian')
            ->select(DB::raw('max(YEAR(tanggal)) as max'), DB::raw('min(YEAR(tanggal)) as min'), DB::raw('count(id) as total'))
            ->get();
        $pelayanan = DB::table('pelayanan')
            ->select(DB::raw('max(YEAR(tanggal)) as max'), DB::raw('min(YEAR(tanggal)) as min'), DB::raw('count(id) as total'))
            ->get();
        $kemitraan = DB::table('kemitraan')
            ->select(DB::raw('max(YEAR(created_at)) as max'), DB::raw('min(YEAR(created_at)) as min'), DB::raw('count(id) as total'))
            ->get();
        // return response()->json($perawatan);
        return view('dashboard', compact('soc', 'perawatan', 'kajian', 'pelayanan', 'kemitraan'));
    }
}

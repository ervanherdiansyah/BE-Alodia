<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserKomisiHistory;
use App\Models\HistoryBonusUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserKomisiHistoryController extends Controller
{
    //
    public function getKomisiHistory(Request $request){
        try{
            $user_id = Auth::user()->id;
            
            $userKomisiHistoryRaw = UserKomisiHistory::where('affiliator_id', $user_id)->get();
            $userKomisiHistory = [];
            foreach($userKomisiHistoryRaw as $data){
                $komisi = [
                    'keterangan'=>$data->keterangan,
                    // info transaksi diganti yang dari table tapi nama dari si affiliate, dari affiliate_id
                    'info_transaksi'=>$data->komisi_affiliate_id->name,
                    'jumlah_komisi'=>$data->jumlah_komisi,
                    'created_at'=>$data->created_at,
                    'updated_at'=>$data->updated_at
                ];
                $userKomisiHistory[] = $komisi;
            }

            $userBonusHistoryRaw = HistoryBonusUser::where('user_id', $user_id)->get();
            $userBonusHistory = [];
            foreach($userBonusHistoryRaw as $data){
                $komisi = [
                    'keterangan'=>$data->keterangan,
                    // info transaksi diganti yang dari table tapi nama dari si affiliate, dari affiliate_id
                    'info_transaksi'=>$data->info_transaksi,
                    'jumlah_komisi'=>$data->jumlah_komisi,
                    'created_at'=>$data->created_at,
                    'updated_at'=>$data->updated_at
                ];
                $userBonusHistory[] = $komisi;
            }

            $mergedUserKomisidanBonusHistory = array_merge($userKomisiHistory, $userBonusHistory);

            usort($mergedUserKomisidanBonusHistory, function ($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });
            
            return response()->json(['data' => $mergedUserKomisidanBonusHistory, 'message' => 'Success'], 200); 
        }
        catch(\Throwable $th){
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
    
    public function getKomisiData(Request $request){
        try{
            $user_id = Auth::user()->id;
            $komisi_repeat_order = UserKomisiHistory::where('affiliator_id', $user_id)->where('Keterangan', 'Repeat Order')->get();
            $komisi_referal = UserKomisiHistory::where('affiliator_id', $user_id)->where('Keterangan', 'Kode Referal')->get();
            $komisi_bonus = HistoryBonusUser::where('user_id', $user_id)->get();

            
    
            $total_komisi_repeat_order = $komisi_repeat_order->sum('jumlah_komisi');
            $total_komisi_referal = $komisi_referal->sum('jumlah_komisi') + $komisi_bonus->sum('jumlah_komisi');
            $total_komisi = $total_komisi_referal + $total_komisi_repeat_order;
            return response()->json(['data' => ["Total_komisi"=>$total_komisi, "Total_komisi_referal"=>$total_komisi_referal, 'Total_komisi_repeat_order'=>$total_komisi_repeat_order]], 200);
        }
        
        catch(\Throwable $th){
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}

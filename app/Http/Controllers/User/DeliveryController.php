<?php

namespace App\Http\Controllers\User; // 必要なモジュールを読込

use Illuminate\Http\Request;
use App\Models\Curriculum; // 追記
use App\Models\Grade; // 追記
use App\Models\User; // 追記
use App\Models\DeliveryTime; // 追記
use App\Models\CurricurumProgress; // 追記
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // 追記
use Carbon\Carbon; // 追記

class DeliveryController extends Controller
{
    // public function __construct() //追加
    // {
    //     $this->middleware('guest:user')->except('logout');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDelivery($id)
    {
        try {
            $curriculums = Curriculum::find($id); //id指定
            $grades = Grade::all();
            $userId = Auth::id(); // ログインしているユーザーのIDを取得 追加
            $curricurum_progress = CurricurumProgress::where('curriculumus_id', $id) //絞り込みメソッド修正2
                ->where('users_id', $userId) // ユーザーIDで絞り込み
                ->first();
    
            if(!$curriculums){ //データがない場合リダイレクト
                return redirect()->route('user.top');
            }
    
            $nowTime = Carbon::now(); //現在時刻の取得
            $deliveryTimes = DeliveryTime::where('curriculums_id', $id)->first(); //絞り込みメソッド修正
            
            if (isset($deliveryTimes->delivery_from) && isset($deliveryTimes->delivery_to)) { //if追加 配信日時が設定されていない場合
                $startTime = $deliveryTimes->delivery_from;
                $endTime = $deliveryTimes->delivery_to;
                if($nowTime >= $startTime && $nowTime <= $endTime) {
                    $deliveryTime = 1; //現在時刻が時間内
                } else {
                    $deliveryTime = 0; //時間外
                }
            } else {
                $deliveryTime = 0; //時間外
            }
            
            if ($curricurum_progress) { //if追加
                return view('user.delivery', compact('curriculums', 'grades', 'deliveryTime','curricurum_progress'));
            } else {
                return redirect()->route('user.top');
            }
        } catch (\Throwable $e) {
            return redirect()->route('user.top');
        }
    }

    public function updateDelivery(Request $request, $id)
    {
        try {
            // データベース接続情報
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "influencer_education";
    
            // データベースへの接続 mysqliを使用する場合、クラス名の前に\を付けて全域の名前空間を指定
            $conn = new \mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) { // 接続エラーチェック
                die("Connection failed: " . $conn->connect_error);
            }
    
            $flgId = Curriculum::find($id)->id; //idを取得
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // clear_flg を 1 に更新する SQL
                $sql = $conn->prepare("UPDATE curricurum_progress SET clear_flg = 1 WHERE id = ?");
                $sql->bind_param("i", $flgId);
        
                // クエリの実行
                if ($sql->execute() === TRUE) {
                    // echo "Record updated successfully";
                    header("Refresh:0");
                } else {
                    echo "Error updating record: " . $sql->error;
                }

                $sql->close();// 接続のクローズ
                $conn->close();
            }
        } catch (Exception $e) {
            header("Location: delivery/{id}"); // エラーが発生した場合リダイレクト
            exit();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

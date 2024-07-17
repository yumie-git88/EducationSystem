<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\DeliveryTime;

class DeliveryController extends Controller
{
    // 配信日時設定ページ表示
    public function delivery($id)
{
    try {
        $curriculum = Curriculum::findOrFail($id);
        $deliveryTimes = DeliveryTime::where('curriculums_id', $id)->get();

        // 既存の配信日時をフォームに表示するための配列を準備する
        $existingDeliveryTimes = [];
        foreach ($deliveryTimes as $deliveryTime) {
            $existingDeliveryTimes[] = [
                'start_date' => date('Y-m-d', strtotime($deliveryTime->delivery_from)),
                'start_time' => date('H:i', strtotime($deliveryTime->delivery_from)),
                'end_date' => date('Y-m-d', strtotime($deliveryTime->delivery_to)),
                'end_time' => date('H:i', strtotime($deliveryTime->delivery_to)),
            ];
        }

        return view('delivery', [
            'curriculum' => $curriculum,
            'existingDeliveryTimes' => $existingDeliveryTimes,
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Failed to display delivery date and time modification page.']);
    }
}

     // 配信日時の保存
     public function saveDeliveryTimes(Request $request, $id)
     {
         // バリデーションルールの設定
         $request->validate([
            'start_dates.*' => 'required|date',
            'start_times.*' => 'required|date_format:H:i',
            'end_dates.*' => 'required|date',
            'end_times.*' => 'required|date_format:H:i',
        ]);
 
         // カリキュラムを取得
         $curriculum = Curriculum::findOrFail($id);
 
        // 既存の配信時間を削除する
$curriculum->deliveryTimes()->delete();
 
         // 新しい配信時間を保存する
$startDates = $request->input('start_dates');
$startTimes = $request->input('start_times');
$endDates = $request->input('end_dates');
$endTimes = $request->input('end_times');

foreach ($startDates as $index => $startDate) {
    $deliveryTime = new DeliveryTime();
    $deliveryTime->curriculums_id = $curriculum->id;
    $deliveryTime->delivery_from = $startDate . ' ' . $startTimes[$index];
    $deliveryTime->delivery_to = $endDates[$index] . ' ' . $endTimes[$index];
    $deliveryTime->save();
}
 
         return redirect()->route('curriculum_list', $curriculum->id)->with('success', '配信日時が保存されました。');
       
     }
}

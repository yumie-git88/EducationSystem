<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;

class DeliveryController extends Controller
{
    public function showDelivery($id)
    {
        // $curriculum = Curriculum::find($id);
        $curriculum = Curriculum::with('grade')->find($id);

        // 授業が存在しない場合はトップページにリダイレクト
        if (!$curriculum) {
            return redirect()->route('user.show.top')->with('status', '授業が見つかりません');
        }

        return view('user.delivery', compact('curriculum'));
    }
}
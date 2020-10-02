<?php

namespace App\Http\Controllers\Api\JxSg;

use App\User;
use Illuminate\Http\Request;
use App\Models\Jx\SignRecord;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{

    public function record(Request $request)
    {
        $rules = [
            'user_id' => ['required', 'int'],
            'star' => ['required', 'string'],
            'money' => ['required'],
            'grade' => ['required', 'string'],
        ];
        $validator = Validator::make($request->all(), $rules);
        $this->unio($request, $validator, '打卡成功', '打卡失败, 请稍后重试');

        return response()->json($this->returned, $this->statusCode);
    }

    public function updateRec(Request $request)
    {
        $rules = [
            'id' => ['required'],
            'remarks' => ['required', 'string']
        ];
        $validator = Validator::make($request->all(), $rules);
        $this->unio($request, $validator, '更新备注成功', '更新备注失败, 请稍后重试', true);

        return response()->json($this->returned, $this->statusCode);
    }

    public function statistics($id = null, $begin = null, $end = null)
    {
        if (is_null([$id, $begin, $end])) {
            $this->returned['result']['msg'] = '请指定用户与闭合时间段';
        } else {
            $currentUser = User::find($id);
            if (is_null($currentUser)) {
                $this->returned['result']['msg'] = '未查询到该用户, 请检查参数';
            } else {
                $data = $currentUser->sinRec()
                                    ->whereBetween('created_at', [$begin, $end])
                                    ->get();
                if ($data->isEmpty()) {
                    $this->returned['result']['msg'] = '未查询到该用户此时间段的任何数据';
                } else {
                    $this->returned['result']['msg'] = '查询成功';
                    $this->returned['result']['code'] = 1;
                    $this->returned['result']['status'] = 'success';
                    $this->returned['data'] = self::syntheticArr($data);
                }
            }
        }
        return response()->json($this->returned, $this->statusCode);
        
    }

    private function unio($request, $validator, $sucMsg, $errMsg, $judge = false)
    {
        if ($validator->fails()) {
            $retErr = $validator->errors();
            $errMsgs = [];
            foreach ($retErr->all() as $message) {
                array_push($errMsgs, $message);
            }
            $this->returned['result']['msg'] = $errMsgs;
            $this->statusCode = 400;
        } else {
            if (!$judge) {
                $res = SignRecord::create($request->all());
            } else {
                $data = SignRecord::find($request->id);
                if (is_null($data)) {
                    $res = false;
                }
                $res = $data->update($request->all());
            }
            
            if ($res) {
                $this->returned['result']['code'] = 1;
                $this->returned['result']['status'] = 'success';
                $this->returned['result']['msg'] = "$sucMsg";
                $this->returned['data'] = $res;
            } else {
                $this->returned['result']['msg'] = "$errMsg";
            }
        }
    }

    private static function syntheticArr($data)
    {
        $dataArr = [];
        foreach ($data as $key => $value) {
            array_push($dataArr, [
                'star' => $value->star,
                'money' => $value->money,
                'grade' => $value->grade,
                'remarks' => $value->remarks,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ]);
        }
        return $dataArr;
    }
}

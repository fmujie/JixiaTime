<?php

namespace App\Http\Controllers\Api\JxSg;

use App\User;
use Illuminate\Http\Request;
use App\Models\Jx\SignRecord;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
     public function __construct()
     {
        parent::__construct();
        $this->middleware('auth:api');
     }
     
     public function userList()
     {
        $usersData = User::get();
        $returnedList =$this->synArr($usersData);
        // 排序（SORT_DESC=>降序、SORT_ASC=>升序）
        $newArr = [];
        foreach ($returnedList as $key => $value) {
            $newArr[$key]['user_money'] = $value['user_money'];
        }
        array_multisort($newArr, SORT_DESC, $returnedList);

        if (empty($returnedList)) {
            $this->returned['result']['msg'] = '未查询到任何数据';
        } else {
            $this->returned['result']['msg'] = '查询成功';
        }
        $this->returned['result']['code'] = 1;
        $this->returned['result']['status'] = 'success';
        $this->returned['data'] = $returnedList;

        return response()->json($this->returned, $this->statusCode);
     }

    public function record(Request $request)
    {
        $rules = [
            'star' => ['required', 'string'],
            'money' => ['required'],
            'grade' => ['required', 'string'],
        ];
        request()->offsetSet('user_id', Auth::user()->id);
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

    // /{id}/{begin}/{end}  /1/2020-10-02/2020-10-03
    public function statistics(Request $request)
    {
        $rules = [
            'id' => ['required'],
            'begin' => ['required'],
            'end' => ['required']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->returned['result']['msg'] = '参数错误';
        } else {
            $id = $request->id;
            $begin = $request->begin;
            $end = $request->end;
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
        }
        return response()->json($this->returned, $this->statusCode);
        
    }

    private function unio($request, $validator, $sucMsg, $errMsg, $judge = false)
    {
        $sel = false;
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
                } else {
                    if ($data->user_id != Auth::user()->id) {
                        $this->returned['result']['msg'] = '非本人更改';
                        $res = false;
                        $sel = true;
                    } else {
                        $res = $data->update($request->all());
                    }
                }
            }
            
            if ($res) {
                $this->returned['result']['code'] = 1;
                $this->returned['result']['status'] = 'success';
                $this->returned['result']['msg'] = "$sucMsg";
                $this->returned['data'] = $res;
            } else {
                if (!$sel) {
                    $this->returned['result']['msg'] = "$errMsg";
                } else {
                    $this->returned['result']['msg'] = "$errMsg" . ', 非本人更改。';
                }
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

    private function synArr($usersData)
    {
        $dataArr = [];
        foreach ($usersData as $key => $value) {
            $userId = $value->id;
            $userName = $value->name;
            $sinrecData = $value->sinRec;
            $userMoney = 0;
            foreach ($sinrecData as $k => $v) {
                $userMoney += $v->money;
            }
            array_push($dataArr, [
                'user_id' => $userId,
                'user_name' => $userName,
                'user_money' => $userMoney,
            ]);
         }
         return $dataArr;
    }

}

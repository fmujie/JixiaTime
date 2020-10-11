<?php

namespace App\Http\Controllers\Api\JxSg;

use App\User;
use Carbon\Carbon;
use App\Models\Jx\Star;
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

    public function delete(Request $request, $id)
    {
        $currentUser = User::find($id);
        if (is_null($currentUser)) {
            $this->returned['result']['msg'] = 'Record not found!';
            $this->status = 404;
        } else {
            $currentUser->delete();
            $currentUser->sinRec()->delete();
            $this->returned['result']['code'] = 200;
            $this->returned['result']['status'] = 'success';
            $this->returned['result']['msg'] = 'User deleted successfully!';
        }

        return response()->json($this->returned, $this->statusCode);
    }

    public function record(Request $request)
    {
        $rules = [
            'star' => ['required', 'string'],
            // 'money' => ['required'],
            'grade' => ['required', 'string'],
        ];
        request()->offsetSet('money', Star::where('star', $request->get('star'))->first()->money*3);
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

    public function searchPer(Request $request)
    {
        request()->offsetSet('userid', Auth::user()->id);
        $ret = $this->statistics($request);
        return $ret;
    }

    // /{id}/{begin}/{end}  /1/2020-10-02/2020-10-03
    public function statistics(Request $request)
    {
        $rules = [
            'userid' => ['required'],
            'stime' => ['required'],
            'etime' => ['required']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $retErr = $validator->errors();
            $errMsgs = [];
            foreach ($retErr->all() as $message) {
                array_push($errMsgs, $message);
            }
            $this->returned['result']['msg'] = $errMsgs;
            $this->statusCode = 400;
        } else {
            $id = $request->userid;
            $begin = $request->stime;
            $end = Carbon::parse($request->etime)->addDays(1)->toDateString();
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
            $crtdt = $value->created_at->toDateTimeString();
            $udtdt = $value->updated_at->toDateTimeString();
            array_push($dataArr, [
                'id' => $value->id,
                'star' => $value->star,
                'money' => $value->money,
                'grade' => $value->grade,
                'remarks' => $value->remarks,
                'created_at' => $crtdt,
                'updated_at' => $udtdt,
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

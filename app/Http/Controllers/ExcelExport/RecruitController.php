<?php

namespace App\Http\Controllers\ExcelExport;

use Illuminate\Http\Request;
use App\Exports\RecruitExport;
use App\Models\MiniPro\Department;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class RecruitController extends Controller
{
    // 预定义response数组、状态码(格式设定)
    protected $statusCode = 200;
    protected $returned = [
        'result' => [
            'code' => 0,
            'status' => 'error',
            'msg' => null
        ],
        'data' => null
    ];

    public function export($grad = 19, $departmentId = 0) 
    {
        if ($grad >= 21 || $departmentId < 0 || $departmentId > 8) {
            $this->returned['result']['msg'] = '参数错误, 请检查年级或者部门代号';
            return response()->json($this->returned, $this->statusCode);
        }

        $departmentName = Department::where('id', $departmentId)->first()->department;
        
        return (new RecruitExport($departmentId, $grad, $departmentName))->download($departmentName . '纳新成员统计表' . '.xlsx');
    }
}

<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\ExcelExport\Recruit;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RecruitExport implements FromQuery, ShouldAutoSize, WithColumnWidths, WithHeadings, WithStyles, WithTitle
{
    use Exportable;

    protected $departmentId = null;
    protected $grad = null;
    protected $departmentName = null;
    protected $orderList = ['1', '2', '3', '4', '5', '6', '7', '8'];

    public function __construct(int $departmentId = 0, int $grad = 19, $departmentName = null)
    {
        $this->departmentId = $departmentId;
        $this->grad = (string)$grad . '000000000';
        $this->departmentName = $departmentName;
    }

    public function query()
    {
        if ($this->departmentId == 0) {
            return Recruit::query()->where('nb', '>', "$this->grad");
        }

        array_splice($this->orderList, $this->departmentId - 1, 1);
        array_unshift($this->orderList, (string)$this->departmentId);
        
        return Recruit::query()->select('name', 'sex', 'nb', 
                                        'phone', 'email', 'college', 'class', 
                                        'part_1', 'part_2', 'introduction')
                                ->where('part_1', $this->departmentId)
                                ->orWhere('part_2', $this->departmentId)
                                ->orderby(DB::raw('FIND_IN_SET(part_1, "' . implode(",", $this->orderList) . '"' . ")"));
    }

    public function columnWidths(): array
    {
        return [
            'B' => 5,
            'F' => 5,
            'H' => 7,
            'I' => 7           
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
    
    public function headings(): array
    {
        return [
            '姓名',
            '性别',
            '学号',
            '手机号',
            '邮箱',
            '学院',
            '班级',
            '志愿一',
            '志愿二',
            '个人简介'
        ];
    }

    public function title(): string
    {
        return $this->departmentName . '纳新人员统计表';
    }
}

<?php

namespace App\Exports;

use App\Models\Warehouse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WarehouseExport implements FromCollection,  WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Warehouse::with('supplier')->get();
    }

    public function map($row): array{
        $fields = [
            $row->id,
            $row->type == 'input' ? "Nhập kho" : "Xuất kho",
            $row->qty,
            number_format($row->total_money,0,',','.'),
            $row->date_time,
            $row->supplier->name ?? "",
        ];
        return $fields;
    }

    public function headings(): array
    {
        return [
            'id',
            'Phân loại',
            'Số lượng',
            'Tổng tiền',
            'Ngày nhập/xuất',
            'Nhà cung cấp',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}

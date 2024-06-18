<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromCollection,  WithHeadings, WithMapping, WithStyles, WithEvents, WithColumnWidths, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category')->get();
    }

    public function map($row): array{
        $fields = [
            $row->id,
            $row->name,
            $row->number,
            $row->getStatus($row->status)['name'] ?? "Tạm dừng",
            number_format($row->price,0,',','.'),
            $row->category->name ?? "",
            $row->description,
        ];
        return $fields;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên Sản Phẩm',
            'Số Lượng',
            'Trạng Thái',
            'Giá Tiền',
            'Danh Mục',
            'Mô Tả',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:G1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('9E9E9E');
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 100,
            'F' => 20,
        ];
    }
}

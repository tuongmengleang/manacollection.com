<?php

namespace App\Exports;

use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminsExport implements FromView, WithMapping, WithColumnFormatting, ShouldAutoSize
{
  public function view(): View
  {
    return view('admin.users.export', [
      'admins' => Admin::all()
    ]);
  }

  public function map($admin): array
  {
    return [
      Date::dateTimeToExcel($admin->created_at)
    ];
  }

  public function columnFormats(): array
  {
    return [
      'E' => NumberFormat::FORMAT_DATE_XLSX22
    ];
  }
}

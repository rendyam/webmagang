<?php

namespace App\Exports;

use App\Models\TRequestTabs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class MagangExport implements FromCollection, WithHeadings, WithMapping
{
    public function map($data): array
    {
        return [
            $data->name,
            $data->nim,
            $data->email,
            $data->phone,
            $data->school,
            $data->levels == 0 ? 'SMA' : ($data->levels == 1 ? 'S1' : 'S2'),
            $data->start_date,
            $data->end_date,
            $data->spesialitation,
            $data->status->title,
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TRequestTabs::where('m_status_tabs_id', '!=', 1)->with('status')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Nim',
            'Email',
            'No. WA',
            'Sekolah/Univ',
            'Jenjang',
            'Mulai Magang',
            'Selesai Magang',
            'Bidang Peminatan Magang',
            'Status Request',
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResidentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;
    protected $voterStatus;

    public function __construct($search, $voterStatus)
    {
        $this->search = $search;
        $this->voterStatus = $voterStatus;
    }

    public function collection()
    {
        return Resident::when($this->search, function ($query) {
                return $query->where('family_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->voterStatus, function ($query) {
                return $query->where('voter_status', $this->voterStatus);
            })
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Family Name',
            'First Name',
            'Voter Status',
            'Created At',
        ];
    }

    public function map($resident): array
    {
        return [
            $resident->id,
            $resident->family_name,
            $resident->first_name,
            $resident->voter_status,
            $resident->created_at,
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResidentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;
    protected $socialClassification;

    public function __construct($search, $socialClassification)
    {
        $this->search = $search;
        $this->socialClassification = $socialClassification;
    }

    public function collection()
    {
        return Resident::when($this->search, function ($query) {
                return $query->where('family_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->socialClassification, function ($query) {
                return $query->whereJsonContains('social_classification', $this->socialClassification);
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
            'Middle Name',
            'Contact Number',
            'Email',
            'Birthday',
            'Birthplace',
            'Blood Type',
            'Sex',
            'Street Address',
            'Employment Status',
            'Employment Sector',
            'Educational Attainment',
            'Course',
            'Social Classification',
            'Voter Status',
            'Civil Status',
            'Spouse Name',
            'Spouse Employment Status',
            'Spouse Employment Sector',
            'Spouse Educational Attainment',
            'Spouse Course'
        ];
    }

    public function map($resident): array
    {
        return [
            $resident->id,
            $resident->family_name,
            $resident->first_name,
            $resident->middle_name,
            $resident->contact_number,
            $resident->email,
            $resident->birthday,
            $resident->birthplace,
            $resident->blood_type,
            $resident->sex,
            $resident->street_address,
            $resident->employment_status,
            $resident->employment_sector,
            $resident->educational_attainment,
            $resident->course,
            implode(', ', $resident->social_classification ?? []),
            $resident->voter_status,
            $resident->civil_status,
            $resident->spouse_name,
            $resident->spouse_employment_status,
            $resident->spouse_employment_sector,
            $resident->spouse_educational_attainment,
            $resident->spouse_course,
        ];
    }
}

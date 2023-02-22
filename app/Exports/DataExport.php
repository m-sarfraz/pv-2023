<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $collection;
    protected $headers;
    public function __construct($collection, $headers)
    {
        $this->collection = $collection;
        $this->headers = $headers;

    }

    public function collection()
    {
        return $this->collection;
    }
    public function headings(): array
    {
        return $this->headers;
    }
}

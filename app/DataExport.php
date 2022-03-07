<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataExport implements FromQuery
{
    use Exportable;
    private $user = [];
    public function __construct(array $user)
    {
        $this->user = $user;
    }
    public function downloadSheet($user)
    {
        return (new FastExcel($this->user))->download('file.xlsx');

    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class AuthorsExport implements FromArray
{
    protected $dataArray;

    public function __construct(array $dataArray)
    {
        $this->dataArray = $dataArray;
    }

    public function array(): array
    {
        return $this->dataArray;
    }
}

<?php
namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Book([
            'call_number' => $row['cn'],
            'title' => $row['books'],
            'author' => $row['authors'],
            'access_no' => json_encode(explode(',', $row['accession_number'])), // Keep the entire string
            'volume' => $row['volumes'],
            'year' => $row['year'],
            'publish' => $row['publish'],
        ]);
    }
}

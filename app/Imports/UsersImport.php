<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class UsersImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation, SkipsEmptyRows, SkipsOnFailure
{
    use Importable;
    use SkipsFailures;
    // use SkipsErrors;
    public function chunkSize(): int
    {
        return 50;
    }

    public function batchSize(): int
    {
        return 100;
    }

    protected $default_password;

    public function __construct($default_password)
    {
        $this->default_password = $default_password;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row["nim"] == null && $row["nama"] == null) {
            return null;
        }
        
        return new User([
            'username' => $row['nim'],
            'password' => $this->default_password,
        ]);
    }

    public function rules(): array
    {
        return [
            'nim' => 'required|unique:users,username|max:25',
        ];
    }
}

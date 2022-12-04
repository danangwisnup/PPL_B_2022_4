<?php

namespace App\Imports;

use App\Models\User;
use App\Models\tb_dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DosenImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // insert data ke tabel User and tb_dosen
        $user = User::create([
            'nim_nip' => str_replace(' ', '', $row['nip']),
            'email' => str_replace(' ', '', $row['email']),
            'nama' => $row['nama'],
            'role' => 'dosen',
            'password' => bcrypt(str_replace(' ', '', $row['nip'])),
        ]);

        $user = tb_dosen::create([
            'nip' => str_replace(' ', '', $row['nip']),
            'nama' => $row['nama'],
            'status' => str_replace(' ', '', $row['status']),
            'email' => str_replace(' ', '', $row['email']),
        ]);

        return $user;
    }

    public function rules(): array
    {
        return [
            'nip' => 'required|unique:users,nim_nip',
            'nama' => 'required',
            'status' => 'required',
            'email' => 'required|email',
        ];
    }
}

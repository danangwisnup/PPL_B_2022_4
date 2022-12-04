<?php

namespace App\Imports;

use App\Models\User;
use App\Models\tb_mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MahasiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Angkatan Mahasiswa
        // 24060120120120
        // 01234567890123
        $angkatan = 20 . substr($row['nim'], 6, 2);

        // 12 = SNMPTN
        // 13 = SBMPTN
        // 14 = Ujian Mandiri
        if (substr($row['nim'], 8, 2) == '12') {
            $jalur_masuk = 'SNMPTN';
        } elseif (substr($row['nim'], 8, 2) == '13') {
            $jalur_masuk = 'SBMPTN';
        } elseif (substr($row['nim'], 8, 2) == '14') {
            $jalur_masuk = 'Ujian Mandiri';
        } else {
            $jalur_masuk = 'SBUB';
        }

        // insert data ke tabel User and tb_mahasiswa
        $user = User::create([
            'nim_nip' => str_replace(' ', '', $row['nim']),
            'email' => str_replace(' ', '', $row['email'] ?? $row['nim'] . '@students.undip.ac.id'),
            'nama' => $row['nama'],
            'role' => 'mahasiswa',
            'password' => bcrypt(str_replace(' ', '', $row['nim'])),
        ]);

        $user = tb_mahasiswa::create([
            'nim' => str_replace(' ', '', $row['nim']),
            'nama' => $row['nama'],
            'status' => $row['status'],

            // jika tidak null dan null
            'angkatan' => str_replace(' ', '', $row['angkatan'] ?? $angkatan),
            'jalur_masuk' => $row['jalur_masuk'] ?? $jalur_masuk,
            'email' => str_replace(' ', '', $row['email'] ?? $row['nim'] . '@students.undip.ac.id'),
        ]);

        return $user;
    }

    public function rules(): array
    {
        return [
            'nim' => 'required|unique:tb_mahasiswas,nim',
            'nama' => 'required',
            'status' => 'required',
        ];
    }
}

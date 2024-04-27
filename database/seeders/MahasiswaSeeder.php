<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = [
            [
                'nim' => '24060121130086',
                'nama' => 'Muhammad Rizki',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121130050',
                'nama' => 'Rizki Utama Fauzi',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100001',
                'nama' => 'Ahmad Fauzi',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100002',
                'nama' => 'Ayu Kartika',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100003',
                'nama' => 'Adi Wijaya',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100004',
                'nama' => 'Budi Cahya',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100005',
                'nama' => 'Bayu Pratama',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100006',
                'nama' => 'Citra Dewi',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100007',
                'nama' => 'Dewi Anggraeni',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100008',
                'nama' => 'Eko Budi',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100009',
                'nama' => 'Fani Lestari',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100010',
                'nama' => 'Gunawan Surya',
                'status' => 'Baru',
            ],
            [
                'nim' => '24060121100011',
                'nama' => 'Hani Fitri',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121100012',
                'nama' => 'Indra Pratama',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121100013',
                'nama' => 'Irfan Pratama',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121100014',
                'nama' => 'Joko Santoso',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121100015',
                'nama' => 'Kartika Puspita',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121100016',
                'nama' => 'Lia Amelia',
                'status' => 'Nonaktif',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100017',
                'nama' => 'Mega Putri',
                'status' => 'Nonaktif',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100018',
                'nama' => 'Nadia Wulandari',
                'status' => 'Nonaktif',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100019',
                'nama' => 'Oscar Efendi',
                'status' => 'Nonaktif',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100020',
                'nama' => 'Putri Safitri',
                'status' => 'Nonaktif',
                'periode_pkl' => '2023/2024 Ganjil', // tidak lulus periode sebelumnya
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100021',
                'nama' => 'Rudi Hartono',
                'status' => 'Nonaktif',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100022',
                'nama' => 'Sari Indah',
                'status' => 'Nonaktif',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100023',
                'nama' => 'Toni Surya',
                'status' => 'Nonaktif',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100024',
                'nama' => 'Umar Fauzi',
                'status' => 'Nonaktif',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100025',
                'nama' => 'Vina Amelia',
                'status' => 'Nonaktif',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100026',
                'nama' => 'Wahyu Pratama',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100027',
                'nama' => 'Ratih Susanti',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100028',
                'nama' => 'Siti Nurjanah',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100029',
                'nama' => 'Cecep Suryana',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100030',
                'nama' => 'Ahmad Ali',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Ganjil', // tidak lulus periode sebelumnya
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100031',
                'nama' => 'Budi Santoso',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100032',
                'nama' => 'Didi Supriadi',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100033',
                'nama' => 'Reza Pratama',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,

            ],
            [
                'nim' => '24060121100034',
                'nama' => 'Tamara Putri',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,

            ],
            [
                'nim' => '24060121100035',
                'nama' => 'Ilham Pratama',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100036',
                'nama' => 'Ulfa Nurul',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100037',
                'nama' => 'Lucy Amelia',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100038',
                'nama' => 'Yuvi Andriyani',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100039',
                'nama' => 'Edi Surya',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100040',
                'nama' => 'Winarti',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Ganjil', // tidak lulus periode sebelumnya
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100041',
                'nama' => 'Kurniawan',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100042',
                'nama' => 'Ratna Sari',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100043',
                'nama' => 'Nurul Hidayah',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100044',
                'nama' => 'Rizki Pratama',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100045',
                'nama' => 'Putri Safitri',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100046',
                'nama' => 'Mutia Sari',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100047',
                'nama' => 'Zia Pratama',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100048',
                'nama' => 'Cici Amelia',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100049',
                'nama' => 'Bondan Pratama',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100050',
                'nama' => 'Zainal Abidin',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100051', 
                'nama' => 'Emily Johnson',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 6,
            ],
            [
                'nim' => '24060121100052', 
                'nama' => 'Daniel Smith',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 6,
            ],
            [
                'nim' => '24060121100053', 
                'nama' => 'Sophia Williams',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 7,
            ],
            [
                'nim' => '24060121100054', 
                'nama' => 'Michael Brown',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 7,
            ],
            [
                'nim' => '24060121100055', 
                'nama' => 'Olivia Jones',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 8,
            ],
            [
                'nim' => '24060121100056', 
                'nama' => 'James Davis',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 8,
            ],
            [
                'nim' => '24060121100057', 
                'nama' => 'Ava Miller',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 9,
            ],
            [
                'nim' => '24060121100058', 
                'nama' => 'William Wilson',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 9,
            ],
            [
                'nim' => '24060121100059', 
                'nama' => 'Isabella Taylor',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 10,
            ],
            [
                'nim' => '24060121100060', 
                'nama' => 'Benjamin Martinez',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 10,
            ],
            [
                'nim' => '24060121100061', 
                'nama' => 'Mia Anderson',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100062', 
                'nama' => 'Alexander White',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100063', 
                'nama' => 'Charlotte Garcia',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100064', 
                'nama' => 'Matthew Thompson',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100065', 
                'nama' => 'Amelia Hernandez',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100066', 
                'nama' => 'Ethan Clark',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 6,
            ],
            [
                'nim' => '24060121100067', 
                'nama' => 'Harper Lopez',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 7,
            ],
            [
                'nim' => '24060121100068', 
                'nama' => 'Jacob Lee',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 8,
            ],
            [
                'nim' => '24060121100069', 
                'nama' => 'Evelyn Perez',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 9,
            ],
            [
                'nim' => '24060121100070', 
                'nama' => 'Daniel Hall',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 10,
            ],
            [
                'nim' => '24060121100071', 
                'nama' => 'Abigail Gonzalez',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100072', 
                'nama' => 'Noah Lewis',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100073', 
                'nama' => 'Emily Baker',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100074', 
                'nama' => 'Samuel Harris',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100075', 
                'nama' => 'Elizabeth Young',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100076', 
                'nama' => 'David Scott',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 6,
            ],
            [
                'nim' => '24060121100077', 
                'nama' => 'Sofia Moore',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 7,
            ],
            [
                'nim' => '24060121100078', 
                'nama' => 'Oliver Walker',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 8,
            ],
            [
                'nim' => '24060121100079', 
                'nama' => 'Victoria Rodriguez',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 9,
            ],
            [
                'nim' => '24060121100080', 
                'nama' => 'Lucas Martin',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 10,
            ],
            [
                'nim' => '24060121100081', 
                'nama' => 'Grace Nguyen',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100082', 
                'nama' => 'Logan King',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100083', 
                'nama' => 'Aria Chavez',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100084', 
                'nama' => 'Jackson Green',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100085', 
                'nama' => 'Lily Rivera',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100086', 
                'nama' => 'Gabriel Adams',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100087', 
                'nama' => 'Addison Mitchell',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100088', 
                'nama' => 'Ryan Hill',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100089', 
                'nama' => 'Natalie Carter',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100090', 
                'nama' => 'John Nelson',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Genap',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100091', 
                'nama' => 'Ella Ramirez',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100092', 
                'nama' => 'Samuel Evans',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 1,
            ],
            [
                'nim' => '24060121100093', 
                'nama' => 'Scarlett Coleman',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100094', 
                'nama' => 'Christopher Hayes',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121100095', 
                'nama' => 'Zoey Wood',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100096', 
                'nama' => 'Nathan Ward',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 3,
            ],
            [
                'nim' => '24060121100097', 
                'nama' => 'Hannah Torres',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100098', 
                'nama' => 'Andrew Russell',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 4,
            ],
            [
                'nim' => '24060121100099', 
                'nama' => 'Brooklyn Barnes',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121100100', 
                'nama' => 'Isaac Hughes',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 5,
            ],


        ];

        foreach ($mahasiswa as $mhs) {
            \App\Models\Mahasiswa::create($mhs);
        }
    }
}

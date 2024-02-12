<?php

namespace Database\Seeders;

use App\Models\ArsipPKL;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArsipPKLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arsip_pkl = [
            [
                'nim' => '0110119001',
                'nama' => 'Mahasiswa 1',
                'periode_pkl' => '2023/2024 Ganjil',
                'instansi' => 'PT. A',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explicabo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
            [
                'nim' => '0110119002',
                'nama' => 'Mahasiswa 2',
                'periode_pkl' => '2023/2024 Ganjil',
                'instansi' => 'PT. B',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explicabo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
            [
                'nim' => '0110119003',
                'nama' => 'Mahasiswa 3',
                'periode_pkl' => '2023/2024 Ganjil',
                'instansi' => 'PT. C',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explic
                abo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
            [
                'nim' => '0110119004',
                'nama' => 'Mahasiswa 4',
                'periode_pkl' => '2022/2023 Genap',
                'instansi' => 'PT. C',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explic
                abo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
            [
                'nim' => '0110119005',
                'nama' => 'Mahasiswa 5',
                'periode_pkl' => '2022/2023 Genap',
                'instansi' => 'PT. C',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explic
                abo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
            [
                'nim' => '0110119006',
                'nama' => 'Mahasiswa 6',
                'periode_pkl' => '2022/2023 Genap',
                'instansi' => 'PT. C',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explic
                abo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
            [
                'nim' => '0110119007',
                'nama' => 'Mahasiswa 7',
                'periode_pkl' => '2022/2023 Ganjil',
                'instansi' => 'PT. C',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explic
                abo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
            [
                'nim' => '0110119008',
                'nama' => 'Mahasiswa 8',
                'periode_pkl' => '2022/2023 Ganjil',
                'instansi' => 'PT. C',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explic
                abo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
            [
                'nim' => '0110119009',
                'nama' => 'Mahasiswa 9',
                'periode_pkl' => '2022/2023 Ganjil',
                'instansi' => 'PT. C',
                'judul' => 'Sistem Informasi',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explic
                abo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Sistem',
                'keyword2' => 'Informasi',
                'keyword3' => 'Keyword 3',
                'keyword4' => 'Keyword 4',
                'keyword5' => 'Keyword 5',
                'link_laporan' => 'drive.google.com',
                'tgl_verif_laporan' => '2023-02-03 23:44:32',
                'nilai' => 'A',
            ],
        ];

        foreach ($arsip_pkl as $arsip) {
            ArsipPKL::create($arsip);
        }
    }
}

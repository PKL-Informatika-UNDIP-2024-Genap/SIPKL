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
                'nim' => '24060121130086',
                'nama' => 'Muhammad Rizki',
                'periode_pkl' => '2023/2024 Ganjil',
                'instansi' => 'Departemen Informatika',
                'judul' => 'Sistem Informasi PKL Departemen Informatika Universitas Diponegoro Berbasis Web Modul Koordinator',
                'abstrak' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus cumque quibusdam suscipit libero tenetur ipsum cupiditate vitae dicta, provident non ullam qui excepturi ex minus reprehenderit modi maiores facere labore sapiente! Explicabo ullam ipsam dolorum odio mollitia labore? Asperiores fugiat odit expedita, nobis excepturi eaque temporibus neque quae reprehenderit incidunt sapiente distinctio autem tempore ea a officia, repudiandae saepe corporis veritatis. Debitis quam obcaecati eum, voluptate laboriosam, delectus expedita eligendi cupiditate minima veniam ullam! Aliquid aliquam inventore ipsam soluta voluptas unde? Cupiditate non impedit inventore est, laudantium excepturi natus. Cupiditate ipsum asperiores cum illum, harum mollitia unde amet vel natus?',
                'keyword1' => 'Pengembangan',
                'keyword2' => 'Sistem',
                'keyword3' => 'Informasi',
                'keyword4' => 'Laporan',
                'keyword5' => 'PKL',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-12',
                'nilai_angka' => 100,
            ],
            [
                'nim' => '24060121130050',
                'nama' => 'Rizki Utama Fauzi',
                'periode_pkl' => '2023/2024 Ganjil',
                'instansi' => 'Departemen Informatika',
                'judul' => 'Sistem Informasi PKL Departemen Informatika Universitas Diponegoro Berbasis Web Modul Mahasiswa dan Pengarsipan',
                'abstrak' => 'Departemen Informatika Universitas Diponegoro secara berkala menyelenggarakan Praktik Kerja Lapangan (PKL) sebagai upaya meningkatkan kualitas pendidikan dan pengalaman praktis mahasiswa program studi Informatika. Akan tetapi, proses pelaporan pelaksanaan yang masih manual menjadi tantangan bagi koordinator PKL dalam mengelola dan memantau pelaksanaan PKL mahasiswa. Oleh karena itu, dibutuhkan sebuah sistem informasi yang terintegrasi dan efisien untuk mengelola kegiatan tersebut. Dalam pengembangan sistem informasi ini, penulis menerapkan metode Agile dan menggunakan Laravel—framework aplikasi web berbasis PHP—dan sistem manajemen basis data MySQL. Hasil dari praktik kerja lapangan ini adalah sebuah Sistem Informasi PKL Informatika Undip—sistem yang dapat meningkatkan efektivitas dan efisiensi pengelolaan data dan pemantauan pelaksanaan PKL. Laporan ini membahas secara khusus modul Mahasiswa dan Pengarsipan dari aplikasi. Dengan aplikasi ini, diharapkan mahasiswa dapat lebih mudah melaporkan perkembangan kegiatannya dan koordinator PKL dapat lebih efektif mengelola dan memantau pelaksanaan kegiatan PKL.',
                'keyword1' => 'PKL',
                'keyword2' => 'Sistem Informasi',
                'keyword3' => 'Aplikasi Web',
                'keyword4' => 'Laravel',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-12',
                'nilai_angka' => 100,
            ],

            [
                'nim' => '24060121100081',
                'nama' => 'Grace Nguyen',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. ABC',
                'judul' => 'Pengembangan Aplikasi Manajemen Keuangan',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Aplikasi Manajemen Keuangan',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'Keuangan',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-01 00:00:00',
                'nilai_angka' => 100,
            ],
            [
                'nim' => '24060121100082',
                'nama' => 'Logan King',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. XYZ',
                'judul' => 'Analisis Sistem Informasi Penjualan',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Penjualan',
                'keyword2' => 'Analisis',
                'keyword3' => 'Penjualan',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-01 00:00:00',
                'nilai_angka' => 80,
            ],
            [
                'nim' => '24060121100083',
                'nama' => 'Aria Chavez',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. DEF',
                'judul' => 'Pengembangan Aplikasi Mobile Banking',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Aplikasi Mobile Banking',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'Banking',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-02 00:00:00',
                'nilai_angka' => 70,
            ],
            [
                'nim' => '24060121100084',
                'nama' => 'Jackson Green',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. GHI',
                'judul' => 'Pengembangan Sistem Informasi Geografis',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Geografis',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'Geografis',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-02 00:00:00',
                'nilai_angka' => 90,
            ],
            [
                'nim' => '24060121100085',
                'nama' => 'Lily Rivera',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. JKL',
                'judul' => 'Analisis dan Perancangan Sistem Informasi Persediaan',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Persediaan',
                'keyword2' => 'Analisis',
                'keyword3' => 'Persediaan',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-03 00:00:00',
                'nilai_angka' => 85,
            ],
            [
                'nim' => '24060121100086',
                'nama' => 'Gabriel Adams',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. MNO',
                'judul' => 'Pengembangan Aplikasi E-Learning',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Aplikasi E-Learning',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'E-Learning',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-03 00:00:00',
                'nilai_angka' => 95,
            ],
            [
                'nim' => '24060121100087',
                'nama' => 'Addison Mitchell',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. PQR',
                'judul' => 'Analisis dan Perancangan Sistem Informasi Akademik',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Akademik',
                'keyword2' => 'Analisis',
                'keyword3' => 'Akademik',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-04 00:00:00',
                'nilai_angka' => 75,
            ],
            [
                'nim' => '24060121100088',
                'nama' => 'Ryan Hill',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. STU',
                'judul' => 'Pengembangan Aplikasi Pencarian Tempat Wisata',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Aplikasi Pencarian Tempat Wisata',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'Wisata',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-04 00:00:00',
                'nilai_angka' => 85,
            ],
            [
                'nim' => '24060121100089',
                'nama' => 'Natalie Carter',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. VWX',
                'judul' => 'Analisis dan Perancangan Sistem Informasi Manajemen Inventaris',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Manajemen Inventaris',
                'keyword2' => 'Analisis',
                'keyword3' => 'Inventaris',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-05 00:00:00',
                'nilai_angka' => 90,
            ],
            [
                'nim' => '24060121100090',
                'nama' => 'John Nelson',
                'periode_pkl' => '2024/2025 Ganjil',
                'instansi' => 'PT. YZB',
                'judul' => 'Analisis dan Perancangan Sistem Informasi Kepegawaian',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Kepegawaian',
                'keyword2' => 'Analisis',
                'keyword3' => 'Kepegawaian',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-09-05 00:00:00',
                'nilai_angka' => 80,
            ],

            [
                'nim' => '24060121100091',
                'nama' => 'Ella Ramirez',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. ABC',
                'judul' => 'Pengembangan Aplikasi Manajemen Keuangan',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Aplikasi Manajemen Keuangan',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'Keuangan',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 90,
            ],
            [
                'nim' => '24060121100092',
                'nama' => 'Samuel Evans',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. XYZ',
                'judul' => 'Analisis Sistem Informasi Penjualan',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Penjualan',
                'keyword2' => 'Analisis',
                'keyword3' => 'Penjualan',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 80,
            ],
            [
                'nim' => '24060121100093',
                'nama' => 'Scarlett Coleman',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. DEF',
                'judul' => 'Pengembangan Aplikasi Mobile Banking',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Aplikasi Mobile Banking',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'Banking',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 75,
            ],
            [
                'nim' => '24060121100094',
                'nama' => 'Christopher Hayes',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. GHI',
                'judul' => 'Pengembangan Sistem Informasi Geografis',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Geografis',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'Geografis',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 90,
            ],
            [
                'nim' => '24060121100095',
                'nama' => 'Zoey Wood',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. JKL',
                'judul' => 'Analisis dan Perancangan Sistem Informasi Persediaan',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Persediaan',
                'keyword2' => 'Analisis',
                'keyword3' => 'Persediaan',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 92,
            ],
            [
                'nim' => '24060121100096',
                'nama' => 'Nathan Ward',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. MNO',
                'judul' => 'Pengembangan Aplikasi E-Learning',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Aplikasi E-Learning',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'E-Learning',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 100,
            ],
            [
                'nim' => '24060121100097',
                'nama' => 'Hannah Torres',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. PQR',
                'judul' => 'Analisis dan Perancangan Sistem Informasi Akademik',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Akademik',
                'keyword2' => 'Analisis',
                'keyword3' => 'Akademik',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 75,
            ],
            [
                'nim' => '24060121100098',
                'nama' => 'Andrew Russell',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. STU',
                'judul' => 'Pengembangan Aplikasi Pencarian Tempat Wisata',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Aplikasi Pencarian Tempat Wisata',
                'keyword2' => 'Pengembangan',
                'keyword3' => 'Wisata',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 99,
            ],
            [
                'nim' => '24060121100099',
                'nama' => 'Brooklyn Barnes',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. VWX',
                'judul' => 'Analisis dan Perancangan Sistem Informasi Manajemen Inventaris',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Manajemen Inventaris',
                'keyword2' => 'Analisis',
                'keyword3' => 'Inventaris',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 92,
            ],
            [
                'nim' => '24060121100100',
                'nama' => 'Isaac Hughes',
                'periode_pkl' => '2023/2024 Genap',
                'instansi' => 'PT. YZB',
                'judul' => 'Analisis dan Perancangan Sistem Informasi Kepegawaian',
                'abstrak' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at dui a nunc vestibulum ultricies. Nam condimentum lorem in tortor fermentum, at cursus justo ultricies. In hac habitasse platea dictumst. Nulla non purus arcu. Quisque auctor nulla id sapien mollis ultricies. Donec id elit ut magna euismod auctor. In eu tellus justo. Duis posuere mauris nec leo vestibulum malesuada. Nam eget augue ut leo aliquet egestas non id purus. Nam non luctus felis. Vivamus interdum hendrerit commodo. Nulla at felis ut justo egestas gravida. Aliquam non velit at lorem dictum sodales at at augue. Sed id justo at nisi ullamcorper eleifend a in risus. Donec dignissim libero id lacinia gravida. Integer porta justo vel odio sodales, sit amet facilisis sem volutpat.',
                'keyword1' => 'Sistem Informasi Kepegawaian',
                'keyword2' => 'Analisis',
                'keyword3' => 'Kepegawaian',
                'link_berkas' => 'drive.google.com',
                'tgl_verif_laporan' => '2024-07-10 00:00:00',
                'nilai_angka' => 90,
            ],

     
        ];

        foreach ($arsip_pkl as $arsip) {
            ArsipPKL::create($arsip);
        }
    }
}

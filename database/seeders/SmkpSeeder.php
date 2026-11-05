<?php

namespace Database\Seeders;

use App\Models\SmkpCriteria;
use App\Models\SmkpElement;
use App\Models\SmkpIndicator;
use Illuminate\Database\Seeder;

class SmkpSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ELEMENT
        |--------------------------------------------------------------------------
        */

        $elements = [
            ['code' => 'I',   'name' => 'KEBIJAKAN', 'sort_order' => 1],
            ['code' => 'II',  'name' => 'PERENCANAAN', 'sort_order' => 2],
            ['code' => 'III', 'name' => 'ORGANISASI DAN PERSONEL', 'sort_order' => 3],
            ['code' => 'IV',  'name' => 'IMPLEMENTASI', 'sort_order' => 4],
            ['code' => 'V',   'name' => 'PEMANTAUAN, EVALUASI DAN TINDAK LANJUT', 'sort_order' => 5],
            ['code' => 'VI',  'name' => 'DOKUMENTASI', 'sort_order' => 6],
            ['code' => 'VII', 'name' => 'TINJAUAN MANAJEMEN DAN PENINGKATAN KINERJA', 'sort_order' => 7],
        ];

        foreach ($elements as $element) {
            SmkpElement::updateOrCreate(
                ['code' => $element['code']],
                [
                    'name' => $element['name'],
                    'sort_order' => $element['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA SMKP
        |--------------------------------------------------------------------------
        |
        | Format:
        |
        | 'element'    => Element I - VII
        | 'code'       => Kode kriteria
        | 'name'       => Nama kriteria
        | 'parent'     => Kode parent, null jika kriteria utama
        | 'indicators' => Daftar indikator
        |
        */

        $criteria = [

            // ==========================================================
            // I. KEBIJAKAN
            // ==========================================================

            [
                'element' => 'I',
                'code' => 'I.1',
                'name' => 'Penyusunan Kebijakan',
                'parent' => null,
                'indicators' => [
                    'Tinjauan awal',
                    'Memenuhi 3 syarat (Risiko KP, benchmarking, efektivitas sumber daya)',
                    'Melibatkan Departemen, pekerja atau serikat',
                    'Evaluasi kebijakan',
                ],
            ],

            [
                'element' => 'I',
                'code' => 'I.2',
                'name' => 'lsi  Kebiiakan',
                'parent' => null,
                'indicators' => [
                    'Isi Kebijakan',
                    'Terdapat visi, misi, tujuan',
                    'Komitmen melaksanakan KP',
                    'Sebagian isi kebijakan diturunkan menjadi program kerja',
                    'Seluruh isi kebijakan diturunkan menjadi program kerja',
                ],
            ],

            [
                'element' => 'I',
                'code' => 'I.3',
                'name' => 'Penetapan Kebijakan',
                'parent' => null,
                'indicators' => [
                    'Tertulis, tertanggal, ditandatangani',
                    'Disahkan pimpinan tertinggi',
                    'Bersifat dinamis',
                ],
            ],

            [
                'element' => 'I',
                'code' => 'I.4',
                'name' => 'Komunikasi Kebijakan',
                'parent' => null,
                'indicators' => [
                    'Melakukan komunikasi kebijakan (dijelaskan dan disebarluaskan)',
                    'Bahasa mudah dipahami (Bahasa Indonesia)',
                    'Menggunakan beberapa media',
                    'Dilakukan evaluasi ketersampaian informasi',
                ],
            ],

            [
                'element' => 'I',
                'code' => 'I.5',
                'name' => 'Tinjauan Kebijakan',
                'parent' => null,
                'indicators' => [
                    'Peninjauan secara berkala',
                    'Perubahan internal dan eksternal',
                    'Sebagian hasil tinjauan sbg masukan penyusunan kebijakan baru',
                    'Seluruh hasil tinjauan sbg masukan penyusunan kebijakan baru',
                ],
            ],

            // ==========================================================
            // II. PERENCANAAN
            // ==========================================================

            [
                'element' => 'II',
                'code' => 'II.1',
                'name' => 'Penelaahan Awal',
                'parent' => null,
                'indicators' => [
                    'Melakukan penelaahan awal (Proses bisnis, penyesuaian thdp peraturan, peninjauan kebijakan KP)',
                    'Menentukan tingkat ketercapaian KP (Tingkat dasar, reaktif, terencana, proaktif, resilient)',
                    'Sesuai dengan kondisi',
                    'Sinkron dengan program KP',
                ],
            ],

            [
                'element' => 'II',
                'code' => 'II.2',
                'name' => 'Manajemen Risiko',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'II',
                'code' => 'II.2.1',
                'name' => 'Komunikasi dan konsultasi risiko',
                'parent' => 'II.2',
                'indicators' => [
                    'Melakukan komunikasi dan konsultasi',
                    'Melakukan komunikasi dan konsultasi ke sebagian pemangku',
                    'Melakukan komunikasi dan konsultasi ke seluruh pemangku',
                    'Sebagian hasil menjadi bahan pertimbangan manajemen risiko',
                    'Seluruh hasil menjadi bahan pertimbangan manajemen risiko',
                ],
            ],

            [
                'element' => 'II',
                'code' => 'II.2.2',
                'name' => 'Penetapan konteks risiko',
                'parent' => 'II.2',
                'indicators' => [
                    'Melakukan penetapan konsteks (ruang lingkup, kegiatan, proses, metodologi penilaian risiko)',
                    'Mencakup sebagian faktor Internal (proses rutin non rutin, perubahan organisasi, faktor pekerja,SPIP)',
                    'Mencakup seluruh faktor Internal (proses rutin non rutin, perubahan organisasi, faktor pekerja,SPIP)',
                    'Mencakup sebagian Faktor Eksternal (PESTEL)',
                    'Mencakup seluruh Faktor Eksternal (PESTEL)',
                ],
            ],

            [
                'element' => 'II',
                'code' => 'II.2.3',
                'name' => 'Identifikasi bahaya',
                'parent' => 'II.2',
                'indicators' => [
                    'Melakukan identifikasi bahaya (sumber2 bahaya, area terpapar bahaya, konsekuensi bahaya)',
                    'Seluruh bahaya diidentifikasi',
                ],
            ],

            [
                'element' => 'II',
                'code' => 'II.2.4',
                'name' => 'Penilaian dan pengendalian risiko',
                'parent' => 'II.2',
                'indicators' => [
                    'Melakukan penilaian dan pengendalian (ruang lingkup, sifat, waktu) : Kualitatif, Semi kualitatif, Kuantitatif',
                    'Dikendalikan sesuai hirarki pengendalian (Eliminasi, subtitusi, isolasi, administrasi, prosedur, APD)',
                    'Implementasi pengendalian',
                ],
            ],

            [
                'element' => 'II',
                'code' => 'II.2.5',
                'name' => 'Pemantauan dan peninjauan',
                'parent' => 'II.2',
                'indicators' => [
                    'Melakukan pemantauan dan peninjauan',
                    'Dilakukan secara periodik atau terjadi kecelakaan, kejadian berbahaya, PAK',
                    'Pada proses dan kegiatan baru',
                    'Hasil memadai',
                ],
            ],

            [
                'element' => 'II',
                'code' => 'II.3',
                'name' => 'Identifikasi dan Kepatuhan Terhadap Ketentuan Peraturan Perundang-undangan dan Persyaratan Lainnya yang Terkait',
                'parent' => null,
                'indicators' => [
                    'Melakukan identifikasi dan kepatuhan peraturan',
                    'Sebagian evaluasi telah mematuhi',
                    'Seluruh evaluasi telah mematuhi',
                ],
            ],

            [
                'element' => 'II',
                'code' => 'II.4',
                'name' => 'Penetapan Tujuan, Sasaran, dan Program',
                'parent' => null,
                'indicators' => [
                    'Melakukan penetapan TSP (Peraturan, kebijakan, risiko,kinerja, kecelakaan, sumberdaya, waktu)',
                    'Disahkan oleh Komite KP',
                    'Selaras dengan kebijakan dan terukur',
                    'Program mempertimbangkan seluruh ketentuan penyusunnya',
                ],
            ],

            [
                'element' => 'II',
                'code' => 'II.5',
                'name' => 'Rencana Kerja dan Anggaran Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [
                    'Penetapan RKAB aspek KP',
                    'Mempertimbangkan skala prioritas',
                    'Pemenuhan perundangan dan persyaratan lain',
                    'Mendapatkan persetujuan : IUP dari pemerintah (menteri/gubernur), IUJP dari IUP',
                ],
            ],
                        // ==========================================================
            // III. ORGANISASI DAN PERSONEL
            // ==========================================================

            [
                'element' => 'III',
                'code' => 'III.1',
                'name' => 'Penyusunan dan Penetapan Struktur Organisasi, Tugas, Tanggung Jawab, dan Wewenang',
                'parent' => null,
                'indicators' => [
                    'Memiliki SO menggambarkan posisi KTT atau PTL, PJO, PO, PT, dan Pengelola KP, serta Kepala Tambang Bawah',
                    'Sesuai ketentuan peraturan perundangan',
                    'Integrasi dgn SO pemegang izin',
                    'Memenuhi ketentuan yg dipersyaratkan',
                    'Dikomunikasikan ke pekerja dan pihak terkait',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.2',
                'name' => 'Penunjukan KTT, Kepala Tambang Bawah Tanah, dan/atau Kepala Kapal Keruk untuk Perusahaan Pertambangan',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'III',
                'code' => 'III.2.1',
                'name' => 'Penunjukan KTT',
                'parent' => 'III.2',
                'indicators' => [
                    'Pengesahan dari KaIT',
                    'Sertifikat KTT sesuai kompetensi (metode tambang, produksi, jumlah pekerja, jenis mineral)',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.2.2',
                'name' => 'Penunjukan Kepala Tambang Bawah Tanah',
                'parent' => 'III.2',
                'indicators' => [
                    'Pengesahan dari KaIT',
                    'Sertifikat KTT sesuai kompetensi',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.2.3',
                'name' => 'Penunjukan Kepala Kapal Keruk',
                'parent' => 'III.2',
                'indicators' => [
                    'Pengesahan dari KTT',
                    'Seluruh KK mendapat surat dr KTT',
                    'Seluruh KK mempunyai KKK',
                    'KKK memiliki sertifikat kompetensi',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.3',
                'name' => 'Penunjukan PJO Untuk Perusahaan Jasa Pertambangan',
                'parent' => null,
                'indicators' => [
                    'Pengesahan dari KTT',
                    'PJO memiliki persyaratan administrasi (jabatan tertinggi di site, uji kemahiran bhs indonesia tingkat madya) dan teknis (memahasi aspek pertambangan, sertifikat)',
                    'Seluruh PJP memiliki PJO',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.4',
                'name' => 'Pembentukan dan Penetapan Bagian K3 Pertambangan dan KO Pertambangan',
                'parent' => null,
                'indicators' => [
                    'KTT Membentuk dan menetapkan K3 dan KO',
                    'Dibentuk berdasarkan jumlah pekerja, sifat dan luas pekerjaan',
                    'Berada didalam struktur organisasi KTT atau dibawah PJO untuk IUJP',
                    'Tugas tanggung jawab mencakup seluruh ruang lingkup sesuai peraturan perundangan',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.5',
                'name' => 'Penunjukan Pengawas Operasional dan Pengawas Teknik',
                'parent' => null,
                'indicators' => [
                    'KTT mengangkat sebagian PO dengan surat penunjukkan',
                    'KTT mengangkat sebagian PT dengan surat pengesahan',
                    'KTT mengangkat seluruh PO dengan surat penunjukkan',
                    'KTT mengangkat seluruh PT dengan surat pengesahan',
                    'Sebagian PO memiliki kartu pengawas dari KaIT',
                    'Seluruh PO memiliki kartu pengawas dari KaIT',
                    'PO dan PT menjalankan tugas dan tanggung jawab',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.6',
                'name' => 'Penunjukan Tenaga Teknik Khusus Pertambangan',
                'parent' => null,
                'indicators' => [
                    'KTT menunjuk TTKP berkompeten (juru ledak, ukur, las, bor, derek, rawat, pemadam kebakaran, tim TGD, dll)',
                    'Membuat daftar TTKP',
                    'Sebagian TTKP memiliki surat penunjukan KTT',
                    'Seluruh TTKP memiliki surat penunjukan KTT',
                    'Sebagian TTKP memiliki sertifikasi kompetensi yg ditetapkan KTT/pemerintah',
                    'Seluruh TTKP memiliki sertifikasi kompetensi yg ditetapkan KTT/pemerintah',
                    'Sebagian TTKP menjalankan tugas dan tanggung jawab sesuai perundangan',
                    'Seluruh TTKP menjalankan tugas dan tanggung jawab sesuai perundangan',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.7',
                'name' => 'Pembentukan dan Penetapan Komite Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin membentuk dan menetapkan KKP (Ketua dijabat KTT, wakil ketua, sekretaris dijabat pengelola KP tertinggi, anggota)',
                    'Disahkan KTT atau PJO',
                    'Anggota dari sebagian perwakilan bagian K3, KO, operasional pertambangan, wakil pekerja',
                    'Anggota dari seluruh perwakilan bagian K3, KO, operasional pertambangan, wakil pekerja',
                    'Sebagian anggota mendapatkan pelatihan',
                    'Seluruh anggota mendapatkan pelatihan',
                    'Menjalankan tugas dan tanggungjawab (menetapkan TSP, memastikan terselenggaranya audit, tinjauna menajemen, membahas program pencegahan kecelakaan, rapat minimal 1 bulan sekali, dll)',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.8',
                'name' => 'Penunjukan Tim Tanggap Darurat',
                'parent' => null,
                'indicators' => [
                    'KTT telah menunjuk TTD',
                    'Dilaporkan ke KaIT',
                    'Mencakup sebagian area kerja',
                    'Mencakup seluruh area kerja',
                    'Selalu siap siaga',
                    'Memiliki ketrampilan dan kompetensi',
                    'Mendapatkan pendidikan dan pelatihan',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.9',
                'name' => 'Seleksi dan Penempatan Personel',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin mengatur seleksi dan penempatan personil secara tertulis',
                    'Mempertimbangkan identifikasi kompetensi kerja',
                    'Memasukkan aspek KP',
                    'Setiap personel memiliki tugas dan tanggungjawab mencakup aspek KP',
                    'Setiap personel memahami dan menjalankan tugas dan tanggungjawab mencakup aspek KP',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.10',
                'name' => 'Penyelenggaraan dan Pelaksanaan Pendidikan dan Pelatihan Serta Kompetensi Kerja',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'III',
                'code' => 'III.10.1',
                'name' => 'Pendidikan dan pelatihan pekerja tambang',
                'parent' => 'III.10',
                'indicators' => [
                    'Pemegang izin menyelenggarakan dan melaksanan diklat kepada pekerja, PO, PT',
                    'Pengumpulan data dan informasi yg mencakup identifikasi pekerjaan dilakukan secara memadai',
                    'Berdasarkan TNA',
                    'Monitoring dan evaluasi diklat dilakukan secara memadai',
                    'Hasil monitoring dan evaluasi ditindaklanjuti',
                    'Program diklat mencapai target dan sasaran yg diharapkan',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.10.2',
                'name' => 'Kompetensi Kerja',
                'parent' => 'III.10',
                'indicators' => [
                    'Pemegang izin mengidentifikasi standar kompetensi KP',
                    'Sebagian pekerja, PO, PT memiliki kompetensi sesuai peraturan',
                    'Seluruh pekerja, PO, PT memiliki kompetensi sesuai peraturan',
                    'Hasil identifikasi kompetensi digunakan dasar penentuan program diklat',
                    'Hasil identifikasi kompetensi digunakan promosi dan penilaian kinerja',
                    'Standar kompetensi dikembangkan sesuai kebutuhan',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.11',
                'name' => 'Penyusunan, Penetapan, dan Penerapan Komunikasi Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin menyusun mekanisme untuk mengkomunikasikan hal2 thdp aspek KP',
                    'Pemegang izin menyusun mekanisme apabila ada kecelakaan, PAK, PTK, dll',
                    'Pemegang izin menerapkan mekanisme untuk mengkomunikasikan hal2 thdp aspek KP',
                    'Pemegang izin mengevaluasi penyampaian informasi kepada pihak terkait',
                    'Informasi yg disampaikan ditindaklanjuti dan dpt dikontrol KTT',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.12',
                'name' => 'Pengelolaan Administrasi Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'III',
                'code' => 'III.12.1',
                'name' => 'Buku tambang',
                'parent' => 'III.12',
                'indicators' => [
                    'Pemegang izin memiliki buku tambang',
                    'Dapat dibaca dan dipelajari pekerja',
                    'KTT memastikan pekerja memahami isi buku tambang',
                    'KTT melakukan sebagian larangan, perintah, petunjuk IT',
                    'KTT melakukan seluruh larangan, perintah, petunjuk IT',
                    'KTT mencatat sebagian hal2 yg diwajibkan untuk didaftarkan di buku tambang',
                    'KTT mencatat seluruh hal2 yg diwajibkan untuk didaftarkan di buku tambang',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.12.2',
                'name' => 'Buku daftar kecelakaan tambang',
                'parent' => 'III.12',
                'indicators' => [
                    'Pemegang izin memiliki buku daftar kecelakaan tambang',
                    'KTT mendaftarkan sebagian kecelakaan (cidera ringan, berat, mati) di buku daftar',
                    'KTT mendaftarkan seluruh kecelakaan (cidera ringan, berat, mati) di buku daftar',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.12.3',
                'name' => 'Pelaporan pengelolaan Keselamatan Pertambangan',
                'parent' => 'III.12',
                'indicators' => [
                    'Pemegang izin melaporkan aspek KP',
                    'Menyampaikan seluruh laporan tertulis aspek KP kepada KaIT',
                    'Sesuai format',
                    'Memenuhi waktu (bulanan, triwulan, tahunan, khusus)',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.12.4',
                'name' => 'Dokumentasi Kejadian Berbahaya, kejadian akibat penyakit tenaga kerja dan penyakit akibat kerja',
                'parent' => 'III.12',
                'indicators' => [
                    'KTT mendokumentasi sebagian kejadian berbahaya, PAK PTK',
                    'KTT mendokumentasi seluruh kejadian berbahaya, PAK PTK',
                    'Menggunakan format khusus',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.12.5',
                'name' => 'Dokumen dan Laporan Pemenuhan Kompetensi dan Persyaratan Lainnya',
                'parent' => 'III.12',
                'indicators' => [
                    'Pemegang izin mendokumentasikan sebagian kelayakan SPIP, sertifikat, laporan kompetensi',
                    'Pemegang izin mendokumentasikan seluruh kelayakan SPIP, sertifikat, laporan kompetensi',
                    'Melakukan pemantauan dan pelaporan pemenuhan kompetensi sesuai peraturan',
                ],
            ],

            [
                'element' => 'III',
                'code' => 'III.13',
                'name' => 'Penyusunan, Penetapan, dan Penerapan Prosedur Partisipasi, Konsultasi, Motivasi, dan Kesadaran Penerapan SMKP Minerba',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin menyusun, menetapkan penerapan SMKP',
                    'Pemegang izin menerapkan, mengevaluasi, mendokumentasi penerapan SMKP',
                    'Melibatkan sebagian departemen dari pekerja',
                    'Melibatkan seluruh departemen dari pekerja',
                    'Proses partisipasi, konsultasi, motivasi menjadi masukan dlm peningkatan KP',
                ],
            ],
                        // ==========================================================
            // IV. IMPLEMENTASI
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.1',
                'name' => 'Pelaksanaan Pengelolaan Operasional',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.1.1',
                'name' => 'Penyusunan, Penetapan, Penerapan, Pendokumentasian, dan Evaluasi Prosedur Operasi / Kerja',
                'parent' => 'IV.1',
                'indicators' => [
                    'Terdapat prosedur kerja',
                    'Prosedur disahkan KTT dan diberi nomor',
                    'Prosedur terdapat di setiap pekerjaan',
                    'Prosedur mempertimbangkan BBS',
                    'Prosedur dikomunikasikan ke pihak terkait',
                    'Prosedur dievaluasi berkala',
                    'Konsisten diterapkan seluruh pekerja',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.1.2',
                'name' => 'Penyusunan, Penetapan, Penerapan, Pendokumentasian, dan Evaluasi Izin kerja khusus',
                'parent' => 'IV.1',
                'indicators' => [
                    'Menyusun dan menetapkan izin kerja khusus',
                    'Mempertimbangkan BBS',
                    'Dievaluasi berkala',
                    'Konsisten diterapkan seluruh pekerja',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.1.3',
                'name' => 'Penyusunan, Penetapan, Penerapan, Pendokumentasian, dan Evaluasi Prosedur Operasi / Kerja Alat pelindung diri dan alat keselamatan',
                'parent' => 'IV.1',
                'indicators' => [
                    'Menilai kebutuhan APD sesuai jenis pekerjaan',
                    'Melaksanakan pelatihan APD',
                    'Evaluasi kepatuhan APD',
                    'Pekerja patuh penggunaan APD',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2',
                'name' => 'Pelaksanaan Pengelolaan Lingkungan Kerja',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.1',
                'name' => 'Pelaksanaan pengelolaan Bahaya Debu',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya dan karakteristik',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.2',
                'name' => 'Pelaksanaan pengelolaan Bahaya Kebisingan',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya dan karakteristik',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.3',
                'name' => 'Pelaksanaan pengelolaan Bahaya Getaran',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya dan getaran tubuh. Tangan, lengan',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.4',
                'name' => 'Pelaksanaan pengelolaan Bahaya Pencahayaan',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya dan karakteristik',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.5',
                'name' => 'Pelaksanaan pengelolaan Kuantitas dan Kualitas Udara Kerja',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya dan karakteristik',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.6',
                'name' => 'Pelaksanaan pengelolaan Iklim Kerja',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya dan indikator index suhu basah dan bola',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.7',
                'name' => 'Pelaksanaan pengelolaan Bahaya Radiasi',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya terkait radiasi alamiah, buatan, pengion dan non pengion',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.8',
                'name' => 'Pelaksanaan pengelolaan Faktor Kimia',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.9',
                'name' => 'Pelaksanaan pengelolaan Faktor Biologi',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya berasal mirko dan makro organisme',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.2.10',
                'name' => 'Pelaksanaan Kebersihan Lingkungan Kerja',
                'parent' => 'IV.2',
                'indicators' => [
                    'Menetapkan prosedur',
                    'Antisipasi dan pengenalan bahaya',
                    'Evaluasi secara berkala yg terdokumentasikan',
                    'Evaluasi dilakukan tenaga berkompeten',
                    'Evaluasi menggunakan alat terkalibrasi',
                    'Sebagian hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                    'Seluruh hasil evaluasi ditindaklanjuti sesuai hirarki pengendalian',
                ],
            ],
                        // ==========================================================
            // IV.3 PELAKSANAAN PENGELOLAAN KESEHATAN KERJA
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.3',
                'name' => 'Pelaksanaan Pengelolaan Kesehatan Kerja',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.1',
                'name' => 'Pemeriksaan Kesehatan',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur pemeriksaan kesehatan',
                    'Pemegang izin melaksanakan sebagian pemeriksaan kesehatan (awal, berkala, khusus, akhir)',
                    'Pemegang izin melaksanakan seluruh pemeriksaan kesehatan (awal, berkala, khusus, akhir)',
                    'Pedoman pemeriksaan disusun oleh dokter psh dan disahkan KTT',
                    'Menindaklanjuti seluruh hasil pemeriksaan kesehatan',
                    'Evaluasi catatan kesehatan pekerja',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.2',
                'name' => 'Pelayanan Kesehatan',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin melakukan pelayanan kesehatan',
                    'Pemegang izin mentapkan prosedur pelayanan kesehatan',
                    'Pemegang izin menyediakan tenaga kesehatan (dokter psh, perawat, dll)',
                    'Penyediaan tenaga kesehatan sesuai peraturan',
                    'Pemegang izin menyediakan sarana dan prasarana (ruangan, peralatan medis, alat evakuasi, dll)',
                    'Penyediaan sarana prasarana sesuai peraturan',
                    'Kualifikasi pelayanan kesehatan kerja sudah sesuai (Kegawatdaruratan, Pratama, Utama)',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.3',
                'name' => 'Pertolongan Pertama pada Kecelakaan',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin melaksanakan pengelolaan P3K',
                    'Pemegang izin mentapkan prosedur P3K',
                    'Pemegang izin menyediakan petugas berkompeten, fasilitas, peralatan',
                    'Pemegang izin mengadakan pelatihan untuk P3K',
                    'Penyediaan petugas berkompeten, fasilitas, peralatan sesuai peraturan',
                    'Penyediaan pelatihan P3K sesuai peraturan',
                    'Kotak P3K dikelola sesuai peraturan',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.4',
                'name' => 'Pengelolaan Kelelahan Kerja (Fatigue)',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin melakukan pengelolaan kelelahan kerja',
                    'Pemegang izin menetapkan prosedur pengelolaan kelelahan kerja',
                    'Pemegang izin melakukan identifikasi, evaluasi dan pengendalian faktor yg menimbulkan kelelahan',
                    'Pemegang izin memberikan diklat/sosialisasi tentang pengelolaan kelelahan',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.5',
                'name' => 'Pengelolaan Pekerja pada Tempat yang Memiliki Risiko Kesehatan Tinggi',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin melakukan pengelolaan pekerja di tempat yg memiliki risiko kesehatan tinggi',
                    'Pemengan izin menetapkan prosedur',
                    'Risiko dikendalikan secara memadai',
                    'Pekerja memahami cara kerja aman dan konsekuensi',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.6',
                'name' => 'Pengelolaan Rekaman Data Kesehatan Kerja',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin melakukan pengelolaan rekaman kesehatan kerja',
                    'Pemegang izin menetapkan prosedur',
                    'Pemegang izin memelihara rekaman kesehatan kerja',
                    'Pemegang izin menganalisa dan mengevaluasi rekaman kesehatan kerja',
                    'Pemegang izin membuat statistik kinerja kesehatan kerja (leading dan lagging indicator)',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.7',
                'name' => 'Pengelolaan Higiene dan Sanitasi',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin melakukan pengelolaan higiene dan sanitasi',
                    'Pemegang izin menetapkan prosedur',
                    'Pemegang izin menyediakan fasilitas menunjang tercapainya higienitas yg memadai',
                    'Pemegang izin melakukan pengelolaan sanitasi minimal : tempat sampah, toilet, wastafel, kebersihan lantai, ruang ganti, kamar mandi yg memadai',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.8',
                'name' => 'Pengelolaan Ergonomi',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin melakukan pengelolaan ergonomi',
                    'Pemegang izin menetapkan prosedur',
                    'Pemegang izin melakukan penilaian risiko ergonomi',
                    'Hasil penilaian risiko memadai',
                    'Pemegang izin menyediakan sebagian prosedur kerja SPIP',
                    'Pemegang izin menyediakan seluruh prosedur kerja SPIP',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.9',
                'name' => 'Pengelolaan Makanan, Minuman dan Gizi Pekerja',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin melakukan pengelolaan makanan, minuman, gizi pekerja',
                    'Pemegang izin menetapkan prosedur',
                    'Penyediaan makanan minuman memenuhi syarat',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.3.10',
                'name' => 'Diagnosis dan Pemeriksaan Penyakit Akibat Kerja',
                'parent' => 'IV.3',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur',
                    'Pemegang izin melakukan diagnosis PAK oleh dokter psh',
                    'KTT melaporkan kepada KaIT',
                    'Formulir sudah tepat',
                    'Batas waktu tepat',
                    'Pemegang izin melakukan upaya kuratif dan rehabilitasi thpd PAK',
                ],
            ],

            // ==========================================================
            // IV.4 PENGELOLAAN KO PERTAMBANGAN
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.4',
                'name' => 'Pelaksanaan Pengelolaan KO Pertambangan',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.4.1',
                'name' => 'Sistem dan pelaksanaan pemeliharaan / perawatan sarana, prasarana, instalasi, dan peralatan pertambangan',
                'parent' => 'IV.4',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur',
                    'Pemegang izin membuat daftar SPIP',
                    'Pemegang izin membuat program, jadwal, prosedur pemeliharaan dan perawatan',
                    'Pelaksanaan program, jadwal, prosedur sesuai dengan jadwal',
                    'Pemeliharaan dan perawatan dilakukan oleh tenaga berkompeten',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.4.2',
                'name' => 'Pengamanan instalasi',
                'parent' => 'IV.4',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur',
                    'Pemegang izin membuat daftar instalasi pertambangan',
                    'Pemegang izin membuat program, jadwal, dan prosedur pengamanan, pemasangan, dan pemeliharaan pengamanan instalasi',
                    'Pelaksanaan program, jadwal, prosedur sesuai dengan jadwal',
                    'Pemeliharaan dan perawatan dilakukan oleh tenaga berkompeten',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.4.3',
                'name' => 'Kelayakan sarana, prasarana, instalasi, dan peralatan pertambangan',
                'parent' => 'IV.4',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur',
                    'Pemegang izin membuat daftar SPIP',
                    'Pemegang izin membuat program, jadwal, dan prosedur pengujian kelayakan sarana, prasarana, instalasi, dan peralatan Pertambangan',
                    'Pelaksanaan program, jadwal, prosedur sesuai dengan jadwal',
                    'Pemeliharaan dan perawatan dilakukan oleh tenaga berkompeten',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.4.4',
                'name' => 'Kompetensi tenaga teknik',
                'parent' => 'IV.4',
                'indicators' => [
                    'Pemegang izin menunjuk tenaga teknik berkompeten untuk menyusun prosedur, program, jadwal dan pengujian kelayakan SPIP',
                    'Jumlah tenaga teknik berkompeten memadai',
                    'Bukti kerja Tenaga Teknis Pertambangan yang Berkompeten telah memadai pengelolaan KO',
                    'Pelaksanaan program tenaga teknik sesuai dengan jadwal',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.4.5',
                'name' => 'Evaluasi Laporan Hasil Kajian Teknis Pertambangan',
                'parent' => 'IV.4',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur',
                    'Pemegang izin membuat kajian teknis saat awal kegiatan',
                    'Pemegang izin membuat kajian teknis bila terjadi perubahan thdp proses SPIP',
                    'Hasil kajian teknis memadai dan disampaikan ke KaIT',
                    'Hasil kajian memadai',
                ],
            ],

            // ==========================================================
            // IV.5 BAHAN PELEDAK DAN PELEDAKAN
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.5',
                'name' => 'Pelaksanaan Pengelolaan Bahan Peledak dan Peledakan',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.5.1',
                'name' => 'Gudang bahan peledak',
                'parent' => 'IV.5',
                'indicators' => [
                    'Pemegang izin memiliki izin yg disahkan KaIT',
                    'Sebagian fasilitas keselamatan & keamanan memadai (security, kepala gudang, pagar, CCTV, hidrant, APAR, penyalur petir, alarm, dll) memadai dan dilakukan pemeliharaan',
                    'Seluruh fasilitas keselamatan & keamanan memadai (security, kepala gudang, pagar, CCTV, hidrant, APAR, penyalur petir, alarm, dll) memadai dan dilakukan pemeliharaan',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.5.2',
                'name' => 'Penyimpanan bahan peledak',
                'parent' => 'IV.5',
                'indicators' => [
                    'Pemegang izin memiliki prosedur peyimpanan handak',
                    'Prosedur dijalankan dengan baik (lampiran peta, dll)',
                    'Pengelolaan administrasi handak (buku catatan keluar masuk handak)',
                    'Penunjukkan petugas administrasi dan petugas gudang',
                    'Petugas administrasi dan petugas gudang memiliki kartu pekerja peledakan (KPP pratama, madya)',
                    'Pemeriksaan handak (stock opname mingguan)',
                    'Pelaporan secara berkala kepada KaIT (triwulan)',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.5.3',
                'name' => 'Pengangkutan bahan peledak',
                'parent' => 'IV.5',
                'indicators' => [
                    'Pemegang izin mempunyai prosedur pengangkutan bahan peledak',
                    'Melakukan penetapan pengamanan (prosedur pengamanan)',
                    'Kelayakan peralatan dan kendaraan (hasil commisioning, pemeriksaan harian, kelayakan unit berbentuk tangki, forklift)',
                    'Hasil pengelolaan pengangkutan bahan peledak memadai',
                    'Kompetensi pekerja (KPP Pertama = satpam, Madya = personel peledakan)',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.5.4',
                'name' => 'Pekerjaan peledakan',
                'parent' => 'IV.5',
                'indicators' => [
                    'Pemegang izin memiliki prosedur (tahap persiapan, peledakan, pasca, gagal ledak)',
                    'Penyediaan peralatan (prosedur, tempat penyimpaan, kalibrasi)',
                    'Mendokumentasi pemeliharaan peralatan (hasil pemeriksaan, kalibrasi, dll)',
                    'Pekerja memiliki kartu izin 
KIM : menguji pola peledakan, menetapkan daerah bahaya peledakan, menyuruh orang menyingkir dan berlindung, meledakkan lubang ledak, menangani kegagalan peledakan, menyambung sirkit peledakan ke sirkit detonator, mengendalikan akibat peledakan, memastikan hasil peledakan
KPP Madya : membuat primer, mengisi bahan peledak ke lubang ledak, merangkai dan menyambung bahan peledak
KPP Pertama : menyumbat lubang ledak',
                ],
            ],

            // ==========================================================
            // IV.6 PERANCANGAN DAN REKAYASA
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.6',
                'name' => 'Penetapan Sistem Perancangan dan Rekayasa',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.6.1',
                'name' => 'Perancangan dan rekayasa',
                'parent' => 'IV.6',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur mempertimbangkan aspek KP pada tahap perancangan SPIP',
                    'Petugas memiliki kompetensi (verifikasi dan persetujuan yg ditunjuk oleh KTT)',
                    'Prosedur dilaksanakan dengan baik',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.6.2',
                'name' => 'Perubahan dan modifikasi',
                'parent' => 'IV.6',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur terkait perubahan dan modifikasi',
                    'Petugas memiliki kompetensi (identifikasi dan tinjauan ulang)',
                    'Prosedur dilaksanakan dengan baik',
                ],
            ],

            // ==========================================================
            // IV.7 SISTEM PEMBELIAN
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.7',
                'name' => 'Penetapan Sistem Pembelian',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin menetapkan prosedur pembelian yang terdokumentasi sesuai dengan spesifikasi teknik, persyaratan KP dan peraturan',
                    'Penetapan prosedur spesikasi pembelian, seleksi pembelian, verifikasi kesesuaian',
                    'Terlaksana implementasi prosedur',
                    'Penjelasan dan sosialisasi ke semua pihak terkait IBPR',
                ],
            ],

            // ==========================================================
            // IV.8 PERUSAHAAN JASA PERTAMBANGAN
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.8',
                'name' => 'Pemantauan dan Pengelolaan Perusahaan Jasa Pertambangan',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.8.1',
                'name' => 'Persyaratan, seleksi dan penetapan perusahaan jasa pertambangan',
                'parent' => 'IV.8',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur persyaratan dan seleksi penetapan IUJP tertuang persyaratan KP',
                    'Kontrak kerja memuat komitmen perusahaan jasa mematuhi persyaratan Keselamatan Pertambangan pemegang izin',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.8.2',
                'name' => 'Tanggung jawab, pemantauan dan pelaporan perusahaan jasa pertambangan',
                'parent' => 'IV.8',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur tanggung jawab, pemantauan dan pelaporan perusahaan jasa pertambangan',
                    'Perusahaan jasa pertambangan memiliki pekerja yg kompeten',
                    'Perusahaan jasa pertambangan menggunakan SPIP dan memiliki bukti kelayakan',
                    'Perusahaan jasa pertambangan melaporkan kepada KTT tentang program KP secara berkala',
                ],
            ],

            [
                'element' => 'IV',
                'code' => 'IV.8.3',
                'name' => 'Evaluasi perusahaan jasa pertambangan',
                'parent' => 'IV.8',
                'indicators' => [
                    'Pemegang izin menetapkan prosedur evaluasi perusahaan jasa pertambangan (kegiatan evaluasi, penilaian hasil evaluasi, laporan dan tindak lanjut evaluasi)',
                    'Melakukan evaluasi prosedur dan memberikan umpan balik',
                ],
            ],

            // ==========================================================
            // IV.9 KEADAAN DARURAT
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.9',
                'name' => 'Pengelolaan Keadaan Darurat',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin menetapkan prosedur penggelolaan keadaan darurat',
                    'Mencakup identifikasi dan penilaian potensi keadaan darurat, pencegahan keadaan darurat, kesiapsiagaan keadaan darurat, respon keadaan darurat, dan pemulihan keadaan darurat',
                    'Prosedur tersebut telah dilaksanakan dengan baik',
                ],
            ],

            // ==========================================================
            // IV.10 P3K
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.10',
                'name' => 'Penyediaan dan Penyiapan P3K',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin menetapkan prosedur penyediaan dan penyimpanan P3K',
                    'Mencakup petugas P3K, kotak P3K, isi kotak P3K, dan pencatatan penggunaan isi kotak P3K',
                    'Prosedur tersebut telah dilaksanakan dengan baik',
                ],
            ],

            // ==========================================================
            // IV.11 OFF THE JOB SAFETY
            // ==========================================================

            [
                'element' => 'IV',
                'code' => 'IV.11',
                'name' => 'Pelaksanaan keselamatan di luar pekerjaan (off the job safety)',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin mengkomunikasikan keselamatan di luar pekerjaan kepada semua Pekerja dan keluarganya',
                    'Materi promosi dan kegiatan didokumentasikan',
                    'Dilakukan di seluruh departemen dari pekerja',
                ],
            ],
                        // ==========================================================
            // V. PEMANTAUAN, EVALUASI DAN TINDAK LANJUT
            // ==========================================================

            [
                'element' => 'V',
                'code' => 'V.1',
                'name' => 'Pemantauan dan pengukuran kinerja',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'V',
                'code' => 'V.1.1',
                'name' => 'Pemantauan dan Pengukuran Pencapaian Tujuan, Sasaran, dan Program Keselamatan Pertambangan',
                'parent' => 'V.1',
                'indicators' => [
                    'Pemegang izin memiliki prosedur pemantauan dan pengukuran pencapaian TSP KP',
                    'Prosedur menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai',
                    'Dilakukan sesuai prosedur',
                    'Hasil pemantauan seluruhnya didokumentasi, dievaluasi dan dibuat perbaikan tindak lanjutnya',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.1.2',
                'name' => 'Pemantauan dan Pengukuran Kinerja Pengelolaan lingkungan kerja',
                'parent' => 'V.1',
                'indicators' => [
                    'Pemengang izin memiliki prosedur pemantauan, pengukuran kinerja, evaluasi, dan tindak lanjut pengelolaan lingkungan kerja yang menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai (debu, kebisingan, getaran, cahaya, dll)',
                    'Dilakukan sesuai prosedur',
                    'Dilakukan oleh petugas higiene industri',
                    'Menetapkan rencana tindak lanjut dan perbaikan berdasarkan hasil evaluasi',
                    'Sebagian tindak lanjut telah dilaksanakan',
                    'Seluruh tindak lanjut telah dilaksanakan',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.1.3',
                'name' => 'Pemantauan dan Pengukuran Kinerja Pengelolaan kesehatan kerja',
                'parent' => 'V.1',
                'indicators' => [
                    'Pemegang izin  prosedur pemantauan, pengukuran kinerja, evaluasi, dan tindak lanjut pengelolaan kesehatan kerja Pertambangan yang menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai ( pemeriksaan kesehatan, pelayanan kesehatan, P3K, fatig, higiene, sanitasi, ergonomi, PAK, dll)',
                    'Pemantauan, pengukuran, dan evaluasi pengelolaan kesehatan kerja Pertambangan telah dilaksanakan sesuai prosedur',
                    'Pemegang izin menetapkan rencana tindak lanjut dan perbaikan berdasarkan hasil evaluasi',
                    'Sebagian tindak lanjut dan perbaikan berdasarkan hasil evaluasi telah dilaksanakan',
                    'Seluruh tindak lanjut dan perbaikan berdasarkan hasil evaluasi telah dilaksanakan',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.1.4',
                'name' => 'Pemantauan dan Pengukuran Kinerja Pengelolaan Keselamatan Operasi Pertambangan',
                'parent' => 'V.1',
                'indicators' => [
                    'Pemegang izin memiliki prosedur pemantauan, pengukuran kinerja, evaluasi, dan tindak lanjut pengelolaan Keselamatan Operasi Pertambangan yang menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai (SPIP, kompetensi tenaga teknik, evaluasi laporan hasil kajian teknis)',
                    'Pemantauan, pengukuran, dan evaluasi pengelolaan Keselamatan Operasi Pertambangan telah dilaksanakan sesuai prosedur',
                    'Pemantauan dan pengukuran dilaksanakan oleh Tenaga Teknis Pertambangan yang Berkompeten di bidang Keselamatan Operasi',
                    'Pemegang izin menetapkan rencana tindak lanjut dan perbaikan berdasarkan hasil evaluasi',
                    'Sebagian tindak lanjut dan perbaikan berdasarkan hasil evaluasi telah dilaksanakan',
                    'Seluruh tindak lanjut dan perbaikan berdasarkan hasil evaluasi telah dilaksanakan',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.1.5',
                'name' => 'Pemantauan dan Pengukuran Kinerja Pengelolaan Bahan Peledak dan Peledakan',
                'parent' => 'V.1',
                'indicators' => [
                    'Pemegang izin prosedur pemantauan, pengukuran kinerja, evaluasi, dan tindak lanjut pengelolaan bahan peledak dan peledakan yang menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai (gudang handak, penyimpanan handak, pekerjaan peledakan, pengankutan)',
                    'Pemantauan, pengukuran, dan evaluasi pengelolaan bahan peledak dan peledakan telah dilaksanakan sesuai prosedur',
                    'Menetapkan rencana tindak lanjut dan perbaikan berdasarkan hasil evaluasi',
                    'Sebagian tindak lanjut dan perbaikan berdasarkan hasil evaluasi telah dilaksanakan',
                    'Seluruh tindak lanjut dan perbaikan berdasarkan hasil evaluasi telah dilaksanakan',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.2',
                'name' => 'Inspeksi Pelaksanaan Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin memiliki prosedur inspeksi Keselamatan Pertambangan',
                    'Prosedur menjelaskan tujuan, jenis, pelaksana, objek, jadwal dan frekuensi, lembar periksa, peralatan, metode atau tata cara, pelaksanaan, klasifikasi bahaya, laporan, tindak lanjut, evaluasi, dan dokumentasi yang sesuai',
                    'Evaluasi, pelaksanaan inspeksi Keselamatan Pertambangan telah dilaksanakan sesuai prosedur',
                    'Hasil inspeksi sebagian didokumentasikan dan dibuat rencana perbaikan',
                    'Hasil inspeksi seluruhnya didokumentasikan dan dibuat rencana perbaikan',
                    'Rencana perbaikan sebagian dilaksanakan',
                    'Rencana perbaikan seluruhnya dilaksanakan',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.3',
                'name' => 'Evaluasi kepatuhan Terhadap Ketentuan Peraturan Perundang-Undangan dan Persyaratan Lainnya Yang Terkait',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin memiliki prosedur evaluasi kepatuhan',
                    'Prosedur telah memadai',
                    'Pelaksanaan evaluasi dilakukan sesuai prosedur',
                    'Pemegang izin menyusun rencana dan pelaksanaan tindaklanjut berdasarkan hasil evaluasi',
                    'Seluruh rencana pelaksanaan perbaikan ditindaklanjuti',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.4',
                'name' => 'Penyelidikan Kecelakaan, Kejadian Berbahaya, dan Penyakit Akibat Kerja',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin memiliki prosedur',
                    'Prosedur meliputi pelaporan awal, pengamanan lokasi, pembentukan tim penyelidikan, tahapan penyelidikan, tahap evaluasi penyelidikan kecelakaan',
                    'Sebagian dilaksanakan sesuai prosedur',
                    'Seluruhnya dilaksanakan sesuai prosedur',
                    'Sebagian didokumentasikan, dikomunikasikan dan dilaksanakan',
                    'Seluruh didokumentasikan, dikomunikasikan dan dilaksanakan',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.5',
                'name' => 'Evaluasi Pengelolaan Administrasi Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [],
            ],

            [
                'element' => 'V',
                'code' => 'V.5.1',
                'name' => 'Buku tambang',
                'parent' => 'V.5',
                'indicators' => [
                    'Mencakup sebagian mencakup pelaksanaan perintah, larangan, petunjuk dari KaIT',
                    'Mencakup seluruh mencakup pelaksanaan perintah, larangan, petunjuk dari KaIT',
                    'Evaluasi minimal 1x dalam 6 bulan',
                    'Hasil evaluasi ditindaklanjuti',
                    'KTT melaksanakan perintah, larangan, petunjuk',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.5.2',
                'name' => 'Buku daftar kecelakaan tambang',
                'parent' => 'V.5',
                'indicators' => [
                    'Terdapat kolom waktu, hari, dan jam kecelakaan, tempat kecelakaan, nama, jenis, kelamin, dan umur dari korban kecelakaan, dll (ttd KTT, lapor ke KaIT)',
                    'Evaluasi minimal 1x dalam 6 bulan',
                    'Hasil evaluasi ditindaklanjuti',
                    'KTT mendaftarkan sebagian kecelakaan tambang yang berakibat cidera ringan, berat, dan mati',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.5.3',
                'name' => 'Pelaporan pengelolaan keselamatan pertambangan',
                'parent' => 'V.5',
                'indicators' => [
                    'Melakukan evaluasi',
                    'Evaluasi tepat waktu, isi sesuai',
                    'Evaluasi minimal 1x dalam 6 bulan',
                    'Hasil evaluasi ditindaklanjuti',
                    'KTT menyampaikan laporan tertulis kepada KaIT sesuai format dan waktu',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.5.4',
                'name' => 'Dokumentasi Kejadian Berbahaya, kejadian akibat penyakit tenaga kerja dan penyakit akibat kerja',
                'parent' => 'V.5',
                'indicators' => [
                    'Melakukan evaluasi',
                    'Evaluasi tepat waktu, isi sesuai',
                    'Evaluasi minimal 1x dalam 6 bulan',
                    'Hasil evaluasi ditindaklanjuti',
                    'KTT mendokumentasikan sebagian kejadian berbahaya, PAK, PTK telah menggunakan format khusus yang ditentukan oleh KaIT',
                    'KTT mendokumentasikan seluruh kejadian berbahaya, PAK, PTK telah menggunakan format khusus yang ditentukan oleh KaIT',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.5.5',
                'name' => 'Dokumentasi dan Laporan pemenuhan Kompetensi serta Persyaratan Lainnya',
                'parent' => 'V.5',
                'indicators' => [
                    'Melakukan evaluasi',
                    'Evaluasi mencakup tingkat pemenuhan persyaratan dan pelaksanaan tindak lanjut',
                    'Evaluasi minimal 1x dalam 6 bulan',
                    'Hasil evaluasi ditindaklanjuti',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.6',
                'name' => 'Audit Internal Penerapan SMKP Minerba atau SMKP Khusus untuk pengolahan dan/ atau pemurnian',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin melakukan audit minimal 1 tahun sekali',
                    'Pemegang izin mempunyai prosedur',
                    'Prosedur terpadat ruang lingkup, frekuensi, metodologi, kompetensi auditor, tanggung jawab dan persyaratan pelaksanaan audit, serta pelaporan hasil audit',
                    'Pelaksanaan audit dilakukan sesuai prosedur',
                    'Hasil audit didokumentasikan, dibuat rencana tindak lanjut, dan dilaksanakan',
                ],
            ],

            [
                'element' => 'V',
                'code' => 'V.7',
                'name' => 'Rencana Perbaikan dan Tindak Lanjut',
                'parent' => null,
                'indicators' => [
                    'Memiliki prosedur kerja',
                    'Prosedur memadai (identifikasi, analisa penyebab, tindakan pencegahan, hasil tindakan pecegahan, tindak lanjut)',
                    'Pelaksanaan dilakukan sesuai prosedur',
                    'Pelaksanaan sebagian didokumentasikan dan dilaksanakan',
                    'Pelaksanaan seluruhnya didokumentasikan dan dilaksanakan',
                ],
            ],

            // ==========================================================
            // VI. DOKUMENTASI
            // ==========================================================

            [
                'element' => 'VI',
                'code' => 'VI.1',
                'name' => 'Penyusunan Penetapan dan Pendokumentasian Manual SMKP Minerba atau SMKP Khusus pada Pengolahan dan/atau Pemurnian',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin mempunyai manual SMKP',
                    'Manual SMKP mencakup ruang lingkup, prosedur terdokumentasi',
                    'Disahkan oleh pemegang izin',
                    'Disosialisasikan kepada seluruh departemen dari pekerja',
                    'Secara konsisten digunakan dalan penyusunan level selanjutnya',
                ],
            ],

            [
                'element' => 'VI',
                'code' => 'VI.2',
                'name' => 'Penyusunan Penetapan, Penerapan dan Pendokumentasian Prosedur pengendalian Dokumen Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin mempunyai prosedur pengendalian dokumen',
                    'Prosedur meliputi pengeluaran, pengendalian, perubahan, identifikasi dan pengelolaan dr luar',
                    'Diterapkan secara konsisten',
                ],
            ],

            [
                'element' => 'VI',
                'code' => 'VI.3',
                'name' => 'Penyusunan Penetapan, Penerapan dan Pendokumentasian Prosedur pengendalian Rekaman Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin mempunyai prosedur pengendalian rekaman',
                    'Prosedur meliputi identifikasi, penyimpanan, perlindungan, akses, penentuan masa simpan dan pemusnahan',
                    'Diterapkan secara konsisten',
                    'Rekaman didokumentasikan dgn konsisten sehingga dpt dibaca, diidentifikasi dan ditelusuri',
                ],
            ],

            [
                'element' => 'VI',
                'code' => 'VI.4',
                'name' => 'Penetapan Jenis Dokumen dan Rekaman',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin menetapkan jenis dokumen dan rekaman yg mencakup sebagian elemen SMKP',
                    'Pemegang izin menetapkan jenis dokumen dan rekaman yg mencakup seluruh elemen SMKP',
                ],
            ],

            // ==========================================================
            // VII. TINJAUAN MANAJEMEN DAN PENINGKATAN KINERJA
            // ==========================================================

            [
                'element' => 'VII',
                'code' => 'VII.1',
                'name' => 'Pelaksanaan Tinjauan Manajemen Penerapan SMKP Minerba atau SMKP Khusus pada pengolahan dan/atau Pemurnian oleh Manajemen Tertinggi Perusahaan',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin melakukan RTM',
                    'RTM dilakukan pimpinan tertinggi',
                    'Dilakukan terencana minimal 1 tahun sekali',
                ],
            ],

            [
                'element' => 'VII',
                'code' => 'VII.2',
                'name' => 'Pendokumentasian Catatan Hasil Tinjauan Manajemen',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin mendokumentasikan hasil tinjauan manajemen',
                    'Tinjauan manajemen meliputi : kebijakan KP, hasil audit, daftar risiko, kepatuhan peraturan, tindak lanjut RTM sebelumnya, tingkat pencapaian KP, kecelakaan, kejadian berbahaya, PAK, PTK',
                ],
            ],

            [
                'element' => 'VII',
                'code' => 'VII.3',
                'name' => 'Keluaran dari Tinjauan Manajemen Keselamatan Pertambangan',
                'parent' => null,
                'indicators' => [
                    'Menghasilkan keputusan dan tindakan yg berhubungan dgn efektifitas sistem manajemen',
                    'Mempertimbangkan : kebijakan KP, kinerja KO sumberdaya, elemen2 lain SMKP',
                ],
            ],

            [
                'element' => 'VII',
                'code' => 'VII.4',
                'name' => 'Pencatatan, Pendokumentasian, dan Pelaporan Hasil Tinjauan Manajemen',
                'parent' => null,
                'indicators' => [
                    'Didokumentasikan, dilaporkan ke pihak2 berkepentingan',
                    'Dikomunikasikan kepada yg memerlukan',
                ],
            ],

            [
                'element' => 'VII',
                'code' => 'VII.5',
                'name' => 'Pelaksanaan Peningkatan Kinerja',
                'parent' => null,
                'indicators' => [
                    'Melaksanakan peningkatan kinerja',
                ],
            ],

            [
                'element' => 'VII',
                'code' => 'VII.6',
                'name' => 'Penggunaan Tinjauan Hasil dari Tindak Lanjut Rencana Perbaikan dalam Penentuan Kebijakan',
                'parent' => null,
                'indicators' => [
                    'Pemegang izin menggunakan sebagian tinjauan dari tindak lanjut sbg dasar dlm penentuan kebijakan',
                    'Pemegang izin menggunakan seluruh tinjauan dari tindak lanjut sbg dasar dlm penentuan kebijakan',
                ],
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | INSERT CRITERIA + INDICATORS
        |--------------------------------------------------------------------------
        */

        foreach ($criteria as $index => $item) {

            $element = SmkpElement::where('code', $item['element'])
                ->firstOrFail();

            $parentId = null;

            if ($item['parent']) {
                $parentId = SmkpCriteria::where('code', $item['parent'])
                    ->value('id');

                if (!$parentId) {
                    throw new \RuntimeException(
                        "Parent criteria {$item['parent']} tidak ditemukan."
                    );
                }
            }

            $criteriaModel = SmkpCriteria::updateOrCreate(
                [
                    'code' => $item['code'],
                ],
                [
                    'smkp_element_id' => $element->id,
                    'parent_id' => $parentId,
                    'name' => $item['name'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );

            /*
             * Hapus indikator lama supaya ketika Seeder dijalankan ulang,
             * data tidak menjadi duplikat.
             */
            SmkpIndicator::where(
                'smkp_criteria_id',
                $criteriaModel->id
            )->delete();

            foreach ($item['indicators'] as $indicatorIndex => $indicator) {
                SmkpIndicator::create([
                    'smkp_criteria_id' => $criteriaModel->id,
                    'indicator' => $indicator,
                    'sort_order' => $indicatorIndex + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
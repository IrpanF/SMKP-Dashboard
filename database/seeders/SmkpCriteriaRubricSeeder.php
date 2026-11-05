<?php

namespace Database\Seeders;

use App\Models\SmkpCriteria;
use App\Models\SmkpCriteriaRubric;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmkpCriteriaRubricSeeder extends Seeder
{
    public function run(): void
    {
        $rubrics = [
            // ELEMEN I — KEBIJAKAN
            'I.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penyusunan kebijakan.',
                    '1' => 'Terdapat bukti bahwa pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan tinjauan awal kondisi Keselamatan Pertambangan, tetapi belum memenuhi secara menyeluruh ketiga syarat penyusunan tinjauan awal dan belum melibatkan seluruh departemen/bagian dari Pekerja atau serikat Pekerja.',
                    '2' => 'Tinjauan awal kondisi Keselamatan Pertambangan telah memenuhi tiga syarat penyusunan tinjauan awal, tetapi belum melibatkan seluruh departemen/bagian dari Pekerja atau serikat Pekerja; atau telah melibatkan seluruh departemen/bagian dari Pekerja atau serikat Pekerja, tetapi belum memenuhi tiga syarat penyusunan tinjauan awal.',
                    '3' => 'Tinjauan awal kondisi Keselamatan Pertambangan telah memenuhi tiga syarat dan melibatkan seluruh departemen/bagian dari Pekerja atau serikat Pekerja dalam penyusunan kebijakan, tetapi belum dilakukan evaluasi terhadap penyusunan kebijakan tersebut.',
                    '4' => 'Tinjauan awal kondisi Keselamatan Pertambangan telah memenuhi tiga syarat, melibatkan seluruh departemen/bagian dari Pekerja atau serikat Pekerja dalam penyusunan kebijakan, dan telah dilakukan evaluasi terhadap penyusunan kebijakan tersebut.',
                ],
            ],

            'I.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah memiliki isi kebijakan.',
                    '1' => 'Terdapat bukti bahwa isi kebijakan telah tersedia, tetapi belum terdapat visi, misi, dan tujuan, atau belum terdapat komitmen dalam melaksanakan Keselamatan Pertambangan.',
                    '2' => 'Isi kebijakan telah memuat visi, misi, tujuan, serta komitmen dalam melaksanakan Keselamatan Pertambangan, tetapi belum ada isi kebijakan yang diturunkan menjadi program kerja Keselamatan Pertambangan.',
                    '3' => 'Isi kebijakan telah memuat visi, misi, tujuan, serta komitmen dalam melaksanakan Keselamatan Pertambangan, tetapi belum semua isi kebijakan diturunkan menjadi program kerja Keselamatan Pertambangan.',
                    '4' => 'Isi kebijakan telah memuat visi, misi, tujuan, serta komitmen dalam melaksanakan Keselamatan Pertambangan, dan semua isi kebijakan telah diturunkan menjadi program kerja Keselamatan Pertambangan.',
                ],
            ],

            'I.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penetapan kebijakan.',
                    '1' => 'Kebijakan telah ditetapkan secara tertulis, tetapi belum disahkan oleh pimpinan tertinggi pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP.',
                    '2' => 'Kebijakan telah ditetapkan secara tertulis dan disahkan oleh pimpinan tertinggi, tetapi belum bersifat dinamis.',
                    '3' => 'Kebijakan telah ditetapkan secara tertulis, disahkan oleh pimpinan tertinggi, dan bersifat dinamis, yaitu menyesuaikan perubahan yang ada pada pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP.',
                ],
            ],

            'I.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan komunikasi kebijakan.',
                    '1' => 'Komunikasi kebijakan telah dilakukan, tetapi belum menggunakan bahasa yang dapat dipahami oleh Pekerja dan belum menggunakan beberapa media seperti papan pengumuman, brosur, penyampaian verbal dalam apel (briefing), dan/atau media lainnya.',
                    '2' => 'Komunikasi kebijakan telah menggunakan bahasa yang dapat dipahami oleh Pekerja, tetapi belum menggunakan beberapa media; atau telah menggunakan beberapa media, tetapi belum menggunakan bahasa yang dapat dipahami oleh Pekerja.',
                    '3' => 'Komunikasi kebijakan telah menggunakan bahasa yang dapat dipahami oleh Pekerja dan beberapa media, tetapi belum melakukan evaluasi ketersampaian informasi kepada seluruh departemen/bagian dari Pekerja.',
                    '4' => 'Komunikasi kebijakan telah menggunakan bahasa yang dapat dipahami oleh Pekerja dan beberapa media, serta telah melakukan evaluasi ketersampaian informasi kepada seluruh departemen/bagian dari Pekerja.',
                ],
            ],

            'I.5' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan tinjauan kebijakan oleh manajemen secara berkala.',
                    '1' => 'Tinjauan kebijakan dilakukan secara berkala dengan menyesuaikan perubahan internal, tetapi belum menyesuaikan perubahan eksternal seperti ketentuan peraturan perundang-undangan dan standar.',
                    '2' => 'Tinjauan kebijakan dilakukan secara berkala dengan menyesuaikan perubahan internal dan eksternal, seperti ketentuan peraturan perundang-undangan dan standar.',
                    '3' => 'Tinjauan kebijakan telah menyesuaikan perubahan internal dan eksternal, serta sebagian hasil tinjauan ditindaklanjuti sebagai masukan dalam penyusunan kebijakan baru.',
                    '4' => 'Tinjauan kebijakan telah menyesuaikan perubahan internal dan eksternal, serta seluruh hasil tinjauan ditindaklanjuti sebagai masukan dalam penyusunan kebijakan baru.',
                ],
            ],

            // ELEMEN II — PERENCANAAN
            'II.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penelaahan awal dalam perencanaan.',
                    '1' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penelaahan awal dalam perencanaan, namun belum menentukan tingkat pencapaian kinerja Keselamatan Pertambangan.',
                    '2' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penelaahan awal dalam perencanaan, dan telah menentukan tingkat pencapaian kinerja Keselamatan Pertambangan, namun tidak sesuai dengan kondisi.',
                    '3' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penelaahan awal dalam perencanaan, menentukan tingkat pencapaian kinerja Keselamatan Pertambangan yang telah sesuai dengan kondisi, namun belum sinkron dengan program Keselamatan Pertambangan yang ditetapkan.',
                    '4' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penelaahan awal dalam perencanaan, menentukan tingkat pencapaian kinerja Keselamatan Pertambangan yang telah sesuai dengan kondisi, dan telah sinkron dengan program Keselamatan Pertambangan yang ditetapkan.',
                ],
            ],

            'II.2.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan komunikasi dan konsultasi risiko.',
                    '1' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan komunikasi dan konsultasi risiko, namun baru dengan sebagian pemangku kepentingan.',
                    '2' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan komunikasi dan konsultasi risiko dengan seluruh pemangku kepentingan, namun hasil dari komunikasi dan konsultasi risiko tidak menjadi bahan pertimbangan dalam Manajemen Risiko.',
                    '3' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan komunikasi dan konsultasi risiko dengan seluruh pemangku kepentingan, namun baru sebagian dari hasil komunikasi dan konsultasi risiko menjadi bahan pertimbangan dalam Manajemen Risiko.',
                    '4' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan komunikasi dan konsultasi risiko dengan seluruh pemangku kepentingan, serta seluruh hasil dari komunikasi dan konsultasi risiko menjadi bahan pertimbangan dalam Manajemen Risiko.',
                ],
            ],

            'II.2.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penetapan konteks risiko.',
                    '1' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penetapan konteks risiko, namun baru mencakup faktor internal atau faktor eksternal.',
                    '2' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penetapan konteks risiko yang telah mencakup sebagian faktor internal dan sebagian faktor eksternal (belum seluruhnya).',
                    '3' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penetapan konteks risiko yang telah mencakup seluruh faktor internal dan faktor eksternal.',
                ],
            ],

            'II.2.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan identifikasi bahaya.',
                    '1' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan identifikasi bahaya, namun belum seluruh bahaya diidentifikasi.',
                    '2' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan identifikasi bahaya, dan telah seluruh bahaya diidentifikasi.',
                ],
            ],

            'II.2.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penilaian dan pengendalian risiko.',
                    '1' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penilaian risiko atau pengendalian risiko, namun belum seluruh bahaya yang teridentifikasi telah dinilai atau belum dikendalikan sesuai dengan hirarki pengendalian.',
                    '2' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penilaian dan pengendalian risiko yang sesuai dengan hirarki pengendalian, namun implementasi pengendaliannya belum memadai.',
                    '3' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan pengendalian risiko yang sesuai dengan hirarki pengendalian, dan implementasi pengendaliannya telah memadai.',
                ],
            ],

            'II.2.5' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan pemantauan dan peninjauan risiko.',
                    '1' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan pemantauan dan peninjauan risiko, namun belum secara periodik atau apabila terjadi kecelakaan atau kejadian berbahaya, Penyakit Akibat Kerja, perubahan dalam peralatan, instalasi, dan/atau proses serta kegiatan, dan proses serta kegiatan baru belum dilakukan pemantauan dan peninjauan.',
                    '2' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan pemantauan dan peninjauan risiko pada kondisi yang dipersyaratkan, namun hasilnya belum memadai.',
                    '3' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan pemantauan dan peninjauan risiko pada kondisi yang dipersyaratkan, serta hasilnya telah memadai.',
                ],
            ],

            'II.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan identifikasi dan kepatuhan ketentuan peraturan perundang-undangan dan persyaratan lainnya yang terkait.',
                    '1' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan identifikasi dan pemantauan terhadap ketentuan peraturan perundang-undangan dan persyaratan lainnya, namun belum melakukan evaluasi kepatuhan terhadap ketentuan peraturan perundang-undangan dan persyaratan perizinan.',
                    '2' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan identifikasi dan pemantauan terhadap ketentuan peraturan perundang-undangan dan persyaratan lainnya, namun berdasarkan hasil evaluasi masih terdapat beberapa peraturan perundang-undangan dan/atau persyaratan perizinan belum dipatuhi.',
                    '3' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan identifikasi dan pemantauan terhadap ketentuan peraturan perundang-undangan dan persyaratan lainnya, dan berdasarkan evaluasi telah mematuhi ketentuan peraturan perundang-undangan dan persyaratan perizinan.',
                ],
            ],

            'II.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penetapan tujuan, sasaran, dan program.',
                    '1' => 'Terdapat bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah melakukan penetapan tujuan, sasaran, dan program, namun belum selaras dengan kebijakan, belum terukur, dan belum disahkan oleh Komite Keselamatan Pertambangan.',
                    '2' => 'Terdapat bukti bahwa tujuan, sasaran, dan program telah disahkan oleh Komite Keselamatan Pertambangan, tetapi sebagian besar belum selaras dengan kebijakan dan belum terukur, serta penyusunan program belum mempertimbangkan seluruh ketentuan penyusunan.',
                    '3' => 'Terdapat bukti bahwa tujuan, sasaran, dan program telah disahkan oleh Komite Keselamatan Pertambangan, seluruh tujuan, sasaran, dan program yang ditetapkan telah selaras dengan kebijakan dan telah terukur, tetapi penyusunan program belum seluruhnya mempertimbangkan seluruh ketentuan penyusunan.',
                    '4' => 'Terdapat bukti bahwa tujuan, sasaran, dan program telah disahkan oleh Komite Keselamatan Pertambangan, seluruh tujuan, sasaran, dan program yang ditetapkan telah selaras dengan kebijakan dan telah terukur, serta penyusunan program telah seluruhnya mempertimbangkan seluruh ketentuan penyusunan.',
                ],
            ],

            'II.5' => [
                'iup_iupk_ipr' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR telah melakukan penetapan rencana kerja anggaran dan biaya aspek Keselamatan Pertambangan yang mendapat persetujuan dari Direktur Jenderal atas nama Menteri atau Gubernur sesuai kewenangannya.',
                    '1' => 'Terdapat bukti bahwa pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR telah menetapkan rencana kerja anggaran dan biaya aspek Keselamatan Pertambangan, namun penyusunannya belum mempertimbangkan skala prioritas sasaran dan program Keselamatan Pertambangan, kebutuhan perbaikan dan peningkatan berkelanjutan, serta pemenuhan peraturan dan persyaratan terkait, dan belum mendapat persetujuan dari Direktur Jenderal atas nama Menteri atau Gubernur sesuai kewenangannya.',
                    '2' => 'Terdapat bukti bahwa pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR telah menetapkan rencana kerja anggaran dan biaya aspek Keselamatan Pertambangan dengan mempertimbangkan skala prioritas sasaran dan program, kebutuhan perbaikan dan peningkatan berkelanjutan, serta pemenuhan peraturan dan persyaratan terkait, namun belum mendapat persetujuan dari Direktur Jenderal atas nama Menteri atau Gubernur sesuai kewenangannya.',
                    '3' => 'Terdapat bukti bahwa pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR telah menetapkan rencana kerja anggaran dan biaya aspek Keselamatan Pertambangan yang mendapat persetujuan dari Direktur Jenderal atas nama Menteri atau Gubernur sesuai kewenangannya.',
                ],

                'iujp' => [
                    '0' => 'Tidak ada bukti yang menunjukkan pemegang IUJP telah memiliki rencana kerja anggaran dan biaya aspek Keselamatan Pertambangan yang sesuai dengan persetujuan dari pemegang IUP, IUPK, atau IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian.',
                    '1' => 'Terdapat bukti bahwa pemegang IUJP telah memiliki rencana kerja dan anggaran biaya Keselamatan Pertambangan, namun penyusunannya belum mempertimbangkan skala prioritas sasaran dan program Keselamatan Pertambangan, kebutuhan perbaikan dan peningkatan berkelanjutan, serta pemenuhan peraturan dan persyaratan terkait, dan belum sesuai dengan persetujuan dari pemegang IUP, IUPK, atau IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian.',
                    '2' => 'Terdapat bukti bahwa pemegang IUJP telah memiliki rencana kerja dan anggaran biaya Keselamatan Pertambangan dengan mempertimbangkan skala prioritas sasaran dan program, kebutuhan perbaikan dan peningkatan berkelanjutan, serta pemenuhan peraturan dan persyaratan terkait, namun belum sesuai dengan persetujuan dari pemegang IUP, IUPK, atau IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian.',
                    '3' => 'Terdapat bukti yang menunjukkan pemegang IUJP telah memiliki rencana kerja anggaran dan biaya aspek Keselamatan Pertambangan yang sesuai dengan persetujuan dari pemegang IUP, IUPK, atau IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian.',
                ],
            ],

            // ELEMEN III — ORGANISASI DAN PERSONEL
            'III.1' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti penyusunan dan penetapan struktur organisasi yang mencakup KTT/PTL, PJO, Pengawas Operasional, Pengawas Teknis, Pengelola Keselamatan Pertambangan, serta Kepala Tambang Bawah Tanah atau Kepala Kapal Keruk apabila dipersyaratkan.',
                    '1' => 'Terdapat struktur organisasi, tetapi belum terintegrasi dengan struktur organisasi perusahaan.',
                    '2' => 'Struktur organisasi telah terintegrasi dengan organisasi perusahaan, tetapi struktur organisasi Keselamatan Pertambangan belum memenuhi ketentuan dan belum dikomunikasikan.',
                    '3' => 'Struktur organisasi telah terintegrasi, tetapi belum memenuhi ketentuan meskipun telah dikomunikasikan; atau telah memenuhi ketentuan tetapi belum dikomunikasikan kepada seluruh pihak terkait.',
                    '4' => 'Struktur organisasi telah terintegrasi dengan organisasi perusahaan, memenuhi ketentuan, dan telah dikomunikasikan kepada seluruh pihak terkait.',
                ],
            ],

            'III.2.1' => [
                'umum' => [
                    '0' => 'Tidak terdapat KTT/PTL yang telah mendapatkan pengesahan dari KaIT atau Kepala Dinas yang membidangi pertambangan sesuai kewenangannya.',
                    '1' => 'KTT/PTL telah mendapatkan pengesahan, tetapi sertifikat kompetensinya belum memenuhi ketentuan.',
                    '2' => 'KTT/PTL telah mendapatkan pengesahan dan memiliki sertifikat kompetensi yang memenuhi ketentuan.',
                ],
            ],

            'III.2.2' => [
                'umum' => [
                    '0' => 'Tidak terdapat Kepala Tambang Bawah Tanah yang mendapatkan pengesahan untuk kegiatan pertambangan bawah tanah.',
                    '1' => 'Kepala Tambang Bawah Tanah telah mendapatkan pengesahan, tetapi sertifikatnya belum memenuhi persyaratan kemampuan teknis, kualifikasi, dan pengalaman.',
                    '2' => 'Kepala Tambang Bawah Tanah telah mendapatkan pengesahan dan memiliki sertifikat yang memenuhi persyaratan kemampuan teknis, kualifikasi, dan pengalaman.',
                ],
            ],

            'III.2.3' => [
                'umum' => [
                    '0' => 'Tidak terdapat Kepala Kapal Keruk pada kegiatan yang mengoperasikan kapal keruk atau kapal isap produksi.',
                    '1' => 'Kepala Kapal Keruk telah ditunjuk oleh KTT, tetapi belum seluruh kapal memiliki Kepala Kapal Keruk yang kompeten atau masih terdapat kapal yang tidak memiliki Kepala Kapal Keruk.',
                    '2' => 'Seluruh Kepala Kapal Keruk telah ditunjuk oleh KTT dan memiliki sertifikat yang memenuhi persyaratan kemampuan teknis, kualifikasi, dan pengalaman.',
                ],
            ],

            'III.3' => [
                // Pemegang IUP, IUPK, dan izin terkait operasi produksi khusus
                'iup_iupk_ipr' => [
                    '0' => 'Tidak terdapat PJO yang mendapatkan pengesahan dari KTT/PTL untuk perusahaan jasa pertambangan yang dipersyaratkan.',
                    '1' => 'PJO telah mendapatkan pengesahan dari KTT/PTL, tetapi belum seluruh perusahaan jasa pertambangan yang dipersyaratkan memiliki PJO dengan persyaratan administrasi dan teknis yang sesuai, atau masih terdapat perusahaan yang belum memiliki PJO.',
                    '2' => 'Seluruh perusahaan jasa pertambangan yang dipersyaratkan memiliki PJO yang mendapatkan pengesahan dari KTT/PTL dan memenuhi persyaratan administrasi serta teknis.',
                ],

                // Pemegang IUJP
                'iujp' => [
                    '0' => 'Tidak terdapat PJO yang mendapatkan pengesahan untuk perusahaan pemegang IUJP.',
                    '1' => 'Terdapat PJO, tetapi belum mendapatkan pengesahan dari KTT/PTL dan/atau belum memenuhi persyaratan administrasi serta teknis.',
                    '2' => 'PJO telah mendapatkan pengesahan dari KTT/PTL dan memenuhi persyaratan administrasi serta teknis.',
                ],
            ],

            'III.4' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti pembentukan Bagian K3 Pertambangan dan KO Pertambangan.',
                    '1' => 'Bagian K3 Pertambangan dan KO Pertambangan telah dibentuk, tetapi kriteria jumlah tenaga kerja dan sifat pekerjaan, struktur pelaporan, serta ruang lingkup tanggung jawab belum memenuhi ketentuan.',
                    '2' => 'Bagian telah dibentuk dan sebagian besar persyaratan struktur serta kriteria telah dipenuhi, tetapi ruang lingkup tanggung jawab belum lengkap dan/atau tugas belum dilaksanakan sepenuhnya.',
                    '3' => 'Struktur organisasi dan ruang lingkup tanggung jawab Bagian K3 Pertambangan dan KO Pertambangan telah memenuhi ketentuan, tetapi tugas dan tanggung jawab belum dilaksanakan sepenuhnya.',
                    '4' => 'Kriteria pembentukan, struktur pelaporan, ruang lingkup tanggung jawab, serta pelaksanaan tugas Bagian K3 Pertambangan dan KO Pertambangan telah memenuhi ketentuan.',
                ],
            ],

            'III.5' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti penunjukan Pengawas Operasional dan Pengawas Teknis.',
                    '1' => 'Sebagian Pengawas Operasional dan/atau Pengawas Teknis telah ditunjuk, tetapi penunjukan belum mencakup seluruh kebutuhan.',
                    '2' => 'Seluruh Pengawas Operasional telah ditunjuk, tetapi sebagian belum memiliki Kartu Pengawas Operasional (KPO); seluruh Pengawas Teknis telah ditunjuk.',
                    '3' => 'Seluruh Pengawas Operasional dan Pengawas Teknis telah ditunjuk serta seluruh KPO yang dipersyaratkan telah disahkan, tetapi tugas dan tanggung jawab belum dilaksanakan sepenuhnya.',
                    '4' => 'Seluruh Pengawas Operasional dan Pengawas Teknis telah ditunjuk, seluruh KPO yang dipersyaratkan telah disahkan, dan tugas serta tanggung jawab telah dilaksanakan.',
                ],
            ],

            'III.6' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti penunjukan tenaga teknis khusus pertambangan yang kompeten.',
                    '1' => 'Tenaga teknis khusus pertambangan telah ditunjuk, tetapi daftar tenaga belum dibuat, sebagian surat penunjukan belum tersedia, dan/atau sebagian sertifikasi kompetensi belum tersedia.',
                    '2' => 'Daftar tenaga teknis dan seluruh surat penunjukan telah tersedia, tetapi sebagian tenaga belum memiliki sertifikasi kompetensi yang dipersyaratkan.',
                    '3' => 'Daftar tenaga teknis, seluruh surat penunjukan, dan sertifikasi kompetensi telah tersedia, tetapi tugas dan tanggung jawab belum dilaksanakan sepenuhnya.',
                    '4' => 'Daftar tenaga teknis, seluruh surat penunjukan, dan sertifikasi kompetensi telah memenuhi ketentuan serta tugas dan tanggung jawab telah dilaksanakan.',
                ],
            ],

            'III.7' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti pembentukan Komite Keselamatan Pertambangan.',
                    '1' => 'Komite Keselamatan Pertambangan telah dibentuk, tetapi belum ditetapkan atau disahkan sesuai ketentuan, keterwakilan belum lengkap, dan/atau pelatihan belum dipenuhi.',
                    '2' => 'Komite Keselamatan Pertambangan telah ditetapkan atau disahkan, tetapi keterwakilan anggota dan/atau pelatihan belum memenuhi seluruh ketentuan.',
                    '3' => 'Komite telah ditetapkan atau disahkan dan keterwakilan anggota telah lengkap, tetapi pelatihan belum lengkap dan/atau tugas belum dilaksanakan sepenuhnya.',
                    '4' => 'Komite telah ditetapkan atau disahkan, keterwakilan anggota dan pelatihan telah memenuhi ketentuan, serta tugas dan tanggung jawab telah dilaksanakan.',
                ],
            ],

            'III.8' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti penunjukan Tim Tanggap Darurat yang dilaporkan kepada KaIT atau Kepala Dinas yang membidangi pertambangan sesuai kewenangannya.',
                    '1' => 'Tim Tanggap Darurat telah ditunjuk, tetapi belum dilaporkan, belum memadai, belum mencakup seluruh area, belum selalu siap, dan/atau kompetensi serta pelatihan anggotanya belum memenuhi ketentuan.',
                    '2' => 'Tim Tanggap Darurat telah dilaporkan, tetapi masih belum memadai dalam hal jumlah, cakupan area, kesiapsiagaan, kompetensi, dan/atau pelatihan.',
                    '3' => 'Tim Tanggap Darurat telah memadai, mencakup seluruh area, siap bertugas, dan memiliki kompetensi yang diperlukan, tetapi pelatihan belum dipenuhi sepenuhnya.',
                    '4' => 'Tim Tanggap Darurat telah dilaporkan, memadai, mencakup seluruh area, selalu siap bertugas, serta memiliki kompetensi dan pelatihan yang memenuhi ketentuan.',
                ],
            ],

            'III.9' => [
                'umum' => [
                    '0' => 'Tidak terdapat sistem tertulis seleksi dan penempatan personel yang mencakup Keselamatan Pertambangan serta penetapan tanggung jawab yang jelas.',
                    '1' => 'Sistem tertulis seleksi dan penempatan personel telah tersedia, tetapi belum mempertimbangkan identifikasi kompetensi, belum mencakup persyaratan Keselamatan Pertambangan, dan/atau belum menetapkan tanggung jawab secara jelas.',
                    '2' => 'Sistem tertulis telah tersedia, tetapi belum sepenuhnya mempertimbangkan identifikasi kompetensi dan persyaratan Keselamatan Pertambangan, meskipun tanggung jawab telah ditetapkan secara jelas.',
                    '3' => 'Sistem seleksi dan penempatan telah mempertimbangkan kompetensi, mencakup persyaratan Keselamatan Pertambangan, dan menetapkan tanggung jawab secara jelas, tetapi belum seluruh personel memahami dan melaksanakannya.',
                    '4' => 'Sistem seleksi dan penempatan telah mempertimbangkan kompetensi, mencakup persyaratan Keselamatan Pertambangan, menetapkan tanggung jawab secara jelas, serta dipahami dan dilaksanakan oleh seluruh personel.',
                ],
            ],

            'III.10.1' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti bahwa pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah menyelenggarakan pendidikan dan pelatihan kepada setiap pekerja, pengawas operasional, dan pengawas teknik.',
                    '1' => 'Pendidikan dan pelatihan telah dilaksanakan, tetapi pengumpulan data pekerjaan dan pekerja, analisis kebutuhan pelatihan (training need analysis), perencanaan program, monitoring dan evaluasi, serta tindak lanjut hasil evaluasi belum dilakukan secara memadai.',
                    '2' => 'Pengumpulan data dan informasi, analisis kebutuhan pelatihan, perencanaan program, serta monitoring dan evaluasi telah dilakukan secara memadai, tetapi hasil monitoring dan evaluasi belum ditindaklanjuti untuk perbaikan berkelanjutan.',
                    '3' => 'Pengumpulan data, analisis kebutuhan, perencanaan, monitoring dan evaluasi, serta tindak lanjut telah dilakukan, tetapi program pendidikan dan pelatihan belum mencapai target dan sasaran yang diharapkan.',
                    '4' => 'Pengumpulan data, analisis kebutuhan, perencanaan, monitoring dan evaluasi, serta tindak lanjut telah dilakukan, dan program pendidikan dan pelatihan telah mencapai target serta sasaran yang diharapkan.',
                ],
            ],

            'III.10.2' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti identifikasi dan pengembangan standar kompetensi kerja Keselamatan Pertambangan sesuai kebutuhan, penggunaan hasil identifikasi kompetensi untuk penerimaan, seleksi, promosi, dan penilaian kinerja, serta pemastian kompetensi pengawas operasional.',
                    '1' => 'Standar kompetensi kerja telah diidentifikasi, tetapi belum seluruh pekerja, pengawas operasional, dan pengawas teknik memiliki kompetensi sesuai ketentuan; hasil identifikasi belum digunakan sebagai dasar program pelatihan dan pertimbangan penerimaan, seleksi, promosi, serta penilaian kinerja; standar kompetensi belum dikembangkan sesuai kebutuhan.',
                    '2' => 'Sebagian pekerja, pengawas operasional, dan pengawas teknik memiliki kompetensi sesuai ketentuan. Hasil identifikasi kompetensi telah digunakan untuk menentukan program pendidikan dan pelatihan, tetapi belum digunakan sebagai dasar penerimaan, seleksi, promosi, dan penilaian kinerja. Standar kompetensi belum dikembangkan sesuai kebutuhan.',
                    '3' => 'Seluruh pekerja, pengawas operasional, dan pengawas teknik memiliki kompetensi sesuai ketentuan. Hasil identifikasi telah digunakan untuk menentukan program pendidikan dan pelatihan serta sebagai dasar pertimbangan penerimaan, seleksi, promosi, dan penilaian kinerja, tetapi standar kompetensi kerja Keselamatan Pertambangan belum dikembangkan sesuai kebutuhan.',
                    '4' => 'Seluruh pekerja, pengawas operasional, dan pengawas teknik memiliki kompetensi sesuai ketentuan. Hasil identifikasi digunakan untuk menentukan program pendidikan dan pelatihan serta sebagai dasar pertimbangan penerimaan, seleksi, promosi, dan penilaian kinerja. Standar kompetensi kerja Keselamatan Pertambangan telah dikembangkan sesuai kebutuhan.',
                ],
            ],

            // 'III.10.3' => [
            //     'umum' => [
            //         '0' => 'Tidak terdapat bukti pendokumentasian, pemantauan, dan/atau pelaporan pemenuhan kompetensi sesuai ketentuan peraturan perundang-undangan dan persyaratan lainnya.',
            //         '1' => 'Sebagian dokumen kelayakan sarana, prasarana, dan instalasi pertambangan, sertifikat dan laporan kompetensi tenaga kerja, lisensi, pengesahan pejabat terkait, serta izin kerja khusus telah didokumentasikan, tetapi pemantauan dan pelaporan pemenuhan kompetensi belum dilakukan.',
            //         '2' => 'Seluruh dokumen kelayakan sarana, prasarana, dan instalasi pertambangan, sertifikat dan laporan kompetensi tenaga kerja, lisensi, pengesahan pejabat terkait, serta izin kerja khusus telah didokumentasikan, tetapi pemantauan dan pelaporan pemenuhan kompetensi belum dilakukan.',
            //         '3' => 'Seluruh dokumen pemenuhan kompetensi dan persyaratan lainnya telah didokumentasikan serta pemantauan dan pelaporan telah dilakukan sesuai ketentuan peraturan perundang-undangan.',
            //         '4' => 'Tidak terdapat tingkat nilai 4 yang terpisah secara jelas pada tabel sumber yang dikirim untuk subelemen ini. Mohon verifikasi kembali kolom skor pada formulir asli sebelum digunakan.',
            //     ],
            // ],

            'III.11' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti bahwa pemegang IUP, IUPK, IUP Operasi Produksi khusus untuk Pengolahan dan/atau Pemurnian, IPR, atau IUJP telah menyusun, menetapkan, dan menerapkan mekanisme komunikasi mengenai hal-hal yang berdampak terhadap Keselamatan Pertambangan kepada pihak terkait.',
                    '1' => 'Mekanisme komunikasi telah disusun dan ditetapkan, tetapi belum diterapkan dan belum dievaluasi. Mekanisme komunikasi mengenai kecelakaan tambang, kejadian berbahaya, kejadian akibat penyakit tenaga kerja, Penyakit Akibat Kerja, dan kondisi darurat juga belum diterapkan sepenuhnya.',
                    '2' => 'Mekanisme komunikasi telah disusun, ditetapkan, dan diterapkan. Mekanisme komunikasi untuk informasi kecelakaan tambang, kejadian berbahaya, penyakit tenaga kerja, Penyakit Akibat Kerja, dan kondisi darurat telah disusun dan ditetapkan, tetapi evaluasi penyampaian informasi belum dilakukan secara memadai.',
                    '3' => 'Mekanisme komunikasi telah disusun, ditetapkan, dan diterapkan serta evaluasi penyampaian informasi telah dilakukan, tetapi informasi yang disampaikan belum ditindaklanjuti oleh pihak terkait yang berada dalam kendali KTT atau PTL.',
                    '4' => 'Mekanisme komunikasi telah disusun, ditetapkan, dan diterapkan; evaluasi penyampaian informasi telah dilakukan; serta informasi telah ditindaklanjuti oleh pihak terkait yang berada dalam kendali KTT atau PTL.',
                ],
            ],

            'III.12.1' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti bahwa pemegang IUP, IUPK, atau IUP Operasi Produksi khusus telah memiliki buku tambang.',
                    '1' => 'Buku tambang tersedia di kantor KTT atau PTL, tetapi belum dapat dibaca dan dipelajari pekerja, perintah dan petunjuk Inspektur Tambang belum dilaksanakan, atau hal yang diwajibkan belum dicatat.',
                    '2' => 'Buku tambang tersedia dan dapat dibaca pekerja. KTT atau PTL telah melaksanakan sebagian perintah dan petunjuk Inspektur Tambang dan/atau mencatat sebagian hal yang diwajibkan.',
                    '3' => 'Buku tambang tersedia dan dapat dibaca pekerja. KTT atau PTL telah melaksanakan perintah dan petunjuk Inspektur Tambang serta mencatat hal yang diwajibkan, tetapi pemahaman pekerja terhadap isi buku belum dipastikan.',
                    '4' => 'Buku tambang tersedia di kantor KTT atau PTL, dapat dibaca pekerja, seluruh perintah dan petunjuk Inspektur Tambang dilaksanakan, serta seluruh hal yang diwajibkan telah dicatat.',
                ],
            ],

            'III.12.2' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti bahwa pemegang IUP, IUPK, atau IUP Operasi Produksi khusus telah memiliki buku daftar kecelakaan tambang.',
                    '1' => 'Buku daftar kecelakaan tambang tersedia, tetapi KTT atau PTL belum mendaftarkan setiap kecelakaan tambang yang mengakibatkan cedera ringan, cedera berat, atau kematian apabila terjadi.',
                    '2' => 'Buku daftar kecelakaan tambang tersedia, tetapi belum seluruh kecelakaan tambang yang mengakibatkan cedera ringan, cedera berat, atau kematian apabila terjadi telah didaftarkan.',
                    '3' => 'Buku daftar kecelakaan tambang tersedia dan setiap kecelakaan tambang yang mengakibatkan cedera ringan, cedera berat, atau kematian apabila terjadi telah didaftarkan.',
                ],
            ],

            'III.12.3' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti bahwa pemegang IUP, IUPK, atau IUP Operasi Produksi khusus telah melakukan pelaporan aspek Keselamatan Pertambangan.',
                    '1' => 'Pelaporan aspek Keselamatan Pertambangan telah dilakukan, tetapi seluruh laporan tertulis belum disampaikan kepada KaIT, format laporan belum sesuai ketentuan, dan/atau waktu penyampaian belum sesuai ketentuan.',
                    '2' => 'Seluruh laporan tertulis aspek Keselamatan Pertambangan telah disampaikan kepada KaIT dan format laporan telah sesuai ketentuan, tetapi waktu penyampaian belum sesuai ketentuan.',
                    '3' => 'Seluruh laporan tertulis aspek Keselamatan Pertambangan telah disampaikan kepada KaIT, format laporan telah sesuai ketentuan, dan penyampaian laporan telah memenuhi tata waktu yang ditetapkan.',
                ],
            ],

            'III.12.4' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti bahwa KTT atau PTL telah mendokumentasikan Kejadian Berbahaya, kejadian akibat penyakit tenaga kerja, dan Penyakit Akibat Kerja secara khusus menggunakan format yang ditentukan KaIT.',
                    '1' => 'Sebagian kejadian telah didokumentasikan secara khusus, tetapi dokumentasi belum menggunakan format khusus yang ditentukan KaIT.',
                    '2' => 'Sebagian kejadian telah didokumentasikan secara khusus dan dokumentasi telah menggunakan format khusus yang ditentukan KaIT.',
                    '3' => 'Seluruh Kejadian Berbahaya, kejadian akibat penyakit tenaga kerja, dan Penyakit Akibat Kerja telah didokumentasikan secara khusus menggunakan format yang ditentukan KaIT.',
                ],
            ],

            'III.12.5' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti pendokumentasian, pemantauan, dan/atau pelaporan pemenuhan kompetensi sesuai ketentuan peraturan perundang-undangan dan persyaratan lainnya.',
                    '1' => 'Sebagian dokumen kelayakan sarana, prasarana, dan instalasi pertambangan, sertifikat kompetensi, lisensi, pengesahan pejabat terkait, dan izin kerja khusus telah didokumentasikan, tetapi pemantauan dan pelaporan pemenuhan kompetensi belum dilakukan.',
                    '2' => 'Seluruh dokumen kelayakan sarana, prasarana, dan instalasi pertambangan, sertifikat kompetensi, lisensi, pengesahan pejabat terkait, dan izin kerja khusus telah didokumentasikan, tetapi pemantauan dan pelaporan pemenuhan kompetensi belum dilakukan.',
                    '3' => 'Seluruh dokumen pemenuhan kompetensi dan persyaratan lainnya telah didokumentasikan serta pemantauan dan pelaporan telah dilakukan sesuai ketentuan.',
                    '4' => 'Tidak terdapat tingkat nilai 4 yang terpisah secara jelas pada tabel sumber yang dikirim untuk subelemen ini. Mohon verifikasi kembali kolom skor pada formulir asli sebelum digunakan.',
                ],
            ],

            'III.13' => [
                'umum' => [
                    '0' => 'Tidak terdapat bukti penyusunan, penerapan, dan pendokumentasian partisipasi, konsultasi, motivasi, dan kesadaran penerapan SMKP Minerba atau SMKP khusus pada Pengolahan dan/atau Pemurnian.',
                    '1' => 'Mekanisme partisipasi, konsultasi, motivasi, dan kesadaran telah disusun, tetapi belum diterapkan dan didokumentasikan.',
                    '2' => 'Partisipasi, konsultasi, motivasi, dan kesadaran telah disusun, diterapkan, serta didokumentasikan, tetapi belum melibatkan seluruh departemen atau bagian pekerja dan pihak terkait.',
                    '3' => 'Partisipasi, konsultasi, motivasi, dan kesadaran telah disusun, diterapkan, didokumentasikan, serta melibatkan seluruh departemen atau bagian pekerja dan pihak terkait.',
                    '4' => 'Partisipasi, konsultasi, motivasi, dan kesadaran telah disusun, diterapkan, didokumentasikan, serta melibatkan seluruh departemen atau bagian pekerja dan pihak terkait. Hasil proses tersebut menjadi masukan untuk peningkatan penerapan Keselamatan Pertambangan.',
                ],
            ],

            //elment IV — PENGENDALIAN BAHAYA DAN RISIKO
            'IV.1.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyusunan, penetapan, penerapan, dokumentasi, dan evaluasi prosedur operasi/kerja dengan mempertimbangkan hasil pemetaan behavior based safety.',
                    '1' => 'Prosedur operasi/kerja telah disusun, ditetapkan, didokumentasikan, disahkan oleh pejabat berwenang, dan diberi nomor. Namun, prosedur belum tersedia untuk setiap pekerjaan, belum mempertimbangkan behavior based safety, belum dikomunikasikan, belum dievaluasi secara berkala, dan belum konsisten diterapkan.',
                    '2' => 'Prosedur telah tersedia untuk setiap pekerjaan, mempertimbangkan behavior based safety, dan dikomunikasikan kepada pihak terkait. Namun, prosedur belum dievaluasi dan ditinjau ulang secara berkala maupun saat terjadi perubahan atau kecelakaan, serta belum konsisten diterapkan.',
                    '3' => 'Prosedur telah disusun dan ditetapkan dengan benar, tersedia untuk setiap pekerjaan, mempertimbangkan behavior based safety, dikomunikasikan, dan dievaluasi secara berkala. Namun, penerapannya belum konsisten oleh seluruh pekerja.',
                    '4' => 'Prosedur telah disusun, ditetapkan, didokumentasikan, disahkan dan diberi nomor; tersedia untuk setiap pekerjaan; mempertimbangkan behavior based safety; dikomunikasikan; dievaluasi secara berkala; dan diterapkan secara konsisten oleh seluruh pekerja.',
                    '5' => 'Prosedur telah disusun, ditetapkan, didokumentasikan, disahkan dan diberi nomor; tersedia untuk setiap pekerjaan; mempertimbangkan behavior based safety; dikomunikasikan; dievaluasi secara berkala; dan diterapkan secara konsisten oleh seluruh pekerja.',
                ],
            ],

            'IV.1.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyusunan, penetapan, penerapan, dokumentasi, dan evaluasi izin kerja khusus dengan mempertimbangkan hasil pemetaan behavior based safety.',
                    '1' => 'Izin kerja khusus telah disusun, ditetapkan, dan didokumentasikan, tetapi belum mempertimbangkan behavior based safety, belum dievaluasi secara berkala, dan belum diterapkan secara konsisten oleh seluruh pekerja.',
                    '2' => 'Izin kerja khusus telah disusun dan didokumentasikan serta telah mempertimbangkan behavior based safety. Namun, izin kerja khusus belum dievaluasi secara berkala dan belum diterapkan secara konsisten.',
                    '3' => 'Izin kerja khusus telah disusun, ditetapkan, didokumentasikan, mempertimbangkan behavior based safety, dievaluasi secara berkala, dan diterapkan secara konsisten oleh seluruh pekerja.',
                    '5' => 'Izin kerja khusus telah disusun, ditetapkan, didokumentasikan, mempertimbangkan behavior based safety, dievaluasi secara berkala, dan diterapkan secara konsisten oleh seluruh pekerja.',
                ],
            ],

            'IV.1.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan Alat Pelindung Diri/Alat Keselamatan.',
                    '1' => 'Kebutuhan APD/Alat Keselamatan telah dinilai berdasarkan jenis pekerjaan dan bahaya, serta telah disediakan secara cuma-cuma dalam jumlah memadai. Namun, pelatihan pekerja dan evaluasi kepatuhan penggunaan serta perawatan belum dilakukan.',
                    '2' => 'Kebutuhan APD/Alat Keselamatan telah dinilai dan disediakan secara cuma-cuma dalam jumlah memadai, serta pelatihan mengenai fungsi, manfaat, penggunaan, dan perawatan telah dilakukan. Namun, evaluasi kepatuhan belum dilakukan.',
                    '3' => 'Penilaian kebutuhan, penyediaan, pelatihan, dan evaluasi kepatuhan penggunaan serta perawatan APD/Alat Keselamatan telah dilakukan. Namun, hasil evaluasi menunjukkan belum seluruh pekerja patuh.',
                    '4' => 'Penilaian kebutuhan, penyediaan, pelatihan, dan evaluasi kepatuhan telah dilakukan; hasil evaluasi menunjukkan seluruh pekerja patuh dalam penggunaan dan perawatan APD/Alat Keselamatan.',
                    '5' => 'Penilaian kebutuhan, penyediaan, pelatihan, dan evaluasi kepatuhan telah dilakukan; hasil evaluasi menunjukkan seluruh pekerja patuh dalam penggunaan dan perawatan APD/Alat Keselamatan.',
                ],
            ],

            'IV.2.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan bahaya debu di lingkungan kerja.',
                    '1' => 'Prosedur pengelolaan debu telah disusun, tetapi pengukuran belum dilakukan secara berkala dan terdokumentasi, belum didukung petugas kompeten serta alat ukur terkalibrasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pengukuran debu telah dilakukan secara berkala dan terdokumentasi oleh petugas kompeten dengan alat terkalibrasi, tetapi hasil pengukuran belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pengukuran debu telah ditindaklanjuti dengan tindakan pengendalian risiko.',
                    '4' => 'Seluruh hasil pengukuran debu telah ditindaklanjuti dengan pengendalian risiko sesuai hierarki pengendalian.',
                    '5' => 'Seluruh hasil pengukuran debu telah ditindaklanjuti dengan pengendalian risiko sesuai hierarki pengendalian.',
                ],
            ],

            'IV.2.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan bahaya kebisingan di lingkungan kerja.',
                    '1' => 'Prosedur pengelolaan kebisingan telah disusun, tetapi pengukuran belum dilakukan secara berkala dan terdokumentasi, belum didukung petugas kompeten serta alat ukur terkalibrasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pengukuran kebisingan telah dilakukan secara berkala dan terdokumentasi oleh petugas kompeten dengan alat terkalibrasi, tetapi hasil pengukuran belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pengukuran kebisingan telah ditindaklanjuti dengan tindakan pengendalian risiko.',
                    '4' => 'Seluruh hasil pengukuran kebisingan telah ditindaklanjuti. Pengendalian mencakup penghilangan atau pengurangan sumber kebisingan, program konservasi pendengaran, pembatasan waktu kerja, rambu peringatan, ketentuan kerja, dan APD yang sesuai.',
                    '5' => 'Seluruh hasil pengukuran kebisingan telah ditindaklanjuti. Pengendalian mencakup penghilangan atau pengurangan sumber kebisingan, program konservasi pendengaran, pembatasan waktu kerja, rambu peringatan, ketentuan kerja, dan APD yang sesuai.',
                ],
            ],

            'IV.2.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan bahaya getaran di lingkungan kerja.',
                    '1' => 'Prosedur pengelolaan getaran telah disusun, tetapi pengukuran belum dilakukan secara berkala dan terdokumentasi, belum didukung petugas kompeten serta alat ukur terkalibrasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pengukuran getaran telah dilakukan secara berkala dan terdokumentasi oleh petugas kompeten dengan alat terkalibrasi, tetapi hasil pengukuran belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pengukuran getaran telah ditindaklanjuti dengan tindakan pengendalian risiko.',
                    '4' => 'Seluruh hasil pengukuran getaran telah ditindaklanjuti melalui pengurangan paparan atau sumber getaran, pembatasan waktu kerja sesuai paparan, dan penggunaan APD yang sesuai.',
                    '5' => 'Seluruh hasil pengukuran getaran telah ditindaklanjuti melalui pengurangan paparan atau sumber getaran, pembatasan waktu kerja sesuai paparan, dan penggunaan APD yang sesuai.',
                ],
            ],

            'IV.2.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan pencahayaan di lingkungan kerja.',
                    '1' => 'Prosedur pengelolaan pencahayaan telah disusun, tetapi pengukuran belum dilakukan secara berkala dan terdokumentasi, belum didukung petugas kompeten serta alat ukur terkalibrasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pengukuran pencahayaan telah dilakukan secara berkala dan terdokumentasi oleh petugas kompeten dengan alat terkalibrasi, tetapi hasil pengukuran belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pengukuran pencahayaan telah ditindaklanjuti dengan penyesuaian kondisi pencahayaan.',
                    '4' => 'Seluruh hasil pengukuran pencahayaan telah ditindaklanjuti dengan penyesuaian tingkat pencahayaan sesuai standar dan kebutuhan area serta aktivitas kerja.',
                    '5' => 'Seluruh hasil pengukuran pencahayaan telah ditindaklanjuti dengan penyesuaian tingkat pencahayaan sesuai standar dan kebutuhan area serta aktivitas kerja.',
                ],
            ],

            'IV.2.5' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan kuantitas dan kualitas udara kerja.',
                    '1' => 'Prosedur pengelolaan kuantitas dan kualitas udara kerja telah disusun, tetapi pengukuran belum dilakukan secara berkala dan terdokumentasi, belum didukung petugas kompeten serta alat ukur terkalibrasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pengukuran kuantitas dan kualitas udara kerja telah dilakukan secara berkala dan terdokumentasi oleh petugas kompeten dengan alat terkalibrasi, tetapi hasil pengukuran belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pengukuran kuantitas dan kualitas udara kerja telah ditindaklanjuti dengan tindakan pengendalian risiko.',
                    '4' => 'Seluruh hasil pengukuran telah ditindaklanjuti melalui penyesuaian kuantitas dan kualitas udara sesuai persyaratan, penyediaan ventilasi memadai, rambu peringatan, ketentuan kerja, dan APD yang sesuai.',
                    '5' => 'Seluruh hasil pengukuran telah ditindaklanjuti melalui penyesuaian kuantitas dan kualitas udara sesuai persyaratan, penyediaan ventilasi memadai, rambu peringatan, ketentuan kerja, dan APD yang sesuai.',
                ],
            ],

            'IV.2.6' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan iklim kerja.',
                    '1' => 'Prosedur pengelolaan iklim kerja telah disusun, tetapi pengukuran belum dilakukan secara berkala dan terdokumentasi, belum didukung petugas kompeten serta alat ukur terkalibrasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pengukuran iklim kerja telah dilakukan secara berkala dan terdokumentasi oleh petugas kompeten dengan alat terkalibrasi, tetapi hasil pengukuran belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pengukuran iklim kerja telah ditindaklanjuti dengan tindakan pengendalian risiko.',
                    '4' => 'Seluruh hasil pengukuran iklim kerja telah ditindaklanjuti melalui pengendalian kondisi iklim sesuai standar, penyediaan sarana dan prasarana yang memadai, pengaturan siklus kerja-istirahat, ketentuan kerja, dan APD yang sesuai.',
                    '5' => 'Seluruh hasil pengukuran iklim kerja telah ditindaklanjuti melalui pengendalian kondisi iklim sesuai standar, penyediaan sarana dan prasarana yang memadai, pengaturan siklus kerja-istirahat, ketentuan kerja, dan APD yang sesuai.',
                ],
            ],

            'IV.2.7' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan bahaya radiasi di lingkungan kerja.',
                    '1' => 'Prosedur pengelolaan radiasi telah disusun, tetapi pengukuran belum dilakukan secara berkala dan terdokumentasi, belum didukung petugas kompeten serta alat ukur terkalibrasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pengukuran radiasi telah dilakukan secara berkala dan terdokumentasi oleh petugas kompeten dengan alat terkalibrasi, tetapi hasil pengukuran belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pengukuran radiasi telah ditindaklanjuti dengan tindakan pengendalian risiko.',
                    '4' => 'Seluruh hasil pengukuran radiasi telah ditindaklanjuti dengan pengendalian risiko sesuai hierarki pengendalian.',
                    '5' => 'Seluruh hasil pengukuran radiasi telah ditindaklanjuti dengan pengendalian risiko sesuai hierarki pengendalian.',
                ],
            ],

            'IV.2.8' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan bahaya faktor kimia di lingkungan kerja.',
                    '1' => 'Prosedur pengelolaan faktor kimia telah disusun, tetapi pengukuran belum dilakukan secara berkala dan terdokumentasi, belum didukung petugas kompeten serta alat ukur terkalibrasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pengukuran faktor kimia telah dilakukan secara berkala dan terdokumentasi oleh petugas kompeten dengan alat terkalibrasi, tetapi hasil pengukuran belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pengukuran faktor kimia telah ditindaklanjuti dengan tindakan pengendalian risiko.',
                    '4' => 'Seluruh hasil pengukuran faktor kimia telah ditindaklanjuti dengan pengendalian risiko sesuai hierarki pengendalian.',
                    '5' => 'Seluruh hasil pengukuran faktor kimia telah ditindaklanjuti dengan pengendalian risiko sesuai hierarki pengendalian.',
                ],
            ],

            'IV.2.9' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan bahaya faktor biologi di lingkungan kerja.',
                    '1' => 'Prosedur pengelolaan faktor biologi telah disusun, tetapi pemantauan dan evaluasi belum dilakukan secara berkala dan terdokumentasi, atau hasilnya belum menjadi dasar pengendalian risiko.',
                    '2' => 'Pemantauan dan evaluasi faktor biologi telah dilakukan secara berkala dan terdokumentasi, tetapi hasilnya belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pemantauan dan evaluasi faktor biologi telah ditindaklanjuti dengan tindakan pengendalian risiko.',
                    '4' => 'Seluruh hasil pemantauan dan evaluasi faktor biologi telah ditindaklanjuti dengan pengendalian risiko sesuai hierarki pengendalian.',
                    '5' => 'Seluruh hasil pemantauan dan evaluasi faktor biologi telah ditindaklanjuti dengan pengendalian risiko sesuai hierarki pengendalian.',
                ],
            ],

            'IV.2.10' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan kebersihan lingkungan kerja.',
                    '1' => 'Prosedur kebersihan lingkungan kerja telah disusun, tetapi pemantauan dan evaluasi belum dilakukan secara berkala dan terdokumentasi, atau belum ada tindakan pengendalian.',
                    '2' => 'Pemantauan dan evaluasi kebersihan lingkungan kerja telah dilakukan secara berkala dan terdokumentasi, tetapi hasilnya belum ditindaklanjuti.',
                    '3' => 'Sebagian hasil pemantauan kebersihan lingkungan kerja telah ditindaklanjuti dengan tindakan perbaikan.',
                    '4' => 'Seluruh hasil pemantauan kebersihan lingkungan kerja telah ditindaklanjuti dengan tindakan pengendalian dan perbaikan.',
                    '5' => 'Seluruh hasil pemantauan kebersihan lingkungan kerja telah ditindaklanjuti dengan tindakan pengendalian dan perbaikan.',
                ],
            ],


            'IV.3.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pelaksanaan pemeriksaan kesehatan awal, berkala, khusus, dan akhir sesuai peraturan.',
                    '1' => 'Prosedur pemeriksaan kesehatan telah ditetapkan, tetapi baru sebagian jenis pemeriksaan dilaksanakan dan belum mengacu pada pedoman dokter perusahaan.',
                    '2' => 'Seluruh jenis pemeriksaan telah dilaksanakan dan mengacu pada pedoman dokter perusahaan, tetapi seluruh hasil pemeriksaan belum ditindaklanjuti.',
                    '3' => 'Seluruh pemeriksaan telah dilaksanakan dan mengacu pada pedoman dokter perusahaan, tetapi hasil belum seluruhnya ditindaklanjuti dan catatan kesehatan pekerja belum dikelola dengan baik.',
                    '4' => 'Prosedur dan seluruh pemeriksaan telah sesuai pedoman; hasil belum seluruhnya ditindaklanjuti, tetapi catatan kesehatan pekerja telah dibuat, didokumentasikan, dan dievaluasi.',
                    '5' => 'Prosedur dan seluruh pemeriksaan telah sesuai pedoman; hasil belum seluruhnya ditindaklanjuti, tetapi catatan kesehatan pekerja telah dibuat, didokumentasikan, dan dievaluasi.',
                ],
            ],

            'IV.3.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyediaan tenaga, sarana, dan prasarana pelayanan kesehatan kerja sesuai peraturan.',
                    '1' => 'Prosedur telah ditetapkan, tetapi tenaga kesehatan, sarana-prasarana, dan penetapan kualifikasi pelayanan belum sesuai ketentuan.',
                    '2' => 'Prosedur telah ditetapkan; tenaga kesehatan dan sarana-prasarana telah sesuai ketentuan serta kualifikasi pelayanan ditetapkan berdasarkan keterisolasian lokasi tambang.',
                    '3' => 'Prosedur, tenaga kesehatan, sarana-prasarana, dan kualifikasi pelayanan telah memenuhi ketentuan yang berlaku.',
                    '4' => 'Prosedur, tenaga kesehatan, sarana-prasarana, dan kualifikasi pelayanan telah memenuhi ketentuan yang berlaku.',
                    '5' => 'Prosedur, tenaga kesehatan, sarana-prasarana, dan kualifikasi pelayanan telah memenuhi ketentuan yang berlaku.',
                ],
            ],

            'IV.3.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyediaan petugas, fasilitas, peralatan, dan pelatihan P3K sesuai ketentuan.',
                    '1' => 'Prosedur P3K telah ditetapkan, tetapi kompetensi petugas, fasilitas, peralatan, pelatihan, atau pengelolaan kotak P3K belum memenuhi ketentuan.',
                    '2' => 'Petugas kompeten, fasilitas, peralatan, pelatihan, dan pengelolaan kotak P3K telah memenuhi ketentuan.',
                    '3' => 'Petugas kompeten, fasilitas, peralatan, pelatihan, dan pengelolaan kotak P3K telah memenuhi ketentuan.',
                    '4' => 'Petugas kompeten, fasilitas, peralatan, pelatihan, dan pengelolaan kotak P3K telah memenuhi ketentuan.',
                    '5' => 'Petugas kompeten, fasilitas, peralatan, pelatihan, dan pengelolaan kotak P3K telah memenuhi ketentuan.',
                ],
            ],

            'IV.3.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan kelelahan kerja pekerja.',
                    '1' => 'Prosedur telah ditetapkan, tetapi identifikasi, evaluasi, pengendalian faktor kelelahan, serta pelatihan dan sosialisasi belum memadai.',
                    '2' => 'Identifikasi, evaluasi, dan pengendalian faktor kelelahan telah dilakukan tetapi belum memadai; pelatihan atau sosialisasi masih bersifat umum.',
                    '3' => 'Identifikasi, evaluasi, dan pengendalian faktor kelelahan telah memadai serta pelatihan atau sosialisasi telah diberikan secara rinci kepada pekerja.',
                    '4' => 'Identifikasi, evaluasi, pengendalian, dan pelatihan pengelolaan kelelahan telah dilaksanakan secara memadai.',
                    '5' => 'Identifikasi, evaluasi, pengendalian, dan pelatihan pengelolaan kelelahan telah dilaksanakan secara memadai.',
                ],
            ],

            'IV.3.5' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan pekerja pada tempat berisiko kesehatan tinggi.',
                    '1' => 'Prosedur telah ditetapkan, tetapi risiko belum dikendalikan secara memadai dan pekerja belum memahami cara kerja aman serta konsekuensi risikonya.',
                    '2' => 'Prosedur telah ditetapkan, risiko telah dikendalikan secara memadai, dan pekerja memahami cara kerja aman serta konsekuensi bekerja di area tersebut.',
                    '3' => 'Prosedur, pengendalian risiko, dan pemahaman pekerja telah memenuhi ketentuan.',
                    '4' => 'Prosedur, pengendalian risiko, dan pemahaman pekerja telah memenuhi ketentuan.',
                    '5' => 'Prosedur, pengendalian risiko, dan pemahaman pekerja telah memenuhi ketentuan.',
                ],
            ],

            'IV.3.6' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pemeliharaan, penjagaan, analisis, dan evaluasi rekaman data kesehatan kerja.',
                    '1' => 'Prosedur telah ditetapkan dan rekaman telah dipelihara, tetapi belum sesuai ketentuan serta belum dianalisis dan dievaluasi.',
                    '2' => 'Rekaman telah dipelihara sesuai ketentuan, tetapi belum dianalisis dan dievaluasi untuk perbaikan kinerja.',
                    '3' => 'Rekaman telah dipelihara, dianalisis, dan dievaluasi, tetapi statistik kinerja kesehatan kerja dengan indikator leading dan lagging belum dibuat.',
                    '4' => 'Rekaman telah dipelihara, dianalisis, dan dievaluasi serta statistik kinerja kesehatan kerja menggunakan indikator leading dan lagging telah dibuat.',
                    '5' => 'Rekaman telah dipelihara, dianalisis, dan dievaluasi serta statistik kinerja kesehatan kerja menggunakan indikator leading dan lagging telah dibuat.',
                ],
            ],

            'IV.3.7' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyediaan fasilitas higiene dan pengelolaan sanitasi di area kerja.',
                    '1' => 'Prosedur telah ditetapkan, tetapi fasilitas higiene dan pengelolaan sanitasi belum memadai.',
                    '2' => 'Prosedur telah ditetapkan; fasilitas higiene dan pengelolaan tempat sampah, toilet, wastafel, lantai, bangunan, ruang ganti, serta kamar mandi telah memenuhi ketentuan.',
                    '3' => 'Fasilitas higiene dan sanitasi telah memenuhi ketentuan yang berlaku.',
                    '4' => 'Fasilitas higiene dan sanitasi telah memenuhi ketentuan yang berlaku.',
                    '5' => 'Fasilitas higiene dan sanitasi telah memenuhi ketentuan yang berlaku.',
                ],
            ],

            'IV.3.8' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan ergonomi untuk menyesuaikan pekerjaan, lingkungan, peralatan, dan pekerja.',
                    '1' => 'Prosedur telah ditetapkan, tetapi identifikasi dan penilaian risiko ergonomi serta pengendaliannya belum dilakukan; sarana dan peralatan belum sesuai kebutuhan pekerja.',
                    '2' => 'Penilaian dan pengendalian risiko ergonomi telah dilakukan tetapi belum memadai; sebagian prosedur, sarana, dan peralatan telah disesuaikan.',
                    '3' => 'Penilaian dan pengendalian risiko ergonomi telah memadai serta seluruh prosedur kerja, sarana, prasarana, instalasi, dan peralatan telah sesuai kondisi pekerja.',
                    '4' => 'Penilaian risiko ergonomi dan seluruh pengendalian serta penyesuaian fasilitas telah memadai.',
                    '5' => 'Penilaian risiko ergonomi dan seluruh pengendalian serta penyesuaian fasilitas telah memadai.',
                ],
            ],

            'IV.3.9' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan makanan, minuman, dan gizi pekerja.',
                    '1' => 'Prosedur telah ditetapkan, tetapi makanan dan minuman belum sepenuhnya memenuhi persyaratan keamanan, kecukupan, higienitas, dan keseimbangan gizi.',
                    '2' => 'Prosedur telah ditetapkan dan makanan serta minuman telah memenuhi persyaratan keamanan, kecukupan, higienitas, dan keseimbangan gizi.',
                    '3' => 'Pengelolaan makanan, minuman, dan gizi pekerja telah memenuhi ketentuan.',
                    '4' => 'Pengelolaan makanan, minuman, dan gizi pekerja telah memenuhi ketentuan.',
                    '5' => 'Pengelolaan makanan, minuman, dan gizi pekerja telah memenuhi ketentuan.',
                ],
            ],

            'IV.3.10' => [
                'umum' => [
                    '0' => 'Tidak ada bukti diagnosis penyakit akibat kerja oleh dokter perusahaan melalui pemeriksaan klinis, kondisi pekerja, dan lingkungan kerja.',
                    '1' => 'Prosedur telah ditetapkan, tetapi diagnosis penyakit akibat kerja belum dilakukan dan pelaporan oleh KTT atau PTL belum dilaksanakan.',
                    '2' => 'Diagnosis telah dilakukan dan dilaporkan, tetapi pelaporan belum menggunakan formulir yang ditentukan atau belum sesuai ketentuan waktu.',
                    '3' => 'Diagnosis telah dilakukan; laporan menggunakan formulir yang ditentukan tetapi belum memenuhi ketentuan waktu, dan upaya kuratif serta rehabilitasi belum dilakukan.',
                    '4' => 'Diagnosis telah dilakukan dan dilaporkan sesuai prosedur, serta upaya kuratif dan rehabilitasi telah dilakukan terhadap pekerja yang didiagnosis.',
                    '5' => 'Diagnosis telah dilakukan dan dilaporkan sesuai prosedur, serta upaya kuratif dan rehabilitasi telah dilakukan terhadap pekerja yang didiagnosis.',
                ],
            ],

            'IV.4.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti sistem dan pelaksanaan pemeliharaan sarana, prasarana, instalasi, dan peralatan pertambangan.',
                    '1' => 'Prosedur dan daftar peralatan telah dibuat, tetapi program, jadwal, dan prosedur pemeliharaan berdasarkan identifikasi karakteristik peralatan belum dibuat.',
                    '2' => 'Program, jadwal, dan prosedur pemeliharaan telah dibuat, tetapi pelaksanaan belum sesuai dan belum dilakukan oleh tenaga teknis kompeten.',
                    '3' => 'Pelaksanaan pemeliharaan telah sesuai program dan jadwal, tetapi belum dilakukan oleh tenaga teknis kompeten.',
                    '4' => 'Pemeliharaan telah dilakukan sesuai program, jadwal, dan prosedur oleh Tenaga Teknis Pertambangan yang Berkompeten.',
                    '5' => 'Pemeliharaan telah dilakukan sesuai program, jadwal, dan prosedur oleh Tenaga Teknis Pertambangan yang Berkompeten.',
                ],
            ],

            'IV.4.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penerapan pengamanan instalasi.',
                    '1' => 'Prosedur dan daftar instalasi serta kebutuhan pengaman telah dibuat, tetapi program, jadwal, dan prosedur pengamanan, pemasangan, serta pemeliharaan belum dibuat.',
                    '2' => 'Program pengamanan instalasi telah dibuat, tetapi pelaksanaan belum sesuai dan belum dilakukan oleh tenaga teknis kompeten.',
                    '3' => 'Pelaksanaan pengamanan telah sesuai program dan jadwal, tetapi belum dilakukan oleh tenaga teknis kompeten.',
                    '4' => 'Pengamanan instalasi telah dilakukan sesuai program, jadwal, dan prosedur oleh Tenaga Teknis Pertambangan yang Berkompeten.',
                    '5' => 'Pengamanan instalasi telah dilakukan sesuai program, jadwal, dan prosedur oleh Tenaga Teknis Pertambangan yang Berkompeten.',
                ],
            ],

            'IV.4.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengujian kelayakan sarana, prasarana, instalasi, dan peralatan pertambangan.',
                    '1' => 'Prosedur dan daftar peralatan telah dibuat, tetapi program, jadwal, dan prosedur pengujian kelayakan belum dibuat.',
                    '2' => 'Program pengujian telah dibuat, tetapi pelaksanaannya belum sesuai dan belum dilakukan oleh tenaga teknis kompeten.',
                    '3' => 'Pengujian telah dilaksanakan sesuai program dan jadwal, tetapi belum dilakukan oleh tenaga teknis kompeten.',
                    '4' => 'Pengujian kelayakan telah dilakukan sesuai program, jadwal, dan prosedur oleh Tenaga Teknis Pertambangan yang Berkompeten.',
                    '5' => 'Pengujian kelayakan telah dilakukan sesuai program, jadwal, dan prosedur oleh Tenaga Teknis Pertambangan yang Berkompeten.',
                ],
            ],

            'IV.4.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penunjukan tenaga teknis kompeten untuk pengelolaan keselamatan operasi pertambangan.',
                    '1' => 'Tenaga teknis kompeten telah ditunjuk, tetapi jumlahnya belum memadai dan bukti kerja seluruh kegiatan belum tersedia.',
                    '2' => 'Jumlah tenaga teknis telah memadai, tetapi bukti kerja belum memadai dan pelaksanaan belum sesuai jadwal serta prosedur.',
                    '3' => 'Jumlah tenaga teknis dan bukti kerja telah memadai, tetapi pelaksanaan program belum sesuai jadwal serta prosedur.',
                    '4' => 'Jumlah tenaga teknis, bukti kerja, dan pelaksanaan program telah memadai serta sesuai jadwal dan prosedur.',
                    '5' => 'Jumlah tenaga teknis, bukti kerja, dan pelaksanaan program telah memadai serta sesuai jadwal dan prosedur.',
                ],
            ],

            'IV.4.5' => [
                'umum' => [
                    '0' => 'Tidak ada bukti kajian teknis pada awal kegiatan atau saat perubahan maupun modifikasi proses dan peralatan pertambangan.',
                    '1' => 'Prosedur evaluasi telah ditetapkan dan kajian teknis awal telah dibuat, tetapi kajian saat perubahan atau modifikasi belum dilakukan.',
                    '2' => 'Kajian awal dan kajian saat perubahan telah dibuat, tetapi hasilnya belum memadai dan belum disampaikan kepada KaIT atau Kepala Dinas atas nama KaIT.',
                    '3' => 'Kajian teknis telah disampaikan kepada KaIT atau Kepala Dinas atas nama KaIT, tetapi hasilnya belum memadai.',
                    '4' => 'Kajian teknis telah memadai dan telah disampaikan kepada KaIT atau Kepala Dinas atas nama KaIT.',
                    '5' => 'Kajian teknis telah memadai dan telah disampaikan kepada KaIT atau Kepala Dinas atas nama KaIT.',
                ],
            ],

            'IV.5.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengelolaan gudang bahan peledak sesuai peraturan.',
                    '1' => 'Perizinan gudang masih berlaku, tetapi penjagaan, fasilitas keselamatan dan keamanan, atau pemeriksaan penangkal petir belum memadai.',
                    '2' => 'Gudang berizin, dijaga selama 24 jam, dilengkapi fasilitas keselamatan dan keamanan, serta penangkal petir diperiksa sesuai ketentuan.',
                    '3' => 'Gudang bahan peledak dikelola sesuai persyaratan perizinan, penjagaan, fasilitas, dan pemeriksaan penangkal petir.',
                    '4' => 'Gudang bahan peledak dikelola sesuai persyaratan perizinan, penjagaan, fasilitas, dan pemeriksaan penangkal petir.',
                    '5' => 'Gudang bahan peledak dikelola sesuai persyaratan perizinan, penjagaan, fasilitas, dan pemeriksaan penangkal petir.',
                ],
            ],

            'IV.5.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyimpanan bahan peledak sesuai peraturan.',
                    '1' => 'Prosedur penyimpanan tersedia, tetapi kesesuaian izin, administrasi, penunjukan petugas, atau pemeriksaan gudang belum memadai.',
                    '2' => 'Penyimpanan, administrasi, pemeriksaan mingguan, dan penunjukan petugas telah sesuai, tetapi Kartu Pekerja Peledakan belum sesuai.',
                    '3' => 'Penyimpanan dan administrasi telah sesuai; petugas memiliki kartu yang sesuai, tetapi pelaporan penggunaan dan persediaan kepada KaIT belum dilakukan berkala.',
                    '4' => 'Penyimpanan, administrasi, pemeriksaan, petugas, kartu, dan pelaporan penggunaan serta persediaan bahan peledak telah sesuai ketentuan.',
                    '5' => 'Penyimpanan, administrasi, pemeriksaan, petugas, kartu, dan pelaporan penggunaan serta persediaan bahan peledak telah sesuai ketentuan.',
                ],
            ],

            'IV.5.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pengangkutan bahan peledak sesuai peraturan.',
                    '1' => 'Prosedur tersedia, tetapi penetapan, pengamanan, kelayakan kendaraan dan peralatan, atau kompetensi pekerja belum sesuai.',
                    '2' => 'Pengamanan dan kelayakan kendaraan serta peralatan telah dilakukan tetapi belum memadai; kompetensi seluruh pekerja belum sesuai.',
                    '3' => 'Pengamanan dan kelayakan kendaraan serta peralatan telah memadai, tetapi kompetensi seluruh pekerja belum sesuai.',
                    '4' => 'Pengangkutan telah dilaksanakan dengan pengamanan dan peralatan memadai serta seluruh pekerja yang menangani memiliki kompetensi sesuai peraturan.',
                    '5' => 'Pengangkutan telah dilaksanakan dengan pengamanan dan peralatan memadai serta seluruh pekerja yang menangani memiliki kompetensi sesuai peraturan.',
                ],
            ],

            'IV.5.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pekerjaan peledakan dilaksanakan sesuai peraturan.',
                    '1' => 'Prosedur tersedia, tetapi peralatan dan bahan belum sesuai, pemeliharaan serta dokumentasi belum memadai, atau pekerja belum memiliki kartu yang sesuai.',
                    '2' => 'Peralatan dan bahan telah sesuai serta telah disimpan, diperiksa, dan dipelihara, tetapi dokumentasi pemeliharaan belum memadai dan kartu pekerja belum sesuai.',
                    '3' => 'Peralatan, bahan, penyimpanan, pemeriksaan, pemeliharaan, dan dokumentasi telah memadai, tetapi kartu pekerja peledakan belum sesuai.',
                    '4' => 'Prosedur pekerjaan peledakan, penanganan peledakan mangkir, peralatan, pemeliharaan, dokumentasi, dan kartu pekerja telah sesuai ketentuan.',
                    '5' => 'Prosedur pekerjaan peledakan, penanganan peledakan mangkir, peralatan, pemeliharaan, dokumentasi, dan kartu pekerja telah sesuai ketentuan.',
                ],
            ],

            'IV.6.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti prosedur terdokumentasi yang mempertimbangkan aspek Keselamatan Pertambangan dalam perancangan dan rekayasa sarana, prasarana, instalasi, peralatan, dan penambangan.',
                    '1' => 'Prosedur terdokumentasi telah ditetapkan, tetapi belum mencakup petugas kompeten untuk verifikasi dan pihak yang bertanggung jawab memberikan persetujuan, serta belum dilaksanakan dengan baik.',
                    '2' => 'Prosedur telah mencakup petugas kompeten untuk verifikasi dan pihak yang bertanggung jawab memberikan persetujuan, tetapi belum dilaksanakan dengan baik.',
                    '3' => 'Prosedur telah mencakup petugas kompeten untuk verifikasi dan pihak yang bertanggung jawab memberikan persetujuan, serta telah dilaksanakan dengan baik.',
                    '5' => 'Prosedur telah mencakup petugas kompeten untuk verifikasi dan pihak yang bertanggung jawab memberikan persetujuan, serta telah dilaksanakan dengan baik.',
                ],
            ],

            'IV.6.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti prosedur yang mengatur perubahan dan modifikasi perancangan serta rekayasa.',
                    '1' => 'Prosedur perubahan dan modifikasi telah ditetapkan untuk mengidentifikasi, mendokumentasikan, meninjau ulang, dan menyetujui perubahan yang berisiko terhadap Keselamatan Pertambangan atau peraturan, tetapi belum mencakup petugas kompeten untuk identifikasi dan tinjauan ulang serta belum dilaksanakan dengan baik.',
                    '2' => 'Prosedur telah mencakup petugas kompeten untuk identifikasi dan tinjauan ulang, tetapi belum dilaksanakan dengan baik.',
                    '3' => 'Prosedur telah mencakup petugas kompeten untuk identifikasi dan tinjauan ulang serta telah dilaksanakan dengan baik.',
                    '5' => 'Prosedur telah mencakup petugas kompeten untuk identifikasi dan tinjauan ulang serta telah dilaksanakan dengan baik.',
                ],
            ],

            'IV.7' => [
                'umum' => [
                    '0' => 'Tidak ada bukti prosedur pembelian terdokumentasi yang mempertimbangkan spesifikasi teknis, persyaratan Keselamatan Pertambangan, dan ketentuan peraturan perundang-undangan.',
                    '1' => 'Prosedur pembelian telah ditetapkan, tetapi belum mencakup spesifikasi pembelian, proses seleksi pembelian, dan verifikasi kesesuaian, serta belum dilaksanakan dengan baik.',
                    '2' => 'Prosedur telah mencakup spesifikasi pembelian, proses seleksi, dan verifikasi kesesuaian, tetapi belum dilaksanakan dengan baik.',
                    '3' => 'Prosedur telah mencakup spesifikasi pembelian, proses seleksi, dan verifikasi kesesuaian serta telah dilaksanakan dengan baik, tetapi pihak pengguna belum mendapat penjelasan tentang identifikasi, penilaian, dan pengendalian risiko saat barang atau jasa diterima.',
                    '4' => 'Prosedur pembelian telah dilaksanakan dengan baik dan pihak terkait telah mendapat penjelasan tentang identifikasi, penilaian, serta pengendalian risiko saat barang atau jasa diterima di tempat kerja.',
                    '5' => 'Prosedur pembelian telah dilaksanakan dengan baik dan pihak terkait telah mendapat penjelasan tentang identifikasi, penilaian, serta pengendalian risiko saat barang atau jasa diterima di tempat kerja.',
                ],
            ],

            'IV.8.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti prosedur terdokumentasi mengenai persyaratan, seleksi, dan penetapan perusahaan jasa Pertambangan.',
                    '1' => 'Prosedur mengenai persyaratan, seleksi, dan penetapan perusahaan jasa Pertambangan telah ditetapkan, tetapi kontrak kerja belum sepenuhnya memuat komitmen untuk mematuhi persyaratan Keselamatan Pertambangan.',
                    '2' => 'Prosedur telah ditetapkan dan kontrak kerja telah memuat komitmen perusahaan jasa Pertambangan untuk mematuhi persyaratan Keselamatan Pertambangan.',
                    '5' => 'Prosedur telah ditetapkan dan kontrak kerja telah memuat komitmen perusahaan jasa Pertambangan untuk mematuhi persyaratan Keselamatan Pertambangan.',
                ],
            ],

            'IV.8.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti prosedur terdokumentasi mengenai tanggung jawab, pemantauan, dan pelaporan perusahaan jasa Pertambangan.',
                    '1' => 'Prosedur telah ditetapkan, tetapi perusahaan belum memastikan kompetensi pekerja, kelayakan sarana dan peralatan, serta kewajiban pelaporan program dan kejadian Keselamatan Pertambangan oleh perusahaan jasa.',
                    '2' => 'Prosedur telah ditetapkan; kompetensi pekerja dan kelayakan sarana serta peralatan telah dipastikan; dan kewajiban pelaporan program, nearmiss, kerusakan properti, kejadian berbahaya, cedera, serta sakit akibat kerja telah ditetapkan.',
                    '5' => 'Prosedur telah ditetapkan; kompetensi pekerja dan kelayakan sarana serta peralatan telah dipastikan; dan kewajiban pelaporan program, nearmiss, kerusakan properti, kejadian berbahaya, cedera, serta sakit akibat kerja telah ditetapkan.',
                ],
            ],

            'IV.8.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti prosedur terdokumentasi mengenai evaluasi perusahaan jasa Pertambangan.',
                    '1' => 'Prosedur evaluasi perusahaan jasa Pertambangan telah ditetapkan, tetapi evaluasi belum dilakukan sesuai prosedur dan umpan balik hasil evaluasi belum diberikan.',
                    '2' => 'Evaluasi perusahaan jasa Pertambangan telah dilakukan sesuai prosedur dan umpan balik hasil evaluasi telah diberikan.',
                    '5' => 'Evaluasi perusahaan jasa Pertambangan telah dilakukan sesuai prosedur dan umpan balik hasil evaluasi telah diberikan.',
                ],
            ],

            'IV.9' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pelaksanaan pengelolaan keadaan darurat.',
                    '1' => 'Prosedur pengelolaan keadaan darurat telah ditetapkan, tetapi belum mencakup identifikasi dan penilaian potensi keadaan darurat, pencegahan, kesiapsiagaan, respons, serta pemulihan.',
                    '2' => 'Prosedur telah mencakup identifikasi dan penilaian potensi keadaan darurat, pencegahan, kesiapsiagaan, respons, serta pemulihan, tetapi belum dilaksanakan dengan baik.',
                    '3' => 'Prosedur pengelolaan keadaan darurat telah mencakup seluruh tahapan dan dilaksanakan dengan baik.',
                    '5' => 'Prosedur pengelolaan keadaan darurat telah mencakup seluruh tahapan dan dilaksanakan dengan baik.',
                ],
            ],

            'IV.10' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyediaan dan penyiapan pertolongan pertama pada kecelakaan.',
                    '1' => 'Prosedur P3K telah ditetapkan, tetapi belum mencakup petugas P3K, kotak P3K, isi kotak P3K, dan pencatatan penggunaan isi kotak P3K.',
                    '2' => 'Prosedur P3K telah mencakup petugas P3K, kotak P3K, isi kotak P3K, dan pencatatan penggunaan isi kotak P3K, tetapi belum dilaksanakan dengan baik.',
                    '3' => 'Prosedur P3K telah mencakup petugas P3K, kotak P3K, isi kotak P3K, dan pencatatan penggunaannya serta telah dilaksanakan dengan baik.',
                    '5' => 'Prosedur P3K telah mencakup petugas P3K, kotak P3K, isi kotak P3K, dan pencatatan penggunaannya serta telah dilaksanakan dengan baik.',
                ],
            ],

            'IV.11' => [
                'umum' => [
                    '0' => 'Tidak ada bukti komunikasi keselamatan di luar pekerjaan kepada seluruh pekerja dan keluarganya.',
                    '1' => 'Keselamatan di luar pekerjaan telah dikomunikasikan kepada pekerja dan keluarga, tetapi materi promosi dan kegiatan belum sepenuhnya didokumentasikan serta belum dilaksanakan di seluruh departemen atau bagian.',
                    '2' => 'Keselamatan di luar pekerjaan telah dikomunikasikan dan materi promosi serta kegiatannya telah didokumentasikan, tetapi belum dilaksanakan di seluruh departemen atau bagian.',
                    '3' => 'Keselamatan di luar pekerjaan telah dikomunikasikan kepada pekerja dan keluarga, materi promosi serta kegiatan telah didokumentasikan, dan kegiatan telah dilaksanakan di seluruh departemen atau bagian.',
                    '5' => 'Keselamatan di luar pekerjaan telah dikomunikasikan kepada pekerja dan keluarga, materi promosi serta kegiatan telah didokumentasikan, dan kegiatan telah dilaksanakan di seluruh departemen atau bagian.',
                ],
            ],

            // ELEMEN V.1 - PEMANTAUAN DAN PENGUKURAN KINERJA
            'V.1.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pemantauan dan pengukuran pencapaian tujuan, sasaran, dan program Keselamatan Pertambangan.',
                    '1' => 'Prosedur pemantauan dan pengukuran telah tersedia, tetapi belum memadai dalam menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai; pelaksanaan belum seluruhnya sesuai prosedur.',
                    '2' => 'Prosedur telah menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai, tetapi pelaksanaan pemantauan dan pengukuran belum seluruhnya sesuai prosedur.',
                    '3' => 'Prosedur telah memadai dan pelaksanaan pemantauan serta pengukuran telah sesuai prosedur, tetapi hasilnya belum seluruhnya didokumentasikan, dievaluasi, dan dibuatkan rencana perbaikan atau tindak lanjut.',
                    '4' => 'Prosedur telah memadai, pelaksanaan sesuai prosedur, serta seluruh hasil telah didokumentasikan, dievaluasi, dan dibuatkan rencana perbaikan atau tindak lanjut.',
                    '5' => 'Prosedur telah memadai, pelaksanaan sesuai prosedur, serta seluruh hasil telah didokumentasikan, dievaluasi, dan dibuatkan rencana perbaikan atau tindak lanjut.',
                ],
            ],

            'V.1.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pemantauan dan pengukuran kinerja pengelolaan lingkungan kerja oleh petugas higiene industri yang ditetapkan.',
                    '1' => 'Prosedur pemantauan, pengukuran kinerja, evaluasi, dan tindak lanjut belum memadai; pelaksanaan belum sesuai prosedur, belum dilakukan oleh petugas higiene industri, dan belum ada rencana tindak lanjut berdasarkan evaluasi.',
                    '2' => 'Prosedur telah memadai, pemantauan dan evaluasi telah dilaksanakan sesuai prosedur oleh petugas higiene industri, tetapi rencana tindak lanjut dan perbaikan berdasarkan evaluasi belum ditetapkan.',
                    '3' => 'Prosedur telah memadai, pemantauan dan evaluasi dilakukan sesuai prosedur oleh petugas higiene industri, rencana tindak lanjut telah ditetapkan, tetapi baru sebagian tindak lanjut dilaksanakan.',
                    '4' => 'Prosedur telah memadai, pemantauan dan evaluasi dilakukan sesuai prosedur oleh petugas higiene industri, rencana tindak lanjut telah ditetapkan, dan seluruh tindak lanjut serta perbaikan telah dilaksanakan.',
                    '5' => 'Prosedur telah memadai, pemantauan dan evaluasi dilakukan sesuai prosedur oleh petugas higiene industri, rencana tindak lanjut telah ditetapkan, dan seluruh tindak lanjut serta perbaikan telah dilaksanakan.',
                ],
            ],

            'V.1.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pemantauan dan pengukuran kinerja pengelolaan kesehatan kerja Pertambangan.',
                    '1' => 'Prosedur pemantauan, pengukuran, evaluasi, dan tindak lanjut belum tersedia; pelaksanaan belum sesuai prosedur dan rencana tindak lanjut berdasarkan evaluasi belum ditetapkan.',
                    '2' => 'Prosedur telah tersedia dan pemantauan, pengukuran, serta evaluasi telah dilaksanakan sesuai prosedur, tetapi rencana tindak lanjut dan perbaikan belum ditetapkan.',
                    '3' => 'Prosedur telah tersedia, pemantauan dan evaluasi dilakukan sesuai prosedur, rencana tindak lanjut telah ditetapkan, tetapi baru sebagian tindak lanjut dilaksanakan.',
                    '4' => 'Prosedur telah menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai; pemantauan serta evaluasi dilakukan sesuai prosedur; dan seluruh tindak lanjut serta perbaikan telah dilaksanakan.',
                    '5' => 'Prosedur telah menjelaskan metode, frekuensi, ruang lingkup, dan peralatan yang sesuai; pemantauan serta evaluasi dilakukan sesuai prosedur; dan seluruh tindak lanjut serta perbaikan telah dilaksanakan.',
                ],
            ],

            'V.1.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pemantauan dan pengukuran kinerja pengelolaan Keselamatan Operasi Pertambangan oleh Tenaga Teknis Pertambangan yang Berkompeten di bidang Keselamatan Operasi.',
                    '1' => 'Prosedur pemantauan, pengukuran, evaluasi, dan tindak lanjut belum memadai; pelaksanaan belum sesuai prosedur, belum dilakukan oleh tenaga teknis yang berkompeten, dan rencana tindak lanjut belum ditetapkan.',
                    '2' => 'Prosedur telah memadai, pemantauan dan evaluasi dilakukan sesuai prosedur oleh tenaga teknis yang berkompeten, tetapi rencana tindak lanjut belum ditetapkan.',
                    '3' => 'Prosedur telah memadai, pemantauan dan evaluasi dilakukan sesuai prosedur oleh tenaga teknis yang berkompeten, rencana tindak lanjut telah ditetapkan, tetapi baru sebagian tindak lanjut dilaksanakan.',
                    '4' => 'Prosedur telah memadai, pemantauan dan evaluasi dilakukan sesuai prosedur oleh tenaga teknis yang berkompeten, rencana tindak lanjut telah ditetapkan, dan seluruh tindak lanjut serta perbaikan telah dilaksanakan.',
                    '5' => 'Prosedur telah memadai, pemantauan dan evaluasi dilakukan sesuai prosedur oleh tenaga teknis yang berkompeten, rencana tindak lanjut telah ditetapkan, dan seluruh tindak lanjut serta perbaikan telah dilaksanakan.',
                ],
            ],

            'V.1.5' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pemantauan dan pengukuran kinerja pengelolaan bahan peledak dan peledakan.',
                    '1' => 'Prosedur pemantauan, pengukuran, evaluasi, dan tindak lanjut belum memadai; pelaksanaan belum sesuai prosedur dan rencana tindak lanjut belum ditetapkan.',
                    '2' => 'Prosedur telah memadai dan pemantauan, pengukuran, serta evaluasi telah dilakukan sesuai prosedur, tetapi rencana tindak lanjut belum ditetapkan.',
                    '3' => 'Prosedur telah memadai, pemantauan dan evaluasi telah dilakukan sesuai prosedur, rencana tindak lanjut telah ditetapkan, tetapi baru sebagian tindak lanjut dilaksanakan.',
                    '4' => 'Prosedur telah memadai, pemantauan dan evaluasi telah dilakukan sesuai prosedur, serta rencana tindak lanjut telah ditetapkan dan seluruh tindak lanjut telah dilaksanakan.',
                    '5' => 'Prosedur telah memadai, pemantauan dan evaluasi telah dilakukan sesuai prosedur, serta rencana tindak lanjut telah ditetapkan dan seluruh tindak lanjut telah dilaksanakan.',
                ],
            ],

            'V.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pelaksanaan inspeksi Keselamatan Pertambangan.',
                    '1' => 'Prosedur inspeksi belum memadai dalam menjelaskan tujuan, jenis, pelaksana, objek, jadwal, frekuensi, lembar periksa, peralatan, metode, klasifikasi bahaya, pelaporan, tindak lanjut, evaluasi, dan dokumentasi; pelaksanaan belum sesuai prosedur.',
                    '2' => 'Prosedur inspeksi telah memadai, tetapi pelaksanaan inspeksi Keselamatan Pertambangan belum sepenuhnya sesuai dengan prosedur.',
                    '3' => 'Prosedur dan pelaksanaan inspeksi telah sesuai, tetapi hasil inspeksi belum seluruhnya didokumentasikan dan belum seluruhnya dibuatkan rencana perbaikan.',
                    '4' => 'Prosedur dan pelaksanaan inspeksi telah sesuai; seluruh hasil inspeksi didokumentasikan dan dibuatkan rencana perbaikan, tetapi rencana perbaikan belum seluruhnya dilaksanakan.',
                    '5' => 'Prosedur dan pelaksanaan inspeksi telah sesuai; seluruh hasil inspeksi didokumentasikan dan dibuatkan rencana perbaikan, tetapi rencana perbaikan belum seluruhnya dilaksanakan.',
                ],
            ],

            'V.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti evaluasi kepatuhan terhadap ketentuan peraturan perundang-undangan dan persyaratan lain yang terkait dengan Keselamatan Pertambangan.',
                    '1' => 'Prosedur evaluasi kepatuhan belum memadai dan pelaksanaannya belum sesuai prosedur; hasil evaluasi serta rencana tindak lanjut belum ditetapkan secara memadai.',
                    '2' => 'Prosedur evaluasi kepatuhan telah memadai, tetapi pelaksanaan evaluasi belum sepenuhnya sesuai prosedur dan tindak lanjut hasil evaluasi belum ditetapkan secara memadai.',
                    '3' => 'Evaluasi kepatuhan telah dilaksanakan sesuai prosedur, tetapi hasil evaluasi belum seluruhnya didokumentasikan dan/atau belum seluruhnya dibuatkan rencana tindak lanjut.',
                    '4' => 'Evaluasi kepatuhan telah dilaksanakan sesuai prosedur, seluruh hasil didokumentasikan dan dibuatkan rencana tindak lanjut, tetapi tindak lanjut belum seluruhnya dilaksanakan.',
                    '5' => 'Evaluasi kepatuhan telah dilaksanakan sesuai prosedur, seluruh hasil didokumentasikan dan dibuatkan rencana tindak lanjut, tetapi tindak lanjut belum seluruhnya dilaksanakan.',
                ],
            ],

            'V.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti evaluasi dan tindak lanjut terhadap laporan hasil penyelidikan kecelakaan, kejadian berbahaya, dan penyakit akibat kerja.',
                    '1' => 'Prosedur evaluasi dan tindak lanjut belum memadai; pelaksanaan belum sesuai prosedur dan dokumentasi hasil penyelidikan belum memadai.',
                    '2' => 'Prosedur telah memadai, tetapi evaluasi dan tindak lanjut laporan hasil penyelidikan belum sepenuhnya dilaksanakan sesuai prosedur.',
                    '3' => 'Evaluasi dan tindak lanjut telah dilaksanakan sesuai prosedur, tetapi dokumentasi, penyampaian hasil, atau pelaksanaan tindakan perbaikan belum sepenuhnya terpenuhi.',
                    '4' => 'Evaluasi dan tindak lanjut telah dilaksanakan sesuai prosedur; hasil penyelidikan didokumentasikan dan dikomunikasikan serta tindakan perbaikan telah dilaksanakan.',
                    '5' => 'Evaluasi dan tindak lanjut telah dilaksanakan sesuai prosedur; hasil penyelidikan didokumentasikan dan dikomunikasikan serta tindakan perbaikan telah dilaksanakan.',
                ],
            ],

            'V.5.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti evaluasi pengelolaan buku tambang.',
                    '1' => 'Evaluasi buku tambang belum mencakup seluruh perintah, larangan, petunjuk, pemberitahuan KaIT dan Inspektur Tambang, serta pendaftaran yang dipersyaratkan. Evaluasi belum dilakukan minimal sekali dalam enam bulan, hasil belum ditindaklanjuti, dan pelaksanaan atau pencatatan kewajiban dalam buku tambang belum seluruhnya dipenuhi.',
                    '2' => 'Evaluasi telah mencakup seluruh aspek yang dipersyaratkan dan dilakukan minimal sekali dalam enam bulan, tetapi hasil belum ditindaklanjuti dan kewajiban dalam buku tambang belum seluruhnya dilaksanakan.',
                    '3' => 'Evaluasi telah mencakup seluruh aspek yang dipersyaratkan dan dilakukan minimal sekali dalam enam bulan. Hasil evaluasi telah ditindaklanjuti, tetapi pelaksanaan perintah, larangan, petunjuk, atau pencatatan kewajiban dalam buku tambang belum seluruhnya dipenuhi.',
                    '4' => 'Evaluasi telah mencakup seluruh aspek yang dipersyaratkan dan dilakukan minimal sekali dalam enam bulan. Hasil telah ditindaklanjuti serta seluruh perintah, larangan, petunjuk, dan kewajiban pencatatan dalam buku tambang telah dilaksanakan.',
                    '5' => 'Evaluasi telah mencakup seluruh aspek yang dipersyaratkan dan dilakukan minimal sekali dalam enam bulan. Hasil telah ditindaklanjuti serta seluruh perintah, larangan, petunjuk, dan kewajiban pencatatan dalam buku tambang telah dilaksanakan.',
                ],
            ],

            'V.5.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti evaluasi pengelolaan buku daftar kecelakaan tambang.',
                    '1' => 'Evaluasi belum mencakup seluruh data kecelakaan yang diwajibkan, belum dilakukan minimal sekali dalam enam bulan, hasil belum ditindaklanjuti, dan pendaftaran kecelakaan yang mengakibatkan cedera ringan, berat, atau meninggal belum seluruhnya dilakukan.',
                    '2' => 'Evaluasi telah mencakup seluruh data kecelakaan yang diwajibkan dan dilakukan minimal sekali dalam enam bulan, tetapi hasil belum ditindaklanjuti dan pendaftaran kecelakaan belum seluruhnya dilakukan.',
                    '3' => 'Evaluasi telah mencakup seluruh data kecelakaan dan dilakukan minimal sekali dalam enam bulan. Hasil telah ditindaklanjuti, tetapi pendaftaran kecelakaan dalam buku daftar kecelakaan tambang belum seluruhnya dilakukan.',
                    '4' => 'Evaluasi telah mencakup seluruh data kecelakaan, dilakukan minimal sekali dalam enam bulan, ditindaklanjuti, dan seluruh kecelakaan yang diwajibkan telah didaftarkan.',
                    '5' => 'Evaluasi telah mencakup seluruh data kecelakaan, dilakukan minimal sekali dalam enam bulan, ditindaklanjuti, dan seluruh kecelakaan yang diwajibkan telah didaftarkan.',
                ],
            ],

            'V.5.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti evaluasi pelaporan Keselamatan Pertambangan.',
                    '1' => 'Evaluasi belum mencakup ketepatan waktu dan kesesuaian isi laporan, belum dilakukan minimal sekali dalam enam bulan, hasil belum ditindaklanjuti, dan pelaporan belum seluruhnya memenuhi ketentuan isi, format, serta tata waktu.',
                    '2' => 'Evaluasi telah mencakup ketepatan waktu dan kesesuaian isi laporan serta dilakukan minimal sekali dalam enam bulan, tetapi hasil belum ditindaklanjuti dan pelaporan belum seluruhnya memenuhi ketentuan.',
                    '3' => 'Evaluasi telah mencakup seluruh aspek yang dipersyaratkan dan telah ditindaklanjuti, tetapi penyampaian laporan, kesesuaian format, atau ketepatan waktu pelaporan belum seluruhnya terpenuhi.',
                    '4' => 'Evaluasi telah mencakup seluruh aspek, dilakukan minimal sekali dalam enam bulan, ditindaklanjuti, dan seluruh laporan telah disampaikan sesuai format serta tata waktu yang ditetapkan.',
                    '5' => 'Evaluasi telah mencakup seluruh aspek, dilakukan minimal sekali dalam enam bulan, ditindaklanjuti, dan seluruh laporan telah disampaikan sesuai format serta tata waktu yang ditetapkan.',
                ],
            ],

            'V.5.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti evaluasi dokumentasi kejadian berbahaya, kejadian akibat penyakit tenaga kerja, dan Penyakit Akibat Kerja.',
                    '1' => 'Evaluasi belum mencakup kesesuaian isi, format, analisis penyebab kejadian, dan pelaksanaan tindak lanjut. Evaluasi belum dilakukan minimal sekali dalam enam bulan, hasil belum ditindaklanjuti, dan dokumentasi kejadian belum seluruhnya menggunakan format khusus yang ditentukan KaIT.',
                    '2' => 'Evaluasi telah mencakup kesesuaian isi, format, analisis penyebab, dan tindak lanjut serta dilakukan minimal sekali dalam enam bulan, tetapi hasil belum ditindaklanjuti dan dokumentasi kejadian belum seluruhnya memenuhi ketentuan.',
                    '3' => 'Evaluasi telah mencakup seluruh aspek dan hasilnya telah ditindaklanjuti, tetapi dokumentasi kejadian belum seluruhnya memenuhi ketentuan format khusus yang ditetapkan KaIT.',
                    '4' => 'Evaluasi telah mencakup seluruh aspek, dilakukan minimal sekali dalam enam bulan, ditindaklanjuti, dan dokumentasi kejadian telah memenuhi ketentuan format khusus yang ditetapkan KaIT.',
                    '5' => 'Evaluasi telah mencakup seluruh aspek, dilakukan minimal sekali dalam enam bulan, ditindaklanjuti, dan dokumentasi kejadian telah memenuhi ketentuan format khusus yang ditetapkan KaIT.',
                ],
            ],

            'V.5.5' => [
                'umum' => [
                    '0' => 'Tidak ada bukti evaluasi dokumen dan laporan pemenuhan kompetensi serta persyaratan lainnya.',
                    '1' => 'Evaluasi belum mencakup tingkat pemenuhan persyaratan dan pelaksanaan tindak lanjut, belum dilakukan minimal sekali dalam enam bulan, dan hasil evaluasi belum ditindaklanjuti sepenuhnya.',
                    '2' => 'Evaluasi telah mencakup tingkat pemenuhan persyaratan dan tindak lanjut, tetapi belum dilakukan minimal sekali dalam enam bulan dan hasil evaluasi belum ditindaklanjuti sepenuhnya.',
                    '3' => 'Evaluasi telah mencakup tingkat pemenuhan persyaratan dan dilakukan minimal sekali dalam enam bulan, tetapi hasil evaluasi belum ditindaklanjuti sepenuhnya.',
                    '4' => 'Evaluasi telah mencakup tingkat pemenuhan persyaratan dan tindak lanjut, dilakukan minimal sekali dalam enam bulan, serta seluruh hasil evaluasi telah ditindaklanjuti.',
                    '5' => 'Evaluasi telah mencakup tingkat pemenuhan persyaratan dan tindak lanjut, dilakukan minimal sekali dalam enam bulan, serta seluruh hasil evaluasi telah ditindaklanjuti.',
                ],
            ],

            // ELEMEN V.6 - AUDIT INTERNAL PENERAPAN SMKP MINERBA
            'V.6' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pelaksanaan audit internal penerapan SMKP Minerba atau SMKP khusus minimal sekali dalam satu tahun.',
                    '1' => 'Prosedur audit internal telah tersedia, tetapi belum memadai dan pelaksanaan audit belum sesuai prosedur.',
                    '2' => 'Prosedur audit internal telah mencakup ruang lingkup, frekuensi, metodologi, kompetensi auditor, tanggung jawab, persyaratan pelaksanaan, dan pelaporan hasil audit, tetapi pelaksanaan audit belum sesuai prosedur.',
                    '3' => 'Prosedur telah memadai dan audit telah dilaksanakan sesuai prosedur, tetapi hasil audit belum seluruhnya didokumentasikan dan belum dibuatkan rencana tindak lanjut.',
                    '4' => 'Prosedur telah memadai, audit telah dilaksanakan sesuai prosedur, seluruh hasil audit telah didokumentasikan, dan rencana tindak lanjut telah dibuat serta dilaksanakan.',
                    '5' => 'Prosedur telah memadai, audit telah dilaksanakan sesuai prosedur, seluruh hasil audit telah didokumentasikan, dan rencana tindak lanjut telah dibuat serta dilaksanakan.',
                ],
            ],

            'V.7' => [
                'umum' => [
                    '0' => 'Tidak ada bukti rencana perbaikan dan tindak lanjut ketidaksesuaian terhadap standar kerja, praktik kerja, prosedur, peraturan perundang-undangan, atau persyaratan SMKP Minerba yang dapat menimbulkan cedera, penyakit, kerusakan sarana atau peralatan, maupun kerusakan lingkungan kerja.',
                    '1' => 'Prosedur tindak lanjut ketidaksesuaian telah tersedia, tetapi belum memadai dan pelaksanaan perencanaan perbaikan serta tindak lanjut belum sesuai prosedur.',
                    '2' => 'Prosedur telah mencakup identifikasi dan perbaikan ketidaksesuaian, analisis penyebab, evaluasi tindakan pencegahan, pencatatan dan komunikasi hasil, serta evaluasi efektivitas tindakan. Namun, pelaksanaan perbaikan belum sesuai prosedur.',
                    '3' => 'Prosedur telah memadai dan pelaksanaan perbaikan telah sesuai prosedur, tetapi perbaikan dan tindak lanjut belum seluruhnya didokumentasikan serta dilaksanakan sesuai perencanaan.',
                    '4' => 'Prosedur telah memadai, pelaksanaan perbaikan sesuai prosedur, dan seluruh perbaikan serta tindak lanjut telah didokumentasikan dan dilaksanakan sesuai perencanaan.',
                    '5' => 'Prosedur telah memadai, pelaksanaan perbaikan sesuai prosedur, dan seluruh perbaikan serta tindak lanjut telah didokumentasikan dan dilaksanakan sesuai perencanaan.',
                ],
            ],

            'VI.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyusunan, penetapan, dan dokumentasi manual SMKP Minerba atau SMKP khusus.',
                    '1' => 'Manual belum mencakup ruang lingkup, prosedur terdokumentasi, interaksi antar-elemen, dan acuan dokumen terkait; manual juga belum disahkan manajemen.',
                    '2' => 'Manual telah mencakup ruang lingkup, prosedur, interaksi antar-elemen, dan acuan dokumen serta telah disahkan, tetapi belum disosialisasikan kepada seluruh departemen atau belum digunakan secara konsisten.',
                    '3' => 'Manual telah memenuhi ruang lingkup, disahkan, dan disosialisasikan kepada seluruh departemen, tetapi belum digunakan secara konsisten dalam penyusunan dokumen tingkat selanjutnya.',
                    '4' => 'Manual telah memenuhi persyaratan, disahkan, disosialisasikan, dan digunakan secara konsisten dalam penyusunan dokumen tingkat selanjutnya.',
                    '5' => 'Manual telah memenuhi persyaratan, disahkan, disosialisasikan, dan digunakan secara konsisten dalam penyusunan dokumen tingkat selanjutnya.',
                ],
            ],

            'VI.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti prosedur pengendalian dokumen Keselamatan Pertambangan yang disusun, ditetapkan, diterapkan, dan didokumentasikan.',
                    '1' => 'Prosedur pengendalian dokumen telah disusun dan didokumentasikan, tetapi belum memadai dan belum diterapkan secara konsisten oleh personel yang ditunjuk.',
                    '2' => 'Prosedur telah mencakup persetujuan penerbitan dan pengendalian dokumen, perubahan atau modifikasi, serta identifikasi dan pengelolaan dokumen eksternal, tetapi belum diterapkan secara konsisten.',
                    '3' => 'Prosedur pengendalian dokumen telah mencakup seluruh aspek yang dipersyaratkan dan diterapkan secara konsisten oleh personel yang ditunjuk.',
                    '5' => 'Prosedur pengendalian dokumen telah mencakup seluruh aspek yang dipersyaratkan dan diterapkan secara konsisten oleh personel yang ditunjuk.',
                ],
            ],

            'VI.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penyusunan, penetapan, penerapan, dan dokumentasi prosedur pengendalian rekaman Keselamatan Pertambangan.',
                    '1' => 'Prosedur pengendalian rekaman belum memadai, belum diterapkan secara konsisten, dan rekaman Keselamatan Pertambangan belum didokumentasikan.',
                    '2' => 'Prosedur telah mencakup identifikasi, penyimpanan, perlindungan, akses, masa simpan, dan pemusnahan rekaman, tetapi belum diterapkan secara konsisten dan rekaman belum didokumentasikan.',
                    '3' => 'Prosedur telah mencakup seluruh aspek pengendalian rekaman, diterapkan secara konsisten, dan rekaman didokumentasikan agar dapat dibaca, diidentifikasi, serta ditelusuri.',
                    '5' => 'Prosedur telah mencakup seluruh aspek pengendalian rekaman, diterapkan secara konsisten, dan rekaman didokumentasikan agar dapat dibaca, diidentifikasi, serta ditelusuri.',
                ],
            ],

            'VI.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penetapan jenis dokumen dan rekaman sesuai elemen-elemen SMKP Minerba atau SMKP khusus.',
                    '1' => 'Jenis dokumen dan rekaman telah ditetapkan, tetapi belum mencakup seluruh elemen SMKP Minerba atau SMKP khusus.',
                    '2' => 'Jenis dokumen dan rekaman telah ditetapkan dan mencakup seluruh elemen SMKP Minerba atau SMKP khusus.',
                    '5' => 'Jenis dokumen dan rekaman telah ditetapkan dan mencakup seluruh elemen SMKP Minerba atau SMKP khusus.',
                ],
            ],

            // ELEMEN VII - TINJAUAN MANAJEMEN
            'VII.1' => [
                'umum' => [
                    '0' => 'Tidak ada bukti tinjauan manajemen terhadap penerapan SMKP yang dilaksanakan secara terencana dan berkala minimal sekali dalam satu tahun serta didokumentasikan.',
                    '1' => 'Tinjauan manajemen telah dilakukan, tetapi tidak dilakukan oleh pimpinan tertinggi dan tidak dilaksanakan secara terencana serta berkala.',
                    '2' => 'Tinjauan manajemen telah dilakukan secara terencana dan berkala, tetapi tidak dilakukan oleh pimpinan tertinggi.',
                    '3' => 'Tinjauan manajemen dilakukan oleh pimpinan tertinggi, tetapi tidak dilaksanakan secara terencana dan berkala.',
                    '4' => 'Tinjauan manajemen dilakukan oleh pimpinan tertinggi secara terencana dan berkala minimal sekali dalam satu tahun serta hasilnya didokumentasikan.',
                    '5' => 'Tinjauan manajemen dilakukan oleh pimpinan tertinggi secara terencana dan berkala minimal sekali dalam satu tahun serta hasilnya didokumentasikan.',
                ],
            ],

            'VII.2' => [
                'umum' => [
                    '0' => 'Tidak ada bukti dokumentasi catatan hasil tinjauan manajemen.',
                    '1' => 'Catatan hasil tinjauan manajemen telah didokumentasikan, tetapi masukan tinjauan manajemen belum memadai.',
                    '2' => 'Catatan hasil tinjauan manajemen telah didokumentasikan dan masukannya telah memadai, termasuk kebijakan, hasil audit, daftar risiko, evaluasi kepatuhan, tindak lanjut sebelumnya, partisipasi dan konsultasi, komunikasi eksternal, pencapaian kinerja, penyelidikan kejadian, tindakan perbaikan, perubahan, serta rekomendasi peningkatan.',
                    '5' => 'Catatan hasil tinjauan manajemen telah didokumentasikan dan masukannya telah memadai, termasuk kebijakan, hasil audit, daftar risiko, evaluasi kepatuhan, tindak lanjut sebelumnya, partisipasi dan konsultasi, komunikasi eksternal, pencapaian kinerja, penyelidikan kejadian, tindakan perbaikan, perubahan, serta rekomendasi peningkatan.',
                ],
            ],

            'VII.3' => [
                'umum' => [
                    '0' => 'Tidak ada bukti keluaran tinjauan manajemen berupa keputusan dan tindakan untuk efektivitas sistem manajemen serta peningkatan kinerja Keselamatan Pertambangan.',
                    '1' => 'Keluaran tinjauan manajemen telah menghasilkan keputusan dan tindakan, tetapi belum sepenuhnya mempertimbangkan kebijakan, kinerja Keselamatan Pertambangan, sumber daya, dan elemen SMKP lainnya.',
                    '2' => 'Keluaran tinjauan manajemen telah menghasilkan keputusan dan tindakan serta sepenuhnya mempertimbangkan kebijakan, kinerja Keselamatan Pertambangan, sumber daya, dan elemen SMKP lainnya.',
                    '5' => 'Keluaran tinjauan manajemen telah menghasilkan keputusan dan tindakan serta sepenuhnya mempertimbangkan kebijakan, kinerja Keselamatan Pertambangan, sumber daya, dan elemen SMKP lainnya.',
                ],
            ],

            'VII.4' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pencatatan, dokumentasi, pelaporan hasil tinjauan manajemen kepada pihak berkepentingan, dan komunikasi kepada pihak yang memerlukan.',
                    '1' => 'Hasil tinjauan manajemen telah dicatat, didokumentasikan, dan dilaporkan kepada pihak berkepentingan, tetapi belum dikomunikasikan kepada pihak yang memerlukan.',
                    '2' => 'Hasil tinjauan manajemen telah dicatat, didokumentasikan, dilaporkan kepada pihak berkepentingan, dan dikomunikasikan kepada pihak yang memerlukan.',
                    '5' => 'Hasil tinjauan manajemen telah dicatat, didokumentasikan, dilaporkan kepada pihak berkepentingan, dan dikomunikasikan kepada pihak yang memerlukan.',
                ],
            ],

            'VII.5' => [
                'umum' => [
                    '0' => 'Tidak ada bukti pelaksanaan peningkatan kinerja ketika terjadi perubahan peraturan, tuntutan pemangku kepentingan, perubahan bisnis atau organisasi, perkembangan teknologi, hasil kajian kecelakaan atau penyakit akibat kerja, pelaporan, maupun masukan pekerja.',
                    '1' => 'Terdapat bukti pelaksanaan peningkatan kinerja sebagai respons terhadap perubahan peraturan, tuntutan pemangku kepentingan, perubahan bisnis atau organisasi, perkembangan teknologi, hasil kajian kejadian, pelaporan, atau masukan pekerja.',
                    '5' => 'Terdapat bukti pelaksanaan peningkatan kinerja sebagai respons terhadap perubahan peraturan, tuntutan pemangku kepentingan, perubahan bisnis atau organisasi, perkembangan teknologi, hasil kajian kejadian, pelaporan, atau masukan pekerja.',
                ],
            ],

            'VII.6' => [
                'umum' => [
                    '0' => 'Tidak ada bukti penggunaan hasil tinjauan tindak lanjut perbaikan sebagai dasar penentuan kebijakan peningkatan kinerja Keselamatan Pertambangan.',
                    '1' => 'Sebagian hasil tinjauan tindak lanjut perbaikan telah digunakan sebagai dasar penentuan kebijakan peningkatan kinerja Keselamatan Pertambangan.',
                    '2' => 'Seluruh hasil tinjauan tindak lanjut perbaikan telah digunakan sebagai dasar penentuan kebijakan peningkatan kinerja Keselamatan Pertambangan.',
                    '5' => 'Seluruh hasil tinjauan tindak lanjut perbaikan telah digunakan sebagai dasar penentuan kebijakan peningkatan kinerja Keselamatan Pertambangan.',
                ],
            ],
        ];

        DB::transaction(function () use ($rubrics) {
            foreach ($rubrics as $code => $permitGroups) {
                $criteria = SmkpCriteria::where('code', $code)->first();

                if (! $criteria) {
                    throw new \RuntimeException(
                        "Subelemen {$code} tidak ditemukan di tabel smkp_criteria."
                    );
                }

                foreach ($permitGroups as $permitType => $levels) {
                    foreach ($levels as $level => $description) {
                        SmkpCriteriaRubric::updateOrCreate(
                            [
                                'smkp_criteria_id' => $criteria->id,
                                'permit_type' => $permitType,
                                'score_level' => (string) $level,
                            ],
                            [
                                'description' => $description,
                                'sort_order' => (int) $level,
                            ]
                        );
                    }
                }
            }
        });
    }
}

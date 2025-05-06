{{-- resources/views/pdf/surat-permohonan.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permohonan Izin Tempat PSG</title>
    <style>
        @page {
            size: F4;
            margin: 1.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.5;
            font-size: 11pt;
        }

        .container {
            width: 100%;
            max-width: 21cm;
            margin: auto;
            box-sizing: border-box;
        }

        .kop-surat {
            width: 100%;
            margin-bottom: 15px;
            border-bottom: 4px solid #000;
            padding-bottom: 10px;
        }

        #tableKop {
            width: 100%;
        }

        .kop-surat td {
            vertical-align: middle;
            padding: 0;
        }

        .logo-cell {
            width: 20%;
            text-align: center;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .header-text {
            text-align: center;
        }

        .header-text h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text h2 {
            font-size: 10pt;
            margin: 0;
            text-transform: uppercase;
        }

        .header-text p {
            font-size: 9pt;
            margin: 2px 0;
        }

        .surat-info p {
            margin: 2px 0;
        }

        .content {
            text-align: justify;
        }

        .content p {
            margin-bottom: 10px;
            text-indent: 1cm;
        }

        .no-indent {
            text-indent: 0;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }

        h1 {
            font-size: 12pt;
            text-align: center;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        #tablePeserta {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            table-layout: fixed;
        }

        #tablePeserta,
        th,
        #tablePeserta td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- Kop Surat --}}
        <div class="kop-surat">
            <table id="tableKop">
                <tr>
                    <td class="logo-cell">
                        @php
                            $path1 = public_path('assets/images/logo/logo-yayasan.jpeg');
                            $type1 = pathinfo($path1, PATHINFO_EXTENSION);
                            $data1 = file_get_contents($path1);
                            $logoYayasan = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);
                        @endphp
                        <img src="{{ $logoYayasan }}" alt="Logo Yayasan" class="logo-img">
                    </td>
                    <td class="header-text">
                        <h2>Yayasan Pendidikan dan Sosial Sunan Ampel</h2>
                        <h1>SMK SUNAN AMPEL</h1>
                        <p>Alamat: Jl. Dsn. Sumberwinong, Kec. Jombang, Kab. Jombang, Jawa Timur</p>
                        <p>Telp: +62 858 5357 5224 | Email: smksunanampeljombang@gmail.com</p>
                    </td>
                    <td class="logo-cell">
                        @php
                            $path2 = public_path('assets/images/logo/logo-sekolah.jpeg');
                            $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                            $data2 = file_get_contents($path2);
                            $logoSekolah = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
                        @endphp
                        <img src="{{ $logoSekolah }}" alt="Logo Sekolah" class="logo-img">
                    </td>
                </tr>
            </table>
        </div>

        {{-- Informasi Surat --}}
        <div class="surat-info">
            <p>Nomor: 01.007/SMK-SA/VII/2024</p>
            <p>Lampiran: 1 Bundel</p>
            <p>Perihal: Permohonan Izin Tempat PSG</p>
        </div>

        {{-- Isi Surat --}}
        <div class="content">
            <p class="no-indent">Kepada Yth:</p>
            <p class="no-indent">{{ $industri->nama_industri }}</p>
            <p class="no-indent">Di Tempat</p>
            <br>
            <p class="no-indent">Assalamualaikum Warohmatullahi Wabarokatuh,</p>

            <p>Segala puji bagi Allah SWT, semoga kita senantiasa mendapatkan rahmat dan taufik-Nya dalam menjalankan aktivitas sehari-hari. Aamiin.</p>

            <p>Dalam rangka pelaksanaan pendidikan sistem ganda guna meningkatkan keterampilan lulusan SMK, siswa-siswi SMK Sunan Ampel diwajibkan mengikuti Praktik Kerja Industri (Prakerin) di dunia usaha atau industri selama kurang lebih 3 bulan.</p>

            <p>Sehubungan dengan hal tersebut, kami mohon kesediaan Bapak/Ibu Pimpinan untuk menerima peserta didik kami (daftar terlampir) guna melaksanakan Prakerin di perusahaan/instansi yang Bapak/Ibu pimpin.</p>

            <p>Adapun program keahlian di SMK Sunan Ampel adalah Teknik Komputer dan Jaringan (TKJ).</p>

            <p>Demikian surat permohonan ini kami buat. Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.</p>

            <p>Wassalamu’alaikum Warohmatullahi Wabarokatuh</p>
        </div>

        {{-- Tanda Tangan --}}
        <div class="signature">
            <p>Jombang, {{ date('d F Y') }}</p>
            <p>Kepala SMK Sunan Ampel</p>
            <br><br>
            <p class="underline-text">Ati’ul Qoni’ah, S.Pd.I</p>
        </div>
    </div>

    {{-- Halaman Kedua: Daftar Siswa --}}
    @if(isset($kelompok) && count($kelompok->anggotaKelompok) > 0)
    <div class="page-break"></div>
    <div class="container">
        <h1>DAFTAR SISWA PROGRAM KEAHLIAN TKJ<br> PESERTA PRAKERIN TAHUN {{ \Carbon\Carbon::parse($pelaksanaan->tgl_mulai)->format('Y') }}</h1>

        <table id="tablePeserta">
            <thead>
                <tr>
                    <th style="width: 8%">No</th>
                    <th style="width: 42%">Nama</th>
                    <th style="width: 30%">Kompetensi Keahlian</th>
                    <th style="width: 20%">Kelas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelompok->anggotaKelompok as $anggota)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $anggota->siswa->nama_siswa ?? 'Nama Siswa' }}</td>
                    <td>{{ $anggota->siswa->kompetensi_keahlian ?? 'Teknik Komputer Jaringan' }}</td>
                    <td>{{ $anggota->siswa->kelas ?? 'Kelas' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</body>

</html>

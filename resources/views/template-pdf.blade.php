<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permohonan PKL</title>
    <style>
    @page {
        size: A4;
        margin: 1.5cm 1.5cm;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        line-height: 1.3;
        font-size: 11pt;
    }

    .container {
        width: 100%;
        max-width: 21cm;
        margin: 0 auto;
        padding: 0;
        box-sizing: border-box;
    }

    .kop-surat {
        width: 100%;
        margin-bottom: 15px;
        border-bottom: 1px solid #000;
        padding-bottom: 10px;
    }

    #tableKop {
        width: 100%;
        border-style: none;
    }

    .kop-surat td {
        vertical-align: middle;
        padding: 0;
    }

    .logo-cell {
        width: 20%;
    }

    .gambar {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    .header-text {
        flex: 1;
        text-align: center;
    }

    .header-text h1 {
        font-size: 14pt;
        margin: 0;
        font-weight: bold;
        text-transform: uppercase;
    }

    .header-text p {
        font-size: 9pt;
        margin: 2px 0;
    }

    .surat-info {
        margin: 10px 0;
    }

    .surat-info p {
        margin: 2px 0;
    }

    .content {
        text-align: justify;
    }

    .content p {
        margin-bottom: 8px;
        text-indent: 1cm;
    }

    .no-indent {
        text-indent: 0;
    }

    .signature {
        margin-top: 30px;
        text-align: right;
    }

    .underline-text {
        text-decoration: underline;
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
        margin-bottom: 15px;
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

    .page-break {
        page-break-after: always;
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Kop Surat dengan Logo -->
        <div class="kop-surat">
            <table id="tableKop">
                <tr>
                    <td class="logo-cell">
                        @php
                        $path = public_path('assets/images/logo/sekolah.png');
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        @endphp
                        <img src="{{ $base64 }}" alt="Logo Sekolah" class="gambar">
                    </td>
                    <td>
                        <div class="header-text">
                            <h1>Sekolah Menengah Kejuruan Sunan Ampel Jombang</h1>
                            <p>Dsn. Sumberwinong, Ds. Banjardowo, Kec/Kab. Jombang, Provinsi Jawa Timur, kodepos 61419
                            </p>
                            <p>Telepon (021) 5725061 | Laman www.smksunanampel.kemdikbud.go.id</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="surat-info">
            <p>No: xx/xxx/xxx/2025</p>
            <p>Hal: Permohonan Praktik Kerja Lapangan (PKL)</p>
            <p>Lamp: 1 Bundel</p>
        </div>

        <div class="content">
            <p class="no-indent">Yth:</p>
            <p class="no-indent">Pimpinan HRD</p>
            <p class="no-indent">{{ $industri->nama_industri }}</p>
            <p class="no-indent">{{ $industri->alamat }}</p>
            <br>
            <p class="no-indent">Dengan Hormat,</p>

            <p>Dalam rangka pelaksanaan Pendidikan Vokasi terkait dengan program <span class="underline-text">link and
                    match</span> guna meningkatkan kompetensi peserta didik, diwajibkan untuk melaksanakan Praktik Kerja
                Lapangan (PKL). Oleh karena itu kami mengajukan permohonan kepada Bapak/Ibu pimpinan perusahaan agar
                dapat menerima peserta didik kami sebagai berikut (terlampir):</p>

            <p>Untuk melaksanakan PKL pada bagian/departemen yang ada di Perusahaan Bapak/Ibu.</p>

            <p>Adapun pelaksanaan PKL kami rencanakan pada bulan
                <span>{{ \Carbon\Carbon::parse($pelaksanaan->tgl_mulai)->format('F') }}</span> tahun
                <span>{{ \Carbon\Carbon::parse($pelaksanaan->tgl_mulai)->format('Y') }}</span> sampai dengan
                <span>{{ \Carbon\Carbon::parse($pelaksanaan->tgl_selesai)->format('F') }}</span> tahun
                <span>{{ \Carbon\Carbon::parse($pelaksanaan->tgl_selesai)->format('Y') }}</span> atau sesuai dengan
                waktu yang Bapak/Ibu tentukan. Demikian surat permohonan ini kami ajukan, atas perhatiannya kami ucapkan
                terima kasih.
            </p>
        </div>

        <div class="signature">
            <p>Jombang, {{ date('d F Y') }}</p>
            <br><br>
            <p>Kepala Sekolah</p>
            <p>SMK Sunan Ampel Jombang</p>
        </div>
    </div>

    <!-- Halaman kedua hanya muncul jika ada data -->
    @if(isset($kelompok) && count($kelompok->anggotaKelompok) > 0)
    <div class="page-break"></div>

    <div class="container">
        <h1>DAFTAR CALON PESERTA PROGRAM PKL TAHUN {{ \Carbon\Carbon::parse($pelaksanaan->tgl_mulai)->format('Y') }}
        </h1>

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
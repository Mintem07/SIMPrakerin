<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permohonan PKL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }
        .container {
            width: 21cm;
            margin: 0 auto;
            padding: 2cm;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header p {
            font-size: 10pt;
            margin: 5px 0;
        }
        .header .underline {
            border-bottom: 1px solid #000;
            margin: 5px auto;
            width: 80%;
        }
        .surat-info {
            margin: 30px 0;
        }
        .surat-info p {
            margin: 5px 0;
            font-size: 11pt;
        }
        .content {
            font-size: 11pt;
            text-align: justify;
        }
        .content p {
            margin-bottom: 10px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
            font-size: 11pt;
        }
        .underline-text {
            text-decoration: underline;
        }
        .italic {
            font-style: italic;
        }
        h1 {
            font-size: 14pt;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .alur {
            margin-top: 30px;
        }
        .alur h2 {
            font-size: 12pt;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .alur ol {
            padding-left: 20px;
        }
        .alur li {
            margin-bottom: 10px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sekolah Menengah Kejuruan Sunan Ampel Jombang</h1>
            <p>Dsn. Sumberwinong, Ds. Banjardowo, Kec/Kab. Jombang, Provinsi Jawa Timur, kodepos 61419</p>
            <p>Telepon (021) 5725061</p>
            <p>Laman www.smksunanampel.kemdikbud.go.id</p>
            <div class="underline"></div>
        </div>

        <div class="surat-info">
            <p>No: xx/xxx/xxx/2025</p>
            <p>Hal: Permohonan Praktik Kerja Lapangan (PKL)</p>
            <p>Lamp: 1 Bundel</p>
        </div>

        <div class="content">
            <p>Yth:</p>
            <p>Pimpinan HRD</p>
            <p>{{ $industri->nama_industri }}</p>
            <p>{{ $industri->alamat }}</p>
            
            <p>Dengan Hormat,</p>
            
            <p>Dalam rangka pelaksanaan Pendidikan Vokasi terkait dengan program <span class="underline-text">link and match</span> guna meningkatkan kompetensi peserta didik, diwajibkan untuk melaksankan Praktik Kerja Lapangan (PKL). Oleh karena itu kami mengajukan permohonan kepada Bapak/Ibu pimpinan perusahaan agar dapat menerima peserta didik kami sebagai berikut (terlampir);</p>
            
            <p>Untuk melaksanakan PKL pada bagian/departemen yang ada di Perusahaan Bapak/Ibu.</p>
            
            <p>Adapun pelaksanaan PKL kami rencanakan pada bulan <span>{{ $penjadwalan->tgl_mulai->format('M') }}</span> tahun <span>{{ $penjadwalan->tgl_mulai->format('Y') }}</span> sampai dengan <span>{{ $penjadwalan->tgl_selesai->format('M') }}</span> tahun <span>{{ $penjadwalan->tgl_selesai->format('Y') }}</span> atau sesuai dengan waktu yang Bapak/Ibu tentukan. Demikian surat permohonan ini kami ajukan, atas perhatiannya kami ucapkan terima kasih.</p>
        </div>

        <div class="signature">
            <p>Jombang, {{ date('d M Y') }}</p>
            // berikan jarak sekitar 2 baris
            <p>{{ $kepsek->nama }}</p>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="container">
        <h1>Daftar Calon Peserta Program PKL tahun 2025</h1>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                {{ $no = 0 }}
                @foreach($kelompok as $group)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $group->anggotaKelompok->siswa->nama_siswa }}</td>
                    <td>Teknik Komputer Jaringan</td>
                    <td>{{ $group->anggotaKelompok->siswa->kelas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
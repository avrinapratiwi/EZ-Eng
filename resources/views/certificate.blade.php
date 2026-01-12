<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Kelulusan</title>
    <link rel="stylesheet" href="{{ asset('index6.css') }}">
</head>
<body>

<div class="certificate-container">
    <div class="certificate-border">

        <div class="certificate-ribbon">
            <div class="certificate-ribbon-text">SERTIFIKAT KOMPETENSI KELULUSAN</div>
            <div class="certificate-ribbon-badge">
                <img src="{{ asset('img/logo_ez-eng.png') }}" alt="EZ-Eng">
            </div>
        </div>

        <div class="certificate-header">
            <div class="certificate-logo">EZ-Eng</div>
        </div>

        <div class="certificate-body">
            <div class="certificate-given-to">Diberikan kepada</div>

            <!-- NAMA USER -->
            <div class="certificate-recipient-name">
                {{ $user->first_name }} {{ $user->last_name }}
            </div>

            <div class="certificate-achievement">Atas kelulusannya pada kelas</div>

            <!-- NAMA COURSE -->
            <div class="certificate-class-name">
                {{ $module->title }}
            </div>
        </div>

        <div class="certificate-footer">
            <div class="certificate-signature-section">

                <!-- TANGGAL LULUS -->
                <div class="certificate-date">
                    {{ \Carbon\Carbon::parse($attempt->finished_at)->format('d F Y') }}
                </div>

                <div class="certificate-signature-image">
                    <img src="{{ asset('img/signature.png') }}" alt="Tanda Tangan" style="width:150px;">
                </div>

                <div class="certificate-signer-name">
                    EZ-Eng Team
                </div>

                <div class="certificate-signer-title">
                    E-Learning Platform
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>

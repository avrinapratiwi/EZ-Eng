<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Kelulusan</title>
    <link rel="stylesheet" href="{{ asset('css/index6.css') }}">
</head>
<body>

<div class="certificate-container">
    <div class="certificate-border">

        <div class="certificate-ribbon">
            <div class="certificate-ribbon-text">SERTIFIKAT KOMPETENSI KELULUSAN</div>
            <div class="certificate-ribbon-badge">
                <img src="{{asset('img/logo_ez-eng.png') }}">
            </div>
        </div>

        <div class="certificate-header">
            <div class="certificate-logo">Eazy English</div>
        </div>

        <div class="certificate-body">
            <div class="certificate-given-to">Diberikan kepada</div>

            <div class="certificate-recipient-name">
                {{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}
            </div>

            <div class="certificate-achievement">Atas kelulusannya pada kelas</div>

            <div class="certificate-class-name">
                {{ $module->title }}
            </div>
        </div>

        <div class="certificate-footer">
            <div class="certificate-signature-section">
                <div class="certificate-date">
                    {{ now()->format('d F Y') }}
                </div>

                <div class="certificate-signature-image">
                    <img src="{{asset('img/ttd.png') }}" style="width:150px;">
                </div>

                <div class="certificate-signer-name">Avrina Pratiwi</div>
                <div class="certificate-signer-title">
                    Project Creator<br>Eazy English
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>

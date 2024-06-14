<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track & Field Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .certificate {
            width: 800px;
            background-color: #d9534f;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            position: relative;
            margin-bottom: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-admin {
            font-weight: bold;
            margin-left: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 50px;
        }

        .logo-text {
            font-size: 2em;
            margin-left: 10px;
        }

        h1 {
            margin: 10px 0;
            font-size: 2.5em;
        }

        h2 {
            margin: 10px 0;
            font-size: 1.5em;
        }

        .player-name {
            font-size: 1.5em;
            font-weight: bold;
            background-color: yellow;
            color: black;
            display: inline-block;
            padding: 5px 10px;
            margin: 10px 0;
        }

        .medals img {
            width: 100px;  /* ou toute autre taille souhaitée */
            height: auto; /* ceci permet de maintenir le ratio d'aspect */
        }

        .details {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .signature {
            margin: 20px 0;
            border-top: 1px solid white;
            width: 200px;
            margin: 0 auto;
            padding-top: 10px;
        }

        .footer {
            margin-top: 20px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .export-pdf-button, a {
            background-color: #f6aa6f;
            color: rgb(0, 0, 0);
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        a {
            display: inline-block;
            line-height: 22px;
            background-color: rgb(212, 212, 212)
        }

        .export-pdf-button:hover, a:hover {
            background-color: #f6aa6f;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1 style="color: yellow">RUNNING CHAMPION</h1>
        <h2>Track & Field Certificate</h2>
        <p>This is to certify that</p>
        <div class="player-name">Equipe : <span style="color: purple">{{ Auth::user()->login }}</span></div>
        <p>
            has successfully accomplished the Track & Field match from Team Company.
            We truly appreciate the hard work, persistence, and teamwork, which leads to ultimate victory.
        </p>
        <p>
            We hope the performance/position remains unbeatable for centuries.
        </p>
        <div class="medals">
            <img src="{{ asset('admin/images/medaille.png') }}" alt="Medal 1">
        </div>
        <div class="details">
            <span>Distance: ____________</span>
            <span>Time: ____________</span>
            <span>Date: ____________</span>
        </div>
        <div class="signature">Signature</div>
        <div class="footer">
            <span>clubhouse.org</span>
        </div>
    </div>
    <div class="buttons">
        <button id="export-pdf" class="export-pdf-button">Exporter pdf</button>
        <a href="{{ route('equipeClassementTotal')}}">Retour</a>
    </div>



<script>
    document.getElementById('export-pdf').addEventListener('click', function() {
        window.location.href = '/generate-pdf';
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richiesta Collaborazione</title>

    {{--(Gmail, Outlook, Apple Mail, etc.) non supportano CSS esterni come file .css o da Vite/CDN --}}
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .btn-primary {
            background-color: #0d6efd;
            color: #fff !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 0.25rem;
            display: inline-block;
            margin-top: 15px;
        }
        h1, h2 {
            color: #343a40;
        }
        p {
            font-size: 1rem;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Richiesta di Collaborazione</h1>
        <h2>Dettagli Utente:</h2>
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p>Clicca il pulsante per renderlo Revisor:</p>
        <a href="{{ route('make.revisor', compact('user')) }}" class="btn-primary">Accetta</a>
    </div>
</body>
</html>
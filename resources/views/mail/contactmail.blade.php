<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuovo Messaggio</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="20" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <tr>
                        <td>
                            <h2 style="color: #333333;">Hai ricevuto un nuovo messaggio</h2>
                            <p style="font-size: 16px; color: #555;">
                                <strong>Titolo:</strong> {{ $emailData['title'] }}
                            </p>
                            <p style="font-size: 16px; color: #555;">
                                <strong>Email:</strong> {{ $emailData['email'] }}
                            </p>
                            <p style="font-size: 16px; color: #555;"><strong>Descrizione:</strong></p>
                            <p style="font-size: 16px; color: #555;">{{ $emailData['description'] }}</p>
                            
                            <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;">
                            
                            <p style="font-size: 14px; color: #999;">Questo è un messaggio automatico. Non rispondere a questa email.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

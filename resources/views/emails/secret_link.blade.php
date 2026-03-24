<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f5; padding: 20px; }
        .container { background-color: #ffffff; padding: 30px; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn { display: inline-block; padding: 15px 25px; background-color: #2563eb; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 12px; color: #6b7280; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color: #1f2937;">Ciao {{ $reservation->guest_name }},</h2>
        <p style="color: #4b5563; font-size: 16px; line-height: 1.5;">
            Siamo felici di ospitarti a <strong>{{ $reservation->apartment->name }}</strong> dal {{ \Carbon\Carbon::parse($reservation->check_in)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($reservation->check_out)->format('d/m/Y') }}.
        </p>
        
        <p style="color: #4b5563; font-size: 16px; line-height: 1.5;">
            Per facilitare il tuo arrivo e ottenere i <strong>codici di accesso e il video istruzioni</strong>, ti chiediamo di completare la registrazione obbligatoria cliccando sul pulsante qui sotto:
        </p>

        <div style="text-align: center;">
            <a href="{{ route('checkin.show', $reservation->token) }}" class="btn">
                Vai al tuo Check-in Online
            </a>
        </div>

        <div class="footer">
            Se il bottone non funziona, copia e incolla questo link nel browser:<br>
            {{ route('checkin.show', $reservation->token) }}
        </div>
    </div>
</body>
</html>
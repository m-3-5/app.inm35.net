<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soggiorno Concluso - {{ $apartment->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-xl p-8 max-w-sm w-full text-center border-t-8 border-gray-400">
        <div class="text-6xl mb-4">👋</div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Soggiorno Concluso</h1>
        <p class="text-gray-600 mb-6">
            Ciao {{ $reservation->guest_name }}, il tuo soggiorno a <strong>{{ $apartment->name }}</strong> è terminato il {{ \Carbon\Carbon::parse($reservation->check_out)->format('d/m/Y') }}.
        </p>
        
        <div class="bg-blue-50 p-4 rounded-xl mb-6">
            <p class="text-blue-800 font-semibold mb-2">Speriamo tu sia stato bene!</p>
            <p class="text-sm text-blue-600">Per motivi di sicurezza, i codici di accesso e le istruzioni non sono più visibili.</p>
        </div>

        <a href="#" class="block w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-4 rounded-xl transition">
            Lascia una Recensione
        </a>
    </div>

</body>
</html>
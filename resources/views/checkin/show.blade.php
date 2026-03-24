<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvenuto a {{ $apartment->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Questo assicura che il testo inserito dall'admin mantenga i formati (grassetto, elenchi) */
        .prose p { margin-bottom: 1rem; }
        .prose ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased pb-20">

    <header class="bg-blue-600 text-white shadow-lg p-6 rounded-b-3xl text-center">
        <h1 class="text-3xl font-bold">{{ $apartment->name }}</h1>
        <p class="mt-2 text-blue-100 text-lg">Ciao {{ $reservation->guest_name }}!</p>
        <p class="mt-1 text-sm text-blue-200">
            Soggiorno: {{ \Carbon\Carbon::parse($reservation->check_in)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($reservation->check_out)->format('d/m/Y') }}
        </p>
    </header>

    <main class="max-w-md mx-auto mt-6 px-4 space-y-6">
		
		@if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-xl shadow-sm animate-pulse">
            <div class="flex">
                <div class="flex-shrink-0">
                    <span class="text-green-500 text-xl">✅</span>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 font-bold">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        @if($apartment->whatsapp_number)
        <a href="https://wa.me/{{ str_replace('+', '', $apartment->whatsapp_number) }}" target="_blank" class="block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-xl shadow-md text-center flex items-center justify-center gap-2">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.115.549 4.188 1.594 6.008L.027 24l6.109-1.565c1.767.95 3.754 1.45 5.895 1.45 6.646 0 12.031-5.385 12.031-12.031C24.062 5.385 18.677 0 12.031 0zm0 21.82c-1.815 0-3.594-.486-5.15-1.41l-.37-.218-3.824.978 1.002-3.73-.24-.381C2.51 15.485 2.004 13.785 2.004 12.031c0-5.531 4.5-10.031 10.027-10.031s10.031 4.5 10.031 10.031c0 5.531-4.5 10.031-10.031 10.031zm5.502-7.518c-.302-.151-1.785-.882-2.063-.983-.277-.101-.48-.151-.681.151-.202.302-.781.983-.957 1.184-.176.202-.353.227-.655.076-1.547-.775-2.735-2.012-3.414-3.513-.176-.302.163-.264.441-.818.088-.176.044-.328-.006-.479-.05-.151-.681-1.642-.932-2.247-.245-.592-.491-.51-.681-.518-.176-.006-.378-.006-.58-.006-.202 0-.529.076-.807.378-.277.302-1.058 1.033-1.058 2.52s1.084 2.923 1.235 3.125c.151.202 2.128 3.25 5.155 4.555.719.31 1.279.496 1.716.635.72.23 1.375.197 1.888.119.574-.087 1.785-.73 2.037-1.436.252-.705.252-1.31.176-1.436-.076-.126-.277-.202-.58-.353z"/></svg>
            Contatta Assistenza
        </a>
        @endif
		
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
            <h2 class="text-xl font-bold mb-3 flex items-center gap-2">
                🔑 Self Check-in
            </h2>
            <p class="text-gray-600 mb-4">L'ingresso è consentito dalle ore {{ \Carbon\Carbon::parse($apartment->default_checkin_hour)->format('H:i') }}.</p>
            
            @if($apartment->access_code)
            <div class="bg-gray-100 p-3 rounded-lg text-center mb-4">
                <span class="text-sm text-gray-500 uppercase">Codice d'accesso</span>
                <p class="text-2xl font-mono font-bold tracking-widest">{{ $apartment->access_code }}</p>
            </div>
            @endif

            @if($apartment->checkin_video_url)
            <a href="{{ $apartment->checkin_video_url }}" target="_blank" class="block w-full bg-blue-100 text-blue-700 text-center font-semibold py-2 rounded-lg hover:bg-blue-200 transition">
                ▶️ Guarda Video Istruzioni
            </a>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow p-5 prose">
            <h2 class="text-xl font-bold mb-3 text-gray-900">ℹ️ Info Soggiorno</h2>
            <div class="text-gray-700 text-sm">{!! $apartment->stay_info !!}</div>
        </div>

        <div class="bg-white rounded-xl shadow p-5 prose">
            <h2 class="text-xl font-bold mb-3 text-gray-900">📋 Regole della Casa</h2>
            <div class="text-gray-700 text-sm">{!! $apartment->house_rules !!}</div>
        </div>

        <div class="bg-white rounded-xl shadow p-5 prose border-l-4 border-red-400">
            <h2 class="text-xl font-bold mb-3 text-gray-900">👋 Check-out</h2>
            <div class="text-gray-700 text-sm">{!! $apartment->checkout_info !!}</div>
        </div>

    </main>
</body>
</html>
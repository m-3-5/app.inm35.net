<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Documenti - {{ $apartment->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 font-sans antialiased">

    <div class="bg-white rounded-3xl shadow-xl p-8 max-w-md w-full border-t-8 border-blue-600">
        
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Benvenuto, {{ $reservation->guest_name }}!</h1>
            <p class="text-gray-600 mt-2">Prima di sbloccare i codici di accesso per <strong>{{ $apartment->name }}</strong>, la legge italiana richiede la registrazione degli ospiti.</p>
        </div>

        <div class="bg-blue-50 p-4 rounded-xl mb-6 text-sm text-blue-800 border border-blue-100">
            <p class="font-semibold mb-1">🔒 Privacy e Sicurezza</p>
            <p>I tuoi documenti saranno utilizzati esclusivamente per la registrazione obbligatoria al portale "Alloggiati Web" della Polizia di Stato. Verranno eliminati in modo sicuro dal server.</p>
        </div>

        <form action="{{ route('checkin.upload', ['token' => $reservation->token]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Carica i documenti (Puoi selezionarne più di uno)</label>
                
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-500 transition-colors bg-gray-50">
                    <div class="space-y-1 text-center">
                        <div class="text-4xl mb-3">📸</div>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 px-3 py-2 shadow border border-gray-200">
                                <span>Scegli file o scatta foto</span>
                                <input id="file-upload" name="document_files[]" type="file" class="sr-only" accept=".jpg,.jpeg,.png,.pdf" multiple required onchange="mostraNomiFile(this)">
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 mt-3">PNG, JPG, PDF fino a 10MB</p>
                        
                        <div id="lista-file" class="mt-4 text-sm font-bold text-blue-700 break-words"></div>
                    </div>
                </div>
                
                @error('document_files.*')
                    <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-xl shadow-sm text-md font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-colors">
                Invia Documenti e Sblocca
            </button>
        </form>
    </div>

   <script>
        // Creiamo un "raccoglitore virtuale" che non si svuota mai
        const contenitoreFile = new DataTransfer();

        function mostraNomiFile(input) {
            const lista = document.getElementById('lista-file');
            
            // 1. Prendiamo i nuovi file appena scelti e li mettiamo nel raccoglitore
            for (let i = 0; i < input.files.length; i++) {
                contenitoreFile.items.add(input.files[i]);
            }

            // 2. Diciamo al modulo di usare il nostro raccoglitore (che ora ha TUTTI i file)
            input.files = contenitoreFile.files;

            // 3. Disegniamo a schermo i nomi di tutti i file accumulati
            lista.innerHTML = ''; 

            if (input.files.length === 1) {
                lista.innerHTML = '✅ File pronto: <strong>' + input.files[0].name + '</strong>';
            } else if (input.files.length > 1) {
                lista.innerHTML = '✅ <strong>' + input.files.length + ' file pronti</strong> per l\'invio:<br>';
                for (let i = 0; i < input.files.length; i++) {
                    lista.innerHTML += '📄 ' + input.files[i].name + '<br>';
                }
            }
        }
    </script>
</body>
</html>
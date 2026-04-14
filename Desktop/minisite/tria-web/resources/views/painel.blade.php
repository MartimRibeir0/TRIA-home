<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRIA-Home | Painel Médico</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50 font-sans text-slate-800">

    <header class="bg-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-tight">TRIA-Home 🏥</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm bg-blue-800 px-3 py-1 rounded-full">Dr. Pedro Lopes</span>
                <span class="text-sm font-semibold">Hospital de Santo André</span>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <h2 class="text-xl font-semibold mb-6 border-b pb-2 text-slate-700">Fila de Espera - Triagem</h2>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-600 text-sm uppercase tracking-wider">
                        <th class="p-4 font-semibold">Posição</th>
                        <th class="p-4 font-semibold">Prioridade</th>
                        <th class="p-4 font-semibold">Utente</th>
                        <th class="p-4 font-semibold">Resumo Clínico (IA)</th>
                        <th class="p-4 font-semibold">Espera Est.</th>
                        <th class="p-4 font-semibold text-center">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($pacientes as $paciente)
                        @php
                            $corBadge = match($paciente->cor_manchester) {
                                'vermelho' => 'bg-red-100 text-red-800 border-red-200',
                                'laranja'  => 'bg-orange-100 text-orange-800 border-orange-200',
                                'amarelo'  => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'verde'    => 'bg-green-100 text-green-800 border-green-200',
                                'azul'     => 'bg-blue-100 text-blue-800 border-blue-200',
                                default    => 'bg-slate-100 text-slate-800 border-slate-200',
                            };
                        @endphp

                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                            <td class="p-4 text-lg font-bold text-slate-500">
                                #{{ $paciente->posicao }}
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold border uppercase tracking-wider {{ $corBadge }}">
                                    {{ $paciente->cor_manchester }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-slate-800">{{ $paciente->nome_utente }}</div>
                                <div class="text-xs text-slate-500">Nasc: {{ $paciente->data_nascimento }}</div>
                            </td>
                            <td class="p-4 text-sm text-slate-600 max-w-xs truncate" title="{{ $paciente->resumo_ia }}">
                                {{ Str::limit($paciente->resumo_ia, 80) }}
                            </td>
                            <td class="p-4">
                                <div class="text-sm font-semibold {{ $paciente->tempo_espera_min > 60 ? 'text-red-500' : 'text-slate-700' }}">
                                    {{ $paciente->tempo_espera_min }} min
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-4 rounded text-sm transition-colors">
                                    Chamar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-500">
                                Não há utentes na fila de espera no momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
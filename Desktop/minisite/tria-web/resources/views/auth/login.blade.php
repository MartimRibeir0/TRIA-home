<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TRIA-Home</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 h-screen flex items-center justify-center font-sans">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-200">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-900">TRIA-Home</h1>
            <p class="text-slate-500 mt-2">Aceda à plataforma hospitalar</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <p class="text-red-700 text-sm">{{ $errors->first() }}</p>
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">E-mail Profissional ou Utente</label>
                <input type="email" name="email" required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                    placeholder="exemplo@tria.pt">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Palavra-passe</label>
                <input type="password" name="password" required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                    placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-slate-600">
                    <input type="checkbox" class="mr-2 rounded border-slate-300 text-blue-600"> Lembrar-me
                </label>
                <a href="#" class="text-blue-600 hover:underline font-medium">Esqueceu a senha?</a>
            </div>

            <button type="submit" 
                class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 rounded-lg transition-colors shadow-lg shadow-blue-900/20">
                Entrar no Sistema
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <p class="text-slate-500 text-sm">
                Não tem conta? <a href="#" class="text-blue-600 font-bold hover:underline">Registe-se aqui</a>
            </p>
        </div>
    </div>

</body>
</html>
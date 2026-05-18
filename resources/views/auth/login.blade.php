<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen antialiased">

<div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 w-full max-w-md mx-4">

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-semibold text-slate-900">Login Admin</h2>
        <p class="text-sm text-slate-500 mt-2">Silakan masukkan kredensial Anda</p>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
            <input type="text" name="username" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
            <input type="password" name="password" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors" required>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-medium py-2.5 rounded-lg transition-colors duration-200">
                Masuk
            </button>
        </div>
    </form>

</div>

</body>
</html>
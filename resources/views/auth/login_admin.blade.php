<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <section class="flex h-screen justify-center items-center">
        <div class="relative md:w-3/12 px-8 py-4">
            <p class="text-lg font-semibold text-center mb-8">Sistem Informasi Pengajuan Magang <br> PT. Krakatau Bandar Samudera</p>
            <form method="POST" action="{{ route('login.admin')}}" class="space-y-4">
                @csrf
                <div>
                    <label for="nik" class="block text-sm font-semibold text-gray-700 mb-1">NIK</label>
                    <input 
                    type="number" 
                    id="nik" 
                    name="nik" 
                    placeholder="Masukan NIK SSO"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm  font-semibold text-gray-700 mb-1">Password</label>
                    <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukan password"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>
                @if (isset($msg))
                    <p class="text-xs px-3 py-2 border border-red-500 bg-red-100 text-red-500">{{$msg}}</p>
                @endif
                <!-- Tombol Login -->
                <div class="mt-6">
                    <button 
                    type="submit"
                    class="w-full font-semibold bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 transition duration-300"
                    >
                    Masuk
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
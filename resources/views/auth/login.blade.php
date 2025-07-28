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
            <form method="POST" action="{{ route('login.create')}}" class="space-y-4">
                <!-- Email -->
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Masukan alamat email"
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
                <div class="flex justify-end mt-2">
                    <a href="" class="text-blue-600 hover:text-blue-800 text-sm font-semibold cursor-pointer">Lupa Password ?</a>
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
            <div class="text-center flex justify-center gap-x-1 mt-2.5 text-sm">
                <span>Belum punya akun ?</span>
                <a class="text-blue-600 hover:text-blue-700 cursor-pointer font-semibold " href="{{ route('register')}}">Daftar disini </a>
            </div>
        </div>
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <section class="flex h-screen justify-center items-center">
        <div class="relative md:w-3/12 px-8 py-4">
            <p class="text-2xl font-bold text-start">Daftar Akun Baru</p>
            <p class="text-sm mb-10">Pastikan Anda melengkapi semua informasi dibawah ini</p>
            <form method="POST" action="{{ route('register.store')}}" autocomplete="off" class="space-y-4 text-sm">
                <!-- Nama Lengkap -->
                @csrf
                <div>
                    <label for="name" class="block font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    placeholder="Masukan Nama lengkap Anda"
                    autocomplete="off"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block font-semibold text-gray-700 mb-1">Email</label>
                    <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="Masukan Email Anda"
                    autocomplete="off"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-semibold text-gray-700 mb-1">Password</label>
                    <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="Masukan Password Anda"
                    autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <span class="italic text-gray-600 text-xs">*Password min 8 character</span>
                </div>
                @if (isset($msg))
                    <p class="text-xs px-3 py-2 border border-red-500 bg-red-100 text-red-500">{{$msg}}</p>
                @endif
                <!-- Tombol Register -->
                <div class="mt-8">
                    <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 font-semibold transition duration-300"
                    >
                    Daftar
                    </button>
                </div>
                </form>
            <div class="text-center flex justify-center gap-x-1 mt-2.5 text-sm">
                <span>Sudah punya akun ?</span>
                <a class="text-blue-600 hover:text-blue-700 cursor-pointer font-semibold " href="{{ route('login')}}">Masuk akun anda </a>
            </div>
        </div>
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>MAGANG</title>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    <section class="w-full md:flex md:flex-row overflow-hidden">
        <section class="md:w-1/6 bg-gray-50 h-screen md:px-3 md:py-3 max-h-screen md:flex md:flex-col gap-y-2 md:border-r border-gray-300">
            <img src="{{ asset('storage/image/kip_logo.png') }}" alt="logo" class=" w-46 px-3 my-3">
            @if ($_SESSION['user_id'])
                <a href="riwayat" class="flex font-[rubik] font-[600] items-center gap-3 py-2 text-gray-700 hover:text-blue-900 px-3 uppercase text-lg hover:bg-blue-100 transition">
                    <img width="30" height="30" src="https://img.icons8.com/fluency/48/order-history.png" alt="order-history"/>
                    <span>Riwayat</span>
                </a>
            @endif
            @if ($_SESSION['user_id'])
                <a href="form" class="flex items-center gap-3 py-2 text-gray-700 hover:text-blue-900 px-3 font-[rubik] font-[600] uppercase text-lg hover:bg-blue-100 transition">
                    <img width="30" height="30" src="https://img.icons8.com/fluency/48/file.png" alt="file"/>
                    <span>Pengajuan</span>
                </a>
            @endif
            @if ($_SESSION['sso_user_id'])
                <a href="verify" class="flex items-center gap-3 py-2 text-gray-700 hover:text-blue-900 px-3 font-[rubik] font-[600] uppercase text-lg hover:bg-blue-100 transition">
                    <img width="30" height="30" src="https://img.icons8.com/fluency/48/approval.png" alt="approval"/>
                    <span>Verifikasi</span>
                </a>
            @endif
            <form method="GET" action="{{ route('logout') }}" class="w-full hover:bg-blue-100 transition px-3">
                @csrf
                <button type="submit" class="flex cursor-pointer items-center gap-3 py-2 text-gray-700 hover:text-blue-900 font-[rubik] font-[600] uppercase text-lg">
                    <img width="30" height="30" src="https://img.icons8.com/stencil/50/exit.png" alt="exit"/>
                    <span>Logout</span>
                </button>
            </form>
        </section>
        <section class="md:w-5/6 h-screen md:px-20 md:pt-10 font-[rubik] overflow-auto">
            @yield('dashboard')
        </section>
    </section>
</body>
</html>
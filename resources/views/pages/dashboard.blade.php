<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <title>MAGANG</title>
</head>
<body>
    <section class="w-full md:flex md:flex-row">
        <section class="md:w-2/12 bg-gray-50 h-screen max-h-screen md:flex md:flex-col gap-y-2 md:border-r border-gray-300">
            <img src="{{ asset('storage/image/kip_logo.png') }}" alt="logo" class=" w-46 px-3 my-3">
            <a href="dashboard/riwayat" class="flex items-center gap-3 py-2 text-gray-700 hover:text-blue-900 px-3 font-bold uppercase text-lg hover:bg-blue-100 transition">
                <img width="30" height="30" src="https://img.icons8.com/fluency/48/order-history.png" alt="order-history"/>
                <span>Riwayat</span>
            </a>
            <a href="dashboard/pengajuan" class="flex items-center gap-3 py-2 text-gray-700 hover:text-blue-900 px-3 font-bold uppercase text-lg hover:bg-blue-100 transition">
                <img width="30" height="30" src="https://img.icons8.com/fluency/48/file.png" alt="file"/>
                <span>Pengajuan</span>
            </a>
            <a href="dashboard/verifikasi" class="flex items-center gap-3 py-2 text-gray-700 hover:text-blue-900 px-3 font-bold uppercase text-lg hover:bg-blue-100 transition">
                <img width="30" height="30" src="https://img.icons8.com/fluency/48/approval.png" alt="approval"/>
                <span>Verifikasi</span>
            </a>
        </section>
        <section class="md:w-10/12 max-h-screen h-screen">
            @yield('dashboard')
        </section>
    </section>
</body>
</html>
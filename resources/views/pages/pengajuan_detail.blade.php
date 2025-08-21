@extends('pages.dashboard')
@section('dashboard')
    <section>
        <p class=" font-[rubik] font-[700] md:text-2xl">Detail Pengajuan Magang</p>
        <p class="font-[rubik] md:text-sm">Anda dapat melihat semua detail pengajuan magang anda dibawah ini</p>
        <div class="grid md:grid-cols-4 grid-cols-1 gap-4 mt-10">
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Status Pengajuan</p>
                @switch($data->status->id)
                    @case(1)
                        <p class="text-sm text-gray-700 bg-gray-50 rounded-lg w-fit px-3 py-1 border border-gray-600 font-semibold">{{ $data->status->title }}</p>
                        @break
                    @case(2)
                        <p class="text-sm text-green-700 bg-green-50 rounded-lg w-fit px-3 py-1 border border-green-600 font-semibold">{{ $data->status->title }}</p>
                        @break
                    @case(3)
                        <p class="text-sm text-blue-700 bg-blue-50 rounded-lg w-fit px-3 py-1 border border-blue-600 font-semibold">{{ $data->status->title }}</p>
                        @break
                    @case(5)
                        <p class="text-sm text-green-700 bg-green-50 rounded-lg w-fit px-3 py-1 border border-green-600 font-semibold">{{ $data->status->title }}</p>
                        @break
                    @default
                        <p class="text-sm text-red-700 bg-red-50 rounded-lg w-fit px-3 py-1 border border-red-600 font-semibold">{{ $data->status->title }}</p>
                @endswitch
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Nama Lengkap</p>
                <p class="text-sm">{{ $data->name }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Nomor Induk</p>
                <p class="text-sm">{{ $data->nim }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Email</p>
                <p class="text-sm">{{ $data->email }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">No WhatsApp</p>
                <p class="text-sm">{{ $data->phone }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Sekolah / Universitas</p>
                <p class="text-sm">{{ $data->school }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Jenjang</p>
                <p class="text-sm">{{ $data->levels === 0 ? 'SMA' : ($data->levels === 1 ? 'S1' : 'S2') }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Jurusan</p>
                <p class="text-sm">{{ isset($data->jurusan) ? $data->jurusan : ''  }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Waktu Magang</p>
                <p class="text-sm">{{ Carbon\Carbon::parse($data->start_date)->format('d M Y') . ' - ' . Carbon\Carbon::parse($data->end_date)->format('d M Y') }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Bidang Peminatan Magang</p>
                <p class="text-sm">{{ $data->spesialitation }}</p>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Curriculum Vitae</p>
                <a href="{{ env('APP_URL') . '/' . 'storage/file/' . $data->path_cv }}" target="blank" class="bg-red-700 w-fit hover:bg-red-700 text-white px-3 py-1 text-sm rounded-md">
                    Lihat File
                </a>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Surat Pengajuan</p>
                <a href="{{ env('APP_URL') . '/' . 'storage/file/' . $data->path_submission_letter }}" target="blank" class="bg-red-700 w-fit hover:bg-red-700 text-white px-3 py-1 text-sm rounded-md">
                    Lihat File
                </a>
            </div>
            <div class="flex flex-col gap-1">
                <p class="font-semibold">Foto Diri</p>
                <a href="{{ env('APP_URL') . '/' . 'storage/file/' . $data->path_photo }}" target="blank" class="bg-red-700 w-fit hover:bg-red-700 text-white px-3 py-1 text-sm rounded-md">
                    Lihat File
                </a>
            </div>
        </div>
        <div class="w-full mt-20">
            <p class=" font-[rubik] font-[600] md:text-2xl mb-8">Log Pengajuan</p>
            @if (!isset($data->requested))
                <p class="text-sm text-center">Belum ada history</p>
            @elseif(count($data->requested) === 1)
                @foreach ($data->requested as $i => $item)
                    <div class="block grid md:grid-cols-4 grid-cols-1 gap-5">
                        <div class="flex flex-row items-center gap-5">
                            <p class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-600 font-bold">{{ $i + 1 }}</p>
                            <div class="block">
                                <p class="text-sm font-bold text-yellow-600">{{ $item->status->title }}</p>
                                <p class="text-xs text-gray-500">{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center gap-5">
                            <p class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 font-bold">{{ $i + 2 }}</p>
                            <div class="block">
                                <p class="text-sm font-bold text-gray-600 uppercase">Menunggu di Review</p>
                                <p class="text-xs text-gray-500">-</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                    @foreach ($data->requested as $i => $item)
                        <div class="block flex flex-col gap-2">
                            @if ($item->status_ref === 1)
                                <div class="flex flex-row items-center gap-5">
                                    <p class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-600 font-bold">{{ $i + 1 }}</p>
                                    <div class="block">
                                        <p class="text-sm font-bold text-yellow-600">{{ $item->status->title }}</p>
                                        <p class="text-xs text-gray-500">{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-row gap-5">
                                    <p class="px-3 py-1 rounded-full h-fit bg-blue-100 text-blue-600 font-bold">{{ $i + 1 }}</p>
                                    <div class="block mt-auto flex flex-col gap-1">
                                        @switch($item->status->id)
                                            @case(5)
                                                <p class="text-sm font-bold text-green-600">{{ $item->status->title }}</p>
                                                @break
                                            @case(6)
                                                <p class="text-sm font-bold text-red-600">{{ $item->status->title }}</p>
                                                @break
                                            @default
                                                <p class="text-sm font-bold text-blue-600">{{ $item->status->title }}</p>
                                        @endswitch
                                        <p class="text-xs text-gray-500">{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
                                        @if (isset($item->doc))
                                            <a href="{{ env('APP_URL') . '/' . 'storage/file/' . $item->doc->path_document }}" target="blank" class="bg-red-700 w-fit hover:bg-red-700 text-white px-3 py-1 text-sm rounded-md">
                                                Lihat File
                                            </a>
                                        @endif
                                        <p class="text-xs">Catatan : <br> {{ $item->notes ?? '-' }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    
@endsection
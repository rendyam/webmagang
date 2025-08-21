@extends('pages.dashboard')
@section('dashboard')
    <section>
        <p class=" font-[rubik] font-[700] md:text-2xl">Riwayat Pengajuan Magang</p>
        <p class="font-[rubik] md:text-sm">Anda dapat melihat semua riwayat pengajuan magang anda dibawah ini</p>
        <div class="mt-14">
            <form method="GET" class="flex justify-end mb-3">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama..."
                    class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-sm"
                >
            </form>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                        <th class="px-4 py-3 text-center text-sm font-[rubik] uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-sm font-[rubik] uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left text-sm font-[rubik] uppercase tracking-wider">Contact</th>
                        <th class="px-4 py-3 text-center text-sm font-[rubik] uppercase tracking-wider">Instansi</th>
                        <th class="px-4 py-3 text-center text-sm font-[rubik] uppercase tracking-wider">Waktu Magang</th>
                        <th class="px-4 py-3 text-center text-sm font-[rubik] uppercase tracking-wider">Status Pengajuan</th>
                        <th class="px-4 py-3 text-center text-sm font-[rubik] uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                        @forelse ($data as $index => $item)
                            <tr class="">
                                <td class="px-4 py-4 text-center">{{$index + 1}}</td>
                                <td class="px-4 py-4">
                                    <p>{{$item->name}}</p>
                                    <span class="text-xs text-gray-500">NI : {{$item->nim}}</span>
                                </td>
                                <td class="px-4 py-4">
                                    <p>{{$item->email}}</p>
                                    <span class="text-xs text-gray-500">{{$item->phone}}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <p class="text-gray-600">{{$item->school}}</p>
                                    <p class="text-gray-500">{{isset($item->jurusan) ? $item->jurusan : ''}}</p>
                                    <p class="uppercase">{{$item->levels  === 0 ? 'SMA' : ($item->levels === 1 ? 'S1' : 'S2')}}</p>
                                </td>
                                <td class="px-4 py-4 text-center">{{Carbon\Carbon::parse($item->start_date)->format('d M Y')}} - {{Carbon\Carbon::parse($item->end_date)->format('d M Y')}}</td>
                                <td class="px-4 py-4 text-center">
                                    @switch($item->m_status_tabs_id)
                                        @case(1)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">{{ $item->status->title }}</span>
                                            @break
                                        @case(2)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">{{ $item->status->title }}</span>
                                            @break
                                        @case(3)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">{{ $item->status->title }}</span>
                                            @break
                                        @case(5)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">{{ $item->status->title }}</span>
                                            @break
                                        @default
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">{{ $item->status->title }}</span>
                                    @endswitch
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @switch($item->m_status_tabs_id)
                                        @case(1)
                                            <div class="flex gap-x-3 justify-center">
                                                <form id="form-send-{{ $item->id }}" method="POST" action="{{ route('store.sending', $item->id) }}">
                                                    @csrf
                                                    <button type="button" onclick="confirmSend('{{ $item->id }}')" class="text-green-600 hover:text-green-800 font-semibold text-sm">Kirim</button>
                                                </form>
                                                <form id="form-delete-{{ $item->id }}" method="POST" action="{{ route('store.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete('{{ $item->id }}')" class="text-red-600 hover:text-red-800 font-semibold text-sm">Hapus</button>
                                                </form>
                                                <a href="change/{{$item->id}}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Edit</a>
                                            </div>
                                            @break
                                        @case(2)
                                            <a href="show/{{$item->id}}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Detail</a>
                                            @break
                                        @case(3)
                                            <a href="show/{{$item->id}}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Detail</a>
                                            @break
                                        @case(4)
                                            <a href="show/{{$item->id}}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Detail</a>
                                            @break
                                        @case(5)
                                            <a href="show/{{$item->id}}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Detail</a>
                                            @break
                                        @case(6)
                                            <a href="show/{{$item->id}}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Detail</a>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500 font-[rubik]">Belum Ada Pengajuan Baru</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 text-sm gap-2">
                <div class="text-gray-600">
                    Menampilkan {{ $data->firstItem() ? $data->firstItem() : '0' }} {{ $data->lastItem() ? ' - ' . $data->lastItem() : '' }} dari {{ $data->total() }} data
                </div>
                <div class="overflow-x-auto">
                    <!-- Tampilkan pagination links dan bawa query search -->
                    {{ $data->appends(request()->only('search'))->links() }}
                </div>
            </div>
        </div>
    </section>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin Anda ingin menghapus?',
                text: "Tindakan ini tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-delete-' + id).submit();
                }
            });
        }

        function confirmSend(id) {
            Swal.fire({
                title: 'Mengirim Permintaan Magang',
                text: "Permintaan Anda akan dikirimkan ke SDM PT Krakatau Bandar Samudera",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#008000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Kirim!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-send-' + id).submit();
                }
            });
        }
    </script>
@endsection
@extends('pages.dashboard')
@section('dashboard')
    <section class="overflow-y-auto">
        <div class="text-center">
            <p class=" font-[rubik] font-[700] md:text-2xl">Edit Pengajuan Magang</p>
            <p class="font-[rubik] md:text-sm">Pastikan Anda melengkapi semua informasi yang ada dibawah ini</p>
        </div>
        @if (isset($msg))
            <p class="text-xs border border-red-500 bg-red-50 px-3 py-2 rounded-md text-red-600">{{$msg}}</p>
        @endif
        <form method="POST" action="{{ route('update.pengajuan',$data->id) }}" enctype="multipart/form-data" class="max-w-3xl mx-auto mt-10 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-700">*</span></label>
                <input type="text" name="name" value="{{$data->name}}" placeholder="Masukan Nama Lengkap" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk <span class="text-red-700">*</span></label>
                <input type="number" name="nim" value="{{$data->nim}}" placeholder="Nomor Induk Siswa/Mahasiswa" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-700">*</span></label>
                    <input type="email" name="email" value="{{$data->email}}" placeholder="Masukan Email Aktif" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp <span class="text-red-700">*</span></label>
                    <input type="number" name="phone" value="{{$data->phone}}" placeholder="Contoh: 08123456789" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
                    <span class="text-xs text-gray-500 italic">Kami akan menghubungi anda melalui WhatsApp</span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Universitas / Sekolah <span class="text-red-700">*</span></label>
                    <input type="text" name="school" value="{{$data->school}}" placeholder="Masukan Nama Sekolah/Universitas" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenjang <span class="text-red-700">*</span></label>
                    <select name="levels" class="w-full text-sm border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
                        <option value="{{$data->levels}}">{{$data->levels == 0 ? 'SMA' : 'S1'}}</option>
                        <option value="0">SMA</option>
                        <option value="1">S1</option>
                        <option value="2">S2</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan <span class="text-red-700">*</span></label>
                    <input type="text" name="jurusan" value="{{isset($data->jurusan) ? $data->jurusan : null}}" placeholder="Masukan Nama Jurusan" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bidang Peminatan Magang<span class="text-red-700">*</span></label>
                <input type="text" name="spesialitation" value="{{$data->spesialitation}}" placeholder="Contoh: Electrical Maintenance" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai Magang <span class="text-red-700">*</span></label>
                    <input type="date" name="start_date" value="{{$data->start_date}}" class="w-full text-sm border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai Magang <span class="text-red-700">*</span></label>
                    <input type="date" name="end_date" value="{{$data->end_date}}" class="w-full text-sm border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-sm placeholder:pl-2" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <div x-data="{ fileName: '{{ $data->path_cv ? basename($data->path_cv) : '' }}' }" class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Curriculum Vitae <span class="text-red-700">*</span></label>
                        <input
                            type="file"
                            name="path_cv"
                            accept="application/pdf"
                            class="hidden"
                            x-ref="inputFile"
                            @change="fileName = $refs.inputFile.files[0]?.name"
                            :required="!fileName"
                        >
                        <!-- Tombol Pilih File (hilang kalau fileName ada) -->
                        <button
                            type="button"
                            @click="$refs.inputFile.click()"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-sm rounded-md"
                            x-show="!fileName"
                            x-transition
                        >
                            Pilih File
                        </button>

                        <!-- Tampilkan nama file + tombol hapus -->
                        <template x-if="fileName">
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-sm text-gray-800 truncate max-w-[200px]" x-text="fileName"></span>
                                <button
                                    type="button"
                                    @click="$refs.inputFile.value = ''; fileName = null"
                                    class="text-red-600 hover:underline text-sm"
                                >
                                    Hapus
                                </button>
                            </div>
                        </template>
                        
                    </div>
                    <span class="text-xs italic text-gray-500 font-normal italic">Only support PDF, Max. 3Mb</span>
                    @if ($data->path_cv)
                        <input type="hidden" name="path_cv" value="{{ $data->path_cv }}">
                    @endif
                </div>
                <div>
                    <div x-data="{ fileName: '{{ $data->path_submission_letter ? basename($data->path_submission_letter) : '' }}' }" class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pengajuan <span class="text-red-700">*</span></label>
                        <input
                            type="file"
                            name="path_submission_letter"
                            accept="application/pdf"
                            class="hidden"
                            x-ref="inputFile"
                            @change="fileName = $refs.inputFile.files[0]?.name"
                            :required="!fileName"
                        >
                        <!-- Tombol Pilih File (hilang kalau fileName ada) -->
                        <button
                            type="button"
                            @click="$refs.inputFile.click()"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-sm rounded-md"
                            x-show="!fileName"
                            x-transition
                        >
                            Pilih File
                        </button>

                        <!-- Tampilkan nama file + tombol hapus -->
                        <template x-if="fileName">
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-sm text-gray-800 truncate max-w-[200px]" x-text="fileName"></span>
                                <button
                                    type="button"
                                    @click="$refs.inputFile.value = ''; fileName = null"
                                    class="text-red-600 hover:underline text-sm"
                                >
                                    Hapus
                                </button>
                            </div>
                        </template>
                    </div>
                    <span class="text-xs italic text-gray-500 font-normal italic">Only support PDF, Max. 3Mb</span>
                    @if ($data->path_submission_letter)
                        <input type="hidden" name="path_submission_letter" value="{{ $data->path_submission_letter }}">
                    @endif
                </div>
                <div>
                    <div x-data="{ fileName: '{{ $data->path_photo ? basename($data->path_photo) : '' }}' }" class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Diri <span class="text-red-700">*</span></label>
                        <input
                            type="file"
                            name="path_photo"
                            accept="image/*"
                            class="hidden"
                            x-ref="inputFile"
                            @change="fileName = $refs.inputFile.files[0]?.name"
                            :required="!fileName"
                        >
                        <!-- Tombol Pilih File (hilang kalau fileName ada) -->
                        <button
                            type="button"
                            @click="$refs.inputFile.click()"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-sm rounded-md"
                            x-show="!fileName"
                            x-transition
                        >
                            Pilih File
                        </button>

                        <!-- Tampilkan nama file + tombol hapus -->
                        <template x-if="fileName">
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-sm text-gray-800 truncate max-w-[200px]" x-text="fileName"></span>
                                <button
                                    type="button"
                                    @click="$refs.inputFile.value = ''; fileName = null"
                                    class="text-red-600 hover:underline text-sm"
                                >
                                    Hapus
                                </button>
                            </div>
                        </template>
                    </div>
                    <span class="text-xs italic text-gray-500 font-normal italic">Only support PNG/JPG/JPEG, Max. 3Mb</span>
                    @if ($data->path_photo)
                        <input type="hidden" name="path_photo" value="{{ $data->path_photo }}">
                    @endif
                </div>
            </div>
            <div class="mt-10">
                <button type="submit" class="w-full text-sm md:w-auto bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan Data
                </button>
            </div>
        </form>
    </section>
@endsection
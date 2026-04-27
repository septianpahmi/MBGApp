<div x-transition>
    <div class="p-4">
        <h1 class="font-bold text-gray-800 text-xl">
            Berikan Penilaian
        </h1>
    </div>
    <section id="sendfeedback" class="p-4">
        <form action="{{ route('feedbackSend', $todayMenu->slug) }}" method="POST" enctype="multipart/form-data"
            x-data="{ rating: 0, imagePreview: null }" class="space-y-2">
            @csrf

            <input type="hidden" name="menu_id" value="{{ $todayMenu->id }}">
            <input type="hidden" name="rating" :value="rating">

            <!-- CARD MENU -->
            <div class="px-2">
                <div class="bg-white border border-gray-200 p-3 rounded-lg flex items-center gap-3 shadow-sm">
                    <img src="/storage/menu/{{ $todayMenu->image }}" class="w-12 h-12 rounded-md object-cover">
                    <div>
                        <h1 class="text-sm font-bold text-gray-800">
                            {{ $todayMenu->title ?? 'Menu tidak ditemukan' }}
                        </h1>
                        <p class="text-xs text-gray-600">
                            {{ Str::limit($todayMenu->description ?? '-', 50) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- RATING -->
            <div class="px-2">
                <h1 class="text-sm font-semibold text-gray-800 mb-2">
                    Bagaimana Penilaian anda?
                </h1>

                <div class="flex gap-1">
                    <template x-for="i in 5" :key="i">
                        <svg @click="rating = i" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-10 h-10 cursor-pointer transition"
                            :class="i <= rating ? 'text-yellow-400 scale-110' : 'text-gray-300'" fill="currentColor">
                            <path
                                d="m12 17.328-5.403 3.286a.75.75 0 0 1-1.12-.813l1.456-6.155-4.796-4.123a.75.75 0 0 1 .428-1.316l6.303-.517 2.44-5.835a.75.75 0 0 1 1.384 0l2.44 5.835 6.303.517a.75.75 0 0 1 .427 1.316l-4.795 4.123 1.456 6.155a.75.75 0 0 1-1.12.813L12 17.328z" />
                        </svg>
                    </template>
                </div>
            </div>

            <!-- KOMENTAR -->
            <div class="px-2">
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Berikan Ulasan Anda
                </label>
                <textarea name="comment" rows="4"
                    class="w-full p-3 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Tulis ulasan..."></textarea>
            </div>

            <!-- UPLOAD IMAGE -->
            <div class="px-2">
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Upload Foto
                </label>

                <!-- Upload Box -->
                <div class="relative w-28 h-28">
                    <label for="image"
                        class="flex flex-col items-center justify-center w-full h-full border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">

                        <template x-if="!imagePreview">
                            <div class="flex flex-col items-center justify-center">
                                <!-- SVG tetap -->
                                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.5 5.5 0 0 0 5 5a4 4 0 0 0 0 8h2M10 15V6m0 0-2 2m2-2 2 2" />
                                </svg>
                            </div>
                        </template>

                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="w-full h-full object-cover rounded-lg">
                        </template>

                        <input id="image" type="file" name="image" class="hidden"
                            @change="
                            const file = $event.target.files[0];
                            if (file) {
                                imagePreview = URL.createObjectURL(file);
                            }
                        ">
                    </label>

                    <!-- HAPUS IMAGE -->
                    <button type="button" x-show="imagePreview"
                        @click="imagePreview = null; document.getElementById('image').value='';"
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 text-xs">
                        ✕
                    </button>
                </div>
            </div>

            <!-- BUTTON -->
            <div class="px-2 pt-2">
                <button type="submit"
                    class="w-full bg-blue-900 hover:bg-blue-700 text-white text-sm font-bold py-3 rounded-lg transition">
                    Kirim Penilaian
                </button>
            </div>
        </form>
    </section>
</div>

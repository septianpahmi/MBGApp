<div x-transition>
    <section class="flex items-center relative h-[210px] top-0">
        <img src="dist/img/bg.jpg" alt="Gambar MBG App" class="w-full object-cover">
        <div class="absolute flex flex-col p-4">
            <h1 class="text-white text-2xl font-semibold">PROFILE PANEL</h1>
            <p class="text-white text-sm">MBG App</p>
        </div>
    </section>
    <section class="relative z-10 mb-4">
        <div class="relative flex items-center top-12 mb-12">
            <div class="flex flex-col p-4">
                <h1 class="text-gray-600 text-xl font-bold">{{ Auth::user()->name }}</h1>
                <p class="text-gray-600 text-sm">
                    {{ $beneficiaries ? $beneficiaries->receiver->name : 'Kitchen not found' }}</p>
            </div>
        </div>
        <div class="bg-white py-4 px-4 relative gap-4 items-center flex z-10 border-b-2 border-gray-200">
            <button @click="page='kitchen'" :class="page === 'kitchen' ? 'text-blue-900 scale-110' : 'text-gray-600'"
                class="flex items-center transition gap-4">
                <span><svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 21H10M14 21H20M4 17.5H10M14 17.5H20M4 14H10M14 14H20M19 8.44444V5M12 7.00671L12.0074 6.99998M12 3L21 10H3L12 3Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg></span>
                <span class="text-md text-gray-600">Informasi Dapur</span>
            </button>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="bg-white py-4 px-4 relative gap-4 items-center flex z-10 border-b-2 border-gray-200">
                <button :href="route('logout')"
                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                    class="flex items-center text-gray-600 transition gap-4">
                    <span><svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 12L17 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M14.5 9L17 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M14.5 15L17 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M17 17C17 19.2091 15.2091 20 13 20H10C7.79086 20 6 18.2091 6 16V8C6 5.79086 7.79086 4 10 4H13C15.2091 4 17 4.79086 17 7"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></span>
                    <span class="text-md text-gray-600">Keluar</span>
                </button>
            </div>
        </form>
    </section>
</div>

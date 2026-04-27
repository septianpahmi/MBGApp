<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MBGApp</title>
    {{-- <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1e3a8a">
    <link rel="apple-touch-icon" href="/dist/img/logombg.png"> --}}
    <link href="dist/img/bgn.webp" rel="icon">
    <link href="dist/img/bgn.webp" rel="apple-touch-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div x-data="{ show: {{ session('success') ? 'true' : 'false' }} }" x-show="show" x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" style="display: none;">

        <!-- MODAL BOX -->
        <div @click.away="show = false"
            class="bg-white rounded-2xl p-6 w-[90%] max-w-sm text-center shadow-lg relative">

            <!-- CLOSE BUTTON -->
            <button @click="show = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl">
                ✕
            </button>

            <!-- IMAGE -->
            <img src="/dist/img/feedback.png" alt="Success" class="w-40 mx-auto mb-12">

            <!-- TEXT -->
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                Terima Kasih!
            </h2>
            <p class="text-gray-500 text-sm mb-4">
                Telah memberikan penilaian Anda.
            </p>
        </div>
    </div>
    <div x-data="app()" x-init="init()"
        class="max-w-md mx-auto bg-white min-h-screen relative overflow-hidden">
        @if (Auth::check())
            <div>
                <template x-if="page === 'home'">
                    @include('front.home')
                </template>
                <template x-if="page === 'feedback'">
                    @include('front.feedback')
                </template>
                <template x-if="page === 'profile'">
                    @include('front.profile')
                </template>
                <template x-if="page === 'kitchen'">
                    @include('front.kitchen')
                </template>
                @if ($todayMenu)
                    <template x-if="page === 'sendfeedback'">
                        @include('front.sendfeedback')
                    </template>
                @endif
            </div>
        @else
            @include('front.auth')
        @endif
        <!-- BOTTOM NAV -->
        <div
            class="fixed
                            bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t flex justify-around py-3 z-10">

            <button @click="page='home'" :class="page === 'home' ? 'text-blue-900 scale-110' : 'text-gray-400'"
                class="flex flex-col items-center transition">

                <span><svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" id="dashboard" class="icon glyph">
                        <rect x=" 2" y="2" width="9" height="11" rx="2">
                        </rect>
                        <rect x="13" y="2" width="9" height="7" rx="2"></rect>
                        <rect x="2" y="15" width="9" height="7" rx="2"></rect>
                        <rect x="13" y="11" width="9" height="11" rx="2"></rect>
                    </svg></span>
                <span class="text-xs font-semibold">Home</span>
            </button>

            <button @click="page='feedback'" :class="page === 'feedback' ? 'text-blue-900 scale-110' : 'text-gray-400'"
                class="flex flex-col items-center transition">

                <span><svg width="20px" height="20px" viewBox="0 -0.5 21 21" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd">
                            <g id="Dribbble-Light-Preview" transform="translate(-99.000000, -320.000000)"
                                fill="currentColor">
                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                    <path
                                        d="M60.556381,172.206 C60.1080307,172.639 59.9043306,173.263 60.0093306,173.875 L60.6865811,177.791 C60.8976313,179.01 59.9211306,180 58.8133798,180 C58.5214796,180 58.2201294,179.931 57.9282291,179.779 L54.3844766,177.93 C54.1072764,177.786 53.8038262,177.714 53.499326,177.714 C53.1958758,177.714 52.8924256,177.786 52.6152254,177.93 L49.0714729,179.779 C48.7795727,179.931 48.4782224,180 48.1863222,180 C47.0785715,180 46.1020708,179.01 46.3131209,177.791 L46.9903714,173.875 C47.0953715,173.263 46.8916713,172.639 46.443321,172.206 L43.575769,169.433 C42.4480682,168.342 43.0707186,166.441 44.6289197,166.216 L48.5916225,165.645 C49.211123,165.556 49.7466233,165.17 50.0227735,164.613 L51.7951748,161.051 C52.143775,160.35 52.8220755,160 53.499326,160 C54.1776265,160 54.855927,160.35 55.2045272,161.051 L56.9769285,164.613 C57.2530787,165.17 57.7885791,165.556 58.4080795,165.645 L62.3707823,166.216 C63.9289834,166.441 64.5516338,168.342 63.423933,169.433 L60.556381,172.206 Z"
                                        id="star_favorite-[#1499]">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <span class="text-xs font-semibold">Rating Saya</span>
            </button>

            <button @click="page='profile'" :class="page === 'profile' ? 'text-blue-900 scale-110' : 'text-gray-400'"
                class="flex flex-col items-center transition">

                <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12.7848 0.449982C13.8239 0.449982 14.7167 1.16546 14.9122 2.15495L14.9991 2.59495C15.3408 4.32442 17.1859 5.35722 18.9016 4.7794L19.3383 4.63233C20.3199 4.30175 21.4054 4.69358 21.9249 5.56605L22.7097 6.88386C23.2293 7.75636 23.0365 8.86366 22.2504 9.52253L21.9008 9.81555C20.5267 10.9672 20.5267 13.0328 21.9008 14.1844L22.2504 14.4774C23.0365 15.1363 23.2293 16.2436 22.7097 17.1161L21.925 18.4339C21.4054 19.3064 20.3199 19.6982 19.3382 19.3676L18.9017 19.2205C17.1859 18.6426 15.3408 19.6754 14.9991 21.405L14.9122 21.845C14.7167 22.8345 13.8239 23.55 12.7848 23.55H11.2152C10.1761 23.55 9.28331 22.8345 9.08781 21.8451L9.00082 21.4048C8.65909 19.6754 6.81395 18.6426 5.09822 19.2205L4.66179 19.3675C3.68016 19.6982 2.59465 19.3063 2.07505 18.4338L1.2903 17.1161C0.770719 16.2436 0.963446 15.1363 1.74956 14.4774L2.09922 14.1844C3.47324 13.0327 3.47324 10.9672 2.09922 9.8156L1.74956 9.52254C0.963446 8.86366 0.77072 7.75638 1.2903 6.8839L2.07508 5.56608C2.59466 4.69359 3.68014 4.30176 4.66176 4.63236L5.09831 4.77939C6.81401 5.35722 8.65909 4.32449 9.00082 2.59506L9.0878 2.15487C9.28331 1.16542 10.176 0.449982 11.2152 0.449982H12.7848ZM12 15.3C13.8225 15.3 15.3 13.8225 15.3 12C15.3 10.1774 13.8225 8.69998 12 8.69998C10.1774 8.69998 8.69997 10.1774 8.69997 12C8.69997 13.8225 10.1774 15.3 12 15.3Z"
                            fill="currentColor" />
                    </svg></span>
                <span class="text-xs">Profil</span>
            </button>
        </div>
    </div>
    <script>
        function app() {
            return {
                page: 'home',
                loading: true,

                init() {
                    setTimeout(() => {
                        this.loading = false
                    }, 1200)
                }
            }
        }
    </script>

    {{-- <script>
        function app() {
            return {
                isLoggedIn: false,
                email: '',
                password: '',
                page: 'home',
                init() {
                    // cek login dari localStorage atau API
                    this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
                },
                login() {
                    if (this.email && this.password) {
                        // validasi login sederhana
                        this.isLoggedIn = true;
                        localStorage.setItem('isLoggedIn', 'true');
                    } else {
                        alert('Email dan password harus diisi!');
                    }
                }
            }
        }
    </script> --}}
    {{-- <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(() => console.log('Service Worker registered'))
                .catch(err => console.log('SW failed', err));
        }
    </script> --}}
</body>

</html>

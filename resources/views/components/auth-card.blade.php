<div class="block lg:flex">
    <div class="flex-none bg-indigo-500">
        <div class="mx-20 flex flex-col items-center min-h-screen items-center justify-center text-white">
            <div>
                <div class="my-10 font-bold text-5xl">
                    PDAM
                </div>
                <div>
                    <p>
                        Aplikasi yang digunakan untuk<br>memudahkan dalam melakukan<br>pengelolaan pencatan dan pembayaran<br>penggunaan air PDAM daerah Kutai Kartanegara<br>Jl.Poros 1 Kec. Loa Kulu Kab. Kutai Kartanegara Kaltim
                    </p>
                </div>
            </div>
            
        </div>
    </div>
    <div class="flex-1 m-5">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="font-bold text-3xl">
                Login
            </div>
            <div class="my-5">
                Silakan Login untuk mulai menggunakan semua fitur aplikasi ini.
            </div>
            {{-- <div>
                {{ $logo }}
            </div> --}}
        
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
    
    
</div>


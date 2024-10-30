<x-app>
    <div class="w-full h-screen flex justify-center items-center">
        <div class="xl:w-[30%]  w-[50%] flex flex-col items-center">
            <h1 class="text-4xl text-orange-500 font-bold">Welcome Back</h1>
            <p class="text-slate-400">Enter your login credentials</p>

            <form action="/" method="post">
                @csrf
                <div class="mt-5 w-80 space-y-5">
                    <x-input name="email" placeholder="example@mail.com" type="email" label="email" :required='true' />

                    <x-input name="password" placeholder="**************" type="password" label="password" :required='true' />

                    <button class="w-full rounded-md bg-orange-500 p-2 text-white" type="submit">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app>

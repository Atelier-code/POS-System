<x-layout.cashier>
    <div class="w-full flex items-center justify-between p-3">
        <h1 class="text-4xl font-bold text-gray-800 ">
            Welcome, <span class="text-gray-500">{{ auth()->user()->name }}</span> 👋
        </h1>

        <a href="{{route('cashier.create.sale')}}" class="p-2 bg-black text-white text-lg rounded-md flex items-center gap-2 ">

            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                <path d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5"/>
            </svg>
           <p> Add Sale</p>
        </a>
    </div>


    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Section -->
        <aside class="w-full lg:w-1/4 space-y-6">
            <!-- Seller Card -->
                <livewire:rank-card id="{{auth()->user()->id}}" />
            <!-- Stats Section -->
            <div class="space-y-6">
                <livewire:total-revenue-card id="{{auth()->user()->id}}" />
                <livewire:total-sales-card id="{{auth()->user()->id}}" />
                <livewire:total-return-card id="{{auth()->user()->id}}" />
            </div>
        </aside>

        <!-- Main Content Section -->
        <main class="w-full lg:w-3/4 bg-white rounded-md shadow-md">
            <div class="flex flex-col gap-6">
                <!-- Revenue Chart -->
                <section class="w-full">
                    <livewire:employee-sales id="{{auth()->user()->id}}" />
                </section>
            </div>
        </main>
    </div>

    <div class="w-full p-2 mt-4 flex  max-lg:flex-col gap-4">
        <livewire:revenue-chart  id="{{auth()->user()->id}}"/>
        <livewire:top-products/>
    </div>
</x-layout.cashier>

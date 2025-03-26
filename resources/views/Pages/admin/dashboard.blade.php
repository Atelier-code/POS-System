<x-layout.admin>
    <div>

        <div class="w-full p-2 grid xl:grid-cols-4  md:grid-cols-2 grid-cols-1  gap-3">
            <livewire:total-revenue-card/>
            <livewire:total-sales-card/>
            <livewire:total-return-card/>
            <livewire:total-employee-card/>
        </div>

        <div class="w-full p-2 mt-4 flex  max-lg:flex-col gap-4">
            <livewire:top-employees/>
            <livewire:top-products/>
        </div>

        <div class="w-full p-2 mt-4 overflow-x-auto">

            <livewire:revenue-chart/>
        </div>


    </div>

</x-layout.admin>

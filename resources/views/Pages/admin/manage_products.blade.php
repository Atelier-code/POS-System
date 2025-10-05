<x-layout.admin>

    <!-- <div class="flex items-center justify-between p-2 mb-3">
        <h2 class="text-2xl font-semibold text-gray-800">Product List</h2>

    </div> -->

    <livewire:products-view/>

<div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 3000, // Closes the alert after 3 seconds (3000 ms)
                    timerProgressBar: true, // Displays a progress bar
                    showConfirmButton: false // Hides the "OK" button
                });
            });
        </script>
    @elseif(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    timer: 3000, // Closes the alert after 3 seconds (3000 ms)
                    timerProgressBar: true, // Displays a progress bar
                    showConfirmButton: false // Hides the "OK" button
                });
            });
        </script>
        @endif
        </div>
</x-layout.admin>

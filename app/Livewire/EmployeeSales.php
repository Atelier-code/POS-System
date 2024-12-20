<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeSales extends Component
{
    use WithPagination;

    public $userId;

    public function mount($id)
    {
        $this->userId = $id;
    }

    public function render()
    {
        // Fetch sales for the user, sorted by newest first and paginated to display 5 at a time
        $sales = Sale::where('user_id', $this->userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.employee-sales', [
            'sales' => $sales,
        ]);
    }
}

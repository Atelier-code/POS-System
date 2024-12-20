<?php

namespace App\Livewire;

use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class RankCard extends Component
{
    public $rank, $id;

    // Mount method to initialize the component with the user ID
    public function mount($id)
    {
        $this->id = $id;
        $this->getUserRank(); // Call the method to get the user's rank
    }

    // Method to get the user's rank based on total sales
    public function getUserRank()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Fetch top employees based on total revenue generated in the current month
        $users = User::select('users.id', 'users.name', 'users.role')
            ->join('sales', 'users.id', '=', 'sales.user_id')
            ->whereMonth('sales.created_at', $currentMonth)
            ->whereYear('sales.created_at', $currentYear)
            ->selectRaw('SUM(sales.total) as total_revenue, COUNT(sales.id) as total_sales')
            ->groupBy('users.id', 'users.name', 'users.role')
            ->orderByDesc('total_revenue')
            ->get();

        // Iterate through the users to find the rank of the specific user
        $this->rank = 0; // Default rank if user is not found
        foreach ($users as $index => $user) {
            // Compare the user_id to the current user's ID
            if ($user->id == $this->id) {
                $this->rank = $index + 1; // 1-based ranking
                break; // Exit the loop once the user is found
            }
        }

        // If the user is not found in the sales, set rank to 0 (or handle accordingly)
        if ($this->rank === 0) {
            $this->rank = 'Not ranked yet'; // Or any other handling logic
        }
    }

    // Render method to display the data in the view
    public function render()
    {
        return view('livewire.rank-card');
    }
}

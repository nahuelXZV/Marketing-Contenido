<?php

namespace App\Livewire\System\Dashboard;

use App\Constants\ProgramsTypes;
use App\Constants\StateStudent;
use App\Models\Course;
use App\Models\Program;
use App\Models\Student;
use App\Models\User;
use App\Services\System\DashboardService;
use Livewire\Component;

class Home extends Component
{
    public $breadcrumbs = [['title' => "Home", "url" => ""]];

    public function render()
    {
        return view('livewire.system.dashboard.home');
    }
}

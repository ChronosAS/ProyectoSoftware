<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public User $user;
    public $report;
    // public $showReport = false;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->report = $this->user->getFirstMedia('medical-report');
    }

    public function showReport()
    {
        return $this->report->toInlineResponse('inline');
    }

    public function acceptUser()
    {

        $this->user->update([
            'accepted' => ($this->user->accepted == 1) ? 0 : 1
        ]);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.show');
    }
}

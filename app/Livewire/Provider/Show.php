<?php

namespace App\Livewire\Provider;

use App\Models\Provider;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public Provider $provider;

    public function mount(Provider $provider)
    {
        $this->provider = $provider;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.provider.show');
    }
}

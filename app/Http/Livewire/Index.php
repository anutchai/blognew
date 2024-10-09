<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $data = User::all();
        return view('livewire.index')->with(compact('data'));
    }
}
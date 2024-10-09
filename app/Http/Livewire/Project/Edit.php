<?php

namespace App\Http\Livewire\Project;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $idd, $name, $lastname, $phone_number, $department, $email;

    public function mount($id){
        $data = User::find($id);
        $this->idd = $id;
        $this->name = $data->name;
        $this->lastname = $data->lastname;
        $this->phone_number = $data->phone_number;
        $this->department = $data->department;
        $this->email = $data->email;
    }
    public function edit(){
        User::Where("id", $this->idd)->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'phone_number' => $this->phone_number,
            'department' => $this->department,
            'email' => $this->email,
        ]);
        return redirect()->to(route('projects'));
    }
    public function render()
    {
        return view('livewire.project.edit');
    }
}

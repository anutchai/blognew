<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\withFileUploads;

class Profile extends Component
{
    use withFileUploads;
    public $name ,$lastname, $photo;

    public function UpdateProfile(){
        try{
            if ($this->photo){
                $fullpath = $this->photo->store('photo', 'public');
                $model = user::find(auth()->user()->id);
                $model->profile_photo_path = $fullpath;
                $model->save();
            }
            User::where('id', auth()->user()->id)
            ->update([
                'name' => $this->name,
                'lastname' => $this->lastname
            ]);
            session()->flash('message', 'Post successfully updated.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function mount(){
        $this->name = auth()->user()->name;
        $this->lastname = auth()->user()->lastname;
    }

    public function render()
    {
        return view('livewire.profile');
    }
}

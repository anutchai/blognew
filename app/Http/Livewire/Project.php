<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Project extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($id){
        $model = User::find($id);
        $model->deleted_by = auth()->user()->id;
        $model->save();
        $model->delete();
    }
    public function render()
    {
        $data = user::Paginate(10);
        return view('livewire.project')->with(compact('data'));
    }
}

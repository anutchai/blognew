<?php

namespace App\Http\Livewire\Project;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use withFileUploads;

    public $name, $lastname, $phone_number, $department, $email, $password, $photo;

    public function add()
    {
        $this->validate([
            'name' => 'required|min:2',
            'lastname' => 'required',
            'phone_number' => 'required|min:10|max:10',
            //'department' => 'required',
            //'email' => 'required',
            //'password' => 'required',
        ], [
            'name.required' => "กรุณากรอกชื่อ",
            'name.min' => "กรุณากรอกชื่อมากกว่า 2 ตัวอักษร",
            'lastname.required' => "กรุณากรอกนามสกุล",
            'phone_number.required' => "กรุณากรอกเบอร์โทร",
            'phone_number.min' => "กรุณากรอกเบอร์โทร 10 ตัวอักษร",
            'phone_number.max' => "กรุณากรอกเบอร์โทร 10 ตัวอักษร",
            //'department.required' => "กรุณากรอกข้อมูล",
            //'email.required' => "กรุณากรอกข้อมูล",
            //'password.required' => "กรุณากรอกข้อมูล",
        ]);

        try {
            $data = user::create([
                'name' => $this->name,
                'lastname' => $this->lastname,
                'phone_number' => $this->phone_number,
                'department' => $this->department,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'created_by' => auth()->user()->id,
            ]);

            if ($this->photo) {
                $fullpath = $this->photo->store('photo', 'public');

                $data->profile_photo_path = $fullpath;
                $data->save();
            }

            return redirect()->to(route('projects'));
        } catch (\Exception $e) {
            //dd($e);
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.project.add');
    }
}

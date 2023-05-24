<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
class Authors extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.authors',[
            'authors' => User::where('id','!=',auth()->id())->paginate(2),
        ]);
    }
}

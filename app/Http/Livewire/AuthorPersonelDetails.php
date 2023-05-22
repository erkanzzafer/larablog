<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
class AuthorPersonelDetails extends Component
{

    public $author;
    public $name, $username, $email, $biography;


    public function mount(){
        $this->author=User::find(auth('web')->id());
        $this->name=$this->author->name;
        $this->username=$this->author->username;
        $this->email=$this->author->email;
        $this->biography=$this->biography;

    }

    public function updateDetails(){
        $this->validate([
            'name' => 'required|string',
            'username'=>'required|unique:users,username,'.auth('web')->id()
        ]);

        User::where('id',auth('web')->id())->update([
            'name' => $this->name,
            'username' => $this->username,
            'biography' => $this-> biography
        ]);
        $this->emit('updateAuthorProfileHeader');
        $this->emit('updateTopHeader');

        $this->showToastr('Your profile info have been successfully updated','success');
    }

    public function showToastr($message,$type){
        return $this-> dispatchBrowserEvent('showToastr',[
            'type'     => $type,
            'message'  => $message
        ]);
    }

    public function render()
    {
        return view('livewire.author-personel-details');
    }


}

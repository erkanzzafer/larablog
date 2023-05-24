<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;



class AddAuthor extends Component
{
    public $name, $email, $username, $author_type, $direct_publisher;
    public function addAuthor(){
         $this->validate([
             'name'       => 'required',
             'email'      => 'required|email|unique:users,email',
             'username'   => 'required|unique:users,username|min:6|max:20',
             'author_type'=> 'required',
             'direct_publisher' => 'required'
         ]);



            $default_password=Random::generate(8);

            $author=new User();
            $author->name=$this->name;
            $author->email=$this->email;
            $author->username=$this->username;
            $author->password=Hash::make($default_password);
            $author->type=$this->author_type;
            $author->direct_publish=$this->direct_publisher;
            $saved=$author->save();

            $data=array(
                'name' => $this->name,
                'username'=>$this->username,
                'email'=>$this->email,
                'password'=>$default_password,
                'url'=>route('author.profile'),
            );

            $author_email=$this->email;
            $author_name=$this->name;
            if($saved){
                 //mail send
              /*  Mail::send('new-author-email-template',$data,function($message) use ($author_email,$author_name){
                    $message->from('noreply@example.com','Larablog');
                    $message->to($author_email,$author_name)
                            ->subject('Account Creation');
                });
*/
                $this->name=$this->email=$this->username=$this->author_type=$this->direct_publisher=null;
                return redirect('/author/authors');

                $this->showToastr('User has been saved successfully', 'success');

            }else{
                $this->showToastr('something went wrong','error');
            }



     }

     public function showToastr($message,$type){
        return $this->dispatchBrowserEvent('showToastr',[
            'type' =>$type,
            'message'=> $message,
        ]);
     }


    public function render()
    {
        return view('livewire.add-author');
    }
}

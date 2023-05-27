<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\Setting;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Illuminate\Support\Facades\Hash;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{

    public function test(){


        dd(Hash::make('123456'));


       }

    public function index(Request $request){
        return view('back.pages.home');
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function changeProfilePicture (Request $request){
        $user = User::find (auth('web')->id());
        $path = 'back/dist/img/authors/';
        $file = $request->file('file');
        $old_picture = $user->getAttributes() ['picture'];
        $file_path = $path. $old_picture;
        $new_picture_name = 'AIMG'.$user->id.time().rand (1,100000).'.jpg';
        if($old_picture != null && File::exists(public_path($file_path))){
        File::delete (public_path($file_path));
        }
        $upload = $file->move (public_path($path), $new_picture_name);
        if($upload) {
        $user->update([
        'picture'=>$new_picture_name
        ]);
            return response()->json(['status'=>1, 'msg'=>'Your profile picture has been successfully updated.']);
            }else{
            return response ()->json (['status' => 0, 'Something went wrong']);
            }
        }



        public function changeBlogLogo (Request $request){
                $settings=Setting::find(1);
                $logo_path='back/dist/img/logo-favicon';
                $old_logo=$settings->getAttributes()['blog_logo'];
                $file=$request->file('blog_logo');
                $filename=time().'_'.rand(1,100000).'_larablog_logo.png';

                 if($request->hasFile('blog_logo')){
                    if ($old_logo != null && File::exists(public_path($logo_path.$old_logo))){
                        File::delete(public_path($logo_path.$old_logo));
                    }

                    $upload=$file->move(public_path($logo_path),$filename);
                    if ($upload){
                        $settings->update([
                            'blog_logo'=>$filename
                        ]);
                        return response()->json(['status'=> 1, 'msg'=>'logo has been successfully updated']);
                    }else{
                        return response()->json(['status'=>0,'msg'=>'something went wrong']);
                    }
                 }
        }

        public function changeBlogFavicon (Request $request){
            $settings=Setting::find(1);
            $favicon_path='back/dist/img/logo-favicon';
            $old_favicon=$settings->getAttributes()['blog_favicon'];
            $file=$request->file('blog_favicon');
            $filename=time().'_'.rand(1,2000).'_larablog_favicon.co';


                if ($old_favicon != null && File::exists(public_path($favicon_path.$old_favicon))){
                    File::delete(public_path($favicon_path.$old_favicon));
                }

                $upload=$file->move(public_path($favicon_path),$filename);
                if ($upload){
                    $settings->update([
                        'blog_favicon'=>$filename
                    ]);
                    return response()->json(['status'=> 1, 'msg'=>'favicon has been successfully updated']);
                }else{
                    return response()->json(['status'=>0,'msg'=>'something went wrong']);
                }
    }

                public function editAuthor ($id){
                    $user = User::findOrFail($id);
                    return view('back.pages.edit_Author', compact('user'));
                }

                public function updateAuthor(Request $request,$id){
                    $user=User::find($id);
                    $user->name=$request->input('name');
                    $user->email=$request->input('email');
                    $user->username=$request->input('username');
                    $user->type=$request->input('author_type');
                    $user->direct_publish=$request->input('direct_publish');
                    $user->update();
                    return redirect('author/authors');
                }

                function deleteAuthor($id){
                    $user = User::findOrFail($id);
                    $user->delete();
                    return redirect()->route('author.authors')->with('success', 'User silindi');
                }

                function createPost(Request $request){

                  dd('1asd');
                }

                function createPost2(Request $request){
                    $request->validate([
                        'sayfa_baslik'=>'required',
                        'sayfa_icerik'=>'required',
                        'sayfa_kategori'=>'required',
                        'sayfa_gorsel' => 'required',
                        'seo_baslik' => 'required',
                        'seo_etiket' => 'required',
                        'seo_icerik' => 'required'

                    ]);

                    if ($request->hasFile('sayfa_gorsel')){
                        $path='back/images/post_images/';
                        $file=$request->file('sayfa_gorsel');
                        $filename=$file->getClientOriginalName();
                        $new_filename=time().'_'.$filename;
                          //$filename=time().'_'.rand(1,2000).'_larablog_favicon.co';
                      //  $upload = Storage::disk('public')-> put($new_filename,(string)file_get_contents($file));
                        $upload=$file->move(public_path($path),$new_filename);
                        if($upload){
                            $post= new Post();
                            $post->author_id=auth()->id();
                            $post->category_id=$request->sayfa_kategori;
                            $post->post_title=$request->sayfa_baslik;
                            $post->post_slug=Str::slug($request->sayfa_baslik);
                            $post->post_content=$request->sayfa_icerik;
                            $post->seo_baslik=$request->seo_baslik;
                            $post->seo_etiket=$request->seo_etiket;
                            $post->seo_icerik=$request->seo_icerik;
                            $post->sayfa_gorsel=$new_filename;
                            $saved=$post->save();
                            if($saved){
                                return response()->json(['code'=>1,'msg'=>'Ürün başarıyla eklendi']);
                            }else{
                                return response()->json(['code'=>3,'msg'=>'Bir hata oluştu']);
                            }
                        }else{
                            return response()->json(['code' =>3, 'msg' =>'Görsel Yüklenirken hata oluştu.']);
                        }
                    }


                }
}

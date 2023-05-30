<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Subcategory;


Route::prefix('author')->name('author.')->group(function(){

    Route::middleware(['guest:web'])->group(function(){
        Route::view('/login','back/pages/auth/login')->name('login');
        Route::view('/forgot-password','back.pages.auth.forgot')->name('forgot-password');
        Route::get('/password/reset/{token}',[AuthorController::class,'ResetForm'])->name('reset-form');
    });

    Route::middleware(['auth:web'])->group(function(){
        Route::get('/home', [AuthorController::class,'index' ])->name('home');
        Route::post('/logout',[AuthorController::class,'logout'])->name('logout');
        Route::view('/profile','back.pages.profile')->name('profile');
        Route::post('/change-profile-picture',[AuthorController::class,'changeProfilePicture'])->name('change-profile-picture');
        Route::view('/settings',[AuthorController::class,'back.pages.settings'])->name('settings');
        Route::post('/change-blog-logo',[AuthorController::class,'changeBlogLogo'])->name('change-blog-logo');
        Route::post('/change-blog-favicon',[AuthorController::class,'changeBlogFavicon'])->name('change-blog-favicon');
        Route::view('/authors','back.pages.authors')->name('authors');
        Route::view('/addAuthor','back.pages.add_author')->name('addAuthor');
        Route::get('/editAuthor/{id}',[AuthorController::class,'editAuthor'])->name('editAuthor');
        Route::put('/updateAuthor/{id}',[AuthorController::class,'updateAuthor'])->name('updateAuthor');
        Route::delete('/deleteAuthor/{id}', [AuthorController::class,'deleteAuthor'])->name('deleteAuthor');
        Route::view('/categories','back.pages.categories')->name('categories');
        Route::view('/subcategories','back.pages.subcategories')->name('subcategories');
        Route::view('/addsubcategory','back.pages.add_subcategory')->name('addsubcategory');
        Route::post('/addsubcategories',[SubCategory::class,'addSubcategory']);
        Route::get('/editsubcategories/{id}',[SubCategory::class,'editSubcategory'])->name('editsubcategories');
        Route::put('/updatesubcategories/{id}',[SubCategory::class,'updateSubcategory'])->name('updatesubcategories');



        Route::prefix('posts')->name('posts.')->group(function(){
            Route::view('/add-post','back.pages.add-post')->name('add-post');
            Route::post('/create',[AuthorController::class,'createPost'])->name('createPost');
            Route::post('/create',[AuthorController::class,'createPost2'])->name('createPost2');
            Route::view('/all','back.pages.all-posts')->name('all-posts');
            Route::get('/edit-post',[AuthorController::class,'editPost'])->name('editPost');
            Route::post('/update-post',[AuthorController::class,'updatePost'])->name('updatePost');
        });


    });
});

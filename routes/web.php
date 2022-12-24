<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Country;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;
use Symfony\Component\ErrorHandler\Debug;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// one to one relationship

Route::get('user/{id}', function ($id) {
    $user = User::findOrFail($id);
    if (isset($user->profile)) {
        dd($user->profile->mobile);
    } else {
        $user->profile()->updateOrCreate(['user_id' => $user->id, 'mobile' => '01095425446']);
    }
});

Route::get('profile/{id}', function ($id) {
    $profile = Profile::findOrFail($id);
    dd($profile->user);
});

Route::get('users', function () {
    $users = User::with('profile')->get();
    foreach ($users as $user) {
        Debugbar::info($user->profile);
    }
    return view('welcome');
});



// one to many relationship
Route::get('user/{id}/posts', function ($id) {
    $user = User::findOrFail($id);
    foreach ($user->posts as $post) {
        Debugbar::info($post->title);
    }
    return view('welcome');
});

//get all users who has posts
Route::get('usersWhoHasPosts', function () {
    // $users = User::whereHas('posts')->get();
    $users = User::Has('posts')->get();
    return $users;
});

Route::get('usersWhoHasPostsWithCondition', function () {
    $users = User::whereHas('posts',function($query){
        // $query->whereIn('id',[1,2]);
        $query->where('id',1);

    })->get();
    return $users;
});


Route::get('usersWhoHasPostsAndPhotos', function () {
    $users = User::has('posts')->orHas('photos')->get();
    return $users;
});


//get all users who dont has posts
Route::get('usersWhoDontHasPosts', function () {
    $users = User::doesntHave('posts')->get();
    return $users;
});

Route::get('post/{id}', function ($id) {
    $post = Post::findOrFail($id);
    Debugbar::info($post->user);
    return view('welcome');
});

// many to many relationship
// Route::get('posts/categories',function(){
//     $posts = Post::all();
//     foreach($posts as $post){
//         Debugbar::info($post->categories);
//     }  
//     return view('welcome');
// });

// many to many relationship
Route::get('posts/categories', function () {
    // with() in relatiohs -> Fewer queries ->"eager loading"
    $posts = Post::with('categories')->get();
    foreach ($posts as $post) {
        Debugbar::info($post->categories);
    }
    return view('welcome');
});

Route::get('categories/posts', function () {
    // with() in relatiohs -> Fewer queries ->"eager loading"
    $categories = Category::with('posts')->get();
    foreach ($categories as $categorie) {
        $categorie->posts()->sync([1, 3]);
        // $categorie->posts()->attach([1,3]);
        // $categorie->posts()->detach([1,3]);


        Debugbar::info($categorie->posts);
    }
    return view('welcome');
});

//morph relation one to many (post -> photos)
Route::get('post/{id}/photos', function ($id) {
    $post = Post::findOrFail($id);
    Debugbar::info($post->photos);
    return view('welcome');
});


Route::get('user/{id}/photos', function ($id) {
    $user = User::findOrFail($id);
    Debugbar::info($user->photos);
    return view('welcome');
});


Route::get('addUser/{id}/photos', function ($id) {
    $user = User::findOrFail($id);
    Debugbar::info($user->photos()->create([
        'src' => 'src/user',
        'type' => 'cover'
    ]));
    return view('welcome');
});


Route::get('user/{id}/cover', function ($id) {
    $user = User::findOrFail($id);
    Debugbar::info($user->cover);
    return view('welcome');
});


//HasManyThrogh relation country->(posts-user)

Route::get('country/{id}/posts', function ($id) {
    $country = Country::findOrFail($id);
    Debugbar::info($country->posts);
    return view('welcome');
});


Route::get('country/{id}/addPosts', function ($id) {
    $country = Country::findOrFail($id);
    $country->posts()->create([
        'title' => "hhhhhh",
        'content' => "hhhhhhhhhhhhhhhhhh",
        'user_id' => 1
    ]);
    return $country->posts;
});

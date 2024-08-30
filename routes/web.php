<?php

use App\Events\MyEvent;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Jobs\SendMail;
use App\Mail\PostPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Broadcaster;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


# POST 
Route::group(["middleware" => "auth"], function () {
    Route::get("posts", [PostController::class, "index"])->name("posts.index");
    Route::get("posts-create", [PostController::class, "create"])->name("posts.create");
    Route::get("posts-trash", [PostController::class, "trash"])->name("posts.trash");
    Route::get("posts-show/{post}", [PostController::class, "show"])->name("posts.show");
    Route::get("posts-edit/{post}", [PostController::class, "edit"])->name("posts.edit");
    Route::put("posts-update", [PostController::class, "update"])->name("posts.update");
    Route::delete("posts-destroy/{id}", [PostController::class, "destroy"])->name("posts.destroy");
});

Route::get("send-mail", function () {
    // Mail::send(new PostPublished());
    SendMail::dispatch();

    dd("Mail has been sent");
});

Route::view("upload", "upload");

Route::post("upload-image", function (Request $request) {

    // dd(Storage::disk()); 
    // $filename = $request->file("image")->getClientOriginalName();

    // $file =  Storage::disk("spaces")->put("uploads/".$filename, $request->file("image"));

    // dd($file);

    // $file_name = time().'_'.$request->file('image')->getClientOriginalName();
    // $file_path = $request->file('image')->storeAs('image', $file_name, "spaces");


    $imagePath = $request->file('image')->store('images', 'spaces');
    // dd($file_path);
   
    return back();
});

# broadcast
Route::get("broadcast-event", function () {
    return view("broadcast-event");
});

Route::post("broadcast-event", function (Request $request) {

    $message = $request->message;

    event(new MyEvent($message));

    return back();

})->name("broadcast.event");

Route::get("broadcast-listener", function () {
    return view("broadcast-listener");
});

Route::get("localization/{local?}", function ($locale = "en") {

    App::setLocale($locale);
    return view("localization", ["name" => "test"]);
});
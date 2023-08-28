<?php
use App\Models\SubCategory;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostCountController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Backend\BackEndController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;

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
Route::get('pdf', [PDFController::class, 'index']);  


Route::group(['middleware' => 'lang'], static function () {
    Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
    Route::get('/all-post', [FrontendController::class, 'all_post'])->name('frontend.all-post');
    Route::get('/search', [FrontendController::class, 'search'])->name('frontend.search');
    Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('frontend.category');
    Route::get('/category/{cat_slug}/{sub_cat_slug}', [FrontendController::class, 'Sub_category'])->name('frontend.sub-category');
    Route::get('/tag/{slug}', [FrontendController::class, 'tag'])->name('frontend.tag');
    Route::get('/single-post/{slug}', [FrontendController::class, 'single'])->name('frontend.single');
    Route::get('contact-us', [FrontendController::class, 'contact_us'])->name('frontend.contact');
    Route::post('contact-us', [ContactController::class, 'store'])->name('contact.store');
    
    Route::get('get-districts/{division_id}', [ProfileController::class, 'getDistrict']);
    Route::get('get-thanas/{district_id}', [ProfileController::class, 'getThana']);
    Route::get('post-count/{post_id}', [FrontendController::class, 'postReadCount']);
   
    
    
 
    
    //Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix'=>'dashboard', 'middleware' => 'auth'], function(){
             
            Route::resource('post', PostController::class);
            Route::resource('comment', CommentController::class);
            Route::resource('profile', ProfileController::class);
            Route::get('/', [BackEndController::class, 'index'])->name('backend.index');
            Route::post('upload-photo', [ProfileController::class, 'upload_photo']);
            Route::get('get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);
    
    
            Route::group(['middleware' => 'admin'], static function () {
                Route::resource('category', CategoryController::class);       
                Route::resource('sub-category', SubCategoryController::class);
                Route::resource('tag', TagController::class);
                Route::resource('users', UsersController::class);
                Route::resource('roles', RoleController::class);
                Route::resource('permission', PermissionController::class);
                


                Route::get('/post/{id}/approve', [PostController::class, 'approval'])->name('post.approve');
                Route::get('pending_post', [PostController::class, 'pending'])->name('post.pending');
                
              });
    
           
            
           
           
            });    
            
       
      //  });
    
    require __DIR__.'/auth.php';
});


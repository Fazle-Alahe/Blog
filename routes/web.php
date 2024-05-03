<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewerController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, 'index'])->name('index');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Authintication
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login/post', [HomeController::class, 'login_post'])->name('login.post');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

//logo
Route::middleware('auth')->group(function () {
    Route::get('/logo', [HomeController::class, 'logo'])->name('logo');
    Route::post('/update/logo', [HomeController::class, 'update_logo'])->name('update.logo');
    Route::post('/icon/update', [HomeController::class, 'icon_update'])->name('icon.update');
});


// About us
Route::middleware('auth')->group(function () {
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::post('/update/about', [HomeController::class, 'update_about'])->name('update.about');
});


// users
Route::middleware('auth')->group(function () {
    Route::get('/user/list',[UserController::class, 'user_list'])->name('user.list');
    Route::post('/user/add',[UserController::class, 'user_add'])->name('user.add');
    Route::get('/user/edit/{id}',[UserController::class, 'user_edit'])->name('user.edit');
    Route::post('/edit/user/{id}',[UserController::class, 'edit_user'])->name('edit.user');
    Route::post('/update/user/pass{id}',[UserController::class, 'update_user_pass'])->name('update.user.pass');
    Route::get('/user/profile',[UserController::class, 'user_profile'])->name('user.profile');
    Route::post('/profile/update',[UserController::class, 'profile_update'])->name('profile.update');
    Route::post('/profile/pass/update',[UserController::class, 'profile_pass_update'])->name('profile.pass.update');
    Route::get('/user/soft/delete/{id}',[UserController::class, 'user_soft_delete'])->name('user.soft.delete');
    Route::get('/trash/user',[UserController::class, 'trash_user'])->name('trash.user');
    Route::get('/restore/user/{id}',[UserController::class, 'restore_user'])->name('restore.user');
    Route::get('/user/permanent/delete/{id}',[UserController::class, 'user_permanent_delete'])->name('user.permanent.delete');
    Route::get('/user/status/{id}',[UserController::class, 'user_status'])->name('user.status');
    Route::post('/blogger/about',[UserController::class, 'blogger_about'])->name('blogger.about');

    Route::post('/user/select/soft_delete', [UserController::class, 'user_select_soft_delete'])->name('user.select.soft_delete');
    ///////restore & permanent delete
    Route::post('/user/select/restore', [UserController::class, 'user_select_restore'])->name('user.select.restore');
});




// category
Route::middleware('auth')->group(function () {
    Route::get('/category', [CategoryController::class, 'category'])->name('category');
    Route::post('/add/category', [CategoryController::class, 'add_category'])->name('add.category');
    Route::get('/edit/category/{id}', [CategoryController::class, 'edit_category'])->name('edit.category');
    Route::post('/update/category/{id}', [CategoryController::class, 'update_category'])->name('update.category');
    Route::get('/category/soft/delete/{id}', [CategoryController::class, 'category_soft_delete'])->name('category.soft.delete');
    Route::get('/trash/category',[CategoryController::class, 'trash_category'])->name('trash.category');
    Route::get('/restore/category/{id}',[CategoryController::class, 'restore_category'])->name('restore.category');
    Route::get('/category/permanent/delete/{id}',[CategoryController::class, 'category_permanent_delete'])->name('category.permanent.delete');
    Route::get('/category/status/{id}',[CategoryController::class, 'category_status'])->name('category.status');
    
    Route::post('/cat/select/soft_delete', [CategoryController::class, 'cat_select_soft_delete'])->name('cat.select.soft_delete');
    ///////restore & permanent delete
    Route::post('/cat/select/restore', [CategoryController::class, 'cat_select_restore'])->name('cat.select.restore');
});



// subscriber
Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');

Route::middleware('auth')->group(function () {
    Route::get('/subscriber/list', [SubscriberController::class, 'subscriber_list'])->name('subscriber.list');
    Route::get('/subscriber/delete/{id}', [SubscriberController::class, 'subscriber_delete'])->name('subscriber.delete');
    Route::post('/selected/subscriber/delete', [SubscriberController::class, 'selected_subscriber_delete'])->name('selected.subscriber.delete');
});



// Frontend contact
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/message', [FrontendController::class, 'message'])->name('message');

// Dashboard message
Route::get('/show/message', [FrontendController::class, 'show_message'])->name('show.message');
Route::get('/message/delete/{id}', [FrontendController::class, 'message_delete'])->name('message.delete');
Route::post('/select/msg/delete', [FrontendController::class, 'select_msg_delete'])->name('select.msg.delete');
Route::get('/view/message/{id}', [FrontendController::class, 'view_message'])->name('view.message');

Route::get('/about/site', [FrontendController::class, 'about_site'])->name('about.site');

// Tag
Route::middleware('auth')->group(function () {
    Route::get('/tag',[TagController::class, 'tag'])->name('tag');
    Route::post('/store/tag',[TagController::class, 'store_tag'])->name('store.tag');
    Route::get('/tag/soft/delete/{id}',[TagController::class, 'tag_soft_delete'])->name('tag.soft.delete');
    Route::post('/tag/delect/soft/delete',[TagController::class, 'tag_select_soft_delete'])->name('tag.select.soft_delete');
    Route::get('/trash/tag',[TagController::class, 'trash_tag'])->name('trash.tag');
    Route::get('/restore/tag/{id}',[TagController::class, 'restore_tag'])->name('restore.tag');
    Route::get('/tag/permanent/delete/{id}',[TagController::class, 'tag_permanent_delete'])->name('tag.permanent.delete');
    Route::post('/tag/select/restore',[TagController::class, 'tag_select_restore'])->name('tag.select.restore');
});


// blog
Route::middleware('auth')->group(function () {
    Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
    Route::post('/post/blog', [BlogController::class, 'post_blog'])->name('post.blog');
    Route::get('/all/blog', [BlogController::class, 'all_blog'])->name('all.blog');
    Route::get('/blog/status/{id}', [BlogController::class, 'blog_status'])->name('blog.status');
    Route::get('/blog/soft/delete/{id}', [BlogController::class, 'blog_soft_delete'])->name('blog.soft.delete');
    Route::get('/edit/blog/{id}', [BlogController::class, 'edit_blog'])->name('edit.blog');
    Route::post('/post/edit/blog/{id}', [BlogController::class, 'post_edit_blog'])->name('post.edit.blog');
    Route::get('/trash/blog', [BlogController::class, 'trash_blog'])->name('trash.blog');
    Route::get('/restore/blog/{id}', [BlogController::class, 'restore_blog'])->name('restore.blog');
    Route::get('/blog/permanent/delete/{id}', [BlogController::class, 'blog_permanent_delete'])->name('blog.permanent.delete');
    
    Route::get('/blog/view/{id}', [BlogController::class, 'blog_view'])->name('blog.view');
    
    Route::post('/select/blog/soft_delete', [BlogController::class, 'select_blog_soft_delete'])->name('select.blog.soft_delete');
    Route::post('/blog/select/restore', [BlogController::class, 'blog_select_restore'])->name('blog.select.restore');
});



// frontend blog
Route::get('/single/blog/{slug}', [BlogController::class, 'single_blog'])->name('single.blog');
Route::get('/all/blogs', [BlogController::class, 'all_blogs'])->name('all.blogs');
Route::get('/category/blogs/{id}', [BlogController::class, 'category_blogs'])->name('category.blogs');

//blogger
Route::get('/blogger',[BloggerController::class, 'blogger'])->name('blogger');
Route::get('/single/blogger/{id}',[BloggerController::class, 'single_blogger'])->name('single.blogger');

// Advertise
Route::middleware('auth')->group(function () {
    Route::get('/advertise',[AdsController::class, 'advertise'])->name('advertise');
    Route::post('/update/ads',[AdsController::class, 'update_ads'])->name('update.ads');
});


// Viewer
Route::get('/registration',[ViewerController::class, 'registration'])->name('registration');
Route::post('/viewer/store',[ViewerController::class, 'viewer_store'])->name('viewer.store');
Route::get('/login/viewer',[ViewerController::class, 'login_viewer'])->name('login.viewer');
Route::post('/loggged/viewer',[ViewerController::class, 'loggged_viewer'])->name('loggged.viewer');
Route::get('/viewer/profile/{id}',[ViewerController::class, 'viewer_profile'])->name('viewer.profile');
Route::post('/viewer/update/{id}',[ViewerController::class, 'viewer_update'])->name('viewer.update');
Route::get('/viewer/logout',[ViewerController::class, 'viewer_logout'])->name('viewer.logout');

// Role manage

Route::middleware('auth')->group(function () {
    Route::get('/role/manage', [RoleController::class, 'role_manage'])->name('role.manage');
    Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
    Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
    Route::get('/delete/role/{id}', [RoleController::class, 'delete_role'])->name('delete.role');
    Route::get('/edit/role/{id}', [RoleController::class, 'edit_role'])->name('edit.role');
    Route::post('/update/role/{id}', [RoleController::class, 'update_role'])->name('update.role');
    Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
    Route::get('/remove/role/{id}', [RoleController::class, 'remove_role'])->name('remove.role');
});


// Comments
Route::post('/store/comment/{id}', [CommentController::class, 'store_comment'])->name('store.comment');

// Reply
Route::post('/store/reply/{id}', [ReplyController::class, 'store_reply'])->name('store.reply');
Route::post('/store/child/reply/{id}', [ReplyController::class, 'store_child_reply'])->name('store.child.reply');

Route::middleware('auth')->group(function () {
    Route::get('/reply/view/{id}', [ReplyController::class, 'reply_view'])->name('reply.view');

    Route::get('/comment/view/{id}', [CommentController::class, 'comment_view'])->name('comment.view');


    // Notification
    Route::get('/notification', [ReplyController::class, 'notification'])->name('notification');
});
<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ApplicationController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {

//     return view('student');
// });
// Route::get('/', function () {

//     return view('auth.login');
// });
Route::get('/login-pannel', function () {

    return view('auth.login');
});
Route::get('/testMail', function () {

    return view('mail.mail');
});

Route::post('login', [LoginController::class, 'login'])->name('login');
route::get('/',[HomePageController::class, 'index']);

Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('status/change', [App\Http\Controllers\HomeController::class, 'changeStatus'])->name('changeStatus');


Auth::routes(['register' => false, 'password.request' => false, 'password.reset' => false]);


Route::middleware('cookies')->group(function () {

Route::resource('/user-management', UserController::class);
Route::get('/getUsers', [UserController::class, 'getUsers'])->name('getUsers');
Route::get('/user-management/delete/{id}', [UserController::class, 'destroy'])->name('delete-user');
Route::post('/user-management/edit/{id}', [UserController::class, 'update'])->name('update-user');
Route::get('/user-management/{id}/restore', [UserController::class, 'userRestore'])->name('restore-user');

Route::get('/user-management/{id}/restore', [UserController::class, 'userRestore'])->name('restore-user');

Route::get('/user-management/{id}/handover', [UserController::class, 'userHandoverDetails'])->name('handover-user');
Route::get('/user-management/{id}/changepassword', [UserController::class, 'userChangePassword'])->name('changepassword-user');

Route::post('/change-password', [UserController::class, 'updatePassword'])->name('update-password');


Route::get('/updateKey', [App\Http\Controllers\UserController::class, 'updateKey'])->name('updateKey');


Route::get('/userimport', [UserController::class, 'userImport'])->name('user.import');
Route::post('/userimport', [UserController::class, 'userImportStore'])->name('user.importStore');





Route::resource('/roles', RoleController::class);
Route::get('/getRoles', [RoleController::class, 'getRoles'])->name('getRoles');
Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('delete-role');
Route::post('/roles/edit/{id}', [RoleController::class, 'update'])->name('update-role');

Route::get('/roles/{id}/editPermission', [RoleController::class, 'editPermission'])->name('edit-rolePermission');
Route::post('/roles/addPermission/{id}', [RoleController::class, 'addPermission'])->name('roles.permission.store');


Route::resource('/permissions', PermissionController::class);
Route::get('/getPermissions', [PermissionController::class, 'getPermissions'])->name('getPermissions');
Route::get('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('delete-permission');
Route::post('/permissions/edit/{id}', [PermissionController::class, 'update'])->name('update-permission');

Route::get('admin/profile','App\Http\Controllers\ProfileController@index')->name('profile.manage');
Route::post('admin/profile/update/','App\Http\Controllers\ProfileController@update')->name('profile.update');

Route::get('student/profile', [App\Http\Controllers\HomeController::class, 'profileMange'])->name('student.profile.manage');

});







Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class,'forgotPassword']);
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class,'forgotPasswordPost']);
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class,'restPassword'])->name('reset.password');
Route::post('/set-new-password', [App\Http\Controllers\Auth\ForgotPasswordController::class,'setNewPassword']);
Route::get('refresh_captcha', [App\Http\Controllers\Auth\ForgotPasswordController::class,'refreshCaptcha'])->name('refresh_captcha');
// admin password edit route starts here
route::get('/admin/profie/password-edit-page',[ProfileController::class, 'editPassword'])->name("profile.password.edit");
route::post('/admin/profie/password-edit-page',[ProfileController::class, 'editPasswordPost'])->name("profile.password.edit.post");
// admin password edit route ends here



// route::get('/applications/ration-card-form',[ApplicationController::class, 'applicationForm']);
// route::post('/applications/ration-card-form',[ApplicationController::class, 'applicationFormPost']);

Route::resource('/applications/application-form', ApplicationController::class);
Route::get('/survey', [ApplicationController::class, 'survey'])->name("survey");
Route::get('/getApplications', [ApplicationController::class, 'getApplications'])->name('getApplications');
Route::get('/application-list', [ApplicationController::class, 'applicationLIst'])->name("application-list");
route::any('/add',[ApplicationController::class, 'add'])->name("add");
Route::get('/survey-home', [ApplicationController::class, 'surveyHome'])->name("survey-home");

Route::get('/applications/ration-aadhaar-form', [ApplicationController::class, 'rationCard'])->name("rationCard");
Route::get('/applications/aadhaar-form', [ApplicationController::class, 'aadhaar'])->name("aadhaar");
Route::get('/applications/no-documents-form', [ApplicationController::class, 'noDocuments'])->name("noDocuments");
route::any('/district',[ApplicationController::class, 'district'])->name("district");
Route::get('/location', [ApplicationController::class, 'getLocations'])->name("location");

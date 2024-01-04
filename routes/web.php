<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\General\DepartmentController;
use App\Http\Controllers\Asset\AssetController;
use App\Http\Controllers\Maintenance\TaskController;
use App\Http\Controllers\Maintenance\WorkorderController;
use App\Http\Controllers\Maintenance\SignageController;
use App\Http\Controllers\Hris\EmployeeController;
use App\Http\Controllers\Hris\Detail\EducationController;
use App\Http\Controllers\Hris\Detail\ContractController;
use App\Http\Controllers\Hris\Detail\ExperienceController;
use App\Http\Controllers\Hris\Detail\FamilyController;
use App\Http\Controllers\Hris\Detail\SicknessController;
use App\Http\Controllers\Hris\Detail\InventoryController;
use App\Http\Controllers\Hris\Detail\RewpunController;
use App\Http\Controllers\Hris\Detail\TrainingController;
use App\Http\Controllers\Hris\Attendance\LeaveController;


// Auth::routes(['register' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(SignageController::class)->middleware('auth')->group(function () {
    Route::get('signage', 'index')->name('signage.index');
    Route::post('signage/store', 'store')->name('signage-store');
    Route::get('signage/pu', 'power')->name('power');
    Route::get('signage/gu', 'gear')->name('gear');
    Route::get('signage/lu', 'light')->name('light');
    Route::get('signage/lobby', 'lobby')->name('lobby');
});

Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('user', 'index')->name('user.index');
    Route::post('user', 'store')->name('user.store');
    Route::get('user/create', 'create')->name('user.create');
    Route::get('user/show/{id}', 'show')->name('user.show');
    Route::put('user/update/{id}', 'update')->name('user.update');
    Route::get('user/delete/{id}', 'destroy')->name('user.destroy');
    Route::get('user/restore/{id}', 'restore')->name('user.restore');
    Route::get('user/{id}/edit', 'edit')->name('user.edit');

    Route::post('role/store', 'rolestr')->name('role.store');
});

Route::controller(EmployeeController::class)->middleware('auth')->group(function () {
    Route::get('/form/{token}', 'showForm')->name('form');
    Route::post('/form/{token}', 'submitForm')->name('submit-form');

    Route::get('employee', 'index')->name('employee.index');
    Route::post('employee', 'store')->name('employee.store');
    Route::get('employee/create', 'create')->name('employee.create');
    Route::get('employee/detail/{id}', 'show')->name('employee.show');
    Route::put('employee/update/{id}', 'update')->name('employee.update');
    Route::get('employee/delete/{id}', 'destroy')->name('employee.destroy');
    Route::get('employee/restore/{id}', 'restore')->name('employee.restore');
    Route::get('employee/{id}/edit', 'edit')->name('employee.edit');

    Route::get('document', 'document')->name('document.index');
    Route::post('document/store', 'documentstr')->name('document.store');

    Route::get('training', 'training')->name('training.index');
    Route::post('training/store', 'trainingstr')->name('training.store');

    Route::get('leave', 'leave')->name('leave.index');
    Route::post('leave/store', 'leavestr')->name('leave.store');

    Route::get('role', 'role')->name('role.index');
    Route::post('role/store', 'rolestr')->name('role.store');
});

Route::controller(EducationController::class)->middleware('auth')->group(function () {
    Route::get('education', 'index')->name('education.index');
    Route::post('education/store', 'store')->name('education.store');
});

Route::controller(ContractController::class)->middleware('auth')->group(function () {
    Route::get('agreement', 'index')->name('agreement.index');
    Route::post('agreement/store', 'store')->name('agreement.store');
});

Route::controller(ExperienceController::class)->middleware('auth')->group(function () {
    Route::get('experience', 'index')->name('experience.index');
    Route::post('experience/store', 'store')->name('experience.store');
});

Route::controller(FamilyController::class)->middleware('auth')->group(function () {
    Route::get('family', 'index')->name('family.index');
    Route::post('family/store', 'store')->name('family.store');
});

Route::controller(SicknessController::class)->middleware('auth')->group(function () {
    Route::get('sickness', 'index')->name('sickness.index');
    Route::post('sickness/store', 'store')->name('sickness.store');
});

Route::controller(InventoryController::class)->middleware('auth')->group(function () {
    Route::get('inventory', 'index')->name('inventory.index');
    Route::post('inventory/store', 'store')->name('inventory.store');
});

Route::controller(RewpunController::class)->middleware('auth')->group(function () {
    Route::get('rewpun', 'index')->name('rewpun.index');
    Route::post('rewpun/store', 'store')->name('rewpun.store');
});

Route::controller(TrainingController::class)->middleware('auth')->group(function () {
    Route::get('training', 'index')->name('training.index');
    Route::post('training/store', 'store')->name('training.store');
});

Route::controller(LeaveController::class)->middleware('auth')->group(function () {
    Route::get('leave', 'index')->name('leave.index');
    Route::post('leave/store', 'store')->name('leave.store');
});

Route::controller(TaskController::class)->middleware('auth')->group(function () {
    Route::get('task', 'index')->name('task.index');
    Route::post('task/store', 'store')->name('task.store');
    Route::get('task/create', 'create')->name('task.create');
    Route::get('task/detail/{id}', 'show')->name('task.show');
    Route::put('task/update/{id}', 'update')->name('task.update');
    Route::delete('task/{id}', 'destroy')->name('task.destroy');
    Route::get('task/{id}/edit', 'edit')->name('task.edit');

    Route::post('task/addfile', 'addfile')->name('task.addfile');

    Route::get('task/done/{id}', 'taskdone')->name('task.done');
    Route::get('task/undone/{id}', 'taskundone')->name('task.undone');
});

Route::controller(WorkorderController::class)->group(function () {
    Route::get('workorder', 'index')->name('workorder.index')
        ->middleware((['auth', 'can:workorder-1234']));

    Route::post('workorder', 'store')->name('workorder.store')
        ->middleware((['auth', 'can:workorder-234']));

    Route::get('workorder/create', 'create')->name('workorder.create')
        ->middleware((['auth', 'can:workorder-234']));

    Route::get('workorder/detail/{orderNumber}', 'show')->name('workorder.show')
        ->middleware((['auth', 'can:workorder-1234']));

    Route::put('workorder/{id}', 'update')->name('workorder.update')
        ->middleware((['auth', 'can:workorder-234']));

    Route::delete('workorder/{id}', 'destroy')->name('workorder.destroy')
        ->middleware((['auth', 'can:workorder-4']));

    Route::get('workorder/{id}/edit', 'edit')->name('workorder.edit')
        ->middleware((['auth', 'can:workorder-234']));

    Route::post('workorder/addcomment', 'addcomment')->name('workorder.addcomment')
        ->middleware((['auth', 'can:workorder-1234']));

    Route::post('workorder/done', 'wodone')->name('workorder.done')
        ->middleware((['auth', 'can:workorder-234']));

    Route::post('workorder/received', 'woreceived')->name('workorder.received')
        ->middleware((['auth', 'can:workorder-234']));

    Route::get('workorder/undone/{orderNumber}', 'woundone')->name('workorder.undone')
        ->middleware((['auth', 'can:workorder-234']));

    Route::post('workorder/addrelation', 'addrelation')->name('workorder.addrelation')
        ->middleware((['auth', 'can:workorder-234']));
});

Route::controller(DepartmentController::class)->middleware('auth')->group(function () {
    Route::get('department', 'index')->name('department.index');
    Route::post('department', 'store')->name('department.store');
    Route::get('department/create', 'create')->name('department.create');
    Route::get('department/{id}', 'show')->name('department.show');
    Route::put('department/{id}', 'update')->name('department.update');
    Route::delete('department/{id}', 'destroy')->name('department.destroy');
    Route::get('department/{id}/edit', 'edit')->name('department.edit');
});

Route::controller(AssetController::class)->middleware('auth')->group(function () {
    Route::get('asset', 'index')->name('asset.index');
    Route::post('asset', 'store')->name('asset.store');
    Route::get('asset/create', 'create')->name('asset.create');
    Route::get('asset/detail/{token}', 'show')->name('asset.show');
    Route::put('asset/{id}', 'update')->name('asset.update');
    Route::delete('asset/{id}', 'destroy')->name('asset.destroy');
    Route::get('asset/{id}/edit', 'edit')->name('asset.edit');

    Route::get('allocation', 'allocation')->name('allocation.index');
    Route::post('allocation/store', 'allocationstr')->name('allocation.store');

    Route::get('location', 'location')->name('location.index');
    Route::post('location/store', 'locationstr')->name('location.store');

    Route::get('category', 'category')->name('category.index');
    Route::post('category/store', 'categorystr')->name('category.store');

    Route::get('vendor', 'vendor')->name('vendor.index');
    Route::post('vendor/store', 'vendorstr')->name('vendor.store');

    Route::get('checklist', 'checklist')->name('checklist.index');
    Route::post('checklist', 'checkliststr')->name('checklist.store');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

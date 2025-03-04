<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Maintenance\ProjectController;
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
use Illuminate\Support\Facades\Auth;
// Auth::routes(['register' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

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
    Route::get('user/show/{id}', 'show')->name('user.show');
    Route::put('user/update/{id}', 'update')->name('user.update');
    Route::get('user/delete/{id}', 'destroy')->name('user.destroy');
    Route::get('user/restore/{id}', 'restore')->name('user.restore');
    Route::get('user/{id}/edit', 'edit')->name('user.edit');

    Route::get('user/profile', 'profile')->name('profile.index');
    Route::get('user/profile/experience', 'profile')->name('profile.experience');
    Route::get('user/profile/education', 'profile')->name('profile.education');
    Route::get('user/profile/family', 'profile')->name('profile.family');
    Route::get('user/profile/contract', 'profile')->name('profile.contract');
    Route::get('user/profile/training', 'profile')->name('profile.training');
    Route::get('user/profile/attendace', 'profile')->name('profile.attendace');
    Route::get('user/profile/punrew', 'profile')->name('profile.punrew');
    Route::get('user/profile/log', 'profile')->name('profile.log');
    Route::get('user/profile/leaves', 'profile')->name('profile.leaves');

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

    Route::get('employee/document', 'document')->name('document.index');
    Route::post('employee/document/store', 'documentstr')->name('document.store');

    Route::get('employee/training', 'training')->name('training.index');
    Route::post('employee/training/store', 'trainingstr')->name('training.store');

    // Route::get('leave', 'leave')->name('leave.index');
    // Route::post('leave/store', 'leavestr')->name('leave.store');

    Route::get('employee/role', 'role')->name('role.index');
    Route::post('employee/role/store', 'rolestr')->name('role.store');
});

Route::controller(EducationController::class)->middleware('auth')->group(function () {
    Route::get('employee/education', 'index')->name('education.index');
    Route::post('employee/education/store', 'store')->name('education.store');
});

Route::controller(ContractController::class)->middleware('auth')->group(function () {
    Route::get('employee/contract', 'index')->name('contract.index');
    Route::post('employee/contract/store', 'store')->name('contract.store');
});

Route::controller(ExperienceController::class)->middleware('auth')->group(function () {
    Route::get('employee/experience', 'index')->name('experience.index');
    Route::post('employee/experience/store', 'store')->name('experience.store');
});

Route::controller(FamilyController::class)->middleware('auth')->group(function () {
    Route::get('employee/family', 'index')->name('family.index');
    Route::post('employee/family/store', 'store')->name('family.store');
});

Route::controller(SicknessController::class)->middleware('auth')->group(function () {
    Route::get('employee/sickness', 'index')->name('sickness.index');
    Route::post('employee/sickness/store', 'store')->name('sickness.store');
});

// Route::controller(InventoryController::class)->middleware('auth')->group(function () {
//     Route::get('inventory', 'index')->name('inventory.index');
//     Route::post('inventory/store', 'store')->name('inventory.store');
// });

Route::controller(RewpunController::class)->middleware('auth')->group(function () {
    Route::get('employee/rewpun', 'index')->name('rewpun.index');
    Route::post('employee/rewpun/store', 'store')->name('rewpun.store');
});

Route::controller(TrainingController::class)->middleware('auth')->group(function () {
    Route::get('employee/training', 'index')->name('training.index');
    Route::post('employee/training/store', 'store')->name('training.store');
});

Route::controller(LeaveController::class)->middleware('auth')->group(function () {
    Route::get('hris/leave', 'index')->name('leave.index'); // for employee
    Route::post('leave/store', 'store')->name('leave.store');
    Route::get('hris/leave/form', 'leaveform')->name('leave.form_leave'); // for employee

    Route::get('hris/leave/approval', 'leaveapproval')->name('leaveapproval.index');
    Route::post('hris/leave/approval/store', 'leaveapprovalstr')->name('leaveapproval.store');
    Route::get('hris/leave/approval/{id}', 'leaveapprovaldetail')->name('approval.show');
    Route::get('hris/leave/data', 'leavedata')->name('leavedata.index'); // for hrd
    Route::put('hris/leave/approval/signed/{id}', 'signaleaveapprovalstr')->name('leaveapprovalsigned.store');
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
    Route::post('task/addcomment', 'addcomment')->name('task.addcomment');
});

Route::controller(ProjectController::class)->middleware('auth')->group(function () {
    Route::get('project', 'index')->name('project.index');
    Route::post('project/store', 'store')->name('project.store');
    Route::get('project/create', 'create')->name('project.create');
    Route::get('project/detail/{id}', 'show')->name('project.show');
    Route::put('project/update/{id}', 'update')->name('project.update');
    Route::delete('project/{id}', 'destroy')->name('project.destroy');
    Route::get('project/{id}/edit', 'edit')->name('project.edit');
    Route::post('project/addfile', 'addfile')->name('project.addfile');
    Route::get('project/done/{id}', 'taskdone')->name('project.done');
    Route::get('project/undone/{id}', 'taskundone')->name('project.undone');
    Route::post('project/addcomment', 'addcomment')->name('project.addcomment');
});


Route::controller(WorkorderController::class)->middleware('auth')->group(function () {
    Route::get('workorder', 'index')->name('workorder.index');
    Route::post('workorder', 'store')->name('workorder.store');
    Route::get('workorder/create', 'create')->name('workorder.create');
    Route::get('workorder/detail/{orderNumber}', 'show')->name('workorder.show');
    Route::put('workorder/{id}', 'update')->name('workorder.update');
    Route::delete('workorder/{id}', 'destroy')->name('workorder.destroy');
    Route::get('workorder/{id}/edit', 'edit')->name('workorder.edit');
    Route::post('workorder/addcomment', 'addcomment')->name('workorder.addcomment');
    Route::post('workorder/done', 'wodone')->name('workorder.done');
    Route::post('workorder/received', 'woreceived')->name('workorder.received');
    Route::get('workorder/undone/{orderNumber}', 'woundone')->name('workorder.undone');
    Route::post('workorder/addrelation', 'addrelation')->name('workorder.addrelation');
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

    Route::get('asset/allocation/{token}', 'allocation')->name('allocation.index');
    Route::post('allocation/store', 'allocationstr')->name('allocation.store');

    Route::get('asset/location', 'location')->name('location.index');
    Route::post('location/store', 'locationstr')->name('location.store');

    Route::get('asset/category', 'category')->name('category.index');
    Route::post('category/store', 'categorystr')->name('category.store');

    Route::get('vendor', 'vendor')->name('vendor.index');
    Route::post('vendor/store', 'vendorstr')->name('vendor.store');

    Route::get('checklist', 'checklist')->name('checklist.index');
    Route::post('checklist', 'checkliststr')->name('checklist.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

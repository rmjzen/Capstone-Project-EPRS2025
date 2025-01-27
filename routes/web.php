<?php

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PleaseController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurposeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\HeadTypeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\AdminBarcodeController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\GuestProfileController;
use App\Http\Controllers\GuestRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\AdminPasswordController;
use App\Http\Controllers\GuestPasswordController;
use App\Http\Controllers\UserAvailabiltyController;
use App\Http\Controllers\AdminPassSlipSlipController;
use App\Http\Controllers\AdminRequestPassSlipController;

// SMS RELATED ROUTES

Route::post('/update-availability/{user}', [UserAvailabiltyController::class, 'updateAvailability']);


Route::get('/banned', function () {
    return view('banned');
})->name('banned');

Route::get('/verify', [VerificationController::class, 'showVerifyForm'])->name('verify');
Route::post('/verify', [VerificationController::class, 'verifyCode']);


Route::middleware(['admin'])->group(function () {
    //please head of office type related routes
    Route::get('/viewheadtype', [PleaseController::class, 'index']);
    Route::get('/pleaseheadtypepost', [PleaseController::class, 'viewcreateheadtype']);
    Route::post('/pleaseheadtypepost', [PleaseController::class, 'createheadtype']);
    Route::delete('/pleaseheadtypepost/{id}', [PleaseController::class, 'destroyheadtype'])->name('destroyheadtype.destroy');

    //barcode related routes
    Route::get('/barcodelist', [AdminBarcodeController::class, 'viewbarcodelist'])->name('barcode.view');
    Route::delete(
        '/barcode/{id}',
        [BarcodeController::class, 'destroy']
    )->name('barcode.destroy');


    //admin profile change password
    Route::post('/password/adminchangepass', [AdminPasswordController::class, 'adminchangepass'])->name('password.adminchangepass');

    //reports related routes

    Route::get('/reports', [ReportsController::class, 'index']);

    //notification related routes
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    //verify
    Route::post('/admin/verify-user/{id}', [AdminController::class, 'verifyUser'])->name('admin.verifyUser');

    //ban user or unban
    Route::post('/faculty/ban/{id}', [AdminController::class, 'ban'])->name('faculty.ban');
    Route::post('/faculty/unban/{id}', [AdminController::class, 'unban'])->name('faculty.unban');

    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/adminlogout', [AdminController::class, 'adminlogout'])->name('admin.logout');
    // Route::get('/adminprofile', [AdminController::class, 'adminprofile']);
    // Add more admin-only routes here

    //Department Related Routes in admin
    Route::get('/viewdepartment', [DepartmentController::class, 'viewdept'])->name('admin.viewdepartment');
    Route::get('/department', [DepartmentController::class, 'createdept']);
    Route::post('/department', [DepartmentController::class, 'postdept']);
    Route::delete('/department/{id}', [DepartmentController::class, 'destroydepartment'])->name('department.destroy');
    Route::get('/editdepartment/{id}', [DepartmentController::class, 'editdepartment'])->name('admin.editdepartment');
    Route::post('/updatedepartment/{id}', [DepartmentController::class, 'updatedepartment'])->name('admin.updatedepartment');

    //Head of Office Related Routes in admin
    Route::get('/viewhead', [HeadController::class, 'viewhead'])->name('admin.viewhead');
    Route::get('/viewcreatehead', [HeadController::class, 'viewcreatehead']);
    Route::post('/createhead', [HeadController::class, 'createhead']);
    Route::delete('/head/{id}', [HeadController::class, 'destroyhead'])->name('head.destroy');
    Route::get('/edithead/{id}', [HeadController::class, 'edithead'])->name('admin.edithead');
    Route::post('/updatehead/{id}', [HeadController::class, 'updatehead'])->name('admin.updatehead');


    //Designation Related Routes in admin
    Route::get('/viewdesignation', [DesignationController::class, 'viewdesignation']);
    Route::get('/viewcreatedesignation', [DesignationController::class, 'viewcreatedesignation']);
    Route::post('/createdesignation', [DesignationController::class, 'createdesignation']);
    Route::delete('/designation/{id}', [DesignationController::class, 'destroydesignation'])->name('designation.destroy');
    Route::get('/editdesignation/{id}', [DesignationController::class, 'editdesignation'])->name('admin.editdesignation');
    Route::post('/updatedesignation/{id}', [DesignationController::class, 'updatedesignation'])->name('admin.updatedesignation');


    //Purpose Related Routes in admin
    Route::get('/viewpurpose', [PurposeController::class, 'viewpurpose']);
    Route::get('/viewcreatepurpose', [PurposeController::class, 'viewcreatepurpose']);
    Route::post('/createpurpose', [PurposeController::class, 'createpurpose']);
    Route::delete('/purpose/{id}', [PurposeController::class, 'destroypurpose'])->name('purpose.destroy');
    Route::get('/editpurpose/{id}', [PurposeController::class, 'editpurpose'])->name('admin.editpurpose');
    Route::post('/updatepurpose/{id}', [PurposeController::class, 'updatepurpose'])->name('admin.updatepurpose');


    //Pass SLip Related Routes in admin
    Route::get('/viewpass', [AdminPassSlipSlipController::class, 'viewpass']);
    Route::get('/viewpassslipedit', function () {
        return view('admin.pass.edit');
    });
    Route::get('/passedit/{id}', [AdminPassSlipSlipController::class, 'passedit']);
    Route::post('/pass-slips/{id}', [AdminPassSlipSlipController::class, 'update'])->name('passslip.update');
    Route::delete('/slip/{id}', [AdminPassSlipSlipController::class, 'destroy'])->name('slip.destroy');

    // Route::get('/viewcreatepurpose', [AdminPassSlipSlipController::class, 'viewcreatepurpose']);
    // Route::post('/createpurpose', [AdminPassSlipSlipController::class, 'createpurpose']);

    //Request Pass SLip Related Routes in admin
    Route::get('/requestpass', [AdminRequestPassSlipController::class, 'requestpass']);
    Route::post('/createrequestpass', [AdminRequestPassSlipController::class, 'createrequestpass']);
    Route::get('/editrequestpass/{id}', [AdminRequestPassSlipController::class, 'editRequestPass'])->name('admin.editRequest');
    Route::post('/updaterequestpass/{id}', [AdminRequestPassSlipController::class, 'updateRequestPass'])->name('admin.updateRequest');

    // Approve leave request
    Route::post('/leaves/{id}/approve', [LeaveController::class, 'approve'])->name('slip.approve');

    // Reject leave request
    Route::post('/leaves/{id}/reject', [LeaveController::class, 'reject'])->name('slip.disapprove');
    //faculy related routes
    Route::get('/viewfaculty', [FacultyController::class, 'viewfaculty']);
    Route::get('/viewcreatefaculty', [FacultyController::class, 'viewcreatefaculty']);
    Route::post('/createfaculty', [FacultyController::class, 'createfaculty']);
    Route::delete('/faculty/{id}', [FacultyController::class, 'destroyfaculty'])->name('faculty.destroy');

    //profile of admin
    Route::get('/adminprofile', [AdminProfileController::class, 'index']);
    Route::post('/adminupdateprofile/{id}', [AdminProfileController::class, 'adminupdateprofile'])->name('admin.updateprofile');
});





Route::post('/verifyout', [GuestController::class, 'verifyout'])->name('verify.logout');


//auth related routes
// Authentication Routes (For Non-Logged-In Users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'viewlogin'])->name('login');
    Route::get('/register', [RegisterController::class, 'viewregister'])->name('register');
    Route::post('/register', [RegisterController::class, 'createregister'])->name('register.store');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');
});



//guest or newly created accounts
Route::middleware(['auth.guest', 'checkBanned', 'verify', 'updatelastseen'])->group(function () {
    //mark as read related routes
    Route::post('/notifications/mark-all-as-readguest', [NotificationController::class, 'markAllAsReadguest'])->name('notifications.markAllAsReadguest');
    Route::post('/head-of-office/slip/{id}/approve', [GuestController::class, 'approveByHeadOffice'])->name('headOffice.slip.approve');
    Route::post('/head-of-office/slip/{id}/disapprove', [GuestController::class, 'disapproveByHeadOffice'])->name('headOffice.slip.disapprove');
    Route::get('/', [GuestController::class, 'index']);
    Route::post('/guestout', [GuestController::class, 'guestlogout'])->name('guest.logout');
    Route::get('/guestdashboard', [GuestController::class, 'viewguestdashboard'])->name('guestdashboard');
    Route::get('/guestpass', [GuestController::class, 'guestpassview']);
    Route::get('/guestviewrequest', [GuestRequestController::class, 'guestviewrequest']);
    Route::post('/guestrequestpost', [GuestController::class, 'guestrequeststore']);
    Route::delete('/deleteguestslip/{id}', [GuestController::class, 'destroy'])->name('guestslip.destroy');
    Route::get('/guestprofile', [GuestProfileController::class, 'index']);
    Route::post('/guestupdateprofile/{id}', [GuestProfileController::class, 'guestupdateprofile'])->name('guest.updateprofile');

    Route::get('/guesteditsliprequest/{id}', [GuestRequestController::class, 'guesteditsliprequest'])->name('guest.guesteditsliprequest');
    Route::post('/guestupdatesliprequest/{id}', [GuestRequestController::class, 'guestupdatesliprequest'])->name('guest.guestupdatesliprequest');

    //change password of guest related routes
    Route::post('/password/guestchangepass', [GuestPasswordController::class, 'guestchangepass'])->name('password.guestchangepass');
});


Route::post('/barcode/scan', [BarcodeController::class, 'scandeparture']);
Route::post('/barcode/scanarrival', [BarcodeController::class, 'scanarrival']);

Route::get('/barcode-scan', [BarcodeController::class, 'index'])->name('barcode.scan');


Route::get('/send-sms-form', [SmsController::class, 'showSmsForm']); // Show the form
Route::post('/send-sms', [SmsController::class, 'sendSms']); // Handle form submission


//print

Route::get('/invoice-pdf', [InvoiceController::class, 'index']);

Route::get('/pass-slip/print/{id}', [InvoiceController::class, 'printPassSlip'])->name('pass-slip.print');
Route::get('/pass-slip/view/{id}', [InvoiceController::class, 'showPrintView'])->name('pass-slip.view');


Route::get('/testroute', function () {
    $name = "Funny Coder";

    Mail::to('businessmailromer@gmail.com')->send(new MyTestEmail($name));
});

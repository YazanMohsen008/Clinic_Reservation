<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReceiverClinicController;
use App\Http\Controllers\ReservationRequestController;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
/*
Route::get    ('countries', [CountryController::class, 'getCountries']);
Route::get    ('countries/{id}', [CountryController::class, 'getCountry']);
Route::post   ('country', [CountryController::class, 'storeCountry']);
Route::put    ('country/{id}', [CountryController::class, 'updateCountry']);
Route::DELETE ('country/{id}', [CountryController::class, 'deleteCountry']);
Route::get        ('downloadFile', [FileController::class, 'Download']);
Route::post       ('uploadFile', [FileController::class, 'Upload']);
*/
Route::post       ('register', [AuthController::class, 'register']);
Route::post       ('login   ', [AuthController::class, 'login']);
Route::apiResource('specialization',"App\Http\Controllers\SpecializationController");

Route::apiResource('clinic',"App\Http\Controllers\ClinicController");
Route::get('clinic-search/{name}',[ClinicController::class, 'searchByName']);

Route::apiResource('receiver_clinics',"App\Http\Controllers\ReceiverClinicController");
Route::get('receiver_clinic-requests/{id}',[ReceiverClinicController::class, 'showClinicTransferRequests']);

Route::apiResource('phoneNumber',"App\Http\Controllers\PhoneNumberController");

Route::apiResource('patient',"App\Http\Controllers\PatientController");
Route::get('patient-reservations/{id}',[PatientController::class, 'showPatientReservations']);
Route::get('patient-consultations/{id}',[PatientController::class, 'showPatientConsultations']);


Route::apiResource('reservation_requests',"App\Http\Controllers\ReservationRequestController");
Route::delete('reservation-cancel',[ReservationRequestController::class, 'cancel']);


Route::apiResource('consultation',"App\Http\Controllers\ConsultationController");
Route::get('specialization_consultations/{id}',[ConsultationController::class, 'showSpecializationConsultations']);

Route::apiResource('patient_file_transfer_request',"App\Http\Controllers\PatientFileTransferRequestController");
Route::apiResource('patient_card',"App\Http\Controllers\PatientCardController");
Route::apiResource('extra_information',"App\Http\Controllers\ExtraInformationController");
Route::apiResource('diagnosis',"App\Http\Controllers\DiagnosisController");
Route::apiResource('medicines',"App\Http\Controllers\MedicineController");
Route::apiResource('attachments',"App\Http\Controllers\AttachmentController");

Route::middleware('auth:sanctum')->group(function (){
    Route::get         ('user', [AuthController::class, 'getUser']);
    Route::post        ('logout',  [AuthController::class, 'logout' ]);
});

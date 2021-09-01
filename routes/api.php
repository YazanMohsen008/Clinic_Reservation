<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientFileTransferRequestController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReceiverClinicController;
use App\Http\Controllers\ReservationRequestController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\SystemAdminController;
use Illuminate\Support\Facades\Route;


Route::post('system-admin', [SystemAdminController::class, 'store']);
Route::get('system-admins', [SystemAdminController::class, 'index']);
Route::post('system-admin-login', [SystemAdminController::class, 'login']);

Route::get('clinic', [ClinicController::class, 'index']);
Route::get('clinic/{id}', [ClinicController::class, 'show']);
Route::get('clinic-search/{name}', [ClinicController::class, 'searchByName']);
Route::post('clinic-login', [ClinicController::class, 'login']);

Route::post('patient-login', [PatientController::class, 'login']);
Route::post('patient', [PatientController::class, 'store']);

Route::get('specializations', [SpecializationController::class, 'index']);
Route::get('prescription/{id}', [PrescriptionController::class, 'show']);

Route::middleware("auth:sanctum")->group(function () {


        Route::get('patient_file_transfer_request', [PatientFileTransferRequestController::class, 'index']);
    Route::middleware("is:system_admin")->group(function () {

        Route::get('current-system-admin', [SystemAdminController::class, 'getUser']);
        Route::post('system-admin-logout', [SystemAdminController::class, 'logout']);

        //specialization
        Route::post('specialization', [SpecializationController::class, 'store']);//system admin &

        Route::put('specialization/{id}', [SpecializationController::class, 'update']);
        Route::delete('specialization', [SpecializationController::class, 'destroy']);

        // clinic
        Route::post('clinic', [ClinicController::class, 'store']);
        Route::put('clinic/{id}', [ClinicController::class, 'update']);
        Route::delete('clinic/{id}', [ClinicController::class, 'destroy']);


    });


    Route::middleware("is:clinic")->group(function () {
        Route::get('current-clinic', [ClinicController::class, 'getUser']);
        Route::Post('clinic-logout', [ClinicController::class, 'logout']);

        //Consultation
        Route::get('specialization_consultations', [ConsultationController::class, 'showSpecializationConsultations']);
        Route::put('consultation/{id}', [ConsultationController::class, 'update']);

        //reservations
        Route::get('clinic-reservations', [ClinicController::class, 'MyReservations']);

        Route::get('preview-Transfer-patient', [ReceiverClinicController::class, 'previewClinicTransferRequests']);
        Route::get('download-Transfer-patient', [ReceiverClinicController::class, 'downloadClinicTransferRequests']);

        Route::post('patient_file_transfer_request', [PatientFileTransferRequestController::class, 'store']);
        Route::get('patient_file_transfer_request/{id}', [PatientFileTransferRequestController::class, 'show']);

        Route::put('reservation_requests/{id}', [ReservationRequestController::class, 'update']);

        // clinic
        Route::put('current-clinic', [ClinicController::class, 'updateCurrent']);//system admin & clinic
        Route::delete('current-clinic', [ClinicController::class, 'destroyCurrent']);//system admin & clinic
    });


    Route::middleware("is:patient")->group(function () {
        Route::get('current-patient', [PatientController::class, 'getUser']);
        Route::get('patient-logout', [PatientController::class, 'logout']);

        //consultations
        Route::post('consultation', [ConsultationController::class, 'store']);
        Route::get('consultation', [ConsultationController::class, 'index']);
        Route::get('patient-consultations', [PatientController::class, 'showPatientConsultations']);

        //reservations
        Route::post('reservation_requests', [ReservationRequestController::class, 'store']);
        Route::get('patient-reservations', [PatientController::class, 'showPatientReservations']);
        Route::delete('reservation-cancel', [ReservationRequestController::class, 'cancel']);

        Route::put('patient', [PatientController::class, 'update']);
        Route::delete('patient', [PatientController::class, 'destroy']);
    });

});



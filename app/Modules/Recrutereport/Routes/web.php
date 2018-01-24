<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'recruitreport' , 'middleware' => ['auth' , 'read_access']], function () {

    Route::get('/', 'RreportController@index')->name('recrutereport');
    Route::get('/vendor', 'RreportController@vendor')->name('recrutereport_vendor');
    Route::get('/vendorList/{id}', 'RreportController@vendorList')->name('recrutereport_vendorList');
    Route::post('/vendor', 'RreportController@vendorSearch')->name('recrutereport_vendorSearch');
    Route::get('/ven', 'RreportController@ticketvendorSearch')->name('recrutereport_ticket_vendorSearch');
    Route::get('/company', 'RreportController@company')->name('recrutereport_company');
    Route::get('/companyList', 'RreportController@companyList')->name('recrutereport_companyList');
    Route::get('/visa', 'RreportController@visa')->name('recrutereport_visa');
    Route::get('/visalist', 'RreportController@visalist')->name('recrutereport_visa');

    Route::get('/customer-report', 'RreportController@customerReport')->name('recrutereport_customer_report');

    //Report
    Route::get('/medical-slip-report', 'RreportController@medicalSlipReport')->name('recrutereport_medical_slip_report');
    Route::post('/medical-slip-report', 'RreportController@medicalSlipReportSearch')->name('recrutereport_medical_slip_report_search');

    //Mofa
    Route::get('/mofa-report', 'RreportController@mofaReport')->name('recrutereport_mofa_report');
    Route::post('/mofa-report', 'RreportController@mofaReportSearch')->name('recrutereport_mofa_report_search');

    //Okala
    Route::get('/okala-report', 'RreportController@okalaReport')->name('recrutereport_okala_report');
    Route::post('/okala-report', 'RreportController@okalaReportSearch')->name('recrutereport_okala_report_search');

    //Fit-Card
    Route::get('/fit-card-report', 'RreportController@fitCardReport')->name('recrutereport_fit_card_report');
    Route::post('/fit-card-report', 'RreportController@fitCardReportSearch')->name('recrutereport_fit_card_report_search');

    //Police Clearance
    Route::get('/police-clearance-report', 'RreportController@policeClearanceReport')->name('recrutereport_police_clearance_report');
    Route::post('/police-clearance-report', 'RreportController@policeClearanceReportSearch')->name('recrutereport_police_clearance_report_search');

    //Medical Slip Form
    Route::get('/medical-slip-form-report', 'RreportController@medicalSlipFormReport')->name('recrutereport_medical_slip_form_report');
    Route::post('/medical-slip-form-report', 'RreportController@medicalSlipFormReportSearch')->name('recrutereport_medical_slip_form_report_search');

    //Finger
    Route::get('/finger-report', 'RreportController@fingerReport')->name('recrutereport_finger_report');
    Route::post('/finger-report', 'RreportController@fingerReportSearch')->name('recrutereport_finger_report_search');

    //Training
    Route::get('/training-report', 'RreportController@trainingReport')->name('recrutereport_training_report');
    Route::post('/training-report', 'RreportController@trainingReportSearch')->name('recrutereport_training_report_search');

    //Manpower
    Route::get('/manpower-report', 'RreportController@manpowerReport')->name('recrutereport_manpower_report');
    Route::post('/manpower-report', 'RreportController@manpowerReportSearch')->name('recrutereport_manpower_report_search');

    //Completion
    Route::get('/completion-report', 'RreportController@completionReport')->name('recrutereport_completion_report');
    Route::post('/completion-report', 'RreportController@completionReportSearch')->name('recrutereport_completion_report_search');

    //Submission
    Route::get('/submission-report', 'RreportController@submissionReport')->name('recrutereport_submission_report');
    Route::post('/submission-report', 'RreportController@submissionReportSearch')->name('recrutereport_submission_report_search');

    //Confirmation
    Route::get('/confirmation-report', 'RreportController@confirmationReport')->name('recrutereport_confirmation_report');
    Route::post('/confirmation-report', 'RreportController@confirmationReportSearch')->name('recrutereport_confirmation_report_search');

    //Visa
    Route::get('/visa-report', 'RreportController@visaReport')->name('recrutereport_visa_report');
    Route::post('/visa-report', 'RreportController@visaReportSearch')->name('recrutereport_visa_report_search');

    Route::get('/visa-details/{id}', 'RreportController@visaDetail')->name('recrutereport_visa_details');

    //Reference
    Route::get('/reference-report', 'RreportController@referenceReport')->name('recrutereport_reference_report');
    Route::post('/reference-report', 'RreportController@referenceReportSearch')->name('recrutereport_reference_report_search');

    //Passenger
    Route::get('/passenger-report/{id}', 'RreportController@passengerReport')->name('recrutereport_passenger_report');
    Route::post('/passenger-report/{id}', 'RreportController@passengerReport')->name('recrutereport_passenger_report');

    //Sub Referance
    Route::get('/subreference-report/{id}', 'RreportController@subreferenceReport')->name('recrutereport_subreference_report');

    //Total Ticket
    Route::get('/total-ticket-report', 'RreportController@totalTicketReport')->name('recrutereport_total_ticket_report');
    Route::post('/total-ticket-report', 'RreportController@totalTicketReportSearch')->name('recrutereport_total_ticket_report_search');
    Route::get('/total-ticket-report/{id}/{start}/{end}', 'RreportController@totalTicketReportFind')->name('recrutereport_total_ticket_find_report');

    //Total Visa
    Route::get('/total-visa-report', 'RreportController@totalVisaReport')->name('recrutereport_total_visa_report');
    Route::post('/total-visa-report', 'RreportController@totalVisaReportSearch')->name('recrutereport_total_visa_report_search');
    Route::get('/total-visa-report/{id}/{start}/{end}', 'RreportController@totalVisaReportFind')->name('recrutereport_total_visa_find_report');

    //Total Visa Column Add
    Route::get('/total-visa-report-group-wise/{id}', 'RreportController@totalVisaReportGroupWise')->name('recrutereport_total_visa_report_group_wise');
    Route::post('/total-visa-report-group-wise', 'RreportController@totalVisaReportGroupWiseSearch')->name('recrutereport_total_visa_report_search_group_wise');
    Route::get('/total-visa-report-group-wise/{id}/{company_id}/{start}/{end}', 'RreportController@totalVisaReportGroupWiseFind')->name('recrutereport_total_visa_find_report_group_wise');

    //Total Visa Numberwise
    Route::get('/total-visa-report-visa-wise/{id}', 'RreportController@totalVisaReportVisaWise')->name('recrutereport_total_visa_report_visa_wise');
    Route::post('/total-visa-report-visa-wise', 'RreportController@totalVisaReportVisaWiseSearch')->name('recrutereport_total_visa_report_search_visa_wise');
    Route::get('/total-visa-report-visa-wise/{id}/{company_id}/{start}/{end}', 'RreportController@totalVisaReportVisaWiseFind')->name('recrutereport_total_visa_find_report_visa_wise');

    //Iqama Report
    Route::get('/iqama-approval-report', 'RreportController@iqamaApprovalReport')->name('recrutereport_iqama_approval_report');
    Route::post('/iqama-approval-report', 'RreportController@iqamaApprovalReportSearch')->name('recrutereport_iqama_approval_report_search');

    //Iqama Insurance
    Route::get('/iqama-insurance-report', 'RreportController@iqamaInsuranceReport')->name('recrutereport_iqama_insurance_report');
    Route::post('/iqama-insurance-report', 'RreportController@iqamaInsuranceReportSearch')->name('recrutereport_iqama_insurance_report_search');

    //Iqama Submission
    Route::get('/iqama-submission-report', 'RreportController@iqamaSubmissionReport')->name('recrutereport_iqama_submission_report');
    Route::post('/iqama-submission-report', 'RreportController@iqamaSubmissionReportSearch')->name('recrutereport_iqama_submission_report_search');

    //Iqama Receive
    Route::get('/iqama-receive-report', 'RreportController@iqamaReceiveReport')->name('recrutereport_iqama_receive_report');
    Route::post('/iqama-receive-report', 'RreportController@iqamaReceiveReportSearch')->name('recrutereport_iqama_receive_report_search');

    //Iqama Clearance
    Route::get('/iqama-clearance-report', 'RreportController@iqamaClearanceReport')->name('recrutereport_iqama_clearance_report');
    Route::post('/iqama-clearance-report', 'RreportController@iqamaClearanceReportSearch')->name('recrutereport_iqama_clearance_report_search');

    //Iqama Recipient
    Route::get('/iqama-recipient-report', 'RreportController@iqamaRecipientReport')->name('recrutereport_iqama_recipient_report');
    Route::post('/iqama-recipient-report', 'RreportController@iqamaRecipientReportSearch')->name('recrutereport_iqama_recipient_report_search');

    //Iqama Acknowledgement
    Route::get('/iqama-acknowledgement-report', 'RreportController@iqamaAcknowledgementReport')->name('recrutereport_iqama_acknowledgement_report');
    Route::post('/iqama-acknowledgement-report', 'RreportController@iqamaAcknowledgementReportSearch')->name('recrutereport_iqama_acknowledgement_report_search');

    //Iqama Before 60
    Route::get('/iqama-before-report', 'RreportController@iqamaBeforeReport')->name('recrutereport_iqama_before_report');
    Route::post('/iqama-before-report', 'RreportController@iqamaBeforeReportSearch')->name('recrutereport_iqama_before_report_search');

    //Iqama After 60
    Route::get('/iqama-after-report', 'RreportController@iqamaAfterReport')->name('recrutereport_iqama_after_report');
    Route::post('/iqama-after-report', 'RreportController@iqamaAfterReportSearch')->name('recrutereport_iqama_after_report_search');

});

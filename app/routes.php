<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('id', '[0-9]+');
Route::pattern('year', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => array('auth','supermanager')), function()
{
	#logs
	Route::get('logs', array('as'=>'admin.logs','uses'=>'\Rap2hpoutre\LaravelLogViewer\LogViewerController@index'));

    # User Management
    Route::get('users/create', 'AdminUsersController@getCreate');
    Route::post('users/create', 'AdminUsersController@postCreate');
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
	Route::get('users/{user}/deactivate', array('as'=>'admin.users.deactivateUser', 'uses'=>'AdminUsersController@deactivateUser'));
    Route::get('users/{user}/activate',array('as'=>'admin.users.activateUser','uses'=>'AdminUsersController@activateUser'));
    Route::get('users/{user}/delete', array('as'=>'admin.users.delete','uses'=>'AdminUsersController@delete'));
    Route::get('users/reset_password/{id}', array('as'=>'admin.users.resetUserPassword','uses'=>'AdminUsersController@resetUserPassword'));
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    //system setups routes
    Route::get('system/upload_gfs', 'SystemSetupsController@getUploadGfs');
    Route::post('system/post_gfs_upload', 'SystemSetupsController@postUploadGfs');
    Route::get('system/add_unit_measure', 'SystemSetupsController@addUnitMeasure');
    Route::post('system/add_unit_measure', 'SystemSetupsController@postUnitMeasure');
    Route::get('system/delete_unit_measure/{id}', 'SystemSetupsController@destroyUnitMeasure');

    Route::get('system/add_gfs', 'SystemSetupsController@addGfs');
    Route::post('system/add_gfs', 'SystemSetupsController@postGfs');
    Route::get('system/delete_gfs/{id}', 'SystemSetupsController@destroyGfs');

    Route::get('system/addPMeasure', 'SystemSetupsController@addPMeasure');
    Route::post('system/storePMeasure', 'SystemSetupsController@storePMeasure');
    Route::get('system/editPMeasure/{id}', 'SystemSetupsController@editPMeasure');
    Route::post('system/updatePMeasure/{id}', 'SystemSetupsController@updatePMeasure');

    Route::get('system/positions', 'SystemSetupsController@listPosition');
    Route::get('system/positions/edit/{id}', 'SystemSetupsController@editPosition');
    Route::post('system/updatePosition/{id}', 'SystemSetupsController@updatePosition');
    Route::get('system/deletePosition/{id}', 'SystemSetupsController@deletePosition');
    Route::post('system/storePosition', 'SystemSetupsController@storePosition');

    Route::controller('system', 'SystemSetupsController');


});


Route::group(array('before' => array('auth','supermanager')), function() {

	Route::get('budget/overAllConsolidate','BudgetControlController@getOverAll');
    Route::get('budget/overAll/{id}','BudgetControlController@getOverAllConsolidation');
    Route::post('budget/overAll','BudgetControlController@postOverAllActivityConsolidation');

	Route::get('reports/overallBudget','ReportsController@getOverallBudget');
    Route::post('reports/overallBudget','ReportsController@postOverallBudget');
	Route::get('reports/overall','ReportsController@downloadOverallBudget');

});

Route::group(array('before' => 'auth'), function() {

	//Dashboard
    Route::get('dashboard', 'HomeController@dashboard');
    Route::controller('home', 'HomeController');

    //Action Plan Setup route
    Route::get('year', 'SetupController@create');
    Route::post('store_year', 'SetupController@storeYear');
    Route::controller('setup', 'SetupController');

    //Budget
    Route::get('budget/submit', 'BudgetControlController@getIndex');
    Route::post('budget/submit', 'BudgetControlController@postIndex');
    Route::get('budget/zone/manage', 'BudgetControlController@manage_zone');
    Route::get('budget/unlock/{id}', 'BudgetControlController@unlock');
	Route::post('budget/zone_submit', 'BudgetControlController@zonalSubmit');
	Route::get('budget/overall/manage', 'BudgetControlController@manage_overall');
    Route::get('budget/zone_unlock/{id}', 'BudgetControlController@unlockZone');
    Route::get('budget/consolidate','BudgetControlController@getZoneConsolidation');
    Route::get('budget/zonal_consolidate/{id}','BudgetControlController@getZonalConsolidation');
    Route::post('budget/activityConsolidation','BudgetControlController@postZoneActivityConsolidation');
    Route::get('budget/zone/delete/{id}','BudgetControlController@deleteZonalActivity');
    Route::get('budget/overall/activity/delete/{id}','BudgetControlController@deleteHqActivity');
    Route::controller('budget', 'BudgetControlController');

	//Revenue
    Route::get('revenue/submit', 'RevenueControlController@getIndex');
    Route::post('revenue/submit', 'RevenueControlController@postIndex');
    Route::get('revenue/manage', 'RevenueControlController@manage');
	Route::get('revenue/unlock/{id}', 'RevenueControlController@unlock');
	Route::controller('revenue', 'RevenueControlController');

    //API routes
    Route::get('api/targets/{id}', 'ApiController@get_targets_by_objective');
    Route::controller('api', 'ApiController');

    //Zone Route
    Route::get('zones/create', 'ZonesController@create');
    Route::get('zones/edit/{id}', 'ZonesController@edit');

    Route::get('zones/edit_unit/{id}', 'ZonesController@editUnit');
    Route::post('zones/updateUnit/{id}', 'ZonesController@updateUnit');

    Route::get('zones/unit/{id}', 'ZonesController@addUnit');
    Route::post('zones/storeUnit/{id}', 'ZonesController@storeUnit');

    Route::post('zones/update/{id}', 'ZonesController@update');
    Route::get('zones/delete/{id}', 'ZonesController@destroy');
    Route::get('zones/index', 'ZonesController@index');
    Route::post('zones/store', 'ZonesController@store');
    Route::controller('zones', 'ZonesController');

    //Units Route
    Route::get('units/create', 'UnitsController@create');
    Route::get('units/edit/{id}', 'UnitsController@edit');
    Route::post('units/update/{id}', 'UnitsController@update');
    Route::get('units/delete/{id}', 'UnitsController@destroy');
    Route::get('units/index', 'UnitsController@index');
    Route::post('units/store', 'UnitsController@store');
    Route::controller('units', 'UnitsController');

    //Revenue Categories Route
    Route::get('revenueCategory/create', 'RevenueCategoriesController@create');
    Route::get('revenueCategory/edit/{id}', 'RevenueCategoriesController@edit');
    Route::get('revenueCategory/addRefSubmission/{id}', 'RevenueCategoriesController@addRefSubmission');
    Route::post('revenueCategory/update/{id}', 'RevenueCategoriesController@update');
    Route::post('revenueCategory/postRefSubmission/{id}', 'RevenueCategoriesController@postRefSubmission');
    Route::get('revenueCategory/delete/{id}', 'RevenueCategoriesController@destroy');
    Route::get('revenueCategory/index', 'RevenueCategoriesController@index');
    Route::post('revenueCategory/store', 'RevenueCategoriesController@store');


    Route::get('revenueCategory/editRefSubmission/{id}', 'RevenueCategoriesController@editRefSubmission');
    Route::post('revenueCategory/postEditRefSubmission/{id}', 'RevenueCategoriesController@postEditRefSubmission');
    Route::get('revenueCategory/deleteRefSubmission/{id}', 'RevenueCategoriesController@deleteRefSubmission');

    Route::get('revenueCategory/classes/{id}', 'RevenueCategoriesController@addClasses');
    Route::get('revenueCategory/deleteClass/{id}', 'RevenueCategoriesController@deleteClass');
    Route::post('revenueCategory/postClass', 'RevenueCategoriesController@postClass');

    Route::controller('revenueCategory', 'RevenueCategoriesController');



    //Ref Submission Route
    Route::get('refSubmission/create', 'RefSubmissionsController@create');
    Route::get('refSubmission/edit/{id}', 'RefSubmissionsController@edit');
    Route::get('refSubmission/projection/{id}', 'RefSubmissionsController@projection');
    Route::post('refSubmission/postProjection', 'RefSubmissionsController@postProjection');
    Route::post('refSubmission/update/{id}', 'RefSubmissionsController@update');
    Route::get('refSubmission/delete/{id}', 'RefSubmissionsController@destroy');
    Route::get('refSubmission/index', 'RefSubmissionsController@index');
    Route::post('refSubmission/store', 'RefSubmissionsController@store');
    Route::controller('refSubmission', 'RefSubmissionsController');




    //Action Plan Actions
    Route::get('add_objective', 'ActionController@addObjective');
    Route::get('upload_objective', 'ActionController@getUploadObjective');
    Route::post('upload_objective/post', 'ActionController@postUploadObjective');
    Route::get('list_objective', 'ActionController@listObjective');
    Route::get('objective_target', 'ActionController@listObjectiveForTarget');
    Route::get('list_target', 'ActionController@listTarget');
    Route::get('list_activities', 'ActionController@listActivity');
    Route::post('store_objective', 'ActionController@storeObjective');
    Route::get('edit_objective/{id}', 'ActionController@editObjective');
    Route::post('update_objective/{id}', 'ActionController@updateObjective');
    Route::get('add_target/{id}', 'ActionController@addTarget');
    Route::get('edit_target/{id}', 'ActionController@editTarget');
    Route::post('update_target/{id}', 'ActionController@updateTarget');
    Route::post('store_target', 'ActionController@storeTarget');
    Route::get('editActivity/{id}', 'ActionController@getEditActivity');
    Route::post('updateActivity/{id}', 'ActionController@postEditActivity');
    Route::get('add_activity/{id}', 'ActionController@addActivity');
    Route::get('delete_activity/{id}', 'ActionController@deleteActivity');
    Route::post('store_activity', 'ActionController@storeActivity');
    Route::get('add_kip/{id}', 'ActionController@addKpi');
    Route::get('add_item/{id}', 'ActionController@addItem');
    Route::get('edit_item/{id}', 'ActionController@getEditItem');
    Route::post('store_item', 'ActionController@storeItem');
    Route::post('updateItem/{id}', 'ActionController@updateItem');
    Route::get('delete_item/{id}', 'ActionController@deleteItem');
    Route::get('myDashboard', 'ActionController@actionDashboard');
    Route::get('ob_details/{id}', 'ActionController@ObDetails');
    Route::get('select_objective', 'ActionController@getSelectObjective');
    Route::post('get_selected_objective', 'ActionController@getSelectedObjective');
    Route::controller('action', 'ActionController');


    #my Budget Routes
    Route::get('mybudget/index', 'MyBudgetController@index');
    Route::get('mybudget/excel', 'MyBudgetController@getExcel');
    Route::get('mybudget/csv', 'MyBudgetController@getCSV');
    Route::get('mybudget/pdf', 'MyBudgetController@getPdf');
    Route::controller('mybudget', 'MyBudgetController');


    #Submissions
    Route::get('submissions/downloadUnitReport', 'SubmissionsController@downloadUnitReport');
    Route::get('submissions/unit_report', 'SubmissionsController@unitReport');
    Route::get('submissions/downloadZoneReport', 'SubmissionsController@downloadZoneReport');
    Route::get('submissions/zone_report', 'SubmissionsController@zoneReport');
    Route::get('submissions/consolidated_report', 'SubmissionsController@consolidatedReport');
    Route::get('submissions/total_report', 'SubmissionsController@totalReport');
    Route::get('submissions/station_report', 'SubmissionsController@stationReport');
    Route::get('submissions/index', 'SubmissionsController@index');
    Route::get('submissions/import_references', 'SubmissionsController@importReference');
    Route::get('submissions/create/{id}', 'SubmissionsController@create');
    Route::get('submissions/show/{id}', 'SubmissionsController@show');
    Route::get('submissions/edit/{id}', 'SubmissionsController@edit');


    Route::post('submissions/postUnitReport', 'SubmissionsController@postUnitReport');
    Route::post('submissions/postZoneReport', 'SubmissionsController@postZoneReport');
    Route::post('submissions/store', 'SubmissionsController@store2');
    Route::post('submissions/update/{id}', 'SubmissionsController@update');
    Route::controller('submissions', 'SubmissionsController');

    #Projections
    Route::get('projections/index', 'ProjectionsController@index');
    Route::get('projections/create', 'ProjectionsController@create');
    Route::get('projections/show/{id}', 'ProjectionsController@show');
    Route::get('projections/edit/{id}', 'ProjectionsController@edit');
    Route::post('projections/update/{id}', 'ProjectionsController@update');
    Route::post('projections/store', 'ProjectionsController@store');
    Route::controller('projections', 'ProjectionsController');


    #Ref Objective Code
    Route::get('refObjectiveCode/index', 'RefObjectiveCodesController@index');
    Route::get('refObjectiveCode/create', 'RefObjectiveCodesController@create');
    Route::get('refObjectiveCode/show/{id}', 'RefObjectiveCodesController@show');
    Route::get('refObjectiveCode/delete/{id}', 'RefObjectiveCodesController@destroy');
    Route::get('refObjectiveCode/edit/{id}', 'RefObjectiveCodesController@edit');
    Route::post('refObjectiveCode/update/{id}', 'RefObjectiveCodesController@update');
    Route::post('refObjectiveCode/store', 'RefObjectiveCodesController@store');
    Route::controller('refObjectiveCode', 'RefObjectiveCodesController');

    #Ref Target Code
    Route::get('refTargetNo/index', 'RefTargetNosController@index');
    Route::get('refTargetNo/create', 'RefTargetNosController@create');
    Route::get('refTargetNo/show/{id}', 'RefTargetNosController@show');
    Route::get('refTargetNo/delete/{id}', 'RefTargetNosController@destroy');
    Route::get('refTargetNo/edit/{id}', 'RefTargetNosController@edit');
    Route::post('refTargetNo/update/{id}', 'RefTargetNosController@update');
    Route::post('refTargetNo/store', 'RefTargetNosController@store');
    Route::controller('refTargetNo', 'RefTargetNosController');

    #personal emoluments references

    Route::get('emoluments/create', 'RefEmolumentsController@create');
    Route::get('emoluments/create_upload', 'RefEmolumentsController@createUpload');
    Route::get('emoluments/index', 'RefEmolumentsController@index');

    Route::post('emoluments/store', 'RefEmolumentsController@store');
    Route::post('emoluments/storeUpload', 'RefEmolumentsController@storeUpload');

    Route::controller('emoluments', 'RefEmolumentsController');



    #Personal Emoluments Remarks References
    Route::get('pe_remarks/index', 'RefRemarksController@index');
    Route::get('pe_remarks/create', 'RefRemarksController@create');

    Route::post('perRemarks/store', 'RefRemarksController@store');
    Route::controller('pe_remarks', 'RefRemarksController');


    #form 8 A route
    Route::get('personal_emoluments/createExcel', 'PersonalEmolumentsController@createExcel');
    Route::get('personal_emoluments/create', 'PersonalEmolumentsController@create');
    Route::get('personal_emoluments/edit/{id}', 'PersonalEmolumentsController@edit');
    Route::get('personal_emoluments/remarks/{id}', 'PersonalEmolumentsController@getRemark');
    Route::get('personal_emoluments/form8A', 'PersonalEmolumentsController@getForm8A');
    Route::get('personal_emoluments/form8B', 'PersonalEmolumentsController@getForm8B');
    Route::get('personal_emoluments/form9', 'PersonalEmolumentsController@form9');
    Route::get('personal_emoluments/index', 'PersonalEmolumentsController@index');
    Route::get('personal_emoluments/getTemplate', 'PersonalEmolumentsController@downloadEmolumentTemplate');
    Route::get('personal_emoluments/downloadForm8A/{year}', 'PersonalEmolumentsController@downloadForm8A');
    Route::post('personal_emoluments/postRemark/{id}', 'PersonalEmolumentsController@postRemark');
    Route::post('personal_emoluments/update/{id}', 'PersonalEmolumentsController@update');
    Route::post('personal_emoluments/form8A', 'PersonalEmolumentsController@postForm8A');
    Route::post('personal_emoluments/storeExcel', 'PersonalEmolumentsController@storeExcel');
    Route::post('personal_emoluments/store', 'PersonalEmolumentsController@store');
    Route::controller('personal_emoluments', 'PersonalEmolumentsController');

    #financial year

    Route::get('financial_year/create', 'FinancialYearsController@create');
    Route::get('financial_year/activate/{id}', 'FinancialYearsController@activate');
    Route::get('financial_year/edit/{id}', 'FinancialYearsController@edit');
    Route::get('financial_year/index', 'FinancialYearsController@index');

    Route::post('financialYear/store', 'FinancialYearsController@store');
    Route::post('financialYear/update/{id}', 'FinancialYearsController@update');
    Route::post('financialYear/storeActivate/{id}', 'FinancialYearsController@storeActivate');
    Route::controller('financial_year', 'FinancialYearsController');


    # Alerts
	 Route::get('alerts/penndingConsolidation', 'AlertsController@pendingConsolidation');
	  Route::get('alerts/pennding_zone_Consolidation', 'AlertsController@pendingZoneConsolidation');
	 Route::controller('alerts', 'AlertsController');


	# Reports
    Route::get('reports/unitBudgetView','ReportsController@getUnitBudget');
    Route::post('reports/unitBudgetView','ReportsController@postUnitBudget');
    Route::get('reports/unitBudget','ReportsController@downloadUnitBudget');

	#unit form3c
    Route::get('reports/unitForm3cView','ReportsController@getUnitForm3c');
    Route::post('reports/unitForm3cView','ReportsController@postUnitForm3c');
    Route::get('reports/unitForm3c','ReportsController@downloadUnitForm3c');

	#zone form3c
    Route::get('reports/zoneForm3cView','ReportsController@getZoneForm3c');
    Route::post('reports/zoneForm3cView','ReportsController@postZoneForm3c');
    Route::get('reports/zoneForm3c','ReportsController@downloadZoneForm3c');

	#HQ form3c
    Route::get('reports/hqForm3cView','ReportsController@getHQForm3c');
    Route::post('reports/hqForm3cView','ReportsController@postHQForm3c');
    Route::get('reports/hqForm3c','ReportsController@downloadHQForm3c');


    Route::get('reports/zonesBudgetView','ReportsController@getZonesBudget');
    Route::post('reports/zonesBudgetView','ReportsController@postZonesBudget');
    Route::get('reports/zoneBudget','ReportsController@downloadZoneBudget');

	Route::get('reports/zonesDistribution','ReportsController@zonalDistribution');
    Route::post('reports/zonesDistribution','ReportsController@postZonalDistribution');
    Route::get('reports/zoneDistribution','ReportsController@downloadZoneDistribution');

    Route::get('reports/zoneUnitsBudget','ReportsController@getZoneUnitsBudget');

    Route::get('reports/unitBudgetSummary','ReportsController@getSummaryUnitBudgetView');
    Route::post('reports/unitBudgetSummary','ReportsController@postSummaryUnitBudgetView');
    Route::get('reports/unitsBudgetSummary','ReportsController@downloadUnitSummaryBudget');

	Route::get('reports/zonesBudgetSummary','ReportsController@getSummaryZoneBudgetView');
    Route::post('reports/zonesBudgetSummary','ReportsController@postSummaryZoneBudgetView');
    Route::get('reports/budgetSummary','ReportsController@downloadSummaryBudget');


    Route::controller('Reports','ReportsController');


    #region Projections
    Route::get('projection/unitBudget','ProjectionsController@getUnitBudgetViewProjection');
    Route::post('projection/unitBudget','ReportsController@postUnitBudgetView');

    #endregion



    Route::get('kpis/index', 'KpisController@index');
    Route::get('kpis/objectives', 'KpisController@objective');
    Route::get('kpis/create/{id}', 'KpisController@create');
    Route::get('kpis/createKPI/{id}', 'KpisController@createKPI');
    Route::post('kpis/store', 'KpisController@store');
	Route::get('kpis/fields/{id}', 'KpisController@getFields');
	Route::post('kpis/fields/{id}', 'KpisController@postFields');
	Route::get('kpis/removeFld/{id}', 'KpisController@getRemoveField');
    Route::controller('kpis', 'KpisController');

	Route::get('refKpiFields', 'RefKpiFieldsController@index');
	Route::get('refKpiFields/create', 'RefKpiFieldsController@create');
	Route::post('refKpiFields/store', 'RefKpiFieldsController@store');
	Route::get('refKpiFields/edit/{id}', 'RefKpiFieldsController@edit');
	Route::post('refKpiFields/update/{id}', 'RefKpiFieldsController@update');
	Route::get('refKpiFields/delete/{id}', 'RefKpiFieldsController@destroy');
	Route::controller('refKpiFields', 'RefKpiFieldsController');

	Route::get('kpiEvaluation', 'KpiEvaluationsController@index');
	Route::get('kpiEvaluation/create/{id}', 'KpiEvaluationsController@create');
	Route::post('kpiEvaluation/store', 'KpiEvaluationsController@store');
	Route::get('kpiEvaluation/delete/{id}', 'KpiEvaluationsController@destroy');
	Route::get('kpiEvaluation/submit', 'KpiEvaluationsController@getSubmitted');
	Route::post('kpiEvaluation/submit', 'KpiEvaluationsController@postSubmitted');
	Route::get('kpiEvaluation/unlock/{id}', 'KpiEvaluationsController@unlock');
	Route::get('kpiEvaluation/unitReport/{id}', 'KpiEvaluationsController@getUnitReport');
	Route::post('kpiEvaluation/unitReport/{id}', 'KpiEvaluationsController@postUnitReport');
	Route::get('kpiEvaluation/zoneReport/{id}', 'KpiEvaluationsController@getZoneReport');
	Route::post('kpiEvaluation/zoneReport/{id}', 'KpiEvaluationsController@postZoneReport');
	Route::get('kpiEvaluation/report/{id}', 'KpiEvaluationsController@getOverallReport');
	Route::post('kpiEvaluation/report/{id}', 'KpiEvaluationsController@postOverallReport');
	Route::controller('kpiEvaluation', 'KpiEvaluationsController');


});



/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */



Route::get('home/index', 'HomeController@index');
Route::controller('home','HomeController');

// User change password
Route::get('user/change_password','UserController@getChangePassword');
Route::post('user/change_password','UserController@postChangePassword');

// User reset routes
Route::get('user/forgot','UserController@getForgot');

Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'UserController@getLogin'));

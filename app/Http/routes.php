<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */
#----------------------- VOTER LOGIN PAGE -------------------#
Route::get('/', 'VoteController@index');
Route::post('/voter_login', 'VoteController@voter_login');
Route::get('/voterDashboard', 'VoteController@voterDashboard');
Route::get('/voterLogout', 'VoteController@voterLogout');
// voter change password
Route::get('/voterChangePassword','VoteController@voterChangePassword');
Route::post('/voterChangePasswordInfo','VoteController@voterChangePasswordInfo');
// voter forget password
Route::get('/voterMobileNumberVerify','VoteController@voterMobileNumberVerify');
Route::post('/voterSendMobileVerificationCode','VoteController@voterSendMobileVerificationCode');
Route::get('/voterRecoverPassword/{id}','VoteController@voterRecoverPassword');
Route::post('/voterRecoverAccount','VoteController@voterRecoverAccount');
#----------------------- GIVEN VOTE PROCESS------------------#
Route::get('/givenVote', 'VoteController@givenVote');
// verify pin to vote
Route::get('/VerifyPinToVote/{election_id}', 'VoteController@VerifyPinToVote');
// input pin to verify
Route::get('/inputPinToVerify/{election_id}', 'VoteController@inputPinToVerify');
Route::post('/checkPinNumber', 'VoteController@checkPinNumber');
Route::get('/choseCandidateType/{election_id}/{pin}', 'VoteController@choseCandidateType');
Route::get('/choiceElectionCandidatePostToVote/{election_id}/{post_id}/{pin}', 'VoteController@choiceElectionCandidatePostToVote');

Route::post('/finalGivenVote', 'VoteController@finalGivenVote');
#----------------------- ADMIN ------------------------------#
Route::get('/admin', 'AdminController@index');
Route::post('/login', 'AdminController@login');
Route::get('/adminLogout', 'AdminController@adminLogout');
Route::get('/adminDashboard', 'DashboardController@adminDashboard');
Route::get('/adminChangePassword','AdminController@adminChangePassword');
Route::post('/adminChangePasswordInfo','AdminController@adminChangePasswordInfo');
Route::get('/mobileNumberVerify','AdminController@mobileNumberVerify');
Route::post('/sendMobileVerificationCode','AdminController@sendMobileVerificationCode');
Route::get('/recoverPassword/{id}','AdminController@recoverPassword');
Route::post('/recoverAccount','AdminController@recoverAccount');
// super admin add admin
Route::get('/addAdmin', 'AdminController@addAdmin');
Route::post('/addAdminInfo', 'AdminController@addAdminInfo');
Route::get('/manageAdmin', 'AdminController@manageAdmin');
#---------------------- POST -------------------------------#
Route::get('/addPost', 'PostController@addPost');
Route::post('/addPostInfo', 'PostController@addPostInfo');
Route::get('/managePost', 'PostController@managePost');
#---------------------- ELECTION ---------------------------#
Route::get('/addElection', 'ElectionController@addElection');
Route::post('/addElectionInfo', 'ElectionController@addElectionInfo');
Route::get('/manageElection', 'ElectionController@manageElection');
#--------------------- SYMBOL-------------------------------#
Route::get('/addSymbol', 'ElectionController@addSymbol');
Route::post('/addSymbolInfo', 'ElectionController@addSymbolInfo');
Route::get('/manageSymbol', 'ElectionController@manageSymbol');
#--------------------- VOTER ----------------------------#
Route::get('/addVoter', 'UserController@addVoter');
Route::post('/addVoterInfo', 'UserController@addVoterInfo');
Route::get('/regVoterVerify/{id}/{random_number}', 'UserController@regVoterVerify');
Route::get('/pendingVoterList', 'UserController@pendingVoterList');
Route::get('/activeVoterList', 'UserController@activeVoterList');
// update voter list by election
Route::get('/updateVoterList', 'UserController@updateVoterList');
Route::post('/updateVoterListInfo', 'UserController@updateVoterListInfo');
#-----------------------CANDIDATES--------------------------#
Route::get('/addCandidate', 'UserController@addCandidate');
Route::post('/addCandidateInfo', 'UserController@addCandidateInfo');
Route::get('/manageCandidate', 'UserController@manageCandidate');
#---------------------- ASSIGN CANDIDATE POST---------------#
Route::get('/addAssiognCandidatePost', 'PostController@addAssiognCandidatePost');
Route::post('/addCandidetPostInfo', 'PostController@addCandidetPostInfo');
Route::get('/manageAssiognCandidatePost', 'PostController@manageAssiognCandidatePost');
#---------------------- VOTE --------------------------------#
Route::get('/addVotingDateAndTime', 'VoteController@addVotingDateAndTime');
Route::post('/addVoteDateAndTimeInfo', 'VoteController@addVoteDateAndTimeInfo');
Route::get('/manageVotingDateAndTime', 'VoteController@manageVotingDateAndTime');
Route::post('/finalVote', 'VoteController@finalVote');
Route::get('/afterVoteSummary/{election_id}/{pin}/{session_id}/{random_number}', 'VoteController@afterVoteSummary');
Route::post('/voteDesicionAftetVote', 'VoteController@voteDesicionAftetVote');
Route::get('/changeMyVote/{election_id}/{pin}/{session_id}/{random_number}/{id}', 'VoteController@changeMyVote');
Route::post('/changeVote', 'VoteController@changeVote');
#---------------------- report-------------------------------#
Route::get('/postWiseElectionResultReport', 'ReportController@postWiseElectionResultReport');
Route::post('/postWiseElectionResultReportView', 'ReportController@postWiseElectionResultReportView');
Route::get('/electionVoterList', 'ReportController@electionVoterList');
Route::post('/getVoterList', 'ReportController@getVoterList');
Route::get('/voterVoteSummary', 'ReportController@voterVoteSummary');
Route::post('/getVoterVoteSummary', 'ReportController@getVoterVoteSummary');
Route::get('/electionResultReport', 'ReportController@electionResultReport');
Route::post('/electionResultReportView', 'ReportController@electionResultReportView');
#---------------------- print -------------------------------#
Route::post('/printElectionResultReport', 'PrintController@printElectionResultReport');
Route::post('/printFinalElectionResultReport', 'PrintController@printFinalElectionResultReport');



#-----------------------------EDIT POST----------------------------------#
Route::get('/editPost/{id}', 'PostController@editPost');
Route::post('/updatePostInfo', 'PostController@updatePostInfo');
#-----------------------------EDIT POST----------------------------------#
#--------------------------EDIT ELECTION---------------------------------#
Route::get('/editElection/{id}', 'ElectionController@editElection');
Route::post('/updateElectionInfo', 'ElectionController@updateElectionInfo');
#--------------------------EDIT ELECTION---------------------------------#
#--------------------------EDIT ADMIN---------------------------------#
Route::get('/editAdmin/{id}', 'AdminController@editAdmin');
Route::post('/updateAdminInfo', 'AdminController@updateAdminInfo');
#--------------------------EDIT ADMIN---------------------------------#
#--------------------------EDIT VOTER---------------------------------#
Route::get('/editVoter/{id}', 'UserController@editVoter');
Route::post('/updateVoterInfo', 'UserController@updateVoterInfo');
#--------------------------EDIT VOTER---------------------------------#
#--------------------------EDIT CANDIDATE---------------------------------#
Route::get('/editCandidate/{id}', 'UserController@editCandidate');
Route::post('/updateCandidateInfo', 'UserController@updateCandidateInfo');
#--------------------------EDIT CANDIDATE---------------------------------#


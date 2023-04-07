# Pharmacy Managment System


## ERD:
![pharmacyERD](https://user-images.githubusercontent.com/63107268/230602218-ddbb990e-1048-45cc-970f-bb6b5567c610.png)


## Routes:

  GET|HEAD  / .................................................................................................. index
  POST      _ignition/execute-solution . ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD  _ignition/health-check ............. ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST      _ignition/update-config .......... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD  addresses ...................................................... addresses.index › AddressController@index
  POST      addresses ...................................................... addresses.store › AddressController@store
  DELETE    addresses/{id} ............................................. addresses.destroy › AddressController@destroy
  GET|HEAD  addresses/{id} ................................................... addresses.show › AddressController@show
  PUT       addresses/{id} ............................................... addresses.update › AddressController@update
  GET|HEAD  api/address .................................................................. Api\AddressController@index
  POST      api/address .................................................................. Api\AddressController@store
  GET|HEAD  api/address/{id} .............................................................. Api\AddressController@show
  DELETE    api/address/{id} ........................................................... Api\AddressController@destroy
  PUT       api/address/{id} ............................................................ Api\AddressController@update
  PUT       api/client/{id} .............................................................. Api\ClientController@update
  GET|HEAD  api/client/{id} ............................................................... Api\ClientController@index
  GET|HEAD  api/email/resend/{id} .................................... verification.resend › Api\AuthController@resend 
  POST      api/login .................................................... auth.getToken › Api\AuthController@getToken 
  POST      api/orders .................................................................... Api\OrderController@create 
  GET|HEAD  api/orders ..................................................................... Api\OrderController@index 
  GET|HEAD  api/orders/{id} ................................................................. Api\OrderController@show 
  PUT       api/orders/{id} ............................................................... Api\OrderController@update 
  POST      api/register ................................................. auth.register › Api\AuthController@register 
  GET|HEAD  api/user ................................................................................................. 
  GET|HEAD  areas ................................................................. areas.index › AreaController@index 
  POST      areas ................................................................. areas.store › AreaController@store
  PUT       areas/{area} ........................................................ areas.update › AreaController@update
  DELETE    areas/{id} ........................................................ areas.destroy › AreaController@destroy  
  GET|HEAD  areas/{id} .............................................................. areas.show › AreaController@show  
  GET|HEAD  areas/{id}/edit ......................................................... areas.edit › AreaController@edit  
  GET|HEAD  clients ........................................................... clients.index › ClientController@index  
  POST      clients ........................................................... clients.store › ClientController@store  
  DELETE    clients/{id} .................................................. clients.destroy › ClientController@destroy  
  GET|HEAD  clients/{id} ........................................................ clients.show › ClientController@show
  PUT       clients/{id} .................................................... clients.update › ClientController@update
  GET|HEAD  clients/{id}/edit ................................................... clients.edit › ClientController@edit  
  GET|HEAD  doctors ........................................................... doctors.index › DoctorController@index
  POST      doctors ........................................................... doctors.store › DoctorController@store  
  POST      doctors/{doctor}/ban .................................................. doctors.ban › DoctorController@ban  
  POST      doctors/{doctor}/unban ............................................ doctors.unban › DoctorController@unban  
  GET|HEAD  doctors/{id} ........................................................ doctors.show › DoctorController@show  
  PUT       doctors/{id} .................................................... doctors.update › DoctorController@update  
  DELETE    doctors/{id} .................................................. doctors.destroy › DoctorController@destroy
  GET|HEAD  doctors/{id}/edit ................................................... doctors.edit › DoctorController@edit  
  POST      email/resend .................................... verification.resend › Auth\VerificationController@resend  
  GET|HEAD  email/verify ...................................... verification.notice › Auth\VerificationController@show  
  GET|HEAD  email/verify/{id}/{hash} ........................ verification.verify › Auth\VerificationController@verify  
  GET|HEAD  home ......................................................................... home › HomeController@index
  GET|HEAD  login ......................................................... login › Auth\LoginController@showLoginForm  
  POST      login ......................................................................... Auth\LoginController@login
  POST      logout .............................................................. logout › Auth\LoginController@logout  
  GET|HEAD  medicines ..................................................... medicines.index › MedicineController@index  
  POST      medicines ..................................................... medicines.store › MedicineController@store  
  GET|HEAD  medicines/{id} .................................................. medicines.show › MedicineController@show
  DELETE    medicines/{id} ............................................ medicines.destroy › MedicineController@destroy  
  GET|HEAD  medicines/{id}/edit ............................................. medicines.edit › MedicineController@edit  
  PUT       medicines/{medicine} ........................................ medicines.update › MedicineController@update  
  GET|HEAD  orders .............................................................. orders.index › OrderController@index  
  POST      orders .............................................................. orders.store › OrderController@store  
  GET|HEAD  orders/stauts/{id} .................................... orders.updatestatus › OrderController@updatestatus  
  DELETE    orders/{id} ..................................................... orders.destroy › OrderController@destroy  
  GET|HEAD  orders/{id} ........................................................... orders.show › OrderController@show  
  GET|HEAD  orders/{id}/edit ...................................................... orders.edit › OrderController@edit  
  PUT       orders/{orders} ................................................... orders.update › OrderController@update  
  GET|HEAD  password/confirm ....................... password.confirm › Auth\ConfirmPasswordController@showConfirmForm  
  POST      password/confirm .................................................. Auth\ConfirmPasswordController@confirm  
  POST      password/email ......................... password.email › Auth\ForgotPasswordController@sendResetLinkEmail  
  GET|HEAD  password/reset ...................... password.request › Auth\ForgotPasswordController@showLinkRequestForm  
  POST      password/reset ...................................... password.update › Auth\ResetPasswordController@reset  
  GET|HEAD  password/reset/{token} ....................... password.reset › Auth\ResetPasswordController@showResetForm  
  GET|HEAD  pharmacies ................................................... pharmacies.index › PharmacyController@index  
  POST      pharmacies ................................................... pharmacies.store › PharmacyController@store  
  GET|HEAD  pharmacies/restore/{pharmacy} ............................ pharmacies.restore › PharmacyController@restore  
  GET|HEAD  pharmacies/{pharmacy} .......................................... pharmacies.show › PharmacyController@show  
  PUT       pharmacies/{pharmacy} ...................................... pharmacies.update › PharmacyController@update  
  DELETE    pharmacies/{pharmacy} .................................... pharmacies.destroy › PharmacyController@destroy  
  GET|HEAD  pharmacies/{pharmacy}/edit ..................................... pharmacies.edit › PharmacyController@edit  
  GET|HEAD  register ......................................... register › Auth\RegisterController@showRegistrationForm  
  POST      register ................................................................ Auth\RegisterController@register  
  GET|HEAD  revenue ......................................................... revenues.index › RevenueController@index  
  GET|HEAD  sanctum/csrf-cookie .................... sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show  
  GET|HEAD  status/statusbarchart ................................... statusbarchart.data › ChartController@statusData  
  GET|HEAD  status/statuspiechart ................................... statuspiechart.data › ChartController@statusData  
  POST      stripe .................................................. stripe.post › StripePaymentController@stripePost  
  GET|HEAD  stripe/{price} ............................................... stripe.get › StripePaymentController@stripe
  
  
## Packages:
  
    
laravel/sanctum                         v3.2.1                Laravel Sanctum provides a featherweight authentication...   
laravel/ui                              v4.2.1                Laravel UI utilities and presets.
yajra/laravel-datatables                v9.0.0                Laravel DataTables Complete Package.
spatie/laravel-permission               5.10.0                Permission handling for Laravel 6.0 and up
webpatser/laravel-countries             dev-master 9d0cd97    Laravel Countries is a bundle for Laravel, providing Al...   
egulias/email-validator                 4.0.1                 A library for validating emails against several RFCs
cybercog/laravel-ban                    4.8.0                 Laravel Ban simplify blocking and banning Eloquent models.   
stripe/stripe-php                       v10.12.1              Stripe PHP Library


## Client API:

Register ----->POST---> http://127.0.0.1:8000/api/register     
Login    ----->POST--->http://127.0.0.1:8000/api/login      

Get Client By Id ---->GET--->http://127.0.0.1:8000/api/client/{id}
Update Client ---->PUT--->http://127.0.0.1:8000/api/client/{id}

Add New Address ---->POST--->http://127.0.0.1:8000/api/address
Get All Addresses ---->GET--->http://127.0.0.1:8000/api/address
Get Address By Id ---->GET-->http://127.0.0.1:8000/api/address/{id}
Update Address ---->PUT--->http://127.0.0.1:8000/api/address/{id}
Delete Address---->DELETE--->http://127.0.0.1:8000/api/address/{id}

Create New Order--->POST-->http://127.0.0.1:8000/api/orders
Get All Orders--->GET--->http://127.0.0.1:8000/api/orders
Get Order By Id --->GET--->http://127.0.0.1:8000/api/orders/{id}
Update Order--->PUT--->http://127.0.0.1:8000/api/orders/{id}
Resend Email Verification --->GET-->http://127.0.0.1:8000/api/email/resend/{id}

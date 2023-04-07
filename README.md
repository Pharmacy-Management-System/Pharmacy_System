# Pharmacy Managment System
<p align="center" >
  <img style = "width:150px; height:110px;border-radius:50%;" src="https://user-images.githubusercontent.com/81237428/230607665-ef41d0f9-52e6-4e21-b87d-6322b338e57c.gif" />
</p>

## Introduction
## Packages

laravel/sanctum                         v3.2.1                Laravel Sanctum provides a featherweight authentication...</br>
laravel/ui                              v4.2.1                Laravel UI utilities and presets.</br>
yajra/laravel-datatables                v9.0.0                Laravel DataTables Complete Package.</br>
spatie/laravel-permission               5.10.0                Permission handling for Laravel 6.0 and up</br>
webpatser/laravel-countries             dev-master 9d0cd97    Laravel Countries is a bundle for Laravel, providing Al...</br>   
egulias/email-validator                 4.0.1                 A library for validating emails against several RFCs</br>
cybercog/laravel-ban                    4.8.0                 Laravel Ban simplify blocking and banning Eloquent models.</br>  
stripe/stripe-php                       v10.12.1              Stripe PHP Library</br>

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

## ERD
![pharmacyERD](https://user-images.githubusercontent.com/63107268/230602218-ddbb990e-1048-45cc-970f-bb6b5567c610.png)


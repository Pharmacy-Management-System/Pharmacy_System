# PHARMACY MANAGMENT SYSTEM
<p align="center" style="margin-top:6%;margin-bottom:6%;">
  <img style = "width:140px; height:140px;" src="https://user-images.githubusercontent.com/81237428/230607665-ef41d0f9-52e6-4e21-b87d-6322b338e57c.gif" />
</p>

## INTRODUCTION
The Pharmacy Managment System is a Laravel web Application that used Most of Laravel Technologies for Pharmacies and Medical prescription purposes. 
The pharmacy Managment System Consists of Four Main Roles Like `admin`, `pharmacy`, `doctor` and `client`.</br>
The `admin` has a Full Access to the whole Parts of the system. The `pharmacy owner` has access on his Doctors and Orders. The `doctor` has access the orders. 
The `client` is the end user who can make any Order.</br>

## FEATURES
- Authuntication
- Email Verification
- Roles and Perimissions
- Auto Assign Order to the Closest Pharmacy Area
- Ban and UnBan Doctor
- Total Revenue of each Pharmacy 
- Email Notification
- Chart Statistics
- Stripe Payment
- Display Orders as Excel Sheet

## DEMO
🎬
We Hope That You are enjoying Watching Our Demo Video 
[Click Here](https://www.youtube.com/watch?v=6k82NfqhROo) 

## INSTALLATION
<pre>
- git clone 
- Composer install
- npm install
- cp .env-example .env
- php artisan migrate
- php artisan db:seed
- php artisan storage:link
- npm run build
- npm run dev
- php artisan serve
- php artisan schedule:work
</pre>
 
 ## CREATE ADMIN 
<pre>
php artisan create:admin --name="admin" --email=admin@admin.com --password=******
</pre>

## CLIENT APIs
<div align="center" style="width:100%">
    
|  METHODS      |         URI              | ACTIONS | 
| :---:         |         :---:            | :---: |   
| POST          | `/api/register`          | `Register` |
| POST          | `/api/login`             | `Login`  | 
| GET           | `/api/client/{id}`       | `Get Client By ID` | 
| PUT           | `/api/client/{id}`       | `Update Client` | 
| POST          | `/api/address`           | `Add New Address` | 
| GET           | `/api/address`           | `Get All Addresses` | 
| GET           | `/api/address/{id}`      | `Get Address By ID` | 
| PUT           | `/api/address/{id}`      | `Update Address` | 
| DELETE        | `/api/address/{id}`      | `Delete Address` | 
| POST          | `/api/orders`            | `Create New Order` | 
| GET           | `/api/orders/{id}`       | `Get Order By ID` | 
| PUT           | `/api/orders/{id}`       | `Update Order` | 
| GET           | `/api/email/resend/{id}` | `Resend Email Verification` | 
    
</div>    
   
## PACKAGES
<pre>
- laravel/sanctum                         v3.2.1                Laravel Sanctum provides a featherweight authentication
- laravel/ui                              v4.2.1                Laravel UI utilities and presets
- yajra/laravel-datatables                v9.0.0                Laravel DataTables Complete Package
- spatie/laravel-permission               5.10.0                Permission handling for Laravel 6.0 and up
- webpatser/laravel-countries             dev-master 9d0cd97    Laravel Countries is a bundle for Laravel, providing Al   
- egulias/email-validator                 4.0.1                 A library for validating emails against several RFCs
- cybercog/laravel-ban                    4.8.0                 Laravel Ban simplify blocking and banning Eloquent models  
- stripe/stripe-php                       v10.12.1              Stripe PHP Library
</pre>

## TECHNOLOGIES
- Laravel Framework
- MYSQL
- jQuery
- JavaSript
- Bootstrap
- HTML
- CSS
- SASS

## SUPPORT
If you like our work, feel free to </br>
⭐ this repository. It helps.

## AUTHORS
  - [Hager Abd El Galil](https://github.com/Hager-Abd-El-Galil)
  - [Mariam Reda Mokhtar](https://github.com/Mariam-Mokhtar)
  - [Radwa Hassan](https://github.com/RadwaHassan99)
  - [Rowan Tamer](https://github.com/rowantamer)
  - [Omnia Goher](https://github.com/Omnia-Goher)

<div align="center">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
    <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white"/>
    <img src="https://img.shields.io/badge/Chart.js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white"/>
    <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white"/>
    <img src="https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=Postman&logoColor=white"/>
    <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E"/>
    <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white"/>
    <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white"/>
</div>
  



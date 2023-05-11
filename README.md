## Laravel API Authentication

This is a Laravel package that provides easy-to-use API authentication using Laravel Passport. The package comes with pre-built controllers, middleware, and routes for registering users, authenticating users, and send opt on mail and phone number.



### Features

-   Register new users
-   Authenticate existing users
-   Pre-built controllers, and routes for easy integration into your Laravel application
-   Send otp on mail and phone number

## Installation package

To install the package, run the following command:

```
composer require bushart/apiauthentication
``` 

## Install Laravel Passport

```
composer require laravel/passport
```

Next, you should execute the passport:install Artisan command

```
php artisan passport:install
```

Finally, in your application's ``config/auth.php`` configuration file, you should define an ``api`` authentication guard and set the ``driver`` option to ``passport``. This will instruct your application to use Passport's ``TokenGuard`` when authenticating incoming API requests:

```
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
 
    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
```
For more information please visit the link: [Laravel Passport](https://laravel.com/docs/10.x/passport)

### Config file

1. Add the service provider to `app/config/app.php`
```
bushart\productmanagement\ApiAuthenticationServiceProvider::class,
```

#### Step 2: Setup Database Configuration

After successfully installing the laravel app then after configuring the database setup. We will open the ".env" file and change the database name, username and password in the env file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Enter_Your_Database_Name
DB_USERNAME=Enter_Your_Database_Username
DB_PASSWORD=Enter_Your_Database_Password
``` 

#### Now, run migration with following command:

```
php artisan migrate
```

#### Configure sender mail address in laravel .env file

##### .env file:
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=TLS
```
#### Create Twilio Account

First you need to create and add phone number. then you can easily get account SID, Token and Number.

Create Account from here: www.twilio.com.

Next add Twilio Phone Number

Next you can get account SID, Token and Number and add these in the .env file like bellow:
#### .env
```
TWILIO_ACCOUNT_SID=XXXXXXXXXXXXXXXXX
TWILIO_AUTH_TOKEN=XXXXXXXXXXXXX
TWILIO_NUMBER=+XXXXXXXXXXX
```

### Usage
The package comes with pre-built controllers, and routes for registering users, authenticating users. To use these features, simply include the package's routes in your Laravel application's routes/api.php file:

You can then make API requests to the following endpoints:

-   `/api/register`: Register a new user
-  `/api/login`: Authenticate an existing user and retrieve an access token
-  `/api/sendOtpEmail`: send otp on mail
-  `/api/sendOtpPhoneNumber`: send otp on phone number
-  `/api/verifyOtp`: Verify otp
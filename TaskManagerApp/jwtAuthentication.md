<h1>
<br>
<div align="center">
    <p>JWT Authentication</p>
</div>

</h1>

<br>

## Introduction
Here I'm going to explain how I implement authentication for my app.

<br>

<hr>
<br>

### <p align="center">  jwt package installation  </p>

The package used in this project is `tymon/jwt-auth` which you can install it like below:
```shell
 composer require tymon/jwt-auth
```
<h4> Add service provider </h4>

Add the service provider to the `providers` array in the `config/app.php` config file as follows:
```shell
'providers' => [
    ...
    
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
]

```
<h4> Publish the config </h4>

Run the following command to publish the package config file:

```shell
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
You should now have a `config/jwt.php` file that allows you to configure the basics of this package.


<h4> Generate secret key </h4>
This command will generate a key for you:

```shell
php artisan jwt:secret
```
This will update your `.env` file with something like `JWT_SECRET=something`.

It is the key that will be used to sign your tokens. How that happens exactly will depend on the algorithm that you choose to use.
<br>

<hr>

<br>

Go to [This](https://jwt-auth.readthedocs.io/en/docs/quick-start/) website to see how setup your `model` and `controller`
but remember you have to write your own middleware in `app/http/middleware/authenticate.php` and then use it in your 
constructor of your controller.


<hr>

### <p align="center">  Why `tymon/jwt-auth` package?  </p>
Because in this app our database is No-SQL (mongoDB) and `tymon/jwt-auth` is the best package I found to
implement authentication in Laravel project which connected to  mongoDB.

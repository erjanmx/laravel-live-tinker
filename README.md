# Laravel-live-tinker

Laravel-live-tinker allows you to live debug/test small parts of your Laravel application from the browser page

![Imgur](https://i.imgur.com/DRXevEn.png)

[Laravel's tinker command](https://github.com/laravel/tinker) allows to run any code you want as if you are inside your Laravel app. 

But what if you want to debug some part of your code, you must start up tinker, type the code, press enter, and quit tinker and everytime you make change in your code you have to run tinker all over again

This package helps you to run any line of code in your Laravel app environment in your favorite browser tab. No tinker launching, no typing or searching previously typed code.


## Installation

You can install the package via composer

> Install only in your dev-environment

```bash
composer require erjanmx/laravel-live-tinker --dev
```

> If you're using Laravel prior to version 5.5 you have to configure by adding Service Provider in your `/config/app.php`
>
> ```
> 'providers' => [
>     // other providers
>     
>     Erjanmx\LiveTinker\LiveTinkerServiceProvider::class,
>  ],
> ```

Publish assets via following command

```bash
php artisan vendor:publish --provider=Erjanmx\\LiveTinker\\LiveTinkerServiceProvider --tag=public
```

## Usage

If you do not have configured web-server we'll use Laravel's built-in one

``` bash
php artisan serve 
```

> Note
>
> Due to security reasons the following route will be available in `APP_DEBUG=true` mode only, which always must be set to `false` in production

Now just open http://**your-domain**/live-tinker (replace **your-domain** with your domain or `ip:port` given by `php artisan serve` command)

You should see editor window with php code highlighting (powered by [Ace Editor](https://github.com/ajaxorg/ace)) and the result window. Now you can type/copy any code or even whole classes and test them in your browser and everything will work as if it has been typed in tinker console command.

## Features

- No dependency
- Full Laravel environment support
- No need to reload page on code change
- Saves your code in local-storage (restores if browser window has restarted)
- Run all or only part of your code
- Code highlight via Ace Editor
- Quick run using keyboard commands
- Laravel-native errors by *Whoops*
- Test any plain PHP code

## Screenshots

### Work with your models 
![Imgur](https://i.imgur.com/0fyjv3n.png)


### Get errors with Whoops
![Imgur](https://i.imgur.com/d2owQjr.png)


### Plain PHP
![Imgur](https://i.imgur.com/G5lwHzx.png)


# License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

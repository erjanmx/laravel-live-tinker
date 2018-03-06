# Laravel live tinker
Live tinker allows you to interact with your Laravel application from the web page

[Laravel's tinker command](https://github.com/laravel/tinker) allows to run any code you want as if you are inside your Laravel app. 

But what if you want to debug some part of your code, you must start up tinker, type the code, press enter, and quit tinker and everytime you make change in your code you have to run tinker all over again

This package helps you to run any line of code in your Laravel app environment in your favorite browser tab. No tinker launching, no typing or searching previously typed code.


## Installation

You can install the package via composer:

```bash
composer require erjanmx/laravel-live-tinker
```

## Usage

If you do not have configured web-server we'll use Laravel's built-in one

``` bash
php artisan serve 
```

Now just open ```http://[your-domain]/live-tinker``` (replace `your-domain` with your domain or `ip:port` given by `php artisan serve` command)

This package uses [Ace Editor](https://github.com/ajaxorg/ace) to get php-editor in your browser

## Screenshots

### Work with your models 

![Imgur](https://i.imgur.com/0fyjv3n.png)

### Get errors with Whoops
![Imgur](https://i.imgur.com/d2owQjr.png)

### Plain PHP
![Imgur](https://i.imgur.com/G5lwHzx.png)

# Licence

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

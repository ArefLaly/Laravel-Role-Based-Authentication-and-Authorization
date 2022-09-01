# Role Based Authentication and Authorization - Laravel   `9.x`

A project which manage Role, Permissions and every actions of your Laravel application. A complete solution for Role based Access Control in Laravel.

**Default Username** 
```
Username - admin@123 
password - admin@123
```

## Requirements:
- Laravel   `9.7`
- Intervention Image 


## Versions:
- Laravel `9.x` & PHP -`8.x`
## Project Setup
Git clone -
```console
git clone https://github.com/ArefLaly/Laravel-Role-Based-Authentication-and-Authorization.git
```

Go to project folder -
```console
cd Laravel-Role-Based-Authentication-and-Authorization
```

Install Laravel Dependencies -
```console
composer install
```

Create `.env` file by copying `.env.example` file

Generate Artisan Key (If needed) -
```console
php artisan key:generate
```

Migrate Database with seeder -
```console
php artisan migrate --seed
```

Run Project -
```php
php artisan serve
```


## How it works
1. Login using Super Admin Default Credential -
    1. Username - `admin@123`
    1. Password - `admin@123`
2. Create Role and it's permissions
3. Create user and Assign Roles to user
5. Assign Multiple Role to user
6. Check by login with the new credentials.
7. If you've not enough permission to do any task, you'll get a warning message.


## Wanna talk with me
Please mail me at - aref.laly1397@gmail.com


## Support
If you like my work you may consider buying me a ☕ / 🍕

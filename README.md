#help
-- https://pusher.com/tutorials/multiple-authentication-guards-laravel

-- https://www.itsolutionstuff.com/post/laravel-6-multi-auth-authentication-tutorialexample.html

-- https://laravel-news.com/running-make-auth-in-laravel-6

-- https://www.itsolutionstuff.com/post/laravel-58-user-roles-and-permissions-tutorialexample.html

*** https://docs.spatie.be/laravel-permission/v3/basic-usage/multiple-guards/ 
*** https://docs.spatie.be/laravel-permission/v3/basic-usage/middleware/
*** https://github.com/spatie/laravel-permission/issues/565

#spa authentication
-- https://medium.com/@ripoche.b/create-a-spa-with-role-based-authentication-with-laravel-and-vue-js-ac4b260b882f


# clone and install project 
1. Clone GitHub repo for this project locally

``` git clone https://github.com/omelab/laraAuth.git ```

2. Install Composer Dependencies
``` composer install ```

3. Install NPM Dependencies
~~ npm install ~~
or if you prefer yarn 
~~ yarn ~~

4. Create a copy of your .env file
``` cp .env.example .env ```

5. Generate an app encryption key
```php artisan key:generate ```

6. Migrate the database
``` php artisan migrate ```

7. Seed the database
```php artisan db:seed``` 	
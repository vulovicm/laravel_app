Laravel 7.3.0 used and PHP version 7.4.2

1/clone project from link: https://github.com/vulovicm/laravel_app
2/ open project in your favourite IDE application
3/run command : composer install 
4/ create database with name "laravel_task" or choose you database name
5/ find file  ".env.example" (in root project) and remove ".example" from it(right click on it -> rename -> delete ".example") so you get ".env".In that file(".env") you will find code = 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306 
DB_DATABASE=laravel_task (database name)
DB_USERNAME= (database username)
DB_PASSWORD= (database passwoed if you have one ! )
6/ run migrations (will also populate seed for you) : 
sudo php artisan migrate:fresh --seed --force
It will create for you 2 Users (test1 and test2) and 4 Friendship types (requested , accepted , canceled , rejected).
7/ Run command in terminal "sudo php artisan serve"
and your ready to go !
In app root folder you will find exported postman collection "FriendRequestApi.postman_collection.json".Import collection in your postman app.You'll find two folders "Auth" and "Friendship".Auth folder is for autentification and Friendship folder is for the requests about sending/accepting/canceling/rejecting frienship request.
As you can see i used {{base_url}} in my case "127.0.0.1" if there is a need please change it.
Also when you hit login API token will be auto stored in "token" variable for other API-s.
Register API is without token so you don't need to logg in for "register" API.
Docker is not implemented.
# Laravel Imageboard
I've been working on this project in order to learn laravel<br>
A simple imageboard made with laravel and mysql. 
This project is heavily inspired by <a href='https://lainchan.org/'>lainchan</a>

## How to use
You will need php 8 to run this project, make sure to edit your <code>php.ini</code> file in order to support larger file handling and to run the project smoothly

After cloning the project (inside the project folder)<br>
<code>composer install</code>

Copy the <code>.env.example</code> and rename it to <code>.env</code> and set up your e-mail and database information

Then generate the project's key<br>
<code>php artisan key:generate</code>

To run the site<br>
<code>composer run dev</code>

To run the post deletion/archiving script<br>
<code>php artisan schedule:work</code>

(currently to give admin privileges the sysadmin will have to update the database manually, <code>update users set isAdmin = 1 where id = ?</code>)


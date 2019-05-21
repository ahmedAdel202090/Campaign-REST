<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Setup Configuration
- download composer from this link (https://getcomposer.org/download/)
- after cloning project go to project path and run this command <b>composer install</b>
- create database and put its name in .env file to DB_DATABASE
- Run this command <b>php artisan migrate</b>

## Running
<p align="center">To Run this Code by Using API for Creating Campaign and UI to figure out chart</p>
<p><b>APIs</b>:<br/>
  -Create new Campaign with body {<br/>
    "name":{"campaign-name"},<br/>
    "country":{"campaign-country"},<br/>
    "budget":{"campaign-budget"},<br/>
    "goal":{"campaign-goal"},<br/>
    "category":{"campaign-category"}//optional choice<br/>
    }<br/>
      `the API path curl`:<b>{host-name}/public/campaign/create</b></p>

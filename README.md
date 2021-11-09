

<h1 align="center">Project Instruction</h1>




#  challenge app using laravel and vuejs
> description
<br>
the project is a simple store of products and categories with simple operation
like delete add and view products
<br>
<a href="http://159.65.25.101/" target="_blank"> is deployed now on digital ocean and is runing inside a docker environment </a>

## Installing / Getting started

to setup the project on ur machine please follow those command bellow


first clone this projct using


```shell
git clone https://github.com/amine620/codingChallenge
```

and  run this command to create vendor folder with all required dependencies of project

```shell
composer update
```


npm install to create node_moudules folder with all required dependencies of project

```shell
npm install
```

if you are using yarn

```shell
yarn install
```

then run this command to complie all css and js file 


```shell
npm run dev
```


## Developing

### Built With
laravel vuejs
### Prerequisites

node v8 or +
<br>
php 7.4 or +
<br>
composer v2 or +


### Setting up Dev

use this commend to generate your own key inside project

```shell
php artisan key:generate
```


and use this to create storage folder

```shell
php artisan storage:link
```



### Building

create your database first and run this command to migrate all tables

```shell
php artisan migrate
```

run this command to add some fake data to play with

```shell
php artisan db:seed
```



## Tests

to run automate test run this command

```shell
php artisan test
```

## Style guide

this project use DRY KISS style 

each line of code has comment to describe the complexity of code

## Api Reference

all of routes endpoint found in api.php 


## Database

database used is mysql database for the project and for the unit test

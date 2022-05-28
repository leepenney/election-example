# Election App Example

A simple form-based app to record visitor's intentions to vote in an upcoming (fictious) general election.

The site is currently hosted at: [http://178.62.40.223/](http://178.62.40.223/)

## Installation

### Requirements

* PHP 8
* MySQL 8

### Installation steps

To install and run the app:

1. Clone this repo
2. In the project folder, run `composer install`
3. Install the NPM dependencies by running `npm install`
4. Create your own .env file using `cp .env.example .env` and updating the values inside
5. Generate an app encrypion key using `php artisan key:generate`
6. Create an empty database called *voting_poll*
7. Update the *.env* file you created with details of the database connection
8. Create the database tables using `php artisan migrate`
9. (optional) Add example data to the tables using `php artisan db:seed`

## Technologies used

* Backend framework: Laravel 8
* Frontend framework: Vue 2
* Database: MySQL

## Data

The list of constituencies is loaded from the constituencies table [source](https://services1.arcgis.com/ESMARspQHYMw9BZ9/arcgis/rest/services/Westminster_Parliamentary_Constituencies_December_2020_UK_BUC/FeatureServer/0/query?where=1%3D1&outFields=PCON20NM,PCON20CD&outSR=4326&f=json&returnGeometry=false)

The list of parties is loaded from the parties table [source](https://www.parliament.uk/about/mps-and-lords/members/parties/)

### Table structure

#### constituencies

Column Name | Datatype
--- | ---
c_id | VARCHAR
c_name | VARCHAR

#### parties

Column Name | Datatype
--- | ---
p_id | BIGIINT
p_name | VARCHAR

#### responses

Column Name | Datatype
--- | ---
r_id | BIGINT
r_constituancy | VARCHAR
r_voting | TINYINT
r_party | VARCHAR

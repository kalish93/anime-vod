# Anime VOD Project

This project allows you to import and display top anime information from the Jikan API. The backend is built using Laravel and is responsible for fetching data from Jikan, storing it in a MySQL database, and exposing API endpoints for accessing the anime data.

## This project uses the following technologies:

- Backend: Laravel (PHP Framework)
- Database: MySQL
- API: Jikan API (External Service)
Setup
## Follow the steps below to set up and run the project locally.

### 1. Clone the Repository
Clone the repository to your local machine using Git:

```git clone https://github.com/fikremariamF/anime-vod.git```
### 2. Install Dependencies
Navigate to the backend directory (or the directory where the Laravel backend resides):

```cd anime-vod```
Then, install the required PHP dependencies using Composer:

```composer install```
If you don't have Composer installed, you can follow the instructions to install Composer here: https://getcomposer.org/download/.

## 3. Set Up the Database
Create a database for the project. You can use tools like phpMyAdmin, MySQL Workbench, or the MySQL command line.

Configure the Database Connection: In the .env file in the backend directory, set the correct database configuration values for DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD based on your local setup.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=anime_vod
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
Run Migrations: After configuring the database, run the Laravel migrations to set up the database tables:

```php artisan migrate```
This will create the necessary tables in the database.

### 4. Running the Project Locally
Run the Laravel Development Server:

```php artisan serve```
By default, this will run the backend on http://localhost:8000.

### 5. Access the API
Once the server is running, you can access the API at the following URLs:

API Base URL: http://localhost:8000/api
## Running the Import Command
The Laravel backend includes a console command that fetches the top 100 anime data from the Jikan API and stores it in the database.

Run the Import Command:
You can run the import command via the terminal:

```php artisan import:anime```
This will fetch anime data and save it to your database.

## API Endpoints
The backend provides the following API endpoints:

1. Get Anime Data by Slug
```Endpoint: /api/anime/{slug}
Method: GET
Description: Fetches anime data for a given anime slug in the requested language.
Parameters:
slug (string): The slug of the anime (e.g., fullmetal-alchemist).
lang (string): Language code (e.g., en or pl).
```

Example Request:

GET /api/anime/frieren-beyond-journeys-end?lang=en
Example Response:

```
{
    "anime": {
        "id": 1,
        "mal_id": 52991,
        "titles": {
            "en": {
                "title": "Frieren: Beyond Journey's End",
                "slug": "frieren-beyond-journeys-end"
            },
            "pl": {
                "title": null,
                "slug": ""
            }
        },
        "synopsis": "During their decade-long quest to defeat the Demon King, the members of the hero's party—Himmel himself, the priest Heiter, the dwarf warrior Eisen, and the elven mage Frieren—forge bonds through adventures and battles, creating unforgettable precious memories for most of them.\n\nHowever, the time that Frieren spends with her comrades is equivalent to merely a fraction of her life, which has lasted over a thousand years. When the party disbands after their victory, Frieren casually returns to her \"usual\" routine of collecting spells across the continent. Due to her different sense of time, she seemingly holds no strong feelings toward the experiences she went through.\n\nAs the years pass, Frieren gradually realizes how her days in the hero's party truly impacted her. Witnessing the deaths of two of her former companions, Frieren begins to regret having taken their presence for granted; she vows to better understand humans and create real personal connections. Although the story of that once memorable journey has long ended, a new tale is about to begin.\n\n[Written by MAL Rewrite]",
        "created_at": "2024-11-06T14:14:31.000000Z",
        "updated_at": "2024-11-06T14:27:12.000000Z"
    }
}
}
```
If the provided slug does not exist in the requested language or the lang does not match, an error response will be returned with a 404 status.



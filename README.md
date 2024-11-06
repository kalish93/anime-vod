Anime VOD Project
Description
This project allows you to import and display top anime information from the Jikan API. The backend is built using Laravel and is responsible for fetching data from Jikan, storing it in a MySQL database, and exposing API endpoints for accessing the anime data.

Table of Contents
Technologies
Setup
Running the Project Locally
Database Setup
Environment Variables
Running Tests
API Endpoints
Contributing
License
Technologies
This project uses the following technologies:

Backend: Laravel (PHP Framework)
Database: MySQL
API: Jikan API (External Service)
Setup
Follow the steps below to set up and run the project locally.

1. Clone the Repository
Clone the repository to your local machine using Git:

bash
Copy code
git clone https://github.com/your-username/anime-vod-project.git
2. Install Dependencies
Navigate to the backend directory (or the directory where the Laravel backend resides):

bash
Copy code
cd backend
Then, install the required PHP dependencies using Composer:

bash
Copy code
composer install
If you don't have Composer installed, you can follow the instructions to install Composer here: https://getcomposer.org/download/.

3. Set Up the Database
Create a database for the project. You can use tools like phpMyAdmin, MySQL Workbench, or the MySQL command line.

Configure the Database Connection: In the .env file in the backend directory, set the correct database configuration values for DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD based on your local setup.

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=anime_vod
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
Run Migrations: After configuring the database, run the Laravel migrations to set up the database tables:
bash
Copy code
php artisan migrate
This will create the necessary tables in the database.

4. Set Up Environment Variables
If your project relies on any environment variables (such as API keys or secret keys), create an .env file in the root directory (or edit the existing one), and add the required variables.

Here is an example:

env
Copy code
APP_NAME=AnimeVOD
APP_ENV=local
APP_KEY=base64:randomgeneratedkey==
APP_DEBUG=true
APP_URL=http://localhost
JIKAN_API_KEY=your_jikan_api_key (optional if needed)
You may also need to configure other services, such as mailers or third-party APIs, depending on your project’s requirements.

5. Running the Project Locally
Backend (Laravel)
Run the Laravel Development Server:
bash
Copy code
php artisan serve
By default, this will run the backend on http://localhost:8000. You can change the port by passing an additional argument, like so:

bash
Copy code
php artisan serve --port=8080
6. Access the API
Once the server is running, you can access the API at the following URLs:

API Base URL: http://localhost:8000/api
Running the Import Command
The Laravel backend includes a console command that fetches the top 100 anime data from the Jikan API and stores it in the database.

Run the Import Command:
You can run the import command via the terminal:

bash
Copy code
php artisan import:anime
This will fetch anime data and save it to your database.

API Endpoints
The backend provides the following API endpoints:

1. Get Anime Data by Slug
Endpoint: /api/anime/{slug}
Method: GET
Description: Fetches anime data for a given anime slug in the requested language.
Parameters:
slug (string): The slug of the anime (e.g., fullmetal-alchemist).
lang (string): Language code (e.g., en or pl).
Example Request:
bash
Copy code
GET /api/anime/fullmetal-alchemist?lang=en
Example Response:
json
Copy code
{
  "id": 1,
  "title": "Fullmetal Alchemist",
  "slug": "fullmetal-alchemist",
  "description": "A story about alchemy, adventure, and a brotherhood...",
  "language": "en"
}
If the provided slug does not exist in the requested language or the lang does not match, an error response will be returned with a 404 status.



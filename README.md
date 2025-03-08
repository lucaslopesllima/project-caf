# Family Support Institution

This project aims to provide a platform for managing and registering beneficiaries, volunteers, and projects within the support institution. The goal is to streamline the organization and monitoring of the institution's actions, facilitating a more efficient connection between those involved and the family support initiatives.

## Features

- **Beneficiary Registration**: Register information about families and individuals who receive support from the institution, including personal details, needs, and attendance history.
- **Volunteer Registration**: Register volunteers willing to offer their time and skills to assist in the institution's projects.
- **Project Management**: Register and track the institution's projects, including information on objectives, deadlines, responsible individuals, and statuses.
- **Activity Monitoring**: Link volunteers to projects and effectively provide support to families.
- **Person Evaluation via Questionnaire**: Evaluate beneficiaries and volunteers through questionnaires, supporting the full CRUD (Create, Read, Update, Delete) operations for managing questionnaires and their responses.

## Technologies Used

- **Backend**: [Laravel](https://laravel.com/)
- **Database**: [MySQL](https://www.mysql.com/)
- **Authentication**: [Laravel Breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze)
- **Docker**: [Docker](https://www.docker.com/)
- **TailWind**: [TailWind](https://tailwindcss.com/)

## Running the Project Locally

### 1. Clone the Repository

Clone this repository to your local machine:
git clone https://github.com/lucaslopesllima/project-caf.git

## 2. Build and start the Docker containers:
docker-compose up --build

## 3. After the containers are running, run the Laravel migrations to set up the database:
docker compose exec app php artisan migrate

## 4. If needed, seed the database with initial data:
docker-compose exec app php artisan db:seed

## 5. Open your browser and navigate to:
http://localhost:8000

Project Structure<br>
app/: Contains the main backend code, such as controllers, models, and services.<br>
database/: Contains migrations, factories, and seeds to set up database tables and initial data.<br>
routes/: Defines the project's routes (such as API and web pages).<br>
resources/: Contains view files (if applicable) and translations.<br>
public/: Public files such as images, CSS, and JavaScript.<br>
tests/: Contains the project's automated tests.<br>
docker/: Contains Docker configuration files (e.g., Dockerfile, docker-compose.yml)<br>


Contributing
If you want to contribute to this project, follow these steps:

Fork this repository.
Create a new branch (git checkout -b my-new-feature).
Make your changes and add tests, if necessary.
Submit a pull request with a clear description of your changes.

License
This project is licensed under the MIT License - see the LICENSE file for more details.

This version includes Docker setup instructions for local development. Let me know if you need further modifications! 🚀


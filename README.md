# Steps to Download and Install a Laravel Project

1. **Clone the project**: Download the project using the following command:
   > git clone git@github.com:Asmaa-izz/academic_networks.git

2. **Navigate to the project folder**:
   >cd academic_networks

3. **Install dependencies**: Make sure you have Composer installed, then run:
   >composer install

4. **Set up the environment file**: Copy the `.env.example` file and rename it to `.env`:
   > cp .env.example .env

5. **Generate the application key**:
   > php artisan key:generate

6. **Configure the database**:
    - Update the database settings in the `.env` file, such as database name, username, and password.
    - Run the migrations to set up the tables:
      > php artisan migrate --seed

7. **Install NPM dependencies and compile assets**:
   > npm install && npm run dev

8. **Start the development server**:
   > php artisan serve

You can now access the project in your browser at: `http://localhost:8000`

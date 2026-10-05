# Portfolio – Oyema Micheal

PHP + MySQL portfolio site, set up to deploy on Render with Docker.

## Before pushing
Copy these folders from your original project into this one:
`inc/`, `classes/SystemSettings.php`, `dist/`, `admin/`, `uploads/` (and any other folders).
Do NOT overwrite the new `classes/DBConnection.php`, `config.php` or `initialize.php`.

## Database
1. Export `db_freelance` from phpMyAdmin locally (Export -> SQL).
2. Create a free MySQL database with a cloud provider.
3. Import the .sql file into it.

## Render
New -> Web Service -> connect this repo (Docker is detected automatically).
Environment variables:

| Key       | Value                                   |
|-----------|-----------------------------------------|
| BASE_URL  | https://your-app.onrender.com/ (keep trailing slash) |
| DB_HOST   | from your MySQL provider                |
| DB_PORT   | from your MySQL provider                |
| DB_USER   | from your MySQL provider                |
| DB_PASS   | from your MySQL provider                |
| DB_NAME   | your database name                      |
| DB_SSL    | true (if your provider requires SSL)    |

Note: uploaded files on Render's free plan are wiped on restart.
Commit images to the repo instead of uploading through the admin panel.

# Web-Based Portfolio Management System – Oyema Micheal

PHP + MySQL portfolio site with an admin panel, ready to deploy on Render (free).

## Deploy on Render
1. Render -> New -> Web Service -> connect this GitHub repo.
2. Language/Runtime: Docker. Instance type: Free.
3. Environment variable (recommended): `ADMIN_PASSWORD` = a strong password.
4. Create Web Service. Site: `https://<name>.onrender.com`, admin: `/admin`.

The database runs inside the container and is loaded from `database/db_freelance.sql`
every time the service starts. Edits made in the online admin panel are lost when the
free service restarts or sleeps. To change content permanently: edit locally in XAMPP,
export the database from phpMyAdmin, replace `database/db_freelance.sql`, commit and push.

## Optional: permanent external MySQL
Set `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME` (and `DB_SSL=true` if required)
and the built-in database is skipped.

## Local (XAMPP)
Put this folder at `C:\xampp\htdocs\freelance` and open http://localhost/freelance/

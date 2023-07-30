# Internship Project - README

## Project Overview

This repository contains the codebase for the Internship Record System, a web application designed to manage and track intern details during their internship program.

## Features

The Internship Record System offers the following features:

- **Intern Registration:** Interns can create an account and log in to the system.
- **Personal Details:** Interns can fill in their personal information, including name, index number, programme of study, school of practice, town, district, class assigned, subjects taught, year of internship, mentor ID, and headmaster's name.
- **Data Validation:** The system validates the input data to ensure accurate and consistent records.
- **Update Information:** Interns can edit and update their personal details if needed.
- **Dashboard:** Upon logging in, interns are redirected to a dashboard displaying links to various forms they need to fill out during their internship.
- **Form Filling:** Interns can access and complete different forms related to their internship tasks.
- **Release Management:** The project uses releases to manage stable versions of the application.

## Project Structure

The project is organized into the following main directories:

- `intern`: Contains PHP scripts and related files for handling intern-related functionalities, such as submitting personal details and viewing forms.
- `db_connection`: Includes files for establishing a database connection and executing SQL queries.
- `styles`: Contains CSS files for styling the web pages.
- `forms`: Contains PHP files for the various internship forms that interns can fill out.

## How to Use

To get started with the Internship Record System, follow these steps:

1. Clone the repository to your local development environment:
<pre><code>git clone https://github.com/KwameGilbert/Intern-Record-System.git</code><pre/>

2. Set up a local development environment with a web server (e.g., Apache) and PHP (>=7.0) support.

3. Import the database schema provided in `db_connection/intern_record_system.sql` to set up the required database tables.

4. Configure the database connection by editing the credentials in `db_connection/db_connection.php`.

5. Launch the web application in your browser by accessing the appropriate URL (e.g., http://localhost/Intern-Record-System/intern/intern_login.php).

## Future Improvements

- Implement user authentication to ensure secure access to intern details and forms.
- Enhance the dashboard layout and styling for a more user-friendly experience.
- Add the ability for administrators to generate reports based on intern activities.

## Contributors

<a href="https://github.com/KwameGilbert">Gilbert Elikplim Kukah</a> - Developer and maintainer.



## Contact

For any questions or support, please reach out to 
Email: kwamegilbert1114@gmail.com.

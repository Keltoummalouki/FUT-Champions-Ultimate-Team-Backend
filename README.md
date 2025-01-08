# FUT Champions Ultimate Team Backend

## Description
This project focuses on developing the backend for the FUT Champions Ultimate Team platform using **PHP procedural programming** and **MySQLi**. The application manages players, teams, nationalities, and related entities while providing internationalization support and a dynamic dashboard for statistics visualization.

## Features
### Core Features
1. **Data Optimization:**
   - Analyze the provided JSON file to design an optimized database structure.
   - Implement normalization principles to avoid redundancy.

2. **Entity Management:**
   - Add, modify, delete, and list entities such as players, teams, and nationalities.
   - Manage relationships (e.g., associating a player with a team and nationality).

3. **Dashboard and Statistics:**
   - View dynamic statistics such as player counts, nationality distributions, and team performance.
   - Visualize data using interactive charts via Chart.js.

4. **Internationalization (i18n):**
   - Support multiple languages.
   - Manage language files (e.g., `fr.php`, `en.php`, `es.php`).
   - Enable language switching from the dashboard.

### Bonus Features
- **AJAX Integration:**
  - Enable asynchronous operations like content loading and validation without reloading the page.
  - Improve user experience with modal-based actions.

- **Interactive Statistics:**
  - Render data insights using interactive graphs and charts.

## User Stories

### Epics and User Stories
#### Epic 1: Manage Players
- **US01:** As an administrator, I want to add, edit, delete, and list players to maintain an updated database.

#### Epic 2: Manage Teams
- **US02:** As an administrator, I want to create and manage teams to organize competitions efficiently.

#### Epic 3: Internationalization Support
- **US03:** As a user, I want to switch the interface language to my preference for better usability.

#### Epic 4: Statistics and Insights
- **US04:** As an administrator, I want to view key statistics on the dashboard to monitor platform usage effectively.

#### Epic 5: Enhanced User Experience
- **US05:** As a user, I want to perform actions without reloading the page to enhance my interaction with the platform.

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- A web server (e.g., Apache, Nginx)
- Composer (optional for dependency management)

### Setup Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repository/fut-champions-backend.git
   cd fut-champions-backend
   ```

2. Import the database schema:
   - Locate the `db.sql` file in the repository.
   - Import the file into your MySQL database using a tool like phpMyAdmin or the MySQL command line:
     ```bash
     mysql -u username -p database_name < db.sql
     ```

3. Configure the database connection:
   - Edit the `config.php` file and provide your database credentials:
     ```php
     <?php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', 'password');
     define('DB_NAME', 'fut_champions');
     ?>
     ```

4. Start the development server:
   ```bash
   php -S localhost:8000
   ```
   Access the application at `http://localhost:8000`.

## Usage
1. **Entity Management:**
   - Use the dashboard to manage players, teams, and nationalities.
   - Perform CRUD operations via the provided forms.

2. **Internationalization:**
   - Switch languages from the dropdown in the dashboard.

3. **Statistics:**
   - Navigate to the Statistics page to view data insights presented through interactive charts.

## Folder Structure
```
├── assets
│   ├── css
│   ├── js
│   └── images
├── includes
│   ├── db.php
│   ├── functions.php
│   └── i18n
│       ├── en.php
│       ├── fr.php
│       └── es.php
├── index.php
├── dashboard.php
├── players.php
├── teams.php
├── config.php
├── db.sql
└── README.md
```

## Security Practices
- **SQL Injection Prevention:**
  - Used prepared statements for database queries.

- **Input Validation:**
  - Validate and sanitize user inputs to avoid XSS attacks.

- **Error Handling:**
  - Implement robust error handling to capture and log exceptions.

## Contributing
Feel free to submit pull requests or file issues. Contributions are welcome to enhance features or fix bugs.

## License
This project is licensed under the MIT License.

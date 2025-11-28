# Login Dashboard Project

This project is a login system with a dashboard, separating the backend and frontend code for better organization and maintainability.

## Project Structure

```
login-dashboard-project
├── backend
│   ├── public
│   │   ├── index.php          # Entry point for the backend application
│   │   └── api.php            # Handles API requests
│   ├── src
│   │   ├── Controllers
│   │   │   ├── AuthController.php      # User authentication methods
│   │   │   └── DashboardController.php  # Dashboard rendering methods
│   │   ├── Middleware
│   │   │   ├── AuthMiddleware.php       # Checks user authentication
│   │   │   └── CsrfMiddleware.php       # CSRF token validation
│   │   ├── Models
│   │   │   └── User.php                  # User data model
│   │   ├── Services
│   │   │   ├── SessionService.php        # Manages user sessions
│   │   │   └── PasswordService.php       # Handles password hashing
│   │   └── Routes
│   │       ├── api.php                   # API routes
│   │       └── web.php                   # Web routes
│   ├── config
│   │   ├── app.php                       # Application configuration
│   │   └── database.php                  # Database connection settings
│   ├── tests
│   │   └── AuthTest.php                  # Unit tests for authentication
│   ├── composer.json                     # Composer dependencies
│   ├── .env.example                      # Example environment variables
│   └── phpunit.xml                       # PHPUnit configuration
├── frontend
│   ├── public
│   │   ├── index.html                    # Main HTML file for the frontend
│   │   └── dashboard.html                 # Dashboard HTML file
│   ├── src
│   │   ├── css
│   │   │   └── styles.css                # CSS styles for the frontend
│   │   ├── js
│   │   │   ├── main.js                   # Main JavaScript file
│   │   │   ├── api
│   │   │   │   ├── client.js             # API request functions
│   │   │   │   └── auth.js               # Authentication API functions
│   │   │   └── components
│   │   │       ├── login-form.js         # Login form component
│   │   │       ├── navbar.js              # Navigation bar component
│   │   │       └── dashboard.js           # Dashboard component
│   ├── tests
│   │   └── auth.spec.js                  # Frontend authentication tests
│   └── package.json                      # npm configuration
├── scripts
│   ├── dev.sh                            # Development mode script
│   └── start.sh                          # Production mode script
├── .gitignore                            # Files to ignore in version control
└── README.md                             # Project documentation
```

## Setup Instructions

1. **Clone the repository:**
   ```
   git clone <repository-url>
   cd login-dashboard-project
   ```

2. **Backend Setup:**
   - Navigate to the `backend` directory.
   - Install dependencies using Composer:
     ```
     composer install
     ```
   - Configure your environment variables by copying `.env.example` to `.env` and updating the values.

3. **Frontend Setup:**
   - Navigate to the `frontend` directory.
   - Install dependencies using npm:
     ```
     npm install
     ```

4. **Running the Application:**
   - For development mode, run the following script:
     ```
     ./scripts/dev.sh
     ```
   - For production mode, run:
     ```
     ./scripts/start.sh
     ```

## Usage

- Access the login page at `http://localhost:your-port/index.html`.
- After logging in, you will be redirected to the dashboard where you can manage your tickets.

## Testing

- Run backend tests using PHPUnit:
  ```
  ./vendor/bin/phpunit
  ```
- Run frontend tests using your preferred testing framework.

## License

This project is licensed under the MIT License.
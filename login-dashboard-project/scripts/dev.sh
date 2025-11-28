#!/bin/bash

# This script is for running the login-dashboard project in development mode.

# Navigate to the backend directory and start the PHP built-in server
cd backend/public
php -S localhost:8000 &

# Navigate to the frontend directory and start a local server (using a tool like http-server)
cd ../../frontend/public
http-server -p 3000 &

# Wait for a few seconds to ensure both servers are up
sleep 5

echo "Development servers are running:"
echo "Backend: http://localhost:8000"
echo "Frontend: http://localhost:3000"
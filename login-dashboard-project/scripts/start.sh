#!/bin/bash

# Start the backend server
php -S localhost:8000 -t backend/public &

# Start the frontend server
npx http-server frontend/public -p 3000 &

# Wait for both servers to start
wait

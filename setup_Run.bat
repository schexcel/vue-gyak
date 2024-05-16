@echo off

cd backend

echo Running Composer install in a new window...
start "Composer Install" cmd /c "composer install && echo Installation complete! && timeout /t 10"

cd..
cd frontend

echo Running npm install in a new window...
start "npm Install" cmd /c "npm install && echo Installation complete! && timeout /t 30"


timeout /t 33

echo Starting Apache server in another new window...
start "Apache Server" cmd /c "C:\xampp\apache\bin\httpd.exe && pause"


echo Starting MySQL server in another new window...
start "MySQL Server" cmd /c "C:\xampp\mysql\bin\mysqld.exe && pause"


cd..
cd backend


echo Starting Laravel server in another new window...
start "Laravel Server" cmd /c "php artisan serve && pause"
 
cd ..
cd frontend

echo Starting Laravel server in another new window...
start "npm run dev" cmd /c "npm run dev && pause"

start http://localhost:5173/
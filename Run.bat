

echo Starting Apache server in another new window...
start "Apache Server" cmd /c "C:\xampp\apache\bin\httpd.exe && pause"


echo Starting MySQL server in another new window...
start "MySQL Server" cmd /c "C:\xampp\mysql\bin\mysqld.exe && pause"


cd backend

echo Starting Laravel server in another new window...
start "Laravel Server" cmd /c "php artisan serve && pause"
 
cd ..
cd frontend

echo Starting Laravel server in another new window...
start "npm run dev" cmd /c "npm run dev && pause"

start http://localhost:5173/




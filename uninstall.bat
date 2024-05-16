@echo off

cd backend

echo Deleting vendor directory in a new window...
start "Delete vendor" cmd /c "rd /s /q vendor && echo Vendor directory deletion complete! && pause"

cd ..
cd frontend

echo Deleting node_modules directory in a new window...
start "Delete node_modules" cmd /c "rd /s /q node_modules && echo node_modules directory deletion complete! && pause"

@echo off
if not exist "resources\views\pages\home.blade.php.enhanced" (
    echo Enhanced backup not found. The current version is already the enhanced one.
    pause
    exit /b
)
echo Restoring enhanced home.blade.php...
copy /Y "resources\views\pages\home.blade.php.enhanced" "resources\views\pages\home.blade.php"
echo.
echo Enhanced version restored!
pause

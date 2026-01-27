@echo off
echo Rolling back home.blade.php to original version...
copy /Y "resources\views\pages\home.blade.php.backup" "resources\views\pages\home.blade.php"
echo.
echo Rollback complete!
echo.
echo To restore the enhanced version, run: restore-enhanced.bat
pause

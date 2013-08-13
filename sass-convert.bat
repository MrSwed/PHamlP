@echo off
echo %date% %time%
set php=d:\denwer\usr\bin\php.exe

%php% -n -q -f "%~dp0sass-console-convert.php" %1  %2

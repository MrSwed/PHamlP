@echo off
echo %date% %time%
set php=d:\denwer\usr\bin\php.exe
set log="%temp%\%~nx0.log"
if NOT %~1=="" (
 set log="%temp%\%~nx1.log"
)

%php% -n -q -f "%~dp0sass-console-convert.php" %1  %2 > %log% 2>&1
type %log%
find /i "error" %log% >nul  && (echo Some errors. See below && exit /b 1 )

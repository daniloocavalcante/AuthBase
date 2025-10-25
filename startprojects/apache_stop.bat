@echo off
cd /D %~dp0
cmd.exe /C start "" /MIN call "C:\xampp\killprocess.bat" "httpd.exe"
if not exist C:\xampp\apache\logs\httpd.pid GOTO exit
del C:\xampp\apache\logs\httpd.pid

:exit

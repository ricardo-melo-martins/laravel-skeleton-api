
Start-Process pwsh.exe -ArgumentList "-noexit", "-command php artisan route:list && php artisan serve"

Start-Process pwsh.exe "-command ./bin/docs.ps1"
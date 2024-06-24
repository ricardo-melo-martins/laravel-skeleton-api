
$laravelLog = "storage/logs/laravel.log"

Remove-Item -Path $laravelLog -Force

Start-Process pwsh.exe -ArgumentList "-WindowStyle 1", "-NonInteractive", "-command '' >> $laravelLog"

Start-Process pwsh.exe -ArgumentList "-noexit", "-command Get-Content -Path $laravelLog -Wait"

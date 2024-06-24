[void][System.Reflection.Assembly]::LoadWithPartialName("MySql.Data")

$DBHost = "localhost"
$DBUser = "root"
$DBPass = ""
$DBName = "laravel_api"
$arquivoSql = "./bin/db.sql"

&"$PSScriptRoot/engine.ps1"

$connectionString = "server=$DBHost;uid=$DBUser;pwd=$DBPass;"

$connection = New-Object MySql.Data.MySqlClient.MySqlConnection
$connection.ConnectionString = $connectionString
$connection.Open()

$command = $connection.CreateCommand()
$command.CommandText = "DROP DATABASE IF EXISTS  $DBName ;"
$command.ExecuteNonQuery()

# $command = $connection.CreateCommand()
# $command.CommandText = "CREATE DATABASE IF NOT EXISTS $DBName ;"
# $command.ExecuteNonQuery()

# $command.CommandText = "USE `$DBName`"
# $command.ExecuteNonQuery()

$scriptSql = Get-Content $arquivoSql
$command.CommandText = "$scriptSql"
$command.ExecuteNonQuery()

$connection.Close()

Write-Host "Banco de dados criado e script SQL executado com sucesso."

Start-Process pwsh.exe -ArgumentList "-noexit", "-command php artisan migrate"
Start-Sleep -Seconds 2

Start-Process pwsh.exe -ArgumentList "-noexit", "-command php artisan db:seed"
Start-Sleep -Seconds 2

Start-Process pwsh.exe -ArgumentList "-noexit", "-command php artisan schedule:run"
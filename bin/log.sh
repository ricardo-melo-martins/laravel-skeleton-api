#!/bin/bash

# Verifica se estamos no Windows
if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "cygwin" ]]; then
    # Usando PowerShell para ler o log
    Get-Content -Path "storage/logs/laravel.log" -Wait
else
    # Usando tail para ler o log (Linux ou macOS)
    tail -f storage/logs/laravel.log
fi
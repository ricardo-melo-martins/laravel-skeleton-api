
$pathToChrome = 'C:\Program Files\Google\Chrome\Application\chrome.exe'
$tempFolder = '--user-data-dir=c:\temp' # pick a temp folder for user data
$startmode = '' # --start-fullscreen or '--kiosk' is another option
$startPage = '--incognito http://localhost:8000/api/documentation'

Start-Process -FilePath $pathToChrome -ArgumentList $tempFolder, $startmode, $startPage

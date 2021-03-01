# Watson
Program engineering module project 

# Projekto ideja

Privačių klinikų lojalumo sistema Watson, skirta privačioms (odontologijos) klinikoms, padedanti pastarosioms palaikyti klientų lojalumą. Pagrindinis sistemos funkcionalumas – galimybė gydytojui registruoti apsilankiuso kliento informaciją sistemoje, kuri po nustatyto laiko išsiųstų jam elektroninį laišką, kuris primintų klientui apie jam kadaise klinikoje atliktas procedūras ir pasiūlytų apsilankyti dar kartą. Viso to prasmė – palaikyti ryšį tarp klinikos ir didelio kiekio klientų, taip išlaikant jų lojalumą.

Praėjus ilgam laiko tarpui, klientas gali pamiršti, kad lankėsi tam tikroje privačioje klinikoje, o esant dideliam klientų kiekiui, gydytojams gali būti sudėtinga visiems pacientams ranka išsiųsti priminimus. Watson sistema užtikrintų galimybę privačių klinikų gydytojams tai atlikti nesudėtingai.


## How to configure with docker

You can watch these videos for better understanding

[Part 1] (https://www.youtube.com/watch?v=ITOnpzkzlYM)
[Part 2] (https://www.youtube.com/watch?v=tcU5XwlEeRU)

Install some type of manager for git (Sourcetree "With gui", Git bash "CLI")
Install docker

Create a folder at root "D:\File_name"

Pull the latest version of the project into the "File_name" folder. Should look like this: "D:\File_name\Watson"

Create these folders inside "File_name":
	mysql
	nginx
	php
	docker-compose.yml
	watson(Should already exist if you pulled the project)

When creating the docker-compose.yml file watch the Part 1 video and do everything.
Everywhere where it should be "./app" write "./watson" - Directory of pulled project.
Use these versions:
	nginx:stable-alpine
	php:7.4-fpm
	mysql:5.6
	node:latest

For all the comands use Command prompt or Powershell
For all docker commands you should select "cd D:\File_name" folder and execute them there.
After that you need to execute the commands written in "cd D:\File_name\Watson"

Execute them as written.
```
composer install
composer require symfony/webpack-encore-bundle
npm install --force
npm run build
```

Now go to localhost:(Port that you set in docker.compose.yml nginx-service port)
Example "localhost:8080"
  
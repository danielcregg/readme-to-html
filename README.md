# readme-to-html

## Pre-requisites
1. Root access to a LAMP server

## Run the following command to install these files:
```bash
sudo apt -yqqq install composer && sudo composer require erusev/parsedown -n && sudo wget -Nqq https://raw.githubusercontent.com/danielcregg/readme-to-html/main/index.html https://raw.githubusercontent.com/danielcregg/readme-to-html/main/convert.php https://raw.githubusercontent.com/danielcregg/readme-to-html/main/readmeProcessor.js -P /var/www/html/
```

GitHub README to HTML
Prepend your standard GitHub README URL with http://yourserverip/ to view it as HTML.

Example: If the README URL is https://github.com/microsoft/vscode/blob/main/README.md, use http://yourserverip/https://github.com/microsoft/vscode/blob/main/README.md

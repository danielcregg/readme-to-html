# README to HTML Converter

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)

A lightweight PHP web application that converts GitHub README.md files into rendered HTML pages. Simply prepend your server URL to any GitHub README link to view it as a fully formatted HTML page.

## Overview

This tool fetches a GitHub repository's `README.md` file, parses the Markdown content using the [Parsedown](https://parsedown.org/) library, and renders it as clean HTML. It uses Apache's `mod_rewrite` to provide a seamless URL-based interface — no forms or extra clicks needed.

## Features

- **URL-Based Conversion** — Prepend your server address to any GitHub README URL to instantly view it as HTML
- **Markdown Parsing** — Powered by the Parsedown library for accurate Markdown-to-HTML conversion
- **Input Validation** — Validates URLs and provides clear error messages for invalid input
- **Apache Rewrite Rules** — Clean URL routing via `.htaccess` rewrite configuration

## Prerequisites

- A Linux server with root access
- Apache HTTP Server with `mod_rewrite` enabled
- PHP (7.4 or higher recommended)
- Composer (PHP dependency manager)

## Getting Started

### Installation

1. Enable Apache's rewrite module and allow `.htaccess` overrides:

   ```bash
   sudo a2enmod rewrite
   sudo sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
   sudo systemctl restart apache2
   ```

2. Install Composer, the Parsedown dependency, and the application files:

   ```bash
   sudo apt -yqqq install composer && \
   sudo composer require erusev/parsedown -n && \
   sudo wget -Nqq \
     https://raw.githubusercontent.com/danielcregg/readme-to-html/main/index.html \
     https://raw.githubusercontent.com/danielcregg/readme-to-html/main/convert.php \
     https://raw.githubusercontent.com/danielcregg/readme-to-html/main/.htaaccess \
     -P /var/www/html/
   ```

### Usage

Once installed, prepend your server's IP or domain to any GitHub README URL:

```
http://yourserverip/https://github.com/microsoft/vscode/blob/main/README.md
```

The application will fetch the raw README content from GitHub, parse the Markdown, and display it as a styled HTML page.

## Tech Stack

- **PHP** — Server-side Markdown fetching and parsing
- **Parsedown** — Markdown-to-HTML parser
- **HTML/CSS** — Frontend display
- **Apache mod_rewrite** — URL routing

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

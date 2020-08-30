# URL Shortener API

Small Laravel App which allow users to shorten standard URL's to make them easier to share.

## Prerequisites

1. Clone the repository to desired folder.
2. Browse to the selected folder through a terminal, execute: `composer install` and wait until it finishes.
3. The app requires an SQL database in order to work, so please create an empty using the following config:
`DB_CONNECTION=mysql`
`DB_HOST=127.0.0.1  `
`DB_PORT=3306       `
`DB_DATABASE=bcdemo `
`DB_USERNAME=root   `
`DB_PASSWORD=       `
(if you want to choose any configuration you will have to change the `.env` file of the project.)

### Getting Started

-Once fullfilled the prerequisites, within the BCDemo folder from a terminal execute:

1. `php artisan migrate:fresh`
2. `php artisan serve`

NOTE: As this app is supposed to work as a server for the following plugin too: https://github.com/gianstrippart/api-plugin please, keep running the artisan command in the background in order to work as intended.
## Authors

* **Gianluigi Strippoli** - [GianStrippArt](https://github.com/gianstrippart)

## License

License: GPLv3 
License URI: http://www.gnu.org/licenses/gpl-3.0.html

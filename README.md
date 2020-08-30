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

## Algorithm

To generate a Short URL the app simply takes a Long URL, saves it to the database and then generates the Short URL, setting arbitrarily the first part of the address to https://shr.tn/ and then adding a random 6 characters long string to it, and then saving it to the database too, among other data, using the following logic:

```php
    $link->name = session('guestUser');
    $longlink = $request->input('longlink');
    $validation = Validator::make($request->all(), [
        'longlink' => 'required|url'
    ]);
    if ($validation->fails())
    {
        return back()->with('error','Please, provide a valid URL format');
    }
    // Final code //
    $shortlink = 'https://shr.tn/'.Str::random(6);
    // Final code //

    $link->longlink = $longlink;
    $link->shortlink = $shortlink;
    $link->user_agent = $request->header('User-Agent');
    $link->save();
    return back()->with('success','Link was shortened successfully!');
```
In this case I opted for a cleaner code by using Laravel's `Str` Class to generate the string.


It can also be done manually by using something like:

```php
    // Old code //
    $data = 'abcdefghijklmnopqrstuvwxyz';
    $data = substr(str_shuffle($data), 0, 6);
    for ($i=0;$i<6;$i++){
        if($i%2 == 0){
            $data[$i] = strtoupper($data[$i]);
        }
    }
    $shortlink = 'https://shr.tn/'.Str::random(6);
    // Old code //
```

## Authors

* **Gianluigi Strippoli** - [GianStrippArt](https://github.com/gianstrippart)

## License

License: GPLv3 
License URI: http://www.gnu.org/licenses/gpl-3.0.html

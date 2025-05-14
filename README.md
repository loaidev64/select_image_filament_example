# How to install
```bash
git clone https://github.com/loaidev64/select_image_filament_example

cd select_image_filament_example

composer i

php artisan key:generate

php artisan migrate

php artisan make:filament-user
```

and then run the laravel project.

# What we did to implement the select component

## First
- downloaded some images and we created a folder called images in storage/app/public and we put the images inside of it.
- the images was .png and .svg

## Second
- we added to `filesystem.php`:
```php


        'images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images'),
            'url' => env('APP_URL') . '/storage/images',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

```
- added a blade directive in `boot` function:
```php
\Blade::directive('svg', function ($arguments) {
            // Funky madness to accept multiple arguments into the directive
            list($path, $class) = array_pad(explode(',', trim($arguments, "() ")), 2, '');
            $path = trim($path, "' ");
            $class = trim($class, "' ");

            // Create the dom document as per the other answers
            $svg = new \DOMDocument();
            $svg->load($path);
            $svg->documentElement->setAttribute("class", $class);
            $output = $svg->saveXML($svg->documentElement);

            return $output;
        });
```

## Third
- created a helper `SelectImageHelper.php`:
```php
class SelectImageHelper
{
    public static function component(): Forms\Components\Select
    {
        return Forms\Components\Select::make('image')
            ->options(static::getImages())
            ->allowHtml()
            ->searchable()
            ->required();
    }

    private static function getImages(): array
    {
        $files = Storage::disk('images')->allFiles();
        $images = [];
        foreach ($files as $file) {
            if (static::isPng($file)) {
                $images[$file] = '<img src="' . asset('storage/images/' . $file) . '" class="h-10 w-10" />';
            } else {
                $images[$file] = \Blade::render("@svg('" . storage_path('app/public/images/' . $file) . "', 'w-10 h-10')");
            }
        }
        return $images;
    }

    private static function isPng(string $image): bool
    {
        return str($image)->endsWith('.png');
    }
}

```
## Finally
- add `SelectImageHelper::component()` to your resource.
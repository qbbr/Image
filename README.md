Q_Image
=======

```php
require_once '/path/to/Image/Autoloader.php';
Q_Image_Autoloader::register();
```

Rotate
------

```php
$image = new Q_Image('1.jpg');
$image->rotate(180);
$image->output(); // output image to browser
//$image->save('2.jpg'); // or save to file
```

Flip
----

```php
$image = new Q_Image('1.jpg');
$image->flip(true); // horizontal
//$image->flip(false, true); // or vertical
//$image->flip(true, true); // or horizontal and vertical
$image->output();
//$image->save('2.jpg');
```

Filter
------

```php
$image = new Q_Image('1.jpg');
$image->filter(IMG_FILTER_GRAYSCALE);
// or multiple filters
$image->filter(array(
    IMG_FILTER_GRAYSCALE,
    IMG_FILTER_EMBOSS
));
$image->output();
```

Resize
------

```php
$image = new Q_Image('1.jpg');
$image->resize(100, 100, Q_Image_Manipulation_Resize::NONE); // do not save proportion
//$image->resize(100, 100, Q_Image_Manipulation_Resize::LARGER_SIDE); // proportion save
//$image->resize(100, 100, Q_Image_Manipulation_Resize::SMALLER_SIDE); // proportion save
$image->output();
```

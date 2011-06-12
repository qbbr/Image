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
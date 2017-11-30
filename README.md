# WordPress Environment

Abbreviated as **W18T**, is a wordpress library for easily getting the major environment variables.

## Hello World

```php
<?php

header( 'Content-Type: application/json' );

include_once 'W18T.class.php';

$environment = new W18T();

echo $environment;

?>
```

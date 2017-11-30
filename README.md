# WordPress Environment

Abbreviated as **W18T**, is a wordpress library for easily getting the major environment variables.

## Usage

```php
<?php

header('content-type: application/json');

include_once 'W18T.class.php';

$environment = new W18T();
echo $environment;

?>
```

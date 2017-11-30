# WordPress Environment

Abbreviated as **W18T**, is a wordpress library for easily getting the major environment variables.

## Quickstart

Enough of the bullshit. Let's dive in already.

```php
<?php

header( 'Content-Type: application/json' );

include_once 'W18T.class.php';

$environment = new W18T();

echo $environment;

?>
```

**Output**



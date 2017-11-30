# WordPress Environment

Abbreviated as **W18T**, is a wordpress library for easily getting the major environment variables.

Wordpress developers have a lot of concerns regarding the wordpress installation.
1. What wordpress version are my clients using?
2. What PHP version are my clients using?
3. Are my clients using Apache? or nginx? or IIS? and what version?

## Quickstart

Enough of the bullshit. Let's dive in!

```php
<?php

header( 'Content-Type: application/json' );

include_once 'W18T.class.php';

$environment = new W18T();

echo $environment;

?>
```

**Output**



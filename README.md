# Wordpress Environment

Abbreviated as **W18T**, is a wordpress library for easily getting the major environment variables.

Wordpress developers have a lot of concerns regarding the wordpress installations that their clients have.
1. What Wordpress version are my clients using?
2. What PHP version are my clients using?
3. Are my clients using Apache? or nginx? or IIS? and what version?
4. Are my clients using MySQL? or MariaDB? and what version?
5. What server machine are my clients using? Linux? or Windows? or Mac?

Considering all these when you are a developer became very necessary especially when trying to fix a bug.

## Quickstart

Enough of all those bullshit. Let's dive in!

```php
<?php

header( 'Content-Type: application/json' );

include_once 'W18T.class.php';

$environment = new W18T();

echo $environment;

?>
```

**Output**
```javascript
{
    "platform": {
        "name": "WordPress",
        "version": "4.9.1"
    },
    "interpreter": {
        "name": "PHP",
        "version": "5.5.36"
    },
    "web_server": {
        "name": "Apache",
        "version": "2.4.16"
    },
    "database_server": {
        "name": "MySQL",
        "version": "5.7.20"
    },
    "operating_system": {
        "name": "Darwin",
        "version": "17.0.0"
    }
}
```


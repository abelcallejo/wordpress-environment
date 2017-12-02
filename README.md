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
        "version": "7.2.0"
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

## More examples

Now let's get rid of the <?php ?> tags, the header() function, and the file include_once. Let's focus on getting the actual values.

```php
$environment = new W18T();

echo $environment->platform->version;           // 4.9.1
echo $environment->interpreter->version;        // 7.2.0
echo $environment->web_server->name;            // Apache
echo $environment->web_server->version;         // 2.4.16
echo $environment->database_server->name;       // MySQL
echo $environment->database_server->version;    // 5.7.20
echo $environment->operating_system->name;      // Darwin
echo $environment->operating_system->version;   // 17.0.0
```

## Sample plugin

I've made a very simple wordpress plugin that uses the W18T library. All you have to do is to:
1. **Download** the plugin - [w18t-sample-plugin.zip](https://github.com/abelcallejo/w18t-sample-plugin/archive/master.zip)
2. **Install** it in your wordpress
3. **Activate** the plugin
4. Go to the **Dashboard** &rsaquo; **W18T plugin**
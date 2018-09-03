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
        "version": {
            "major": 4,
            "minor": 4.9,
            "specific": "4.9.8",
            "raw": "4.9.8"
        }
    },
    "interpreter": {
        "name": "PHP",
        "version": {
            "major": 7,
            "minor": 7.2,
            "specific": "7.2.9",
            "raw": "7.2.9"
        }
    },
    "web_server": {
        "name": "Apache",
        "version": {
            "major": 2,
            "minor": 2.4,
            "specific": "2.4.34",
            "raw": "Apache\/2.4.34 (Unix) PHP\/7.2.9"
        }
    },
    "database_server": {
        "name": "MySQL",
        "version": {
            "major": 5,
            "minor": 5.6,
            "specific": "5.6.27",
            "raw": "5.6.27"
        }
    },
    "operating_system": {
        "name": "Darwin",
        "version": {
            "major": 17,
            "minor": 17.5,
            "specific": "17.5.0",
            "raw": "Darwin Kernel Version 17.5.0: Mon Mar  5 22:24:32 PST 2018; root:xnu-4570.51.1~1\/RELEASE_X86_64"
        }
    }
}
```

## More examples

Now let's get rid of the `<?php` `?>` tags, the `header()` function, and the file `include_once`. Let's focus on getting the actual values for realistic purposes.

```php
$environment = new W18T();

// Classic name and version
echo $environment->operating_system;            // "Darwin"
echo $environment->operating_system->version;   // "17.5.0"

// Is the version still supported? Get more detailed
echo $environment->operating_system->version->major;    // 17
echo $environment->operating_system->version->minor;    // 17.5

// Version of PHP?
echo $environment->interpreter->version;    // 7.2.9

// Version of Apache?
echo $environment->web_server->version;         // 2.4.34

// Version of MySQL?
echo $environment->database_server->version;    // 5.6.27

// Version of WordPress?
echo $environment->platform->version;           // 4.9.8
```

## Sample plugin

I've made a very simple wordpress plugin that uses the W18T library. All you have to do is to:
1. **Download** the plugin - [w18t-sample-plugin.zip](https://github.com/abelcallejo/w18t-sample-plugin/archive/master.zip)
2. **Install** it in your wordpress
3. **Activate** the plugin
4. Go to the **Dashboard** &rsaquo; **W18T plugin**
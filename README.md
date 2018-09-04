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
require_once 'W18T.class.php';
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

For realistic purposes, let's focus on getting the actual values.

```php
$environment = new W18T();

// Classic name and version
echo $environment->operating_system;            // "Darwin"
echo $environment->operating_system->version;   // "17.5.0"

// Is the version still supported? Get the numeric values that can be used for comparison
echo $environment->operating_system->version->major;    // 17
echo $environment->operating_system->version->minor;    // 17.5

// Version of PHP?
echo $environment->interpreter->version;        // "7.2.9"

// Version of Apache?
echo $environment->web_server->version;         // "2.4.34"

// Version of MySQL?
echo $environment->database_server->version;    // "5.6.27"

// Version of WordPress?
echo $environment->platform->version;           // "4.9.8"

// It works the same as above
echo $environment->platform->version->specific; // "4.9.8"
```

## Demo

I've made a very simple wordpress plugin that uses the W18T library. All you have to do is to:
1. **Download** the plugin - [w18t-sample-plugin-master.zip](https://github.com/abelcallejo/w18t-sample-plugin/archive/master.zip)
2. **Install** it in your wordpress
3. **Activate** the plugin
4. Go to the **Dashboard** &rsaquo; **W18T plugin**

## Installation

Integrating the W18T library to your project can be done in 3 ways. Select the method that suits you best.

### Method A

**Composer**. The current recommended way of installing libraries in PHP is by using a package manager. This simplifies the package management for PHP projects. For this method, installation is done by command-line.

1. Make sure you have installed Composer - [Installation procedure](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
2. Go to your working directory

```sh
cd /path/to/working-dir
```

3. Add the W18T library in your project's library packages

```sh
composer require abelcallejo/wordpress-environment:dev-master
```

4. In your PHP code, include the library like so:

```php
<?php
require_once '/path/to/working-dir/vendor/autoload.php';
$environment = new W18T();

echo $environment;
?>
```

### Method B

**Zip file**. The traditional way of installing libraries in PHP is by using compressed files. This intuitive-*vises* the package management for PHP projects. For this method, installation is done by user interface.

1. Download a Zip copy of the library - [wordpress-environment-2.0.zip](https://github.com/abelcallejo/wordpress-environment/archive/2.0.zip)
2. Decompress/unzip the downloaded file
3. In your PHP code, include the library like so:

```php
<?php
require_once '/path/to/working-dir/wordpress-environment/W18T.class.php';
$environment = new W18T();

echo $environment;
?>
```
### Method C

**Git**. The most helpful way of installing libraries in PHP is by using daily builds. This encourages developers to work-and-use packages with latest daily updates. For this method, installation is done by command-line.

1. Make sure you have installed Git - [Installation procedure](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
2. Go to your working directory

```sh
cd /path/to/working-dir
```

3. Add the W18T library in your project's library packages

```sh
git clone https://github.com/abelcallejo/wordpress-environment.git
```

4. In your PHP code, include the library like so:

```php
<?php
require_once '/path/to/working-dir/wordpress-environment/W18T.class.php';
$environment = new W18T();

echo $environment;
?>
```
## Releases

### Alpha

**1.0** - Bare values of the the environment variables. *Released December 2, 2017*

### Beta

**2.0** - Added numeric major and minor versions of the environment varialbles. *Released September 4, 2018*

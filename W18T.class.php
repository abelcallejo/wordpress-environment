<?php
/**
 * WordPress Environment (W18T)
 * @version 1.0
 * 
 * A wordpress library for getting major server environment variables
 * 
 * @license GNU Lesser General Public License version 3
 * @license https://opensource.org/licenses/LGPL-3.0
 * 
 * @author Abel Callejo <abelboy.callejo@gmail.com>
 */
include_once(__dir__."/W18T_Software.class.php");
include_once(__dir__."/W18T_Software_Version.class.php");

class W18T
    {
    public $platform;
    public $interpreter;
    public $web_server;
    public $database_server;
    public $operating_system;

    public function __construct()
        {
        /**
         * This block contains multiple sections for propagating values
         * Section 1 - Platform (WordPress)
         * Section 2 - Interpreter (PHP)
         * Section 3 - Web server (Apache, nginx, or IIS)
         * Section 4 - Database server (MySQL, or MariaDB)
         * Section 5 - Operating system (Linux, Windows, Darwin, etc)
         */
        
        /**
         * Section 1 - Platform
         */
        global $wp_version;
        
        $platform = new W18T_Software( "WordPress" );

        if( isset($wp_version) )
            {
            $platform->version = new W18T_Software_Version( $wp_version );
            }
        else{
            $platform->version = new W18T_Software_Version();
            $platform->error = "Unable to detect the version number. W18T only relies on the global wordpress variable called \$wp_version to get the version number. Make sure you are calling this inside a Wordpress theme or plugin.";
            }
        
        $this->platform = $platform;
        
        /**
         * Section 2 - Interpreter
         */
        $interpreter = new W18T_Software( "PHP" );
        $interpreter->version = new W18T_Software_Version( PHP_VERSION );
        
        $this->interpreter = $interpreter;
        
        /**
         * Section 3 - Web server
         */
        $web_server_information_string = $_SERVER['SERVER_SOFTWARE'];

        /**
         * Section 3.1
         * Break down the web server information string into value parts
         * based on the space-separated values
         */
        $web_server_value_parts_array = explode(" ", $web_server_information_string);

        /**
         * Section 3.2
         * Use the first value part to get the actual web server details
         */
        $web_server_parts = explode("/", $web_server_value_parts_array[0]);

        /**
         * Section 3.3
         * Prepare the web_server object to be stored
         * Make sure the server name does not contain a dash character (-)
         */        
        $web_server = new W18T_Software( str_replace("-", " ", $web_server_parts[0]) );
        $web_server->version = new W18T_Software_Version( $_SERVER['SERVER_SOFTWARE'] );
        
        $this->web_server = $web_server;
        
        /**
         * Section 4
         * 
         * Section 4.1
         * Create a connection to get the database server details
         */
        $database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

        /**
         * Section 4.2
         * Pupulate the name and version values
         */
        if( ! mysqli_connect_errno() )
            {
            if( strpos($database->server_info, "MariaDB") !== false )
                {
                $database_server = new W18T_Software( "MariaDB" );
                }
            else{
                $database_server = new W18T_Software( "MySQL" );
                }

            $result = $database->query("SELECT version() AS version");            
            $row = $result->fetch_assoc();
            $database_server->version = new W18T_Software_Version( $row['version'] );
            }
        else{
            $database_server = new W18T_Software();
            $database_server->version = new W18T_Software_Version();
            $database_server->error = "Unable to connect to the database. Make sure you are calling this inside wordpress.";
            }
            
        $this->database_server = $database_server;
        
        /**
         * Section 5
         */
        $operating_system = new W18T_Software( PHP_OS );
        $operating_system->version = new W18T_Software_Version( php_uname('v') );
        $this->operating_system = $operating_system;
        }

    public function __toString()
        {
        if( defined('JSON_PRETTY_PRINT') )
            {
            return json_encode($this,JSON_PRETTY_PRINT);
            }
        return json_encode($this);
        }
    }

?>
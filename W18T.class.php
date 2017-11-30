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
         * 
         * Section 1.1
         * Retrieve the value of the wordpress global variable
         * known as $wp_version
         */
        global $wp_version;
        
        /**
         * Section 1.2
         * Prepare the platform object to be stored
         */
        $platform = new stdClass();
        $platform->name = "WordPress";
        
        if( isset($wp_version) )
            {
            $platform->version = $wp_version;
            }
        else{
            $platform->version = "Unknown";
            $platform->error = "Unable to detect the version number. Make sure you are calling this inside wordpress.";
            }
        
        /**
         * Section 1.3
         * Store the platform object
         */
        $this->platform = $platform;
        
        /**
         * Section 2 - Interpreter
         * 
         * Section 2.1
         * Prepare the interpreter object to be stored
         */
        $interpreter = new stdClass();
        $interpreter->name = "PHP";
        $interpreter->version = PHP_VERSION;
        
        /**
         * Section 2.2
         * Store the interpreter object
         */
        $this->interpreter = $interpreter;
        
        /**
         * Section 3 - Web server
         * 
         * Section 3.1
         * In a safer way, retrieve the value of the super global variable
         * known as $_SERVER['SERVER_SOFTWARE']
         */
        $web_server_information_string = filter_input(INPUT_SERVER,'SERVER_SOFTWARE');

        /**
         * Section 3.2
         * Break down the web server information string into value parts
         * based on the space-separated values
         */
        $web_server_value_parts_array = explode(" ", $web_server_information_string);

        /**
         * Section 3.3
         * Use the first value part to get the actual web server details
         */
        $web_server_parts = explode("/", $web_server_value_parts_array[0]);

        /**
         * Section 3.4
         * Prepare the web_server object to be stored
         * Make sure the server name does not contain a dash character (-)
         */
        $web_server = new stdClass();
        $web_server->name = str_replace("-", " ", $web_server_parts[0]);
        $web_server->version = $web_server_parts[1];
        
        /**
         * Section 3.5
         * Store the web server object
         */
        $this->web_server = $web_server;
        
        /**
         * Section 4
         * 
         * Section 4.1
         * Prepare the database_server object to be stored
         */
        $database_server = new stdClass();

        /**
         * Section 4.2
         * Database details require a connection
         */
        $database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

        /**
         * Section 4.3
         * Pupulate the name and version values
         */
        if( ! mysqli_connect_errno() )
            {
            if( strpos($database->server_info, "MariaDB") !== false )
                {
                $database_server->name = "MariaDB";
                }
            else{
                $database_server->name = "MySQL";
                }

            $result = $database->query("SELECT version() AS version");            
            $row = $result->fetch_assoc();
            $database_server->version = $row['version'];
            }
        else{
            $database_server->name = "Unconnected";
            $database_server->version = "Unknown";
            $database_server->error = "Unable to connect to the database. Make sure you are calling this inside wordpress.";
            }
            
        $this->database_server = $database_server;

        
        /**
         * Section 5
         * 
         * Section 5.1
         * Prepare the operating_system object to be stored
         */
        $operating_system = new stdClass();
        $operating_system->name = PHP_OS;
        $operating_system->version = $this->extract_version_number_from( php_uname('v') );
        $this->operating_system = $operating_system;
        }

    public function extract_version_number_from( $haystack )
        {
        /**
         * Find candidate strings
         */
        preg_match('/((\d)+(\.|\D))+/',$haystack,$version_candidates_array);
        
        /**
         * Use the first candidate for declaring the version number
         */
        if( count($version_candidates_array)>0 && strlen($version_candidates_array[0])>0 )
            {
            // Replace dots with underscore so they belong to word characters
            $version_candidates_array[0] = str_replace(".","_",$version_candidates_array[0]);
            // Replace all non-word characters with and EMPTY string
            $version_candidates_array[0] = preg_replace('/[\W]/', '', $version_candidates_array[0]);
            // Revert back the dots from the temporary underscore strings
            $version_candidates_array[0] = str_replace("_",".",$version_candidates_array[0]);
            // Impose the version number
            $version = $version_candidates_array[0];
            }
        else{
            $version = "Unknown";
            }

        return $version;
        }
    
    public function __toString()
        {
        return json_encode($this,JSON_PRETTY_PRINT);
        }
    }

?>
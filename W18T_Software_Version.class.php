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

class W18T_Software_Version
    {
    public $major;
    public $minor;
    public $specific;
    public $raw;

    public function __construct( $raw_version_string="" )
        {
        if( empty( $raw_version_string ) )
            {
            $this->major = 0;
            $this->minor = 0;
            $this->specific = "Unknown";
            $this->raw = "Unknown";
            }
        else{
            $this->raw = $raw_version_string;
            $this->specific = $this->extract_version_number_from( $raw_version_string . " " );
            $this->major = $this->extract_major_version_from( $this->specific );
            $this->minor = $this->extract_minor_version_from( $this->specific );
            }
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
        
    public function extract_major_version_from( $haystack )
        {
        $numbers = explode( ".", $haystack );
        
        if( intval( $numbers[0] ) > 0 )
            {
            return intval($numbers[0]);
            }

        return 0;
        }

    public function extract_minor_version_from( $haystack )
        {
        $numbers = explode( ".", $haystack );

        if( floatval( $numbers[0] . "." . $numbers[1] ) > 0 )
            {
            return floatval( $numbers[0] . "." . $numbers[1] );
            }

        return 0;
        }



    public function __toString()
        {
        return $this->specific;
        }
    }

?>
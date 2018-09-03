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

class W18T_Software
    {
    public $name;
    public $version;

    public function __construct( $name="Unknown" )
        {
        $this->name = $name;
        }

    public function __toString()
        {
        return $this->name;
        }
    }

?>
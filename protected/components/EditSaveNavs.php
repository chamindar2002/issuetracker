<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditSaveNavs
 *
 * @author Oracle
 */
class EditSaveNavs {
    //put your code here
    public static function appendEditSaveNavlinks($identifier){
    
        echo "<div class='edit_save_links_placeholder' id=\"nav_$identifier\">";
        echo "<a id=\"enable_$identifier\">Edit</a> &nbsp; | &nbsp;";
        echo "<a id=\"disable_$identifier\">Cancel</a> &nbsp; | &nbsp;";
        echo "<a id=\"save_$identifier\">Save</a>";
        echo "</div>";
    }
}

?>

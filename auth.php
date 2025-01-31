<?php
/**
 * @author Mart Mangus
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 * Authentication Plugin: Ask for ID-number in login when it is not set
 *
 */

require_once($CFG->libdir.'/authlib.php');
require_once('insertidnumber_form.php');

class auth_plugin_askidnumber extends auth_plugin_base {

    /** Constructor */
    function auth_plugin_askidnumber() {
        $this->authtype = 'askidnumber';
    }

    function user_authenticated_hook($user) {
        global $CFG;
        if (!auth_insertidnumber_form::valid_estonian_idnumber($user->idnumber))
        {   // Here We ask to insert the correct ID-number
            $USER = complete_user_login($user);
            $goto = $CFG->wwwroot.'/auth/askidnumber/form.php';
            redirect($goto);
        }
    }
}


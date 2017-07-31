<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * This file is part of Auth_Ldap.

    Auth_Ldap is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Auth_Ldap is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Auth_Ldap.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * @author      Greg Wojtak <gwojtak@techrockdo.com>
 * @copyright   Copyright © 2010,2011 by Greg Wojtak <gwojtak@techrockdo.com>
 * @package     Auth_Ldap
 * @subpackage  auth demo
 * @license     GNU Lesser General Public License
 */
class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('Form_validation');
        $this->load->library('auth_ldap');
        $this->load->helper('url');
        $this->load->library('table');
    }

    function index() {
        $this->session->keep_flashdata('tried_to');
        $this->login();
    }

    function login($errorMsg = NULL) {
        $this->session->keep_flashdata('tried_to');
        if (!$this->auth_ldap->is_authenticated()) {
            // Set up rules for form validation
            $this->form_validation->set_rules('username', 'Username', 'required|alpha_dash');
            $this->form_validation->set_rules('password', 'Password', 'required');

            // Do the login...
            if ($this->form_validation->run() && $this->auth_ldap->login($this->form_validation->set_value('username'), $this->form_validation->set_value('password'))) {
                // Login WIN!
                if ($this->session->flashdata('tried_to')) {
                    redirect($this->session->flashdata('tried_to'));
                } else {
                    redirect('/portal/');
                }
            } else {
                // Login FAIL
                $this->load->view('auth/login_form', array('login_fail_msg' => 'Error with LDAP authentication.'));
            }
        } else {
            // Already logged in...
            redirect('/portal/');
        }
    }

    function logout() {
        if ($this->auth_ldap->is_authenticated()) {
            $data['name'] = $this->session->userdata('cn');
            $data['username'] = $this->session->userdata('username');

            $this->auth_ldap->logout();
        }

        $this->load->view('auth/logout_view', $data);
    }
}

?>

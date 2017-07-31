<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * hosts            - Array of ldap servers to try to authenticate against.
 * ports            - The remote port on the ldap server to connect to.
 * basedn           - The base dn of your ldap data store.
 * login_attribute  - LDAP attribute used to check usernames against.
 * proxy_user       - Distinguised name of a proxy user if your LDAP server does not allow anonymous binds.
 * proxy pass       - Password to use with above.
 * roles            - An array of role names to use within your app. The values are arbitrary.
 * member_attribute - Attribute to search to determine allowance after successful authentication.
 * internal_domain  - An internal domain to be used. If provided dn lookup will not be preformed.
 * auditlog         - Location to log auditable events. Needs to be writeable by the web server.
 *
 */

$config['hosts'] = array('ldap.mycompany.com');
$config['ports'] = array(389);
$config['basedn'] = 'dc=mycompany,dc=com';
$config['login_attribute'] = 'uid';
$config['proxy_user'] = '';
$config['proxy_pass'] = '';
$config['roles'] = array(
    1 => 'User',
    3 => 'Power User',
    5 => 'Administrator'
);
$config['member_attribute'] = 'memberUid';
$config['internal_domain'] = 'MYDOMAIN';
$config['auditlog'] = 'application/logs/audit.log';
?>
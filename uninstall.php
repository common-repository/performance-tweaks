<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Cleanup database entries after uninstall
$option_name1 = 'rhptp_contactform7_checkbox';
$option_name2 = 'rhptp_emoji_checkbox';
$option_name3 = 'rhptp_deferjs_checkbox';
$option_name4 = 'rhptp_asyncjs_checkbox';
$option_name5 = 'rhptp_removeqs_checkbox';
$option_name6 = 'rhptp_dns_checkbox';
$option_name7 = 'rhptp_xmlrpc_checkbox';
$option_name8 = 'rhptp_acf_checkbox';
$option_name9 = 'rhptp_heartbeat_checkbox';
$option_name10 = 'rhptp_revisions_checkbox';

delete_option($option_name1);
delete_option($option_name2);
delete_option($option_name3);
delete_option($option_name4);
delete_option($option_name5);
delete_option($option_name6);
delete_option($option_name7);
delete_option($option_name8);
delete_option($option_name9);
delete_option($option_name10);
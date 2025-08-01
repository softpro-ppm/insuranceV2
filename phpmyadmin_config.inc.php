<?php
/**
 * phpMyAdmin configuration for local Insurance Management System
 */

/* Servers configuration */
$i = 0;

/* Server: localhost */
$i++;
$cfg['Servers'][$i]['host'] = 'localhost';
$cfg['Servers'][$i]['port'] = '';
$cfg['Servers'][$i]['socket'] = '';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = 'insurance_user';
$cfg['Servers'][$i]['password'] = 'password123';

/* Additional settings */
$cfg['blowfish_secret'] = 'insuranceV2LocalDevelopment2025';
$cfg['DefaultLang'] = 'en';
$cfg['ServerDefault'] = 1;
$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';

/* Theme settings */
$cfg['ThemeDefault'] = 'bootstrap';
$cfg['NavigationTreePointerEnable'] = true;

/* Session settings */
$cfg['LoginCookieValidity'] = 3600;
$cfg['Servers'][$i]['AllowNoPassword'] = false;

/* Database-specific settings */
$cfg['Servers'][$i]['only_db'] = 'insurance_v2';
$cfg['ShowDbStructureCreation'] = true;
$cfg['ShowDbStructureLastUpdate'] = true;
$cfg['ShowDbStructureLastCheck'] = true;
$cfg['HideDbStructureCreation'] = false;
$cfg['HideDbStructureLastUpdate'] = false;
$cfg['HideDbStructureLastCheck'] = false;

/* Display settings */
$cfg['MaxRows'] = 25;
$cfg['Order'] = 'ASC';
$cfg['NavigationTreeDefaultTabTable'] = 'structure';
$cfg['NavigationTreeDefaultTabTable2'] = '';

/* Export settings */
$cfg['Export']['method'] = 'quick';
$cfg['Export']['format'] = 'sql';
$cfg['Export']['compression'] = 'none';
$cfg['Export']['charset'] = 'utf-8';

/* Import settings */
$cfg['Import']['charset'] = 'utf-8';

?>

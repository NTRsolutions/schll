<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-04-02 11:42:27 --> 404 Page Not Found: Frontend/autocomplete
ERROR - 2018-04-02 11:51:17 --> Severity: Parsing Error --> syntax error, unexpected 'return' (T_RETURN) E:\wamp64\www\school\mvc\models\Book_m.php 57
ERROR - 2018-04-02 11:54:08 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 11:56:09 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 11:56:36 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 11:57:39 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 11:59:09 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 11:59:42 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 11:59:55 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 12:00:16 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 12:00:28 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 12:00:30 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 12:01:00 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 12:01:05 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 12:01:10 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 12:29:12 --> Severity: Warning --> mail(): Failed to connect to mailserver at &quot;localhost&quot; port 25, verify your &quot;SMTP&quot; and &quot;smtp_port&quot; setting in php.ini or use ini_set() E:\wamp64\www\school\main\libraries\Email.php 1896
ERROR - 2018-04-02 12:29:13 --> Could not find the language line "mail_valid"
ERROR - 2018-04-02 12:29:38 --> Query error: Table 'school.conversations' doesn't exist - Invalid query: SELECT DISTINCT *
FROM `conversation_user` `a`
LEFT JOIN `conversations` `b` ON `a`.`conversation_id`=`b`.`id`
LEFT JOIN `conversation_msg` `c` ON `a`.`conversation_id`=`c`.`conversation_id`
WHERE `a`.`user_id` = '1'
AND `a`.`usertypeID` = '1'
AND `a`.`trash` =0
AND `c`.`start` = 1
AND `b`.`draft` =0
GROUP BY `b`.`id`
ORDER BY `b`.`id` DESC
ERROR - 2018-04-02 12:34:31 --> Query error: Table 'school.conversations' doesn't exist - Invalid query: SELECT DISTINCT *
FROM `conversation_user` `a`
LEFT JOIN `conversations` `b` ON `a`.`conversation_id`=`b`.`id`
LEFT JOIN `conversation_msg` `c` ON `a`.`conversation_id`=`c`.`conversation_id`
WHERE `a`.`user_id` = '1'
AND `a`.`usertypeID` = '1'
AND `a`.`trash` =0
AND `c`.`start` = 1
AND `b`.`draft` =0
GROUP BY `b`.`id`
ORDER BY `b`.`id` DESC
ERROR - 2018-04-02 12:45:35 --> Query error: Table 'school.conversations' doesn't exist - Invalid query: SELECT DISTINCT *
FROM `conversation_user` `a`
LEFT JOIN `conversations` `b` ON `a`.`conversation_id`=`b`.`id`
LEFT JOIN `conversation_msg` `c` ON `a`.`conversation_id`=`c`.`conversation_id`
WHERE `a`.`user_id` = '1'
AND `a`.`usertypeID` = '1'
AND `a`.`trash` =0
AND `c`.`start` = 1
AND `b`.`draft` =0
GROUP BY `b`.`id`
ORDER BY `b`.`id` DESC
ERROR - 2018-04-02 12:52:24 --> Query error: Table 'school.conversations' doesn't exist - Invalid query: SELECT DISTINCT *
FROM `conversation_user` `a`
LEFT JOIN `conversations` `b` ON `a`.`conversation_id`=`b`.`id`
LEFT JOIN `conversation_msg` `c` ON `a`.`conversation_id`=`c`.`conversation_id`
WHERE `a`.`user_id` = '1'
AND `a`.`usertypeID` = '1'
AND `a`.`trash` =0
AND `c`.`start` = 1
AND `b`.`draft` =0
GROUP BY `b`.`id`
ORDER BY `b`.`id` DESC
ERROR - 2018-04-02 23:36:28 --> Severity: Warning --> mail(): Failed to connect to mailserver at &quot;localhost&quot; port 25, verify your &quot;SMTP&quot; and &quot;smtp_port&quot; setting in php.ini or use ini_set() D:\wamp64\www\school\main\libraries\Email.php 1896

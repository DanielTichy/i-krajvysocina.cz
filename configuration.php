<?php


/**
 * Customize standart configuration by runtime server
 */
class JConfig extends _JConfig{
  var $serverName = 'Master';

  function DevelCfg(){
	  $this->host     = 'localhost';
  	$this->user     = 'root';
  	$this->password = 'root';
  	$this->db       = 'ic_ikrajvysocina';
  	$this->dbprefix = 'jos_';
  	$this->log_path = 'D:\\Projects\\ihornik.cz\\wwwroot\\logs';
    $this->tmp_path = 'D:\\Projects\\ihornik.cz\\wwwroot\\tmp';
  }

  function __construct(){
    $this->serverName = $_SERVER["HTTP_HOST"];
    if($this->serverName == 'dwpfla'){
      $this->DevelCfg();
    }
  }
}

class _JConfig {

	var $offline = '0';
	var $editor = 'jce';
	var $list_limit = '100';
	var $helpurl = 'http://help.joomla.org';
	var $debug = '0';
	var $debug_lang = '0';
	var $sef = '1';
	var $sef_rewrite = '0';
	var $sef_suffix = '1';
	var $feed_limit = '100';
	var $feed_email = 'author';
	var $secret = 'N8eEEcBmiMIzuonw';
	var $gzip = '0';
	var $error_reporting = '-1';
	var $xmlrpc_server = '0';

	var $live_site = '';
	var $force_ssl = '0';
	var $offset = '0';
	var $caching = '0';
	var $cachetime = '15';
	var $cache_handler = 'file';
	var $memcache_settings = array();
	var $MetaAuthor = '1';
	var $MetaTitle = '1';
	var $lifetime = '15';
	var $session_handler = 'database';

	var $sitename = 'Vysocina';
	var $MetaDesc = 'Joomla! - nástroj pro dynamický portál a redakční systém';
	var $MetaKeys = 'joomla, Joomla';
	var $offline_message = 'Tyto webové stránky se momentálně upravují.  Prosíme, přijdťe později.';

	/**
	 * Older Config from ic.cz
	 *
	var $dbtype = 'mysql';
	var $host = 'mysql.ic.cz';
	var $user = 'ic_ikrajvysocina';
	var $password = 'dbvysocina';
	var $db = 'ic_ikrajvysocina';
	var $dbprefix = 'jos_';

	var $mailer = 'mail';
	var $mailfrom = 'dwp.ullmann@gmail.cz';
	var $fromname = 'Vysocina';
	var $sendmail = '/usr/sbin/sendmail';
	var $smtpauth = '0';
	var $smtpsecure = 'none';
	var $smtpport = '25';
	var $smtpuser = '';
	var $smtppass = '';
	var $smtphost = 'localhost';

	var $ftp_enable = '0';
	var $ftp_host = '127.0.0.1';
	var $ftp_port = '21';
	var $ftp_user = '';
	var $ftp_pass = '';
	var $ftp_root = '';

	var $log_path = '/home/free/ic.cz/i/ikrajvysocina/root/www/logs';
	var $tmp_path = '/home/free/ic.cz/i/ikrajvysocina/root/www/tmp';

	*/

	/**
	 * forpsi server configuration values
	 */
	var $dbtype = 'mysql';
	var $host = 'c183um.forpsi.com';
	var $user = 'ikrajvysocinacz';
	var $password = 'f6matP8H';
	var $db = 'ikrajvysocinacz';
	var $dbprefix = 'jos_';

	var $mailer = 'mail';
	var $mailfrom = 'dwp.ullmann@gmail.cz';
	var $fromname = 'ikrajvysocina.cz';
	var $sendmail = '/usr/sbin/sendmail';
	var $smtpauth = '0';
	var $smtpsecure = 'none';
	var $smtpport = '25';
	var $smtpuser = 'postmaster';
	var $smtppass = 'xtV8kkHq';
	var $smtphost = 'http://mailadmin.forpsi.com';

	var $ftp_enable = '0';
	var $ftp_host = 'c184un.forpsi.com';
	var $ftp_port = '21';
	var $ftp_user = 'ikrajvysocinacz';
	var $ftp_pass = 'xtV8kkHq';
	var $ftp_root = 'www';

	var $log_path = '/httpd/html/ikrajvysocinacz/logs';
	var $tmp_path = '/httpd/html/ikrajvysocinacz/tmp';

	/* KONEC Specifickych parametru podle hostingu */

}


?>
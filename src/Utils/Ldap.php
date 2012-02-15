<?php

class Ldap {



	/** @var resource */ private static $cn = null;
	/** @var string */ private static $dn = null;

	public static function Connect($server,$dn,$port=389){
		if (!is_null(self::$cn)) self::Disconnect();

		self::$cn = ldap_connect($server,$port);
		ldap_set_option(self::$cn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option(self::$cn, LDAP_OPT_NETWORK_TIMEOUT, 3);

		// Test connexion
		if (!@ldap_bind(self::$cn)) {
			self::Disconnect();
			throw new ApplicationException(Lemma::Pick('MsgCannotConnectToLdapServer'));
		}

		ldap_unbind(self::$cn);
		self::$cn = ldap_connect($server,$port);
		ldap_set_option(self::$cn, LDAP_OPT_PROTOCOL_VERSION, 3);
		self::$dn = $dn;

		return true;
	}

	public static function Disconnect(){
		if (!is_null(self::$cn)) ldap_close(self::$cn);
		self::$cn = null;
		self::$dn = null;
	}

	public static function IsConnected(){
		return !is_null(self::$cn);
	}


	public static function RetrieveUserInfo($username,$password){
		return self::RetrieveUserInfoX($username,$password,array_slice(func_get_args(),2));
	}
	private static function RetrieveUserInfoX($username,$password,$attributes=array()) {

		$filter = "(&(objectclass=person)(userPassword=*)(|(uid=$username)) )";
		$search_result = ldap_search(self::$cn, self::$dn, $filter, $attributes);
		$info	= ldap_get_entries(self::$cn, $search_result);

		if ($info === false || $info['count'] == 0)
			throw new ApplicationException(Lemma::Pick('MsgInvalidUsername'));

		if ($info['count'] > 1)
			throw new ApplicationException(Lemma::Pick('MsgMultipleUsersFound'));

		$ldap_bind = ldap_bind(self::$cn, $info[0]['dn'], $password);

		if ($ldap_bind === false)
			throw new ApplicationException(Lemma::Pick('MsgInvalidPassword'));

		return $info[0];
	}
}



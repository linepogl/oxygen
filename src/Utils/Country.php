<?php

final class Country {

	public static $Enum = array (
		'AND'=>'AD','ARE'=>'AE','AFG'=>'AF','ATG'=>'AG',
		'AIA'=>'AI','ALB'=>'AL','ARM'=>'AM','AGO'=>'AO',
		'ATA'=>'AQ','ARG'=>'AR','ASM'=>'AS','AUT'=>'AT',
		'AUS'=>'AU','ABW'=>'AW','ALA'=>'AX','AZE'=>'AZ',
		'BIH'=>'BA','BRB'=>'BB','BGD'=>'BD','BEL'=>'BE',
		'BFA'=>'BF','BGR'=>'BG','BHR'=>'BH','BDI'=>'BI',
		'BEN'=>'BJ','BLM'=>'BL','BMU'=>'BM','BRN'=>'BN',
		'BOL'=>'BO','BES'=>'BQ','BRA'=>'BR','BHS'=>'BS',
		'BTN'=>'BT','BVT'=>'BV','BWA'=>'BW','BLR'=>'BY',
		'BLZ'=>'BZ','CAN'=>'CA','CCK'=>'CC','COD'=>'CD',
		'CAF'=>'CF','COG'=>'CG','CHE'=>'CH','CIV'=>'CI',
		'COK'=>'CK','CHL'=>'CL','CMR'=>'CM','CHN'=>'CN',
		'COL'=>'CO','CRI'=>'CR','CUB'=>'CU','CPV'=>'CV',
		'CUW'=>'CW','CXR'=>'CX','CYP'=>'CY','CZE'=>'CZ',
		'DEU'=>'DE','DJI'=>'DJ','DNK'=>'DK','DMA'=>'DM',
		'DOM'=>'DO','DZA'=>'DZ','ECU'=>'EC','EST'=>'EE',
		'EGY'=>'EG','ESH'=>'EH','ERI'=>'ER','ESP'=>'ES',
		'ETH'=>'ET','FIN'=>'FI','FJI'=>'FJ','FLK'=>'FK',
		'FSM'=>'FM','FRO'=>'FO','FRA'=>'FR','GAB'=>'GA',
		'GBR'=>'GB','GRD'=>'GD','GEO'=>'GE','GUF'=>'GF',
		'GGY'=>'GG','GHA'=>'GH','GIB'=>'GI','GRL'=>'GL',
		'GMB'=>'GM','GIN'=>'GN','GLP'=>'GP','GNQ'=>'GQ',
		'GRC'=>'GR','SGS'=>'GS','GTM'=>'GT','GUM'=>'GU',
		'GNB'=>'GW','GUY'=>'GY','HKG'=>'HK','HMD'=>'HM',
		'HND'=>'HN','HRV'=>'HR','HTI'=>'HT','HUN'=>'HU',
		'IDN'=>'ID','IRL'=>'IE','ISR'=>'IL','IMN'=>'IM',
		'IND'=>'IN','IOT'=>'IO','IRQ'=>'IQ','IRN'=>'IR',
		'ISL'=>'IS','ITA'=>'IT','JEY'=>'JE','JAM'=>'JM',
		'JOR'=>'JO','JPN'=>'JP','KEN'=>'KE','KGZ'=>'KG',
		'KHM'=>'KH','KIR'=>'KI','COM'=>'KM','KNA'=>'KN',
		'PRK'=>'KP','KOR'=>'KR','KWT'=>'KW','CYM'=>'KY',
		'KAZ'=>'KZ','LAO'=>'LA','LBN'=>'LB','LCA'=>'LC',
		'LIE'=>'LI','LKA'=>'LK','LBR'=>'LR','LSO'=>'LS',
		'LTU'=>'LT','LUX'=>'LU','LVA'=>'LV','LBY'=>'LY',
		'MAR'=>'MA','MCO'=>'MC','MDA'=>'MD','MNE'=>'ME',
		'MAF'=>'MF','MDG'=>'MG','MHL'=>'MH','MKD'=>'MK',
		'MLI'=>'ML','MMR'=>'MM','MNG'=>'MN','MAC'=>'MO',
		'MNP'=>'MP','MTQ'=>'MQ','MRT'=>'MR','MSR'=>'MS',
		'MLT'=>'MT','MUS'=>'MU','MDV'=>'MV','MWI'=>'MW',
		'MEX'=>'MX','MYS'=>'MY','MOZ'=>'MZ','NAM'=>'NA',
		'NCL'=>'NC','NER'=>'NE','NFK'=>'NF','NGA'=>'NG',
		'NIC'=>'NI','NLD'=>'NL','NOR'=>'NO','NPL'=>'NP',
		'NRU'=>'NR','NIU'=>'NU','NZL'=>'NZ','OMN'=>'OM',
		'PAN'=>'PA','PER'=>'PE','PYF'=>'PF','PNG'=>'PG',
		'PHL'=>'PH','PAK'=>'PK','POL'=>'PL','SPM'=>'PM',
		'PCN'=>'PN','PRI'=>'PR','PSE'=>'PS','PRT'=>'PT',
		'PLW'=>'PW','PRY'=>'PY','QAT'=>'QA','REU'=>'RE',
		'ROU'=>'RO','SRB'=>'RS','RUS'=>'RU','RWA'=>'RW',
		'SAU'=>'SA','SLB'=>'SB','SYC'=>'SC','SDN'=>'SD',
		'SWE'=>'SE','SGP'=>'SG','SHN'=>'SH','SVN'=>'SI',
		'SJM'=>'SJ','SVK'=>'SK','SLE'=>'SL','SMR'=>'SM',
		'SEN'=>'SN','SOM'=>'SO','SUR'=>'SR','STP'=>'ST',
		'SLV'=>'SV','SXM'=>'SX','SYR'=>'SY','SWZ'=>'SZ',
		'TCA'=>'TC','TCD'=>'TD','ATF'=>'TF','TGO'=>'TG',
		'THA'=>'TH','TJK'=>'TJ','TKL'=>'TK','TLS'=>'TL',
		'TKM'=>'TM','TUN'=>'TN','TON'=>'TO','TUR'=>'TR',
		'TTO'=>'TT','TUV'=>'TV','TWN'=>'TW','TZA'=>'TZ',
		'UKR'=>'UA','UGA'=>'UG','UMI'=>'UM','USA'=>'US',
		'URY'=>'UY','UZB'=>'UZ','VAT'=>'VA','VCT'=>'VC',
		'VEN'=>'VE','VGB'=>'VG','VIR'=>'VI','VNM'=>'VN',
		'VUT'=>'VU','WLF'=>'WF','WSM'=>'WS','YEM'=>'YE',
		'MYT'=>'YT','ZAF'=>'ZA','ZMB'=>'ZM','ZWE'=>'ZW'
		);

	private static $EnumIOC = array(
		'AFG'=>'AF','ALB'=>'AL','ALG'=>'DZ','ASA'=>'AS',
		'AND'=>'AD','ANG'=>'AO','ANT'=>'AG','ARG'=>'AR',
		'ARM'=>'AM','ARU'=>'AW','AUS'=>'AU','AUT'=>'AT',
		'AZE'=>'AZ','BAH'=>'BS','BRN'=>'BH','BAN'=>'BD',
		'BAR'=>'BB','BLR'=>'BY','BEL'=>'BE','BIZ'=>'BZ',
		'BEN'=>'BJ','BER'=>'BM','BHU'=>'BT','BOL'=>'BO',
		'BIH'=>'BA','BOT'=>'BW','BRA'=>'BR','IVB'=>'VG',
		'BRU'=>'BN','BUL'=>'BG','BUR'=>'BF','BDI'=>'BI',
		'CAM'=>'KH','CMR'=>'CM','CAN'=>'CA','CPV'=>'CV',
		'CAY'=>'KY','CAF'=>'CF','CHA'=>'TD','CHI'=>'CL',
		'CHN'=>'CN','TPE'=>'TW','COL'=>'CO','COM'=>'KM',
		'CGO'=>'CG','COK'=>'CK','CRC'=>'CR','CIV'=>'CI',
		'CRO'=>'HR','CUB'=>'CU','CYP'=>'CY','CZE'=>'CZ',
		'DEN'=>'DK','DJI'=>'DJ','DMA'=>'DM','DOM'=>'DO',
		'COD'=>'CD','ECU'=>'EC','EGY'=>'EG','ESA'=>'SV',
		'GEQ'=>'GQ','ERI'=>'ER','EST'=>'EE','ETH'=>'ET',
		'FIJ'=>'FJ','FIN'=>'FI','FRA'=>'FR','GAB'=>'GA',
		'GAM'=>'GM','GEO'=>'GE','GER'=>'DE','GHA'=>'GH',
		'GBR'=>'GB','GRE'=>'GR','GRN'=>'GD','GUM'=>'GU',
		'GUA'=>'GT','GUI'=>'GN','GBS'=>'GW','GUY'=>'GY',
		'HAI'=>'HT','HON'=>'HN','HKG'=>'HK','HUN'=>'HU',
		'ISL'=>'IS','IND'=>'IN','INA'=>'ID','IRI'=>'IR',
		'IRQ'=>'IQ','IRL'=>'IE','ISR'=>'IL','ITA'=>'IT',
		'JAM'=>'JM','JPN'=>'JP','JOR'=>'JO','KAZ'=>'KZ',
		'KEN'=>'KE','KIR'=>'KI','KUW'=>'KW','KGZ'=>'KG',
		'LAO'=>'LA','LAT'=>'LV','LIB'=>'LB','LES'=>'LS',
		'LBR'=>'LR','LBA'=>'LY','LIE'=>'LI','LTU'=>'LT',
		'LUX'=>'LU','MKD'=>'MK','MAD'=>'MG','MAW'=>'MW',
		'MAS'=>'MY','MDV'=>'MV','MLI'=>'ML','MLT'=>'MT',
		'MHL'=>'MH','MTN'=>'MR','MRI'=>'MU','MEX'=>'MX',
		'FSM'=>'FM','MDA'=>'MD','MON'=>'MC','MGL'=>'MN',
		'MNE'=>'ME','MAR'=>'MA','MOZ'=>'MZ','MYA'=>'MM',
		'NAM'=>'NA','NRU'=>'NR','NEP'=>'NP','NED'=>'NL',
		'NZL'=>'NZ','NCA'=>'NI','NIG'=>'NE','NGR'=>'NG',
		'PRK'=>'KP','NOR'=>'NO','OMA'=>'OM','PAK'=>'PK',
		'PLW'=>'PW','PLE'=>'PS','PAN'=>'PA','PNG'=>'PG',
		'PAR'=>'PY','PER'=>'PE','PHI'=>'PH','POL'=>'PL',
		'POR'=>'PT','PUR'=>'PR','QAT'=>'QA','ROU'=>'RO',
		'RUS'=>'RU','RWA'=>'RW','SKN'=>'KN','LCA'=>'LC',
		'VIN'=>'VC','SAM'=>'WS','SMR'=>'SM','STP'=>'ST',
		'KSA'=>'SA','SEN'=>'SN','SRB'=>'RS','SEY'=>'SC',
		'SLE'=>'SL','SIN'=>'SG','SVK'=>'SK','SLO'=>'SI',
		'SOL'=>'SB','SOM'=>'SO','RSA'=>'ZA','KOR'=>'KR',
		'ESP'=>'ES','SRI'=>'LK','SUD'=>'SD','SUR'=>'SR',
		'SWZ'=>'SZ','SWE'=>'SE','SUI'=>'CH','SYR'=>'SY',
		'TJK'=>'TJ','TAN'=>'TZ','THA'=>'TH','TLS'=>'TL',
		'TOG'=>'TG','TGA'=>'TO','TRI'=>'TT','TUN'=>'TN',
		'TUR'=>'TR','TKM'=>'TM','TUV'=>'TV','UGA'=>'UG',
		'UKR'=>'UA','UAE'=>'AE','USA'=>'US','URU'=>'UY',
		'UZB'=>'UZ','VAN'=>'VU','VEN'=>'VE','VIE'=>'VN',
		'ISV'=>'VI','YEM'=>'YE','ZAM'=>'ZM','ZIM'=>'ZW'
		);


	private static $ordered_enum = null;
	public static function GetTranslatedOrderedEnum(){
		if (is_null(self::$ordered_enum)){
			self::$ordered_enum = array();
			foreach (self::$Enum as $lang)
				self::$ordered_enum[$lang] = strval(self::Translate($lang));
			asort(self::$ordered_enum);
		}
		return self::$ordered_enum;
	}
	public static function Translate($code) {
		return Lemma::Retrieve('country:'.$code);
	}
	public static function ConvertIso3ToIso2($iso3){
		return isset(self::$Enum[$iso3]) ? self::$Enum[$iso3] : null;
	}
	/** International Olympics Committee */
	public static function ConvertIocToIso2($ioc){
		return isset(self::$EnumIOC[$ioc]) ? self::$EnumIOC[$ioc] : null;
	}
}
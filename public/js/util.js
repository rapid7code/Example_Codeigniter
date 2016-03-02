/*
 * Util functions
 *
 * @author Thanh Lâm, Võ
 * @since 2012-10-11
 * @Use jQuery library
 */
 
/**
 * Add support format function like string object in .Net.
 *
 * Ex:
		var str = "";
		str.format("{0} {1}", "first_name", "last name");
		console.log(str);
 */
String.prototype.format = function () {
	var args = arguments;
	return this.replace(/\{\{|\}\}|\{(\d+)\}/g, function (curlyBrack, index) {
		return ((curlyBrack == "{{") ? "{" : ((curlyBrack == "}}") ? "}" : args[index]));
	});
};

var Validator = (function ($) {

	//Validates a date input -- http://jquerybyexample.blogspot.com/2011/12/validate-date-    using-jquery.html
	function isDate(str) {
		var currVal = str;
		if (currVal == '')
			return false;

		//Declare Regex
		var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
		var dtArray = currVal.match(rxDatePattern); // is format OK?

		if (dtArray == null)
			return false;

		//Checks for dd/mm/yyyy format.
		var dtDay = dtArray[1];
		var dtMonth = dtArray[3];
		var dtYear = dtArray[5];

		if (dtMonth < 1 || dtMonth > 12)
			return false;
		else if (dtDay < 1 || dtDay > 31)
			return false;
		else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
			return false;
		else if (dtMonth == 2) {
			var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
			if (dtDay > 29 || (dtDay == 29 && !isleap))
				return false;
		}

		return true;
	}

	/*
	 * Check whether email is valid
	 */
	var isValidEmail = function (strEmail) {
		
		validRegExp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		
		if (strEmail.search(validRegExp) == -1) {
			return false;
		}
		
		return true;
	}

	/*
	 * Check whether mobile phone number is valid
	 */
	var isValidMobile = function (str) {
	
		str = str.replace(/([- ])/g, '');
		validRegExp = /^[0-9]{10,}$/i;
		
		if (str.search(validRegExp) == -1)
			return false;
			
		return true;
	}

	/*
	 * Check whether desk phone number is valid
	 */
	var isValidPhone = function (str) {
	
		//validRegExp = /^[ 0-9]{8,}$/i;
		str = str.replace(/([- ])/g, '');
		validRegExp = /^[0-9]{8,}$/i;
		
		if (str.search(validRegExp) == -1) {
		
			return false;
		}
		
		return true;
	}

	var isValidUrl = function (str) {
		validRegExp = /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/i;
		if (str.search(validRegExp) == -1)
			return false;
		return true;
	}

	var isValidPostCode = function (postCode) {
		var validRegExp = /^\d{5}$|^\d{5}-\d{4}$/;
		return validRegExp.test(postCode);
	}

	/**
	 * Format XXXXXXXXXX.
	 */
	var isValidIdCard = function (str) {
		validRegExp = /^[0-9]{9,15}$/i;
		if (str.search(validRegExp) == -1)
			return false;
		return true;
	}


	/**
	 * Format XXXXXX-XX-XXXX Or XXXXXX XX XXXX Or XXXXXXXXXXXX with X = a number.
	 */
	var isICNo = function (str) {
		if (str.length != 12 && str.length != 14)
			return false;
		if (str.length == 14) {
			if (str.indexOf('-') != -1)
				var validRegExp = /^\d{6}-\d{2}-\d{4}$/;
			else if (str.indexOf(' ') != -1)
				var validRegExp = /^\d{6} \d{2} \d{4}$/;
			else
				return false;

			return validRegExp.test(str);
		} else {
			var validRegExp = /^\d{12}$/;
			return validRegExp.test(str);
		}

	}

	/**
	 * Format XXXXXX-XX-XXXX Or XXXXXX XX XXXX Or XXXXXXXXXXXX with X = a number.
	 */
	var isBRNo = function (str) {
		var validRegExp = /^[0-9a-zA-Z]{7}$/;
		return validRegExp.test(str);
	}

	/**
	 * cellphone 	0xxx-xxx-xxx 
	 * phone 		0x-xxxx-xxxx
	 */
	var isTaiwanMobile = function (str) {
		var cellPhoneRegExp = /^0\d{3}-\d{3}-\d{3}$/;
		var phoneRegExp = /^0\d{1}-\d{4}-\d{4}$/;
		var validRegExp = /^0[0-9]{9}$/;

		str = str.replace(/([- ])/g, '');

		if (cellPhoneRegExp.test(str))
			return true;
		else if (phoneRegExp.test(str))
			return true;
		else if (validRegExp.test(str))
			return true;
		else
			return false;
	}

	/**
	 * Validate Malaysia mobile.
	 *
	 * Minimum 10 digits & maximum 11 digits. Need to start with "0"
	 */
	var isMalaysiaMobile = function (str) {
		var validRegExp = /^0\d{9,10}$/;
		str = str.replace(/([- ])/g, '');
		if (validRegExp.test(str))
			return true;
		else
			return false;
	}

	return {
		"isDate" : isDate,
		"isEmail" : isValidEmail,
		"isValidEmail" : isValidEmail,
		"isMobile" : isValidMobile,
		"isValidMobile" : isValidMobile,
		"isPhone" : isValidPhone,
		"isValidPhone" : isValidPhone,
		"isPostCode" : isValidPostCode,
		"isValidPostCode" : isValidPostCode,
		"isUrl" : isValidUrl,
		"isValidUrl" : isValidUrl,
		"isICNo" : isICNo,
		"isBRNo" : isBRNo,
		"isValidIdCard" : isValidIdCard,
		"isIdCard" : isValidIdCard,
		"isTaiwanMobile" : isTaiwanMobile,
		"isMalaysiaMobile" : isMalaysiaMobile
	};
})(jQuery);

/**
 *
 *
 */
var Util = (function ($) {
	/*
	 * Get an ajax content.
	 *
	 * @Use var diagram = $.parseJSON( getPostContent( '/doajax?action=login-status', data ) );
	 */
	var getPostContent = function (url, data) {
		var value = (function () {
			var val = null;
			$.ajax({
				'type' : 'POST',
				'async' : false,
				'global' : false,
				'url' : url,
				'data' : data,
				'success' : function (res) {
					val = res;
				}
			});
			return val;
		})();
		return value;
	}

	/*
	 * Get an ajax content.
	 *
	 * @Use var diagram = $.parseJSON( getContent( '/doajax?action=login-status' ) );
	 */
	var getContent = function (url) {
		var value = (function () {
			var val = null;
			$.ajax({
				'async' : false,
				'global' : false,
				'url' : url,
				'success' : function (data) {
					val = data;
				}
			});
			return val;
		})();
		return value;
	}

	var removeAccents = function (s) {
		var r = s.toLowerCase();
		var r = s.toLowerCase();
		r = r.replace(new RegExp("\\s+", 'g'), " ");
		r = r.replace(new RegExp("[àáâãäåầấậẫẩắằặẵẳ]", 'g'), "a");
		r = r.replace(new RegExp("æ", 'g'), "ae");
		r = r.replace(new RegExp("ç", 'g'), "c");
		r = r.replace(new RegExp("đ", 'g'), "d");
		r = r.replace(new RegExp("[èéẻẽẹêëếềểễệ]", 'g'), "e");
		r = r.replace(new RegExp("[ìíîïị]", 'g'), "i");
		r = r.replace(new RegExp("ñ", 'g'), "n");
		r = r.replace(new RegExp("[òóôõöỏõọộốồổỗơờớởỡợ]", 'g'), "o");
		r = r.replace(new RegExp("œ", 'g'), "oe");
		r = r.replace(new RegExp("[ùúûüụưừứữự]", 'g'), "u");
		r = r.replace(new RegExp("[ýÿỳỷỹỵ]", 'g'), "y");
		//r = r.replace(new RegExp("\\W", 'g'),"");
		return r;
	}

	/**
	 * Parse query string to json object
	 * @author Võ Thanh Lâm
	 */
	function queryStringToJSON(str) {
		var arr = str.split('&');
		var obj = {};
		for (var i = 0; i < arr.length; i++) {
			var bits = arr[i].split('=');
			obj[bits[0]] = bits[1];
		}
		return obj;
	}
	
	/**
	 *
	 */
	function datediff(interval, fromDate, toDate) {
		/*
		 * DateFormat month/day/year hh:mm:ss
		 * ex.
		 * datediff('01/01/2011 12:00:00','01/01/2011 13:30:00','seconds');
		 */
		var second=1000, minute=second*60, hour=minute*60, day=hour*24, week=day*7;
		fromDate = new Date(fromDate);
		toDate = new Date(toDate);
		var timediff = toDate - fromDate;
		if (isNaN(timediff)) return NaN;
		switch (interval) {
			case "y": return toDate.getFullYear() - fromDate.getFullYear();
			case "m": return (
				( toDate.getFullYear() * 12 + toDate.getMonth() )
				-
				( fromDate.getFullYear() * 12 + fromDate.getMonth() )
			);
			case "w"  : return Math.floor(timediff / week);
			case "d"   : return Math.floor(timediff / day);
			case "h"  : return Math.floor(timediff / hour); 
			case "i": return Math.floor(timediff / minute);
			case "s": return Math.floor(timediff / second);
			default: return undefined;
		}
	}
	
	function getAge( birthDate ) {
		var now = new Date();
		var age = datediff('y', birthDate, now);
		var birthDay = myBirthDate(birthDate, age);
		if( (now - birthDay) < 0 )
			age--;
		return age;
	}
	
	function checkBirthDate( dateOfBirth, age ) {
		var bd = myBirthDate( dateOfBirth, age );
		var now = new Date();
		
		if( (now - bd) < 0 ) 
			return false;
		else
			return true;
	}
	
	function myBirthDate( dateOfBirth, age ){
		var d = dateOfBirth.getDay();
		var m = dateOfBirth.getMonth();
		var y = dateOfBirth.getFullYear();
		var ny = y + age;
		if( m == 2 && d == 29 ){
			if( !isLeap(ny) ) {
				d = 28;
			}
		}
		return new Date(ny, m, d);
	}
	
	var isLeap = function (year) {
		return (((year % 4) == 0) && ((year % 100) != 0) || ((year % 400) == 0));
	}


	return {
		'getContent' : getContent,
		'getPostContent' : getPostContent,
		'removeAccents' : removeAccents,
		queryStringToJSON : queryStringToJSON
	};
})(jQuery);

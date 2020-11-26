;(function($){
/**
 * jqGrid Hungarian Translation
 * ≈êrszigety √Åd·m udx6bs@freemail.hu
 * http://trirand.com/blog/ 
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/

$.jgrid = $.jgrid || {};
$.extend($.jgrid,{
	defaults : {
		recordtext: "Oldal {0} - {1} / {2}",
		emptyrecords: "Nincs tal·lat",
		loadtext: "Bet√∂ltÈs...",
		pgtext : "Oldal {0} / {1}"
	},
	search : {
		caption: "KeresÈs...",
		Find: "Keres",
		Reset: "AlapÈrtelmezett",
		odata: [{ oper:'eq', text:"egyenl≈ë"},{ oper:'ne', text:"nem egyenl≈ë"},{ oper:'lt', text:"kevesebb"},{ oper:'le', text:"kevesebb vagy egyenl≈ë"},{ oper:'gt', text:"nagyobb"},{ oper:'ge', text:"nagyobb vagy egyenl≈ë"},{ oper:'bw', text:"ezzel kezd≈ëdik"},{ oper:'bn', text:"nem ezzel kezd≈ëdik"},{ oper:'in', text:"tartalmaz"},{ oper:'ni', text:"nem tartalmaz"},{ oper:'ew', text:"vÈgz≈ëdik"},{ oper:'en', text:"nem vÈgz≈ëdik"},{ oper:'cn', text:"tartalmaz"},{ oper:'nc', text:"nem tartalmaz"},{ oper:'nu', text:'is null'},{ oper:'nn', text:'is not null'}],
		groupOps: [	{ op: "AND", text: "all" },	{ op: "OR",  text: "any" }	],
		operandTitle : "Click to select search operation.",
		resetTitle : "Reset Search Value"
	},
	edit : {
		addCaption: "√öj tÈtel",
		editCaption: "TÈtel szerkesztÈse",
		bSubmit: "MentÈs",
		bCancel: "MÈgse",
		bClose: "Bez·r·s",
		saveData: "A tÈtel megv·ltozott! TÈtel mentÈse?",
		bYes : "Igen",
		bNo : "Nem",
		bExit : "MÈgse",
		msg: {
			required:"K√∂telez≈ë mez≈ë",
			number:"KÈrj√ºk, adjon meg egy helyes sz·mot",
			minValue:"Nagyobb vagy egyenl≈ënek kell lenni mint ",
			maxValue:"Kisebb vagy egyenl≈ënek kell lennie mint",
			email: "hib·s emailc√≠m",
			integer: "KÈrj√ºk adjon meg egy helyes egÈsz sz·mot",
			date: "KÈrj√ºk adjon meg egy helyes d·tumot",
			url: "nem helyes c√≠m. El≈ëtag k√∂telez≈ë ('http://' vagy 'https://')",
			nodefined : " nem defini·lt!",
			novalue : " visszatÈrÈsi ÈrtÈk k√∂telez≈ë!!",
			customarray : "Custom function should return array!",
			customfcheck : "Custom function should be present in case of custom checking!"
			
		}
	},
	view : {
		caption: "TÈtel megtekintÈse",
		bClose: "Bez·r·s"
	},
	del : {
		caption: "T√∂rlÈs",
		msg: "Kiv·laztott tÈtel(ek) t√∂rlÈse?",
		bSubmit: "T√∂rlÈs",
		bCancel: "MÈgse"
	},
	nav : {
		edittext: "",
		edittitle: "TÈtel szerkesztÈse",
		addtext:"",
		addtitle: "√öj tÈtel hozz·ad·sa",
		deltext: "",
		deltitle: "TÈtel t√∂rlÈse",
		searchtext: "",
		searchtitle: "KeresÈs",
		refreshtext: "",
		refreshtitle: "Friss√≠tÈs",
		alertcap: "FigyelmeztetÈs",
		alerttext: "KÈrem v·lasszon tÈtelt.",
		viewtext: "",
		viewtitle: "TÈtel megtekintÈse"
	},
	col : {
		caption: "Oszlopok kiv·laszt·sa",
		bSubmit: "Ok",
		bCancel: "MÈgse"
	},
	errors : {
		errcap : "Hiba",
		nourl : "Nincs URL be·ll√≠tva",
		norecords: "Nincs feldolgoz·sra v·rÛ tÈtel",
		model : "colNames Ès colModel hossza nem egyenl≈ë!"
	},
	formatter : {
		integer : {thousandsSeparator: " ", defaultValue: '0'},
		number : {decimalSeparator:",", thousandsSeparator: " ", decimalPlaces: 2, defaultValue: '0,00'},
		currency : {decimalSeparator:",", thousandsSeparator: " ", decimalPlaces: 2, prefix: "", suffix:"", defaultValue: '0,00'},
		date : {
			dayNames:   [
				"Va", "HÈ", "Ke", "Sze", "Cs√º", "PÈ", "Szo",
				"Vas·rnap", "HÈtf≈ë", "Kedd", "Szerda", "Cs√ºt√∂rt√∂k", "PÈntek", "Szombat"
			],
			monthNames: [
				"Jan", "Feb", "M·r", "√Åpr", "M·j", "J˙n", "J˙l", "Aug", "Szep", "Okt", "Nov", "Dec",
				"Janu·r", "Febru·r", "M·rcius", "√Åprili", "M·jus", "J˙nius", "J˙lius", "Augusztus", "Szeptember", "OktÛber", "November", "December"
			],
			AmPm : ["de","du","DE","DU"],
			S: function (j) {return '.-ik';},
			srcformat: 'Y-m-d',
			newformat: 'Y/m/d',
			parseRe : /[#%\\\/:_;.,\t\s-]/,
			masks : {
				ISO8601Long:"Y-m-d H:i:s",
				ISO8601Short:"Y-m-d",
				ShortDate: "Y/j/n",
				LongDate: "Y. F hÛ d., l",
				FullDateTime: "l, F d, Y g:i:s A",
				MonthDay: "F d",
				ShortTime: "a g:i",
				LongTime: "a g:i:s",
				SortableDateTime: "Y-m-d\\TH:i:s",
				UniversalSortableDateTime: "Y-m-d H:i:sO",
				YearMonth: "Y, F"
			},
			reformatAfterEdit : false
		},
		baseLinkUrl: '',
		showAction: '',
		target: '',
		checkbox : {disabled:true},
		idName : 'id'
	}
});
})(jQuery);

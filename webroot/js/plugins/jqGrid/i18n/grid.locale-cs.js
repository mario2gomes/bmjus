;(function($){
/**
 * jqGrid Czech Translation
 * Pavel Jirak pavel.jirak@jipas.cz
 * doplnil Thomas Wagner xwagne01@stud.fit.vutbr.cz
 * http://trirand.com/blog/ 
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/
$.jgrid = $.jgrid || {};
$.extend($.jgrid,{
	defaults : {
		recordtext: "Zobrazeno {0} - {1} z {2} z�znamů",
	    emptyrecords: "Nenalezeny ž�dn� z�znamy",
		loadtext: "Načít�m...",
		pgtext : "Strana {0} z {1}"
	},
	search : {
		caption: "Vyhled�v�m...",
		Find: "Hledat",
		Reset: "Reset",
	    odata: [{ oper:'eq', text:"rovno"},{ oper:'ne', text:"nerovno"},{ oper:'lt', text:"menší"},{ oper:'le', text:"menší nebo rovno"},{ oper:'gt', text:"větší"},{ oper:'ge', text:"větší nebo rovno"},{ oper:'bw', text:"začín� s"},{ oper:'bn', text:"nezačín� s"},{ oper:'in', text:"je v"},{ oper:'ni', text:"není v"},{ oper:'ew', text:"končí s"},{ oper:'en', text:"nekončí s"},{ oper:'cn', text:"obsahuje"},{ oper:'nc', text:"neobsahuje"},{ oper:'nu', text:'is null'},{ oper:'nn', text:'is not null'}],
	    groupOps: [	{ op: "AND", text: "všech" },	{ op: "OR",  text: "někter�ho z" }	],
		operandTitle : "Click to select search operation.",
		resetTitle : "Reset Search Value"
	},
	edit : {
		addCaption: "Přidat z�znam",
		editCaption: "Editace z�znamu",
		bSubmit: "Uložit",
		bCancel: "Storno",
		bClose: "Zavřít",
		saveData: "Data byla změněna! Uložit změny?",
		bYes : "Ano",
		bNo : "Ne",
		bExit : "Zrušit",
		msg: {
		    required:"Pole je vyžadov�no",
		    number:"Prosím, vložte validní číslo",
		    minValue:"hodnota musí být větší než nebo rovn� ",
		    maxValue:"hodnota musí být menší než nebo rovn� ",
		    email: "není validní e-mail",
		    integer: "Prosím, vložte cel� číslo",
			date: "Prosím, vložte validní datum",
			url: "není platnou URL. Vyžadov�n prefix ('http://' or 'https://')",
			nodefined : " není definov�n!",
			novalue : " je vyžadov�na n�vratov� hodnota!",
			customarray : "Custom function měl� vr�tit pole!",
			customfcheck : "Custom function by měla být přítomna v případě custom checking!"
		}
	},
	view : {
	    caption: "Zobrazit z�znam",
	    bClose: "Zavřít"
	},
	del : {
		caption: "Smazat",
		msg: "Smazat vybraný(�) z�znam(y)?",
		bSubmit: "Smazat",
		bCancel: "Storno"
	},
	nav : {
		edittext: " ",
		edittitle: "Editovat vybraný ř�dek",
		addtext:" ",
		addtitle: "Přidat nový ř�dek",
		deltext: " ",
		deltitle: "Smazat vybraný z�znam ",
		searchtext: " ",
		searchtitle: "Najít z�znamy",
		refreshtext: "",
		refreshtitle: "Obnovit tabulku",
		alertcap: "Varov�ní",
		alerttext: "Prosím, vyberte ř�dek",
		viewtext: "",
		viewtitle: "Zobrazit vybraný ř�dek"
	},
	col : {
		caption: "Zobrazit/Skrýt sloupce",
		bSubmit: "Uložit",
		bCancel: "Storno"	
	},
	errors : {
		errcap : "Chyba",
		nourl : "Není nastavena url",
		norecords: "Ž�dn� z�znamy ke zpracov�ní",
		model : "D�lka colNames <> colModel!"
	},
	formatter : {
		integer : {thousandsSeparator: " ", defaultValue: '0'},
		number : {decimalSeparator:".", thousandsSeparator: " ", decimalPlaces: 2, defaultValue: '0.00'},
		currency : {decimalSeparator:".", thousandsSeparator: " ", decimalPlaces: 2, prefix: "", suffix:"", defaultValue: '0.00'},
		date : {
			dayNames:   [
				"Ne", "Po", "Út", "St", "Čt", "P�", "So",
				"Neděle", "Pondělí", "Úterý", "Středa", "Čtvrtek", "P�tek", "Sobota"
			],
			monthNames: [
				"Led", "Úno", "Bře", "Dub", "Kvě", "Čer", "Čvc", "Srp", "Z�ř", "Říj", "Lis", "Pro",
				"Leden", "Únor", "Březen", "Duben", "Květen", "Červen", "Červenec", "Srpen", "Z�ří", "Říjen", "Listopad", "Prosinec"
			],
			AmPm : ["do","od","DO","OD"],
			S: function (j) {return j < 11 || j > 13 ? ['st', 'nd', 'rd', 'th'][Math.min((j - 1) % 10, 3)] : 'th'},
			srcformat: 'Y-m-d',
			newformat: 'd/m/Y',
			parseRe : /[#%\\\/:_;.,\t\s-]/,
			masks : {
		        ISO8601Long:"Y-m-d H:i:s",
		        ISO8601Short:"Y-m-d",
		        ShortDate: "n/j/Y",
		        LongDate: "l, F d, Y",
		        FullDateTime: "l, F d, Y g:i:s A",
		        MonthDay: "F d",
		        ShortTime: "g:i A",
		        LongTime: "g:i:s A",
		        SortableDateTime: "Y-m-d\\TH:i:s",
		        UniversalSortableDateTime: "Y-m-d H:i:sO",
		        YearMonth: "F, Y"
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

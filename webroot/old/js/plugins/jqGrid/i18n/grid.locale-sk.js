;(function($){
/**
 * jqGrid Slovak Translation
 * Milan Cibulka
 * http://trirand.com/blog/ 
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/
$.jgrid = $.jgrid || {};
$.extend($.jgrid,{
	defaults : {
		recordtext: "Zobrazených {0} - {1} z {2} z�znamov",
	    emptyrecords: "Neboli n�jden� žiadne z�znamy",
		loadtext: "Načít�m...",
		pgtext : "Strana {0} z {1}"
	},
	search : {
		caption: "Vyhľad�vam...",
		Find: "Hľadať",
		Reset: "Reset",
	    odata: [{ oper:'eq', text:"rovn� sa"},{ oper:'ne', text:"nerovn� sa"},{ oper:'lt', text:"menšie"},{ oper:'le', text:"menšie alebo rovnaj�ce sa"},{ oper:'gt', text:"väčšie"},{ oper:'ge', text:"väčšie alebo rovnaj�ce sa"},{ oper:'bw', text:"začína s"},{ oper:'bn', text:"nezačína s"},{ oper:'in', text:"je v"},{ oper:'ni', text:"nie je v"},{ oper:'ew', text:"končí s"},{ oper:'en', text:"nekončí s"},{ oper:'cn', text:"obahuje"},{ oper:'nc', text:"neobsahuje"},{ oper:'nu', text:'is null'},{ oper:'nn', text:'is not null'}],
	    groupOps: [	{ op: "AND", text: "všetkých" },	{ op: "OR",  text: "niektor�ho z" }	],
		operandTitle : "Click to select search operation.",
		resetTitle : "Reset Search Value"
	},
	edit : {
		addCaption: "Pridať z�znam",
		editCaption: "Edit�cia z�znamov",
		bSubmit: "Uložiť",
		bCancel: "Storno",
		bClose: "Zavrieť",
		saveData: "Údaje boli zmenen�! Uložiť zmeny?",
		bYes : "Ano",
		bNo : "Nie",
		bExit : "Zrušiť",
		msg: {
		    required:"Pole je požadovan�",
		    number:"Prosím, vložte valídne číslo",
		    minValue:"hodnota musí býť väčšia ako alebo rovn� ",
		    maxValue:"hodnota musí býť menšia ako alebo rovn� ",
		    email: "nie je valídny e-mail",
		    integer: "Prosím, vložte cel� číslo",
			date: "Prosím, vložte valídny d�tum",
			url: "nie je platnou URL. Požadovaný prefix ('http://' alebo 'https://')",
			nodefined : " nie je definovaný!",
			novalue : " je vyžadovan� n�vratov� hodnota!",
			customarray : "Custom function mala vr�tiť pole!",
			customfcheck : "Custom function by mala byť prítomn� v prípade custom checking!"
		}
	},
	view : {
	    caption: "Zobraziť z�znam",
	    bClose: "Zavrieť"
	},
	del : {
		caption: "Zmazať",
		msg: "Zmazať vybraný(�) z�znam(y)?",
		bSubmit: "Zmazať",
		bCancel: "Storno"
	},
	nav : {
		edittext: " ",
		edittitle: "Editovať vybraný riadok",
		addtext:" ",
		addtitle: "Pridať nový riadek",
		deltext: " ",
		deltitle: "Zmazať vybraný z�znam ",
		searchtext: " ",
		searchtitle: "N�jsť z�znamy",
		refreshtext: "",
		refreshtitle: "Obnoviť tabuľku",
		alertcap: "Varovanie",
		alerttext: "Prosím, vyberte riadok",
		viewtext: "",
		viewtitle: "Zobraziť vybraný riadok"
	},
	col : {
		caption: "Zobrazit/Skrýť stĺpce",
		bSubmit: "Uložiť",
		bCancel: "Storno"	
	},
	errors : {
		errcap : "Chyba",
		nourl : "Nie je nastaven� url",
		norecords: "Žiadne z�znamy k spracovaniu",
		model : "Dĺžka colNames <> colModel!"
	},
	formatter : {
		integer : {thousandsSeparator: " ", defaultValue: '0'},
		number : {decimalSeparator:".", thousandsSeparator: " ", decimalPlaces: 2, defaultValue: '0.00'},
		currency : {decimalSeparator:".", thousandsSeparator: " ", decimalPlaces: 2, prefix: "", suffix:"", defaultValue: '0.00'},
		date : {
			dayNames:   [
				"Ne", "Po", "Ut", "St", "Št", "Pi", "So",
				"Nedela", "Pondelok", "Utorok", "Streda", "Štvrtok", "Piatek", "Sobota"
			],
			monthNames: [
				"Jan", "Feb", "Mar", "Apr", "M�j", "J�n", "J�l", "Aug", "Sep", "Okt", "Nov", "Dec",
				"Janu�r", "Febru�r", "Marec", "Apríl", "M�j", "J�n", "J�l", "August", "September", "Okt�ber", "November", "December"
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

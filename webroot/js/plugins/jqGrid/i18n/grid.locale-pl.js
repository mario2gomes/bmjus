;(function($){
/**
 * jqGrid Polish Translation
 * Łukasz Schab lukasz@freetree.pl
 * http://FreeTree.pl
 *
 * Updated names, abbreviations, currency and date/time formats for Polish norms (also corresponding with CLDR v21.0.1 --> http://cldr.unicode.org/index) 
 * Tomasz Pęczek tpeczek@gmail.com
 * http://tpeczek.blogspot.com; http://tpeczek.codeplex.com
 *
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/
$.jgrid = $.jgrid || {};
$.extend($.jgrid,{
	defaults : {
		recordtext: "Pokaż {0} - {1} z {2}",
		emptyrecords: "Brak rekord�w do pokazania",
		loadtext: "Ładowanie...",
		pgtext : "Strona {0} z {1}"
	},
	search : {
		caption: "Wyszukiwanie...",
		Find: "Szukaj",
		Reset: "Czyść",
		odata: [{ oper:'eq', text:"dokładnie"},{ oper:'ne', text:"r�żne od"},{ oper:'lt', text:"mniejsze od"},{ oper:'le', text:"mniejsze lub r�wne"},{ oper:'gt', text:"większe od"},{ oper:'ge', text:"większe lub r�wne"},{ oper:'bw', text:"zaczyna się od"},{ oper:'bn', text:"nie zaczyna się od"},{ oper:'in', text:"jest w"},{ oper:'ni', text:"nie jest w"},{ oper:'ew', text:"kończy się na"},{ oper:'en', text:"nie kończy się na"},{ oper:'cn', text:"zawiera"},{ oper:'nc', text:"nie zawiera"},{ oper:'nu', text:'is null'},{ oper:'nn', text:'is not null'}],
		groupOps: [	{ op: "AND", text: "oraz" },	{ op: "OR",  text: "lub" }	],
		operandTitle : "Click to select search operation.",
		resetTitle : "Reset Search Value"
	},
	edit : {
		addCaption: "Dodaj rekord",
		editCaption: "Edytuj rekord",
		bSubmit: "Zapisz",
		bCancel: "Anuluj",
		bClose: "Zamknij",
		saveData: "Dane zostały zmienione! Zapisać zmiany?",
		bYes: "Tak",
		bNo: "Nie",
		bExit: "Anuluj",
		msg: {
			required: "Pole jest wymagane",
			number: "Proszę wpisać poprawną liczbę",
			minValue: "wartość musi być większa lub r�wna od",
			maxValue: "wartość musi być mniejsza lub r�wna od",
			email: "nie jest poprawnym adresem e-mail",
			integer: "Proszę wpisać poprawną liczbę",
			date: "Proszę podaj poprawną datę",
			url: "jest niewłaściwym adresem URL. Pamiętaj o prefiksie ('http://' lub 'https://')",
			nodefined: " niezdefiniowane!",
			novalue: " wymagana jest wartość zwracana!",
			customarray: "Funkcja niestandardowa powinna zwracać tablicę!",
			customfcheck: "Funkcja niestandardowa powinna być obecna w przypadku niestandardowego sprawdzania!"
		}
	},
	view : {
		caption: "Pokaż rekord",
		bClose: "Zamknij"
	},
	del : {
		caption: "Usuń",
		msg: "Czy usunąć wybrany rekord(y)?",
		bSubmit: "Usuń",
		bCancel: "Anuluj"
	},
	nav : {
		edittext: "",
		edittitle: "Edytuj wybrany wiersz",
		addtext: "",
		addtitle: "Dodaj nowy wiersz",
		deltext: "",
		deltitle: "Usuń wybrany wiersz",
		searchtext: "",
		searchtitle: "Wyszukaj rekord",
		refreshtext: "",
		refreshtitle: "Przeładuj",
		alertcap: "Uwaga",
		alerttext: "Proszę wybrać wiersz",
		viewtext: "",
		viewtitle: "Pokaż wybrany wiersz"
	},
	col : {
		caption: "Pokaż/Ukryj kolumny",
		bSubmit: "Zatwierdź",
		bCancel: "Anuluj"
	},
	errors : {
		errcap: "Błąd",
		nourl: "Brak adresu url",
		norecords: "Brak danych",
		model : "Długość colNames <> colModel!"
	},
	formatter : {
		integer : {thousandsSeparator: " ", defaultValue: '0'},
		number : {decimalSeparator:",", thousandsSeparator: " ", decimalPlaces: 2, defaultValue: '0,00'},
		currency : {decimalSeparator:",", thousandsSeparator: " ", decimalPlaces: 2, prefix: "", suffix:" zł", defaultValue: '0,00'},
		date : {
			dayNames:   [
				"niedz.", "pon.", "wt.", "śr.", "czw.", "pt.", "sob.",
				"niedziela", "poniedziałek", "wtorek", "środa", "czwartek", "piątek", "sobota"
			],
			monthNames: [
				"sty", "lut", "mar", "kwi", "maj", "cze", "lip", "sie", "wrz", "paź", "lis", "gru",
				"styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"
				],
			AmPm : ["","","",""],
			S: function (j) {return '';},
			srcformat: 'Y-m-d',
			newformat: 'd.m.Y',
			parseRe : /[#%\\\/:_;.,\t\s-]/,
			masks : {
				ISO8601Long: "Y-m-d H:i:s",
				ISO8601Short: "Y-m-d",
				ShortDate: "d.m.y",
				LongDate: "l, j F Y",
				FullDateTime: "l, j F Y H:i:s",
				MonthDay: "j F",
				ShortTime: "H:i",
				LongTime: "H:i:s",
				SortableDateTime: "Y-m-d\\TH:i:s",
				UniversalSortableDateTime: "Y-m-d H:i:sO",
				YearMonth: "F Y"
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
;(function($){
/**
 * jqGrid French Translation
 * Tony Tomov tony@trirand.com
 * http://trirand.com/blog/ 
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/
$.jgrid = $.jgrid || {};
$.extend($.jgrid,{
	defaults : {
		recordtext: "Enregistrements {0} - {1} sur {2}",
		emptyrecords: "Aucun enregistrement à afficher",
		loadtext: "Chargement...",
		pgtext : "Page {0} sur {1}"
	},
	search : {
		caption: "Recherche...",
		Find: "Chercher",
		Reset: "R�initialiser",
		odata: [{ oper:'eq', text:"�gal"},{ oper:'ne', text:"diff�rent"},{ oper:'lt', text:"inf�rieur"},{ oper:'le', text:"inf�rieur ou �gal"},{ oper:'gt', text:"sup�rieur"},{ oper:'ge', text:"sup�rieur ou �gal"},{ oper:'bw', text:"commence par"},{ oper:'bn', text:"ne commence pas par"},{ oper:'in', text:"est dans"},{ oper:'ni', text:"n'est pas dans"},{ oper:'ew', text:"finit par"},{ oper:'en', text:"ne finit pas par"},{ oper:'cn', text:"contient"},{ oper:'nc', text:"ne contient pas"},{ oper:'nu', text:'is null'},{ oper:'nn', text:'is not null'}],
		groupOps: [	{ op: "AND", text: "tous" },	{ op: "OR",  text: "au moins un" }	],
		operandTitle : "Click to select search operation.",
		resetTitle : "Reset Search Value"
	},
	edit : {
		addCaption: "Ajouter",
		editCaption: "Editer",
		bSubmit: "Valider",
		bCancel: "Annuler",
		bClose: "Fermer",
		saveData: "Les donn�es ont chang� ! Enregistrer les modifications ?",
		bYes: "Oui",
		bNo: "Non",
		bExit: "Annuler",
		msg: {
			required: "Champ obligatoire",
			number: "Saisissez un nombre correct",
			minValue: "La valeur doit �tre sup�rieure ou �gale à",
			maxValue: "La valeur doit �tre inf�rieure ou �gale à",
			email: "n'est pas un email correct",
			integer: "Saisissez un entier correct",
			url: "n'est pas une adresse correcte. Pr�fixe requis ('http://' or 'https://')",
			nodefined : " n'est pas d�fini!",
			novalue : " la valeur de retour est requise!",
			customarray : "Une fonction personnalis�e devrait retourner un tableau (array)!",
			customfcheck : "Une fonction personnalis�e devrait �tre pr�sente dans le cas d'une v�rification personnalis�e!"
		}
	},
	view : {
		caption: "Voir les enregistrement",
		bClose: "Fermer"
	},
	del : {
		caption: "Supprimer",
		msg: "Supprimer les enregistrements s�lectionn�s ?",
		bSubmit: "Supprimer",
		bCancel: "Annuler"
	},
	nav : {
		edittext: " ",
		edittitle: "Editer la ligne s�lectionn�e",
		addtext:" ",
		addtitle: "Ajouter une ligne",
		deltext: " ",
		deltitle: "Supprimer la ligne s�lectionn�e",
		searchtext: " ",
		searchtitle: "Chercher un enregistrement",
		refreshtext: "",
		refreshtitle: "Recharger le tableau",
		alertcap: "Avertissement",
		alerttext: "Veuillez s�lectionner une ligne",
		viewtext: "",
		viewtitle: "Afficher la ligne s�lectionn�e"
	},
	col : {
		caption: "Afficher/Masquer les colonnes",
		bSubmit: "Valider",
		bCancel: "Annuler"
	},
	errors : {
		errcap : "Erreur",
		nourl : "Aucune adresse n'est param�tr�e",
		norecords: "Aucun enregistrement à traiter",
		model : "Nombre de titres (colNames) <> Nombre de donn�es (colModel)!"
	},
	formatter : {
		integer : {thousandsSeparator: " ", defaultValue: '0'},
		number : {decimalSeparator:",", thousandsSeparator: " ", decimalPlaces: 2, defaultValue: '0,00'},
		currency : {decimalSeparator:",", thousandsSeparator: " ", decimalPlaces: 2, prefix: "", suffix:"", defaultValue: '0,00'},
		date : {
			dayNames:   [
				"Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam",
				"Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"
			],
			monthNames: [
				"Jan", "F�v", "Mar", "Avr", "Mai", "Jui", "Jul", "Aou", "Sep", "Oct", "Nov", "D�c",
				"Janvier", "F�vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "D�cembre"
			],
			AmPm : ["am","pm","AM","PM"],
			S: function (j) {return j == 1 ? 'er' : 'e';},
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

;(function($){
/**
 * jqGrid Vietnamese Translation
 * L� Đình Dũng dungtdc@gmail.com
 * http://trirand.com/blog/ 
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/
$.jgrid = $.jgrid || {};
$.extend($.jgrid,{
	defaults : {
		recordtext: "View {0} - {1} of {2}",
		emptyrecords: "Không c� dữ liệu",
		loadtext: "Đang nạp dữ liệu...",
		pgtext : "Trang {0} trong tổng số {1}"
	},
	search : {
		caption: "Tìm kiếm...",
		Find: "Tìm",
		Reset: "Khởi tạo lại",
		odata: [{ oper:'eq', text:"bằng"},{ oper:'ne', text:"không bằng"},{ oper:'lt', text:"b� hơn"},{ oper:'le', text:"b� hơn hoặc bằng"},{ oper:'gt', text:"lớn hơn"},{ oper:'ge', text:"lớn hơn hoặc bằng"},{ oper:'bw', text:"bắt đầu với"},{ oper:'bn', text:"không bắt đầu với"},{ oper:'in', text:"trong"},{ oper:'ni', text:"không nằm trong"},{ oper:'ew', text:"kết th�c với"},{ oper:'en', text:"không kết th�c với"},{ oper:'cn', text:"chứa"},{ oper:'nc', text:"không chứa"},{ oper:'nu', text:'is null'},{ oper:'nn', text:'is not null'}],
		groupOps: [	{ op: "VÀ", text: "tất cả" },	{ op: "HOẶC",  text: "bất kỳ" }	],
		operandTitle : "Click to select search operation.",
		resetTitle : "Reset Search Value"
	},
	edit : {
		addCaption: "Th�m bản ghi",
		editCaption: "Sửa bản ghi",
		bSubmit: "Gửi",
		bCancel: "Hủy bỏ",
		bClose: "Đ�ng",
		saveData: "Dữ liệu đ� thay đổi! C� lưu thay đổi không?",
		bYes : "C�",
		bNo : "Không",
		bExit : "Hủy bỏ",
		msg: {
			required:"Trường dữ liệu bắt buộc c�",
			number:"H�y điền đ�ng số",
			minValue:"gi� trị phải lớn hơn hoặc bằng với ",
			maxValue:"gi� trị phải b� hơn hoặc bằng",
			email: "không phải là một email đ�ng",
			integer: "H�y điền đ�ng số nguy�n",
			date: "H�y điền đ�ng ngày th�ng",
			url: "không phải là URL. Khởi đầu bắt buộc là ('http://' hoặc 'https://')",
			nodefined : " chưa được định nghĩa!",
			novalue : " gi� trị trả về bắt buộc phải c�!",
			customarray : "Hàm n�n trả về một mảng!",
			customfcheck : "Custom function should be present in case of custom checking!"
			
		}
	},
	view : {
		caption: "Xem bản ghi",
		bClose: "Đ�ng"
	},
	del : {
		caption: "X�a",
		msg: "X�a bản ghi đ� chọn?",
		bSubmit: "X�a",
		bCancel: "Hủy bỏ"
	},
	nav : {
		edittext: "",
		edittitle: "Sửa dòng đ� chọn",
		addtext:"",
		addtitle: "Th�m mới 1 dòng",
		deltext: "",
		deltitle: "X�a dòng đ� chọn",
		searchtext: "",
		searchtitle: "Tìm bản ghi",
		refreshtext: "",
		refreshtitle: "Nạp lại lưới",
		alertcap: "Cảnh b�o",
		alerttext: "H�y chọn một dòng",
		viewtext: "",
		viewtitle: "Xem dòng đ� chọn"
	},
	col : {
		caption: "Chọn cột",
		bSubmit: "OK",
		bCancel: "Hủy bỏ"
	},
	errors : {
		errcap : "Lỗi",
		nourl : "không url được đặt",
		norecords: "Không c� bản ghi để xử lý",
		model : "Chiều dài của colNames <> colModel!"
	},
	formatter : {
		integer : {thousandsSeparator: ".", defaultValue: '0'},
		number : {decimalSeparator:",", thousandsSeparator: ".", decimalPlaces: 2, defaultValue: '0'},
		currency : {decimalSeparator:",", thousandsSeparator: ".", decimalPlaces: 2, prefix: "", suffix:"", defaultValue: '0'},
		date : {
			dayNames:   [
				"CN", "T2", "T3", "T4", "T5", "T6", "T7",
				"Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ s�u", "Thứ bảy"
			],
			monthNames: [
				"Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12",
				"Th�ng một", "Th�ng hai", "Th�ng ba", "Th�ng tư", "Th�ng năm", "Th�ng s�u", "Th�ng bảy", "Th�ng t�m", "Th�ng chín", "Th�ng mười", "Th�ng mười một", "Th�ng mười hai"
			],
			AmPm : ["s�ng","chiều","SÁNG","CHIỀU"],
			S: function (j) {return j < 11 || j > 13 ? ['st', 'nd', 'rd', 'th'][Math.min((j - 1) % 10, 3)] : 'th';},
			srcformat: 'Y-m-d',
			newformat: 'n/j/Y',
			parseRe : /[#%\\\/:_;.,\t\s-]/,
			masks : {
				// see http://php.net/manual/en/function.date.php for PHP format used in jqGrid
				// and see http://docs.jquery.com/UI/Datepicker/formatDate
				// and https://github.com/jquery/globalize#dates for alternative formats used frequently
				// one can find on https://github.com/jquery/globalize/tree/master/lib/cultures many
				// information about date, time, numbers and currency formats used in different countries
				// one should just convert the information in PHP format
				ISO8601Long:"Y-m-d H:i:s",
				ISO8601Short:"Y-m-d",
				// short date:
				//    n - Numeric representation of a month, without leading zeros
				//    j - Day of the month without leading zeros
				//    Y - A full numeric representation of a year, 4 digits
				// example: 3/1/2012 which means 1 March 2012
				ShortDate: "n/j/Y", // in jQuery UI Datepicker: "M/d/yyyy"
				// long date:
				//    l - A full textual representation of the day of the week
				//    F - A full textual representation of a month
				//    d - Day of the month, 2 digits with leading zeros
				//    Y - A full numeric representation of a year, 4 digits
				LongDate: "l, F d, Y", // in jQuery UI Datepicker: "dddd, MMMM dd, yyyy"
				// long date with long time:
				//    l - A full textual representation of the day of the week
				//    F - A full textual representation of a month
				//    d - Day of the month, 2 digits with leading zeros
				//    Y - A full numeric representation of a year, 4 digits
				//    g - 12-hour format of an hour without leading zeros
				//    i - Minutes with leading zeros
				//    s - Seconds, with leading zeros
				//    A - Uppercase Ante meridiem and Post meridiem (AM or PM)
				FullDateTime: "l, F d, Y g:i:s A", // in jQuery UI Datepicker: "dddd, MMMM dd, yyyy h:mm:ss tt"
				// month day:
				//    F - A full textual representation of a month
				//    d - Day of the month, 2 digits with leading zeros
				MonthDay: "F d", // in jQuery UI Datepicker: "MMMM dd"
				// short time (without seconds)
				//    g - 12-hour format of an hour without leading zeros
				//    i - Minutes with leading zeros
				//    A - Uppercase Ante meridiem and Post meridiem (AM or PM)
				ShortTime: "g:i A", // in jQuery UI Datepicker: "h:mm tt"
				// long time (with seconds)
				//    g - 12-hour format of an hour without leading zeros
				//    i - Minutes with leading zeros
				//    s - Seconds, with leading zeros
				//    A - Uppercase Ante meridiem and Post meridiem (AM or PM)
				LongTime: "g:i:s A", // in jQuery UI Datepicker: "h:mm:ss tt"
				SortableDateTime: "Y-m-d\\TH:i:s",
				UniversalSortableDateTime: "Y-m-d H:i:sO",
				// month with year
				//    Y - A full numeric representation of a year, 4 digits
				//    F - A full textual representation of a month
				YearMonth: "F, Y" // in jQuery UI Datepicker: "MMMM, yyyy"
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

if (jQuery("#code-edit").length) {
	editAreaLoader.init({
		id: "code-edit",
		font_family: "Courier New",
		syntax_selection_allow: "css,html,js,php,xml,sql",
		syntax: "php",
		start_highlight: true,
		//allow_resize: "y",
		is_multi_files: true,
		allow_toggle: false,
		//fullscreen:true,
		EA_load_callback: "load_callback"
	});

	function load_callback() {
		open_file('', 'new file', 'php');
	}

	function open_file(a, b, c) {
		$.ajax({
			type: "get",
			url: "./?page=code-creator&act=source&hash_file=" + a + "&data=",
			dataType: "html",
			success: function(result) {
				//console.log(result);
				var new_file = {
					id: b,
					text: result,
					syntax: c
				};
				editAreaLoader.openFile("code-edit", new_file);
			}
		});
	}
};

var jzOpener = {
	target: 'null',
	callback: function(_val) {
		console.log(this.target);
		$(jzOpener.target).val(_val);
	},
	open: function(url, title, target) {
		jzOpener.target = target;
		var newwindow = window.open(url, title, 'height=640,width=800');
		if (window.focus) {
			newwindow.focus()
		}
	}
};

(function($) {
	$.fn.optionType = function() {
		$(".option_type").each(function() {
			var text = $(this).val();
			var label = $(this).attr('data-label');
			var explanation = $(this).attr('data-explanation');
			var enum_select = $(this).attr('data-enum');
			var sub_type = $(this).attr('data-sub-type');
			window.console && console.log(sub_type);
			$(explanation).fadeIn();
			$(explanation).find('label').html('Place Holder');
			$(enum_select).fadeOut();
			$(sub_type).fadeOut();
			switch (text) {
			case 'text':
				$(explanation).fadeIn();
				$(explanation).find('label').html('Place Holder');
				$(enum_select).fadeOut();
				$(sub_type).fadeOut();
				break;
			case 'textarea':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeOut();
				$(enum_select).fadeOut();
				$(sub_type).fadeOut();
				break;
			case 'checkbox':
				$(explanation).fadeIn();
				$(explanation).find('label').html('Explanation');
				$(enum_select).fadeOut();
				$(sub_type).fadeOut();
				break;
			case 'select':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeOut();
				$(enum_select).fadeIn();
				$(sub_type).fadeOut();
				break;
			case 'radio':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeOut();
				$(enum_select).fadeIn();
				$(sub_type).fadeOut();
				break;
			case 'wpcolor':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeIn();
				$(enum_select).fadeOut();
				$(sub_type).fadeOut();
				break;
			case 'media-upload':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeIn();
				$(enum_select).fadeOut();
				$(sub_type).fadeOut();
				break;
			case 'wp_dropdown_pages':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeIn();
				$(enum_select).fadeOut();
				$(sub_type).fadeIn();
				break;
 			case 'wp_dropdown_pages_dinamic':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeIn();
				$(enum_select).fadeOut();
				$(sub_type).fadeIn();
				break;
			case 'wp_dropdown_categories':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeIn();
				$(enum_select).fadeOut();
				$(sub_type).fadeOut();
				break;
			case 'wp_dropdown_users':
				$(explanation).find('label').html('Explanation');
				$(explanation).fadeIn();
				$(enum_select).fadeOut();
				$(sub_type).fadeOut();
				break;
			};
		});
	};
    
    
	$.fn.strToVariable = function() {
		var me = this;
		var str = $(me).val();
		var valid, charCode;
		str = str.split(' ').join('_').toLocaleLowerCase();
		str = str.split('-').join('_').toLocaleLowerCase();
		valid = '';
		for (i = 0; i < str.length; i++) {
			charCode = str[i].charCodeAt();
			if ((charCode < 123) && (charCode > 96) || (charCode == 95) || (charCode < 58) && (charCode > 47)) {
				valid += str[i];
			}
		}
		valid = valid.split('__').join('_').toLocaleLowerCase();
		$(me).val(valid);
		//dom help
		var domHelpBlock = $("<p>").addClass("info-block").append("<span class='fa fa-spinner fa-spin'></span> converting...");
		var help_block = $(me).parent().find('.info-block');
		if ($(help_block).length == 0) {
			$(me).after(domHelpBlock);
		} else {
			$(me).html(domHelpBlock);
		}
		$(me).parent().find('.info-block').fadeOut(1000, function() {
			$(this).replaceWith('');
		});
	};
})(jQuery);


$(document).ready(function() {
	if ($.fn.validate) {
		$('form').validate({
			errorClass: "text-danger",
			validClass: "text-success",
			errorElement: "p",
			unhighlight: function(element) {
				var elmName = $(element)[0].tagName;
				if (($(element).attr('type') == 'text') || ($(element).attr('type') == 'url') || elmName.toLowerCase() == 'textarea') {
					var feedback_icon = $(element).parent().find('.form-control-feedback');
					if ($(feedback_icon).length == 0) {
						$(element).closest('.form-group').addClass('has-feedback');
						var domIcon = $("<span>").addClass('fa fa-spinner fa-spin form-control-feedback text-success').fadeIn(1000, function() {
							$(this).removeClass('fa fa-spinner fa-spin').addClass('glyphicon glyphicon-ok form-control-feedback text-success');
						});
						$(element).parent().append(domIcon);
						console.log('unhighlight 1');
					} else {
						$(feedback_icon).fadeOut(200, function() {
							$(this).removeClass('text-danger').removeClass('glyphicon glyphicon-remove glyphicon-ok').addClass('fa fa-spinner fa-spin').fadeIn(1000, function() {
								$(this).removeClass('fa fa-spinner fa-spin').addClass('text-success').addClass('glyphicon glyphicon-ok');
							});
						});
						console.log('unhighlight 2');
					}
				}
			},
			highlight: function(element) {
				var elmName = $(element)[0].tagName;
				if (($(element).attr('type') == 'text') || ($(element).attr('type') == 'url') || elmName.toLowerCase() == 'textarea') {
					var feedback_icon = $(element).parent().find('.form-control-feedback');
					if ($(feedback_icon).length == 0) {
						$(element).closest('.form-group').addClass('has-feedback');
						var domIcon = $("<span>").addClass('fa fa-spinner fa-spin form-control-feedback text-danger').fadeIn(1000, function() {
							$(this).removeClass('fa fa-spinner fa-spin').addClass('glyphicon glyphicon-remove');
						});
						$(element).parent().append(domIcon);
						console.log('highlight 1');
					} else {
						console.log('highlight 2');
						$(feedback_icon).fadeOut(200, function() {
							$(this).removeClass('text-success').removeClass('glyphicon glyphicon-ok').addClass('fa fa-spinner fa-spin').fadeIn(1000, function() {
								$(this).removeClass('fa fa-spinner fa-spin').addClass('text-danger').addClass('glyphicon glyphicon-remove');
							});
						});
					}
				}
			},
		});
	}
	if ($.fn.colorbox) {
		$('a.colorbox').colorbox({
			rel: 'images'
		});
	}
	if ($.fn.carousel) {
		$('.carousel').carousel();
	}
	$(".remove").click(function() {
		var target = $(this).attr('href');
		$(target).fadeOut().replaceWith('');
	});
	if ($("#Tags").length) {
		$("#Tags").tagsinput();
	}
	if ($("#modal_dialog").length) {
		$("#modal_dialog").modal();
	}
	$(this).optionType();
	$(".option_type").change(function() {
		$(this).optionType();
	});
	$("input[data-type='var']").change(function() {
		$(this).strToVariable();
	});
	if ($.fn.jstree) {
		$('#treefiles').on('changed.jstree', function(e, data) {
			var i, j, file_hash, file_name;
			for (i = 0, j = data.selected.length; i < j; i++) {
				file_hash = data.instance.get_node(data.selected[i]).li_attr['data-file'];
				file_ext = data.instance.get_node(data.selected[i]).li_attr['data-ext'];
				file_name = data.instance.get_node(data.selected[i]).text;
			}
			//console.log(file_name);
			if (file_ext) {
				open_file(file_hash, file_name, file_ext);
			}
		}).jstree();
	}
	$("#filter-icon").keyup(function() {
		var keyword = $(this).val();
		$(".insert-icon").each(function() {
			var find_icon = $(this).attr('href');
			find_icon = find_icon.substr(1, (find_icon.length - 1));
			$(this).addClass('hidden');
			if (find_icon.toLowerCase().indexOf(keyword) >= 0) {
				$(this).removeClass('hidden');
			}
		});
	});
	$(".insert-icon").click(function() {
		var value_icon = $(this).attr('data-icon');
		var class_icon = $(this).attr('data-class');
		$("#preview-icon").attr('class', null);
		$("#preview-icon").addClass(class_icon);
		$("#code-icon").html('&lt;span class="' + class_icon + '"&gt;&lt;/span&gt;');
		$("#filter-icon").val(value_icon);
	});
	$(".opener-dialog").on("click", function(e) {
		e.preventDefault();
		var url = $(this).attr("href");
		var title = $(this).attr("title");
		var target = $(this).attr("data-target");
		jzOpener.open(url, title, target);
	});
});
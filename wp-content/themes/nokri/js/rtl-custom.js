/*
Template Name: Nokri Job Board Theme
Author: ScriptsBundle
Version: 1.0
Designed and Development by: ScriptsBundle

====================================
[ CSS TABLE CONTENT ]
------------------------------------
    
	
	1.0 - Pre Loader
	2.0 - Counter Up
	3.0 - OUR CLIENTS CAROUSEL
	4.0 - TESTIMONIAL 1
	5.0 - TESTIMONIAL 2
	6.0 - ACCORDIAN
	7.0 - FOOTER REVEAL
	8.0 - SEACRH FIXED
	9.0 - MENU
	10.0 - SCROLL TO TOP
	11.0 - FILE UPLOADER
	
	
-------------------------------------
[ END CSS TABLE CONTENT ]
=====================================
*/

(function($) {
    "use strict";

	$('.cand_type_form').on( "click", function() {
		$('form#cand_type_form').submit();
	});
	

	$('.cand_level_form').on( "click", function() {
	$('form#cand_level_form').submit();
	});
	
	$('.cand_skills_form').on( "click", function() {
	$('form#cand_skills_form').submit();
	});
	
	$('.cand_experience_form').on( "click", function() {
	$('form#cand_experience_form').submit();
	});
	
	
	$( ".candidates_orders" ).change(function() {
 	$('form#candiate_order').submit();
	});
	
	
	
	
	$('.new-sidebar .panel-collapse').on('show.bs.collapse', function () {
		$(this).siblings('.panel-heading').addClass('active');
	  });
	
	  $('.new-sidebar .panel-collapse').on('hide.bs.collapse', function () {
		$(this).siblings('.panel-heading').removeClass('active');
	  });
	
	
	/*JQUERY SELECT*/
	
	$('.js-example-basic-single').select2({
		width:'100%',
		dir: "rtl"
	});
 
// Log In Model

  $('.search_company').on( "click", function() {
	$('form#company_form').submit();
});
  
$( ".search_company" ).change(function() {
	$('form#company_form').submit();
});


/*iCheck for others*/
$(document).ready(function(){
  $('.input-icheck-others').iCheck({
	checkboxClass: 'icheckbox_square',
	radioClass: 'iradio_square',
	increaseArea: '10%' 
  });
});

/*Skills bar*/
$(function () { 
  $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
});  

 $( window ).scroll(function() {   
  if($( window ).scrollTop() > 10){  // scroll down abit and get the action   
  $(".progress-bar").each(function(){
	each_bar_width = $(this).attr('aria-valuenow');
	$(this).width(each_bar_width + '%');
  });
	   
   }  
 });


/*SCROLL TO SPASIFIC BLOCK*/
$(function() {
    $('a[href*=#].scroller:not([href=#])').click(function() {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
        if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    });
});

//Job apply with external link
$('#ad_external').on('select2:select', function (e) {
  var link_val = $("#ad_external").select2('val');
  if(link_val == 'exter')
  {
	    $('#job_external_link_feild').show();
		$('#job_external_url').prop('required',true);
  }
  else
  {
	  $('#job_external_url').removeAttr('required');
	 $('#job_external_link_feild').hide(); 
  }
});

/*iCheck*/
/*$(document).ready(function(){
  $('.input-icheck').iCheck({
	checkboxClass: 'icheckbox_square',
	radioClass: 'iradio_square',
	increaseArea: '10%' 
  });
});*/
// Alphabet Click
$('.alphabets a').on( "click", function() {
$('.cp-loader').show();
 var value = $(this).data("value");
 $("#alphabet").val(value);
$('form#alphabets_form').submit();
});
// Candidalte List order
$( ".cand_list_order" ).change(function() {
	$('.cp-loader').show();
	$('form#cand_list_order').submit();
});
$( ".job_search" ).change(function() {
 $('form#job_search').submit();
});

 $('.search_job').on( "click", function() {
 $('form#sav_job_search').submit();
});

$('.search_aplied_job').on( "click", function() {
 $('form#job_search').submit();
});

 /*--- Employer Active Job Form ---*/
$('.submit_emp_active_job_form').on( "click", function() {
	$('form#emp_active_job').submit();
});

$( ".emp_active_job" ).change(function() {
 	$('form#emp_active_job').submit();
});


 
/*--- End Employer Active Job Form  ---*/
  
 /*--- Employer Followers  Form ---*/
$( ".emp_followers_form" ).change(function() {
	$('form#follower_form').submit();
});
 /*--- Employer Followers  Form ---*/
 
 
  /*--- Employer Resumes  Form ---*/
  
  $('.search_resume').on( "click", function() {
	$('form#emp_resumes_form').submit();
});
  
$( ".resumes_filter" ).change(function() {
	$('form#emp_resumes_form').submit();
});
 /*--- Employer Followers  Form ---*/
 
 /*--- Employer Pakckages  Form ---*/ 
 $( ".order_form" ).change(function() {
	$('form#order_form').submit();
});
 

   /*--- Toggle Value ---*/
  $('input[name="is_opened_all"]').on('switchChange.bootstrapSwitch', function(event, state) {
  $("#business-hours-fields").slideToggle( "slow");
  $("#timezone").slideToggle( "slow");
 });
    /*--- Toggle Value ---*/
    $("#sortable").sortable();
    $("#sortable").disableSelection();
    /*--- PRE LOADER JS ---*/

    var nokri_ajax_url = $('#nokri_ajax_url').val();
    /*--- Counter Up---*/

    $('.counter-stats').counterUp({
        delay: 10,
        time: 2000
    });
    /* ======= Masonry Grid System ======= */
	$('.posts-masonry').masonry();
	/*--- OUR CLIENTS CAROUSEL---*/
	 $(".clients-list").owlCarousel({
		nav:false,
        loop:true,
		rtl:true,
		margin:10,
		dots: false,
		autoplay:true,
		autoplayTimeout:5000,
		autoplaySpeed:3000,
		responsiveClass:true,
		responsive:{
			0:{
				items:2,
			},
			600:{
				items:4,
			},
			1000:{
				items:6,
			}
		}
    });
	
	/*--- Owl  Carousel clients --*/
$('.n-client-box').owlCarousel({
			dots: false,
			rtl:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:4
				},
				1000:{
					items:5
				}
			}
		});

  	/*--- Owl  Carousel --*/
   	$(".featured-job-slider").owlCarousel({
		nav:true,
		navText:["<i class='ti-angle-left'></i>","<i class='ti-angle-right'></i>"],
        loop:false,
		dots: false,
		rtl:true,
		autoplay:true,
		autoplayTimeout:10000,
		autoplaySpeed:1500,
		responsiveClass:true,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:1,
			},
			1000:{
				items:1,
			}
		}
    });
	
	/*--- Clients carousel---*/
	$('.n-owl-testimonial-23').owlCarousel({
			dots: false,
			loop: false,
			rtl:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:2
				},
				1000:{
					items:3
				}
			}
		});
		
		
$('.n-owl-testimonial-2').owlCarousel({
		nav:true,
		rtl:true,
		navText:["<i class='ti-angle-left'></i>","<i class='ti-angle-right'></i>"],
		dots: true,
		loop: true,
		margin:20,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:3
			}
		}
	});	
		
	
	/*--- MAIN SECTION CATS---*/
$(".featured-cat").owlCarousel({
  nav:false,
  loop:true,
  rtl:true,
  dots: false,
  autoplay:true,
  autoplayTimeout:5000,
  autoplaySpeed:3000,
  autoplayHoverPause:true,
  responsiveClass:true,
  responsive:{
   0:{
    items:3,
   },
   600:{
    items:5,
   },
   1000:{
    items:6,
   }
  }
    });

	
	/*--- TESTIMONIAL 2---*/

    $(".owl-testimonial-2").owlCarousel({
        nav:false,
		navText:false,
        loop:true,
		rtl:true,
		dots: false,
		autoplay:true,
		autoplayTimeout:10000,
		autoplaySpeed:1500,
		responsiveClass:true,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:2,
			},
			1000:{
				items:3,
			}
		}
    });
	
	
	
	/*--- TESTIMONIAL 1---*/
	$("#owl-testimonial").owlCarousel({
		nav:false,
		//navText:["<i class='ti-angle-left'></i>","<i class='ti-angle-right'></i>"],
        loop:true,
		dots: true,
		rtl:true,
		autoplay:true,
		autoplayTimeout:7000,
		autoplaySpeed:1500,
		responsiveClass:true,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:2,
			},
			1000:{
				items:2,
			}
		}
    });

	$(".full-width-job-slider").owlCarousel({
		nav:true,
		rtl:true,
		navText:["<i class='ti-angle-left'></i>","<i class='ti-angle-right'></i>"],
        loop:true,
		dots: false,
		margin:10,
		autoplay:true,
		autoplayTimeout:10000,
		autoplaySpeed:1500,
		responsiveClass:true,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:3,
			},
			1000:{
				items:3,
			}
		}
    });
	$(".category-style-3-slider").owlCarousel({
		nav:false,
		rtl:true,
		//navText:["<i class='ti-angle-left'></i>","<i class='ti-angle-right'></i>"],
        loop:false,
		dots: false,
		margin:10,
		autoplay:true,
		autoplayTimeout:10000,
		autoplaySpeed:1500,
		responsiveClass:true,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:3,
			},
			1000:{
				items:4,
			}
		}
    });
	/*TOP HIRING COMPIES SLIDER*/
	$(".top-hiring-company-slider").owlCarousel({
		nav:false,
		rtl:true,
		//navText:["<i class='ti-angle-left'></i>","<i class='ti-angle-right'></i>"],
        loop:true,
		dots: false,
		margin:10,
		autoplay:true,
		autoplayTimeout:7000,
		autoplaySpeed:1500,
		responsiveClass:true,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:3,
			},
			1000:{
				items:5,
			}
		}
    });

    /*--- ACCORDIAN---*/

    $('.panel-heading').on( "click", function() {
        $('.panel-heading').removeClass('tab-collapsed');
        var collapsCrnt = $(this).find('.collapse-controle').attr('aria-expanded');
        if (collapsCrnt != 'true') {
            $(this).addClass('tab-collapsed');
        }
    });

/******** Start New JS **********/

$(".select-generat ").select2({
        placeholder: get_strings.option_select,
        allowClear: true,
        maximumSelectionLength: 10,
		dir: "rtl",
		
    });
    
    
    /* ======= Progress bars ======= */
			$('.progress-bar > span').each(function() {
					var $this = $(this);
					var width = $(this).data('percent');
					$this.css({
						'transition': 'width 3s'
					});
					setTimeout(function() {
						$this.appear(function() {
							$this.css('width', width + '%');
						});
					}, 500);
				});

		/*MOBILD DASHBOARD MENU*/
			$(".menu-dashboard").on('click',function(){
				$(".profile-menu").toggleClass("position");
			});	


/*MOBILD DASHBOARD MENU*/
 $('#dashboard-bar-right').theiaStickySidebar({
  additionalMarginTop: 80
 });

 $('#side-fix').theiaStickySidebar({
  additionalMarginTop: 80
 });
 
 /*Premium Jobs vertical slider*/
 $(document).ready(function(){
	 $( ".slider-1" ).each(function() {
		$(this).bxSlider({
			 mode: 'vertical',
			moveSlides: 1,
			infiniteLoop: true,
			minSlides: 3,
			maxSlides: 3,
			speed: 2000,
			controls: true,
			nextText: '<i class="fa fa-angle-right"></i>',
			prevText:'<i class="fa fa-angle-left"></i>',
			pager:false,
			auto:true,
			autoHover:true,
			pause:$(this).attr('data-slider-speed'),
			//ticker:true,
		});
	
	 });
});
 
 
 $(document).ready(function() {
	 $('#hero-cat-parralex').show();
/*--- Owl  Carousel categories --*/
$('.main-hero-cat').owlCarousel({
	nav:true,
	rtl:true,
	navText:["<i class='ti-angle-left'></i>","<i class='ti-angle-right'></i>"],
	loop:true,
	dots: false,
	responsive:{
		0:{
			items:1
		},
		600:{
			items:2
		},
		1000:{
			items:4
		}
	}
});
});



/******** End New JS **********/


    $('#tags_tag').tagEditor({
    placeholder: get_strings.select_tags,
	removeDuplicates: false,
});
    /* --- SEACRH FIXED---*/

    $(window).scroll(function() {

        var scrollTop = $(window).scrollTop();
        if (scrollTop > 300) {
            $(".search").addClass("navbar-fixed-top");

        } else if (scrollTop < 300) {
            $(".search").removeClass("navbar-fixed-top");
        }

    });

    $(".questions-category").select2({
        placeholder: get_strings.option_select,
        allowClear: true,
        maximumSelectionLength: 15,
		dir: "rtl"
    });

    $(".select-category ").select2({
        placeholder: get_strings.option_select,
        allowClear: true,
        maximumSelectionLength: 13,
		dir: "rtl"
    });
    $(".select-location").select2({
        placeholder: get_strings.option_select,
        allowClear: true,
        maximumSelectionLength: 13,
		dir: "rtl"
    });

    $(".select-resume").select2({
        placeholder: get_strings.option_select,
        allowClear: true,
		dir: "rtl"
    });
	
	$(".select-generat").select2({
        placeholder: get_strings.option_select,
        allowClear: true,
        maximumSelectionLength: 15,
		dir: "rtl",
    });

    /*--- Drop Zone For Portfolio---*/
    function sbDropzone_image() {
        Dropzone.autoDiscover = false;
        var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
        var fileList = new Array;
        var i = 0;
        $("#dropzone").dropzone({
            addRemoveLinks: true,
            paramName: "my_file_upload",
            maxFiles: $('#sb_upload_limit').val(), //change limit as per your requirements
            acceptedFiles: '.jpeg,.jpg,.png',
            dictMaxFilesExceeded: $('#adforest_max_upload_reach').val(),
            /*acceptedFiles: acceptedFileTypes,*/
            url: nokri_ajax_url + "?action=nokri_upload_portfolio&is_update=" + $('#is_update').val(),
            parallelUploads: 1,
            dictDefaultMessage: $('#dictDefaultMessage').val(),
            dictFallbackMessage: $('#dictFallbackMessage').val(),
            dictFallbackText: $('#dictFallbackText').val(),
            dictFileTooBig: $('#dictFileTooBig').val(),
            dictInvalidFileType: $('#dictInvalidFileType').val(),
            dictResponseError: $('#dictResponseError').val(),
            dictCancelUpload: $('#dictCancelUpload').val(),
            dictCancelUploadConfirmation: $('#dictCancelUploadConfirmation').val(),
            dictRemoveFile: $('#dictRemoveFile').val(),
            dictRemoveFileConfirmation: null,
            init: function() {
                var thisDropzone = this;
                $.post(nokri_ajax_url, {
                    action: 'get_uploaded_portfolio_images',
                }).done(function(data) {
					if(data != 0)
					{
                    $.each(data, function(key, value) {
                        var mockFile = {
                            name: value.name,
                            size: value.size
                        };
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.name);
                        $('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", value.id);
                        i++;
                    });
					}
                    if (i > 0)
                        $('.dz-message').hide();
                    else
                        $('.dz-message').show();
                });
                this.on("addedfile", function(file) {
                    $('.dz-message').hide();
                });
                this.on("success", function(file, responseText) {
                    var res_arr = responseText.split("|");
                    if ($.trim(res_arr[0]) != "0") {
                        $('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", responseText);
                        i++;
                        $('.dz-message').hide();
                    } else {
                        if (i == 0)
                            $('.dz-message').show();
                        this.removeFile(file);
                        toastr.error(res_arr[1], '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });
                this.on("removedfile", function(file) {
                    var img_id = file._removeLink.attributes[2].value;
                    if (img_id != "") {
                        i--;
                        if (i == 0)
                            $('.dz-message').show();
                        $.post(nokri_ajax_url, {
                            action: 'delete_ad_image',
                            img: img_id,
                            is_update: $('#is_update').val(),
                        }).done(function(response) {
                           if ($.trim(response) == "1") {
                               toastr.success($('#del_msg').val(), '', {
									timeOut: 2500,
									"closeButton": true,
									"positionClass": "toast-top-right"
								});
                            }
							else {
                               toastr.warning($('#demo_mode').val(), '', {
									timeOut: 2500,
									"closeButton": true,
									"positionClass": "toast-top-right"
								});
                            }
                        });
                    }
                });

            },

        });
    }
    sbDropzone_image();
    /*--- End Drop Zone For Portfolio---*/

    /*--- Drop Zone For Resumes---*/

    function sbDropzone_resume() {
        Dropzone.autoDiscover = false;
        var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
        var fileList = new Array;
        var i = 0;
        $("#dropzone_resume").dropzone({
            addRemoveLinks: true,
            paramName: "my_cv_upload",
            maxFiles: $('#sb_upload_limit').val(), //change limit as per your requirements
            acceptedFiles: '.txt,.doc,.docx,.pdf',
            dictMaxFilesExceeded: $('#adforest_max_upload_reach').val(),
            /*acceptedFiles: acceptedFileTypes,*/
            url: nokri_ajax_url + "?action=cand_resume&is_update=" + $('#is_update').val(),
            parallelUploads: 1,
            dictDefaultMessage: $('#dictDefaultMessage').val(),
            dictFallbackMessage: $('#dictFallbackMessage').val(),
            dictFallbackText: $('#dictFallbackText').val(),
            dictFileTooBig: $('#dictFileTooBig').val(),
            dictInvalidFileType: $('#dictInvalidFileType').val(),
            dictResponseError: $('#dictResponseError').val(),
            dictCancelUpload: $('#dictCancelUpload').val(),
            dictCancelUploadConfirmation: $('#dictCancelUploadConfirmation').val(),
            dictRemoveFile: $('#dictRemoveFile').val(),
            dictRemoveFileConfirmation: null,
            init: function() {
                var thisDropzone = this;
                $.post(nokri_ajax_url, {
                    action: 'get_uploaded_cand_resume',
                }).done(function(data) {
                    $.each(data, function(key, value) {
                        var mockFile = {
                            name: value.display_name,
                            size: value.size
                        };
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.name);
                        $('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", value.id);
                        i++;
                    });
                    if (i > 0)
                        $('.dz-message').hide();
                    else
                        $('.dz-message').show();
                });
                this.on("addedfile", function(file) {
                    $('.dz-message').hide();
                });
                this.on("success", function(file, responseText) {
                    var res_arr = responseText.split("|");
                    if ($.trim(res_arr[0]) != "0") {
                        $('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", responseText);
                        i++;
                        $('.dz-message').hide();
                    } else {
                        if (i == 0)
                            $('.dz-message').show();
                        this.removeFile(file);
                        toastr.error(res_arr[1], '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });
                this.on("removedfile", function(file) {
					 var resume_id = file._removeLink.attributes[2].value;
                    if (resume_id != "") {
                        i--;
                        if (i == 0)
                            $('.dz-message').show();
						 $.post(nokri_ajax_url, {
                            action: 'delete_cand_resume',
                            resume: resume_id,
                            is_update: $('#is_update').val(),
                        }).done(function(response) {
                            if ($.trim(response) == "1") {
                               toastr.success($('#del_msg').val(), '', {
									timeOut: 2500,
									"closeButton": true,
									"positionClass": "toast-top-right"
								});
                            }
							else {
                               toastr.warning($('#demo_mode').val(), '', {
									timeOut: 2500,
									"closeButton": true,
									"positionClass": "toast-top-right"
								});
                            }
                        });
                    }
                });

            },

        });
    }
    sbDropzone_resume();
    /*--- End Drop Zone For Resumes---*/

    /* Candidate Deleting  Resumes */
	
    $(".del_my_resume").on("click", function() {
		var del_val = $('.del_my_resume').attr("value");
		$.confirm({
		animationBounce: 1.5,
		closeAnimation: 'rotateXR',
        title: get_strings.confirmation,
        content: get_strings.content,
        type: 'red',
        buttons: {
            tryAgain: {
                text: get_strings.btn_cnfrm,
                btnClass: 'btn-red',
                action: function(){
		 $('.cp-loader').show();
        $.post(nokri_ajax_url, {
            action: 'delete_cand_resume',
            resume: del_val,
        }).done(function(response) {
            $('.cp-loader').hide();
            if ($.trim(response) !== "") {
			      $.dialog({
					        title: get_strings.success,
							content: get_strings.action_success,
                            icon: 'fa fa-smile-o',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
				});
            } else {
                toastr.error($('#job_cv_action_fail').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
                }
            },
            close: function () {
            }
        }
    });
    });

	 /* Candidate  Deleting Saved Jobs */

    $(".del_saved_job").on("click", function() {
        var del_job_id = $(this).attr("data-value");
		$.confirm({
		animationBounce: 1.5,
		closeAnimation: 'rotateXR',
        title: get_strings.confirmation,
        content: get_strings.content,
        type: 'red',
        buttons: {
            tryAgain: {
                text: get_strings.btn_cnfrm,
                btnClass: 'btn-red',
                action: function(){
		 $('.cp-loader').show();
        $.post(nokri_ajax_url, {
            action: 'del_saved_job',
            cand_job_id: del_job_id,
        }).done(function(response) {
            $('.cp-loader').hide();
            if ($.trim(response) == "1") {
			      $.dialog({
					        title: get_strings.success,
							content: get_strings.action_success,
                            icon: 'fa fa-smile-o',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
				});
				$("#save-job-html-"+del_job_id).remove();
            } else {
                toastr.warning($('#demo_mode').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
                }
            },
            close: function () {
				 $('.cp-loader').hide();
            }
        }
    });
    });


	/* ======= Revolution slider  Home Page Cleaning ======= */
    if ($('.slider-grid-3').length > 0) {
                $(".slider-grid-3").revolution({
                    delay: 9000,
                    startwidth: 1170,
                    startheight: 620,
                    onHoverStop: "off",
                    hideThumbs: 1,
                    hideTimerBar: "on",
                    navigationType: "none",
                    navigationStyle: "preview3",
                    fullWidth: "on",
                    dottedOverlay: "custom",
                    fullScreen: "off",
                    fullScreenOffsetContainer: ""
                });
            }

    /*--- MENU---*/

    $('.mega-menu').megaMenu({
        // DESKTOP MODE SETTINGS
        logo_align: 'left',
        /* align the logo left or right. options (left) or (right)*/
        links_align: 'left',
        /* align the links left or right. options (left) or (right)*/
        socialBar_align: 'left',
        /*align the socialBar left or right. options (left) or (right)*/
        searchBar_align: 'right',
        /*align the search bar left or right. options (left) or (right)*/
        trigger: 'hover',
        /*show drop down using click or hover. options (hover) or (click)*/
        effect: 'fade',
        /*drop down effects. options (fade), (scale), (expand-top), (expand-bottom), (expand-left), (expand-right)*/
        effect_speed: 400,
        /*drop down show speed in milliseconds*/
        sibling: true,
        /*hide the others showing drop downs if this option true. this option works on if the trigger option is "click". options (true) or (false)*/
        outside_click_close: true,
        /*hide the showing drop downs when user click outside the menu. this option works if the trigger option is "click". options (true) or (false)*/
        top_fixed: false,
        /*fixed the menu top of the screen. options (true) or (false)*/
        sticky_header: false,
        /*menu fixed on top when scroll down down. options (true) or (false)*/
        sticky_header_height: 200,
        /* sticky header height top of the screen. activate sticky header when meet the height. option change the height in px value.*/
        menu_position: 'horizontal',
        /* change the menu position. options (horizontal), (vertical-left) or (vertical-right)*/
        full_width: false,
        /*make menu full width. options (true) or (false)*/
        /* MOBILE MODE SETTINGS*/
        mobile_settings: {
            collapse: true,
            /*collapse the menu on click. options (true) or (false)*/
            sibling: true,
            /*hide the others showing drop downs when click on current drop down. options (true) or (false)*/
            scrollBar: true,
            /*enable the scroll bar. options (true) or (false)*/
            scrollBar_height: 400,
            /*scroll bar height in px value. this option works if the scrollBar option true.*/
            top_fixed: false,
            /*fixed menu top of the screen. options (true) or (false)*/
            sticky_header: false,
            /*menu fixed on top when scroll down down. options (true) or (false)*/
            sticky_header_height: 200 /*sticky header height top of the screen. activate sticky header when meet the height. option change the height in px value.*/
        }
    });


    /*--- SCROLL TO TOP---*/

    $(document).ready(function() {

        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });


        $('.scrollup').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });

    });


    // Validating Registration process
    if ($('#sb-signup-form').length > 0) {
		$('#my-alert').hide();  
		$('#contct').hide();
        $('#sb_register_msg').hide();
        $('#sb_register_redirect').hide();
        $('#sb-signup-form').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                $('.cp-loader').show();
                // Ajax for Registration 
                $('#sb_register_submit').hide();
                $('#sb_register_msg').show();
                $.post(nokri_ajax_url, {
                    action: 'sb_register_user',
                    sb_signup_data: $("form#sb-signup-form").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
                    $('#sb_register_msg').hide();
                    if ($.trim(response) == '1') {
                        $('#sb_register_redirect').show();
						$('#my-alert').show();
                        window.location = $('#profile_page').val();
                    }
					else if ($.trim(response) == '2') {
                        $.alert({
                            title: get_strings.rgstr_info,
                            icon: 'fa fa-envelope-o',
                            type: 'green',
                            content: $('#verify_account_msg').val(),
                            buttons: {
                                okay: {
                                    text: get_strings.rgstr_resend,
                                    btnClass: 'btn-blue',
                                    action: function() {
                                        var usr_email = $('#sb_reg_email').val();
                                        $.post(nokri_ajax_url, {
                                            action: 'sb_resend_email',
                                            usr_email: usr_email,
                                        }).done(function(response)
										{
                                            toastr.success($('#verify_account_msg').val(), '', {
                                                timeOut: 3500,
                                                "closeButton": true,
                                                "positionClass": "toast-top-right"
                                            });
											if($('#is_email_on').val() == 1)
											{
											 	$('#contct').show();
											}
                                        });
                                    }
                                },
                                cancelAction: {
                                    text: get_strings.rgstr_close,
                                    btnClass: 'btn-red',
                                    action: function() {
										 $('#my-alert').show();
                                    }
                                }
                            }
                        });
                    } 
					else if ($.trim(response) == '3') {
					$('#sb_register_submit').show();
                    toastr.warning($('#demo_mode').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
                    } 
					else {
                        $('#sb_register_submit').show();
                        toastr.error(response, '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });

                return false;
            });
    }

    /*Resend Email*/
    $('#resend_email').on('click', function() {
        var usr_email = $('#sb_reg_email').val();
        $.post(nokri_ajax_url, {
            action: 'sb_resend_email',
            usr_email: usr_email,
        }).done(function(response) {
            toastr.success($('#verify_account_msg').val(), '', {
                timeOut: 3500,
                "closeButton": true,
                "positionClass": "toast-top-right"
            });
            $('#my-alert').hide();
            $('#contct').show();
        });
    });
    // Validating SignIn process	

    if ($('#sb-login-form-data').length > 0) {
        // Login Process
        $('#sb_login_msg').hide();
        $('#sb_login_redirect').hide();

        $('#sb-login-form-data').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                $('#sb_loading').show();
                $('.cp-loader').show();
                // Ajax for Registration
                $('#sb_login_submit').hide();
                $('#sb_login_msg').show();
                $.post(nokri_ajax_url, {
                    action: 'sb_login_user',
                    sb_login_data: $("form#sb-login-form-data").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
                    $('#sb_loading').hide();
                    $('#sb_login_msg').hide();

                    if ($.trim(response) == '1') {
                        $('#sb_login_redirect').show();
                        window.location = $('#profile_page').val();
                    } else {
                        $('#sb_login_submit').show();
                        toastr.error(response, '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-bottom-right"
                        });

                    }
                });

                return false;
            });
    }

    /*// Forgot Password*/
    if ($('#sb-forgot-form').length > 0) {
        $('#sb_forgot_msg').hide();

        $('#sb-forgot-form').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                // Ajax for Registration
                $('#sb_forgot_submit').hide();
                $('#sb_forgot_msg').show();
                $('.cp-loader').show();
                $.post(nokri_ajax_url, {
                    action: 'sb_forgot_password',
                    sb_data: $("form#sb-forgot-form").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
                    $('#sb_forgot_msg').hide();

                    if ($.trim(response) == '1') {
                        $('#sb_forgot_submit').show();
                        $('#sb_forgot_email').val('');
                        toastr.success($('#nokri_forgot_msg').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                        $('#myModal').modal('hide');
                    } else {
                        $('#sb_forgot_submit').show();
                        toastr.error(response, '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });

                return false;
            });
    }


 $(window).on('load',function(){
       $('#sb_reset_password_modal').modal('show');
    });

  if ($('#sb-reset-password-form').length > 0) {
        $('#sb_reset_password_msg').hide();
        $('#sb-reset-password-form').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                if ($('#sb_new_password').val() != $('#sb_confirm_new_password').val()) {
                    toastr.error($('#nokri_password_mismatch_msg').val(), '', {
                        timeOut: 2500,
                        "closeButton": true,
                        "positionClass": "toast-top-right"
                    });
                    return false;
                }
                 //Ajax for Registration
                $('#sb_reset_password_submit').hide();
                $('#sb_reset_password_msg').show();
                $('#sb_loading').show();
                $.post(nokri_ajax_url, {
                    action: 'sb_reset_password',
                    sb_data: $("form#sb-reset-password-form").serialize(),
                }).done(function(response) {
                    $('#sb_loading').hide();
                    $('#sb_reset_password_msg').hide();

                    var get_r = response.split('|');
                    if ($.trim(get_r[0]) == '1') {
                        toastr.success(get_r[1], '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                        $('#sb_reset_password_modal').modal('hide');
                        $('#sb_reset_password_submit').show();
						 $('#login-modal').modal('show');
                    } else {
                        $('#sb_reset_password_submit').show();
                        toastr.error(get_r[1], '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });

                    }

                });

                return false;
            });
    }

    /* Employer Profile  */

    // Validating Employer Profile process
    if ($('#sb-emp-profile').length > 0) {
        $('#sb_register_redirect').hide();
		$('#emp_proc').hide();
		$('#emp_redir').hide();
        $('#sb-emp-profile').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                $('.cp-loader').show();
				$('#emp_proc').show();
				$('#emp_save').hide();
                // Ajax for Registration
                $.post(nokri_ajax_url, {
                    action: 'emp_profiles',
                    sb_data: $("form#sb-emp-profile").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
					$('#emp_proc').hide();
					$('#emp_redir').show();
                    if ($.trim(response) == '1') {
                        toastr.success($('#nokri_emp_profile_save').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
						location.reload();
                    } else {
                         toastr.warning($('#demo_mode').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });

                return false;
            });
    }






    // Validating contact me process
    if ($('#contact_form_email').length > 0) {
        $('#sb_register_redirect').hide();
		$('#emp_proc').hide();
		$('#emp_redir').hide();
        $('#contact_form_email').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                $('.cp-loader').show();
				$('#emp_proc').show();
				$('#emp_save').hide();
                // Ajax for Registration
                $.post(nokri_ajax_url, {
                    action: 'contact_me',
                    contact_me_data: $("form#contact_form_email").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
					$('#emp_proc').hide();
					$('#emp_redir').show();
                    if ($.trim(response) == '1') {
                        toastr.success($('#contact_sent').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
						document.getElementById("contact_form_email").reset();
						//location.reload();
                    } else {
                        toastr.error(response, '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });

                return false;
            });
    }





    // Upload Employers profile picture 
    $('body').on('change', '.sb_files-data', function(e) {

        var fd = new FormData();
        var files_data = $('.form-group .sb_files-data');

        $.each($(files_data), function(i, obj) {
            $.each(obj.files, function(j, file) {
                fd.append('my_file_upload[' + j + ']', file);
            });
        });

        fd.append('action', 'upload_user_pic');
        $('.cp-loader').show();
        $.ajax({
            type: 'POST',
            url: nokri_ajax_url,
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {
                $('.cp-loader').hide();
                var res_arr = res.split("|");
                if ($.trim(res_arr[0]) == "1") {
                    toastr.success($('#nokri_dp_save').val(), '', {
                        timeOut: 2500,
                        "closeButton": true,
                        "positionClass": "toast-top-right"
                    });

                    $('#emp_dp').attr('src', res_arr[1]);

                } else {
                    toastr.error(res_arr[1], '', {
                        timeOut: 2500,
                        "closeButton": true,
                        "positionClass": "toast-top-right"
                    });
                }

            }
        });


    });

    // Upload Employers Cover picture 
    $('body').on('change', '.sb_files-data-cover', function(e) {

        var fd = new FormData();
        var files_data = $('.form-group .sb_files-data-cover');

        $.each($(files_data), function(i, obj) {
            $.each(obj.files, function(j, file) {
                fd.append('my_file_upload_cover[' + j + ']', file);
            });
        });

        fd.append('action', 'upload_user_cover');
        $('.cp-loader').show();
        $.ajax({
            type: 'POST',
            url: nokri_ajax_url,
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {
                $('.cp-loader').hide();
                var res_arr = res.split("|");
                if ($.trim(res_arr[0]) == "1") {
                    toastr.success($('#nokri_emp_profile_save').val(), '', {
                        timeOut: 2500,
                        "closeButton": true,
                        "positionClass": "toast-top-right"
                    });
					 $('#emp_cover').attr('src', res_arr[1]);
                } else {
                    toastr.error(res_arr[1], '', {
                        timeOut: 2500,
                        "closeButton": true,
                        "positionClass": "toast-top-right"
                    });
                }

            }
        });


    });

    /* Employers Deleting  Jobs */

       $(".del_my_job").on("click", function() {
        var my_job_id = $(this).attr("data-value");
		$.confirm({
		animationBounce: 1.5,
		closeAnimation: 'rotateXR',
        title: get_strings.confirmation,
        content: get_strings.content,
        type: 'red',
        buttons: {
            tryAgain: {
                text: get_strings.btn_cnfrm,
                btnClass: 'btn-red',
                action: function(){
		 $('.cp-loader').show();
        $.post(nokri_ajax_url, {
            action: 'del_emp_job',
            emp_job_id: my_job_id,
        }).done(function(response) {
            $('.cp-loader').hide();
            if ($.trim(response) == "1") {
			      $.dialog({
					        title: get_strings.success,
							content: get_strings.action_success,
                            icon: 'fa fa-smile-o',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
				});
				$("#all-jobs-list-box2-"+my_job_id).remove();
            } else {
                toastr.warning($('#demo_mode').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
                }
            },
            close: function () {
            }
        }
    });
		
	
		
    });


/****************************/
/* Candidate Custom Location*/
/***************************/

if ($('#candidate-profile').length > 0)
{
	$('#ad_country_sub_div').hide();
	$('#ad_country_sub_sub_div').hide();
	$('#ad_country_sub_sub_sub_div').hide();
	// Countries Level
	var country_level = $('#country_level').val();
	if (country_level >= 2) {
				$('#ad_country_sub_div').show();
			}
	if (country_level >= 3) {
				$('#ad_country_sub_sub_div').show();
			}
	if (country_level >= 4) {
				$('#ad_country_sub_sub_sub_div').show();
			}
}

    /* Candidate Profile  */
    // Validating Candidate Profile process
    if ($('#candidate-profile').length > 0) {
		$('.cand_person_pro').hide();
        $('#candidate-profile').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                $('.cp-loader').show();
				$('.cand_person_save').hide();
				$('.cand_person_pro').show();
                // Ajax for Registration
                $.post(nokri_ajax_url, {
                    action: 'candidate_profile_action',
                    candidate_data: $("form#candidate-profile").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
					$('.cand_person_save').show();
				    $('.cand_person_pro').hide();
                    if ($.trim(response) == '1') 
					{
                        toastr.success($('#nokri_emp_profile_save').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    } 
					else {
                        toastr.warning($('#demo_mode').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });

                return false;
            });

    }
    // Upload Candidate profile picture 
    $('body').on('change', '.candidate_files-data', function(e) {

        var fd = new FormData();
        var files_data = $('.form-group .candidate_files-data');
        $.each($(files_data), function(i, obj) {
            $.each(obj.files, function(j, file) {
                fd.append('candidate_dp[' + j + ']', file);
            });
        });
        fd.append('action', 'candidate_dp');
        $('.cp-loader').show();
        $.ajax({
            type: 'POST',
            url: nokri_ajax_url,
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {
                $('.cp-loader').hide();
                var res_arr = res.split("|");
                if ($.trim(res_arr[0]) == "1") {
                    toastr.success($('#nokri_dp_save').val(), '', { 
                        timeOut: 2500,
                        "closeButton": true,
                        "positionClass": "toast-top-right"
                    });

                    $('#candidate_dp').attr('src', res_arr[1]);

                } 
				else if ($.trim(res_arr[0]) == "2") {
                    toastr.warning($('#demo_mode').val(), '', { 
                        timeOut: 2500,
                        "closeButton": true,
                        "positionClass": "toast-top-right"
                    });
                } 
				else {
                    toastr.error(res_arr[1], '', {
                        timeOut: 2500,
                        "closeButton": true,
                        "positionClass": "toast-top-right"
                    });
                }

            }
        });


    });

	
	
    // Candidate Aplly Job Athentication
    $(".apply_job").on( "click", function() {
        $('.cp-loader').show();
		//$("#applying_job").attr('data-job-id');
        var apply_job_id =  $(this).attr('data-job-id');
        $.post(nokri_ajax_url, {
            action: 'aplly_job',
            'apply_job_id': apply_job_id
        }).done(function(response)
		{
                    $('.cp-loader').hide();
                    if ($.trim(response) == '2') 
					{
                        toastr.error($('#not_log_in').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    } 
					else if ($.trim(response) == '3') 
					{
							toastr.info($('#not_cand').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
					else if ($.trim(response) == '5') 
					{
							toastr.warning($('#demo_mode').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
					else if ($.trim(response) == '4') 
					{
							$.dialog({
								title: get_strings.apply_msg,
								content: get_strings.apply_details,
								icon: 'fa fa-frown-o',
								theme: 'modern',
								closeIcon: true,
								animation: 'scale',
								type: 'red',
								});
								setTimeout(function(){
								location.reload();
								},2000);
                    } 
					else {
                       $("#popup-data").html(response);
					   // Initialize Select After Response
						$(".select-generat").select2({
						placeholder: get_strings.resume_select,
						allowClear: true,
						maximumSelectionLength: 5,
						dir: "rtl",
						});
            			$("#myModal-job").modal("show");
            			$('.cp-loader').hide();
                    }
                });
    });

// Candidate short details popups
$(".candidate_short_det").on( "click", function() {
	$('.cp-loader').show();
	$("#short-desc-data").html('');
	var candidate_id   =  $(this).attr('data-applierId');
	var job_id         =  $(this).attr('data-jobid');
	var attachment_id  =  $(this).attr('data-attachid');
	$.post(nokri_ajax_url, {
		action: 'candidate_short_details',
		'candidate_id'		: candidate_id,
		'job_id'      		: job_id,
		'attachment_id'     : attachment_id,
	}).done(function(response)
	{
				$('.cp-loader').hide();
				if ($.trim(response) == '2') 
				{
					toastr.error($('#not_log_in').val(), '', {
						timeOut: 2500,
						"closeButton": true,
						"positionClass": "toast-top-right"
					});
				} 
				else {
				   $("#short-desc-data").html(response);
					$("#short-detail-modal").modal("show");
					$('.cp-loader').hide();
				}
			});
});


 // Candidate resume status action
$(".candidate_resume_action").on( "click", function() {
        $('.cp-loader').show();
        var candidate_id   =  $(this).attr('data-applierId');
		var job_id         =  $(this).attr('data-jobid');
        $.post(nokri_ajax_url, {
            action: 'candidate_resume_status_action',
            'candidate_id'		: candidate_id,
			'job_id'      		: job_id,
        }).done(function(response)
		{
                    $('.cp-loader').hide();
                    if ($.trim(response) == '2') 
					{
                        toastr.error($('#not_log_in').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    } 
					else {
                       $("#status_action_data").html(response);
					   
					   $(function() {
						$('#email_send_toggle').bootstrapToggle();
					  });
					   // Initialize Select After Response
						$(".js-example-basic-single").select2({
						placeholder: get_strings.resume_select,
						allowClear: true,
						maximumSelectionLength: 5,
						});
            			$("#myModalaction").modal("show");
						$("#myModalaction").modal("show");
            			$('.cp-loader').hide();
                    }
                });
    });








// Candidate View Job Application
    $(".view_app").on( "click", function() {
        $('.cp-loader').show();
        var app_job_id = $(this).attr("data-value");
		$("#app-data").html('');
        $.post(nokri_ajax_url, {
            action: 'view_application',
            'app_job_id': app_job_id
        }).done(function(response) {
            $("#app-data").html(response);
            $("#appmodel").modal("show");
            $('.cp-loader').hide();
        });

    });

    // Add to Cart
    $('body').on('click', '.sb_add_cart', function() {
        $('.cp-loader').show();
        $.post(nokri_ajax_url, {
            action:      'sb_add_cart',
            product_id:  $(this).attr('data-product-id'),
            qty:         $(this).attr('data-product-qty'),
			is_free:     $(this).attr('data-product-is-free'),
        }).done(function(response) {
            $('.cp-loader').hide();
            var get_r = response.split('|');
			if ($.trim(get_r[0]) == '3') {
                toastr.success(get_r[1], '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
                window.location = get_r[2];
            } 
			else if ($.trim(get_r[0]) == '5') {
                toastr.warning(get_r[1], '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
               
            } 
			
			 else if ($.trim(get_r[0]) == '4') {
                toastr.error(get_r[1], '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
               
            }
			else if ($.trim(get_r[0]) == '6') {
                toastr.warning(get_r[1], '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
               
            } 
           else if ($.trim(get_r[0]) == '1') {
                toastr.success(get_r[1], '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
                window.location = get_r[2];
            } 
			else {
                toastr.error(get_r[1], '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });

    });

    if ($('#facebook_key').val() != "" && $('#google_key').val() != "" ) {
        // Hello JS
        hello.init({
            facebook: $('#facebook_key').val(),
            google: $('#google_key').val(),
        }, {
            redirect_uri: $('#redirect_uri').val()
        });
    } else if ($('#facebook_key').val() != "" && $('#google_key').val() == "") {
        // Hello JS
        hello.init({
            facebook: $('#facebook_key').val(),
        }, {
            redirect_uri: $('#redirect_uri').val()
        });
    } else if ($('#google_key').val() != "" && $('#facebook_key').val() == "") {
        // Hello JS
        hello.init({
            google: $('#google_key').val(),
        }, {
            redirect_uri: $('#redirect_uri').val()
        });
    }

    // Hello JS Hander
    $('a.btn-social').on('click', function() {
        hello.on('auth.login', function(auth) {
            console.log(auth);
            $('.cp-loader').show();
            // Call user information, for the given network
            hello(auth.network).api('me').then(function(r) {
                if ($('.get_action').val() == 'login' || $('.get_action').val() == 'register') {

                    $.post(nokri_ajax_url, {
                        action: 'sb_social_login',
                        email: r.email,
                        key_code: $('#nonce').val()
                    }).done(function(response) {
                        var get_r = response.split('|');
                        if ($.trim(get_r[0]) == '1') {
                            $('#nonce').val(get_r[1]);
                            if ($.trim(get_r[2]) == '1') {
                                toastr.success(get_r[3], '', {
                                    timeOut: 2500,
                                    "closeButton": true,
                                    "positionClass": "toast-top-right"
                                });
                                window.location = $('#profile_page').val();
                            } 
							else if ($.trim(get_r[2]) == '3') {
                        toastr.warning(get_r[3], '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
							else {
                                toastr.error(get_r[3], '', {
                                    timeOut: 2500,
                                    "closeButton": true,
                                    "positionClass": "toast-top-right"
                                });
                            }

                        }

                    });

                } else {
                    $('#sb_reg_name').val(r.name);
                    $('#sb_reg_email').val(r.email);
                }
                $('.cp-loader').hide();
            });
        });
    });
	 // Validating Acount Type process
$("#social_login_btn").click(function() {
	$('.cp-loader').show();
   $.post(nokri_ajax_url, {
	action: 'after_social_login',
	social_login_data: $("form#social_login_form").serialize(),
	}).done(function(response) {
		$('.cp-loader').hide();
		if ($.trim(response) !== "") {
			toastr.success($('#job_cv_action').val(), '', {
				timeOut: 2500,
				"closeButton": true,
				"positionClass": "toast-top-right"
			});
			window.location = $('#profile_page').val();
		} else {
			toastr.error($('#job_cv_action_fail').val(), '', {
				timeOut: 2500,
				"closeButton": true,
				"positionClass": "toast-top-right"
			});
		}
	});	

});
	

 

    /*Make Post on blur of title field*/
    $('#ad_title').on('blur', function() {
        if ($('#is_update').val() == "") {
            $.post(nokri_ajax_url, {
                action: 'post_ad',
                title: $('#ad_title').val(),
                is_update: $('#is_update').val(),
            }).done(function(response) {

            });
        }

    });
	
    /* ======= Ad Location ======= */
	 if( $('#lat').length > 0 )
		  {
			   var map_type = get_strings.nokri_map_type;
				var lat =	$('#lat').val();
				var lon =	$('#lon').val();
				if( map_type == 'leafletjs_map')
				{
					/*For leafletjs map*/
					var map = L.map('itemMap').setView([lat, lon], 7);					
					L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
						attribution: ''
					}).addTo(map);
					L.marker([lat, lon]).addTo(map);
				}
				else if( map_type == 'google_map')
				{
					
					var map =    "";
					var latlng = new google.maps.LatLng(lat, lon);
					var myOptions = {
					   zoom: 13,
					   center: latlng,
					   scrollwheel: false,
					   mapTypeId: google.maps.MapTypeId.ROADMAP,
					   size: new google.maps.Size(480,240)
				   }
				   map = new google.maps.Map(document.getElementById("itemMap"), myOptions);
				   var marker = new google.maps.Marker({
					   map: map,
					   position: latlng
				   });
				}
		  }
	
	
	
	
	
	
	
	
	
	 /* ======= Contact Map ======= */
	
    if ($('#contact-lat').length > 0) {
        var contact_lat = $('#contact-lat').val();
        var contact_lon = $('#contact-long').val();
        var map = "";
        var latlng = new google.maps.LatLng(contact_lat, contact_lon);
        var myOptions = {
            zoom: 15,
            center: latlng,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            size: new google.maps.Size(480, 240)
        }
        map = new google.maps.Map(document.getElementById("contact-map"), myOptions);
        var marker = new google.maps.Marker({
            map: map,
            position: latlng
        });
    }
	
    /***********/
    /* Job Post*/
    /***********/
	
	
    if ($('#emp-job-post').length > 0) {
		// Countries Hide 
		$('#ad_country_sub_div').hide();
		$('#ad_country_sub_sub_div').hide();
		$('#ad_country_sub_sub_sub_div').hide();
		// Categories Hide 
        $('#second_level').hide();
        $('#third_level').hide();
        $('#forth_level').hide();
		

        if ($('#is_update').val() != "") {
            var level = $('#is_level').val();
            if (level >= 2) {
                $('#ad_cat_sub_div').show();
            }
            if (level >= 3) {
                $('#ad_cat_sub_sub_div').show();
            }
            if (level >= 4) {
                $('#ad_cat_sub_sub_sub_div').show();
            }
			
			// Countries Level
			
		var country_level =		$('#country_level').val();
		if( country_level >= 2 )
		{
			$('#ad_country_sub_div').show();
		}
		if( country_level >= 3 )
		{
			$('#ad_country_sub_sub_div').show();
		}
		if( country_level >= 4 )
		{
			$('#ad_country_sub_sub_sub_div').show();
		}
			
        }
		$('#job_proc').hide();
        $('#job_redir').hide();
        $('#emp-job-post').parsley().on('field:validated', function() {})
            .on('form:submit', function() {
                // Ad Post
                $('.cp-loader').show();
				$('#job_proc').show();
				$('#job_redir').hide();
				$('#job_post').hide();
                $.post(nokri_ajax_url, {
                    action: 'sb_ad_posting',
                    sb_data: $("form#emp-job-post").serialize(),
                    is_update: $('#is_update').val(),
                }).done(function(response) {
                    $('.cp-loader').hide();
					if ($.trim(response) == "2") {
                        toastr.warning($('#demo_mode').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
						$('#job_post').show();
						$('#job_proc').hide();
                    }
                    else if ($.trim(response) == "0") {
                        toastr.error($('#job_post_error').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    } else {
                        toastr.success($('#nokri_emp_job_post').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
						$('#job_proc').hide();
				        $('#job_redir').hide();
						$('#job_redir').show();
                        window.location	=	response;
                    }
                });

                return false;
            });


        if ($('#is_update').val() != "") {
            var level = $('#is_level').val();
            if (level >= 2) {
                $('#second_level').show();
            }
            if (level >= 3) {
                $('#third_level').show();
            }
            if (level >= 4) {
                $('#forth_level').show();
            }
        }

        /* Level 1 */
        $('#job_cat').on('change', function() {
            $('.cp-loader').show();
            $.post(nokri_ajax_url, {
                action: 'get_cats',
                cat_id: $("#job_cat").val(),
            }).done(function(response) {
                $('.cp-loader').hide();
                $("#second_level").val('');
                if ($.trim(response) != "") {
                    second_level
                    $('#job_cat_id').val($("#job_cat").val());
                    $('#second_level').show();
                    $('#job_cat_second').html(response);
                } else {
                    $('#second_level').hide();
                    $('#third_level').hide();
                    $('#forth_level').hide();
                }
            });
        });

        /* Level 2 */
        $('#job_cat_second').on('change', function() {
            $('.cp-loader').show();
            $.post(nokri_ajax_url, {
                action: 'get_cats',
                cat_id: $("#job_cat_second").val(),
            }).done(function(response) {
                $('.cp-loader').hide();
                if ($.trim(response) != "") {
                    $('#ad_cat_id').val($("#ad_cat_sub").val());
                    $('#third_level').show();
                    $('#job_cat_third').html(response);
                } else {
                    $('#third_level').hide();
                    $('#forth_level').hide();
                }

            });
        });

        /* Level 3 */
        $('#job_cat_third').on('change', function() {
            $('.cp-loader').show();
            $.post(nokri_ajax_url, {
                action: 'get_cats',
                cat_id: $("#job_cat_third").val(),
            }).done(function(response) {
                $('.cp-loader').hide();
                $("#ad_cat_sub_sub_sub").val('');
                if ($.trim(response) != "") {
                    $('#ad_cat_id').val($("#ad_cat_sub_sub").val());
                    $('#forth_level').show();
                    $('#job_cat_forth').html(response);
                } else {
                    $('#forth_level').hide();
                }
            });
        });

        /* Level 4 */
        $('#ad_cat_sub_sub_sub').on('change', function() {
            $('#ad_cat_id').val($("#ad_cat_sub_sub_sub").val());
        });

    }

    /* Candidate Submitting Resume On Job */

    $(document).on('click', '#submit_cv_form_btn', function() {

        $('#submit_cv_form1').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                $('.cp-loader').show();
				
                // Ajax Submitting Resume
                $.post(nokri_ajax_url, {
                    action: 'submit_cv_action',
                    submit_cv_data: $("form#submit_cv_form1").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
                    if ($.trim(response) == '1') {
                           $.dialog({
					        title: get_strings.success,
							content: get_strings.action_success,
                            icon: 'fa fa-smile-o',
                            theme: 'modern',
                            closeIcon: true,
                                animation: 'zoom',
    							closeAnimation: 'scale',
                            type: 'blue',
				});
				setTimeout(function(){
					location.reload();
				},2000);
                    } else {
                        toastr.error(response, '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });

                return false;
            });
    });


    /* Candidate Saving  Job */
   $(".save_job").click(function() {
        $('.cp-loader').show();
        var job_id = $(this).attr("data-value");
        $.post(nokri_ajax_url, {
            action: 'save_my_job',
            job_id: job_id,
        }).done(function(response) {
            $('.cp-loader').hide();
            if ($.trim(response) == "1")
			 {
                toastr.success($('#saved_job_success').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            } 
			else if ($.trim(response) == "2")
			{
                toastr.warning($('#not_log_in').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
			else if ($.trim(response) == "3")
			{
                toastr.info($('#not_cand').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
			else if ($.trim(response) == "4")
			{
                toastr.warning($('#demo_mode').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
			else 
			{
                toastr.error($('#job_cv_action_fail').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
			
			
        });
    });
	
	 /* Candidate Already Saved Message */

    $(".saved").click(function() {
               toastr.error($('#saved_job').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
        });
    /* Candidate Following Company */

    $(".follow_company").click(function() {
        $('.cp-loader').show();
        var comp_id = $(this).attr("data-value");
        $.post(nokri_ajax_url, {
            action: 'following_company',
            company_id: comp_id,
        }).done(function(response) {
            $('.cp-loader').hide();
            if ($.trim(response) == "2") {
				toastr.warning($('#not_log_in').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            } else if ($.trim(response) == "3") {  
				toastr.info($('#not_cand').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
			else if ($.trim(response) == "4") {  
				toastr.warning($('#demo_mode').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
			else if ($.trim(response) == "1") {  
				toastr.success($('#comp_folow_success').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
    });
	
    /* Candidate Deleting Following Company */
    $(".unfollow_comp").on("click", function() {
        var comp_id = $(this).attr("data-value");
		$.confirm({
		animationBounce: 1.5,
		closeAnimation: 'rotateXR',
        title: get_strings.confirmation,
        content: get_strings.content,
        type: 'red',
        buttons: {
            tryAgain: {
                text: get_strings.btn_cnfrm,
                btnClass: 'btn-red',
                action: function(){
		 $('.cp-loader').show();
        $.post(nokri_ajax_url, {
            action: 'un_following_company',
            company_id: comp_id,    
        }).done(function(response) {
            $('.cp-loader').hide();
            if ($.trim(response) == "1") {
			      $.dialog({
					        title: get_strings.success,
							content: get_strings.action_success,
                            icon: 'fa fa-smile-o',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
				});
				$("#company-box-"+comp_id).remove();
            } 
			else if ($.trim(response) == '2')
			 {
                    toastr.warning($('#demo_mode').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
                    } 
			else {
                toastr.error($('#job_cv_action_fail').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
                }
            },
            close: function () {
            }
        }
    });
    });

 /* Company Deleting Followings */
 
    $(".unfollow_cands").on("click", function() {
        var follower_id = $(this).attr("data-id");
		$.confirm({
		animationBounce: 1.5,
		closeAnimation: 'rotateXR',
        title: get_strings.confirmation,
        content: get_strings.content,
        type: 'red',
        buttons: {
            tryAgain: {
                text: 'Confirm',
                btnClass: 'btn-red',
                action: function(){
		 $('.cp-loader').show();
        $.post(nokri_ajax_url, {
            action: 'un_following_followers',
            follower_id: follower_id,    
        }).done(function(response) {
            $('.cp-loader').hide();
            if ($.trim(response) == "1") {
			      $.dialog({
					        title: get_strings.success,
							content: get_strings.action_success,
                            icon: 'fa fa-smile-o',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
				});
				$("#company-box-"+follower_id).remove();
            } 
			else if ($.trim(response) == '2') {
		toastr.warning($('#demo_mode').val(), '', {
			timeOut: 2500,
			"closeButton": true,
			"positionClass": "toast-top-right"
		});
	} 
			else {
                toastr.error($('#job_cv_action_fail').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
                }
            },
            close: function () {
            }
        }
    });    });

    /* Employer Action On Resume Request*/
    $('.action_change').on('change', function() {
        $('.cp-loader').show();
        var val = $(this).val();
        var val2 = $("#action_job_id").val();
        var val3 = $(this).attr('data-applier-id');
        $.post(nokri_ajax_url, {
            action: 'job_action',
            cv_action: val,
            job_id: val2,
            cand_id: val3,
        }).done(function(response) {
            $('.cp-loader').hide();

            if ($.trim(response) !== "") {
                $("#status-" + val3).html("<h5>" + response + "</h5>");
                toastr.success($('#job_cv_action').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            } else {
                toastr.error($('#job_cv_action_fail').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
    });

    /* Employer Create  Email Template*/

    if ($('#create_email_template').length > 0) {
		$('#temp_proc').hide();
        $('#create_email_template').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
            })
            .on('form:submit', function() {
                $('.cp-loader').show();
				$('#temp_save').hide();
				$('#temp_proc').show();
                // Ajax for Registration
                $.post(nokri_ajax_url, {
                    action: 'create_email_action',
                    temp_data: $("form#create_email_template").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
					$('#temp_proc').hide();
					$('#temp_save').show();
                    if ($.trim(response) == '1') {
                        toastr.success($('#nokri_emp_profile_save').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    } else {
                         toastr.warning($('#demo_mode').val(), '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });

                return false;
            });
    }

	 /* Employer Select Email Template*/
    $(document).on('change', '.template_select', function() {
        $('.cp-loader').show();
        var temp_val = $( "#temp_select" ).val();
        $.post(nokri_ajax_url, {
            action: 'template_select_action',
			 temp_val: temp_val,
        }).done(function(response) {
            $('.cp-loader').hide();
            $('#email_temp_html').html(response);
			$('.rich_textarea').jqte({
            link: false,
            unlink: false,
            formats: false,
            format: false,
            funit: false,
            fsize: false,
            fsizes: false,
            color: false,
            strike: false,
            source: false,
            sub: false,
            sup: false,
            indent: false,
            outdent: false,
            right: false,
            left: false,
            center: false,
            remove: false,
            rule: false,
            title: false,
        });
        });
    });
	
	 /* Employer  Deleting Email Template */

    $(".del_email_template").on("click", function() {  
        var email_temp_id = $(this).attr("data-tempId");
		$.confirm({
		animationBounce: 1.5,
		closeAnimation: 'rotateXR',
        title: get_strings.confirmation,
        content: get_strings.content,
        type: 'red',
        buttons: {
            tryAgain: {
                text: get_strings.btn_cnfrm,
                btnClass: 'btn-red',
                action: function(){
		 $('.cp-loader').show();
        $.post(nokri_ajax_url, {
            action: 'del_email_temp',
            temp_id: email_temp_id,
        }).done(function(response) {
            $('.cp-loader').hide();
            if ($.trim(response) == "1") {
			      $.dialog({
					        title: get_strings.success,
							content: get_strings.action_success,
                            icon: 'fa fa-smile-o',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
				});
				$("#email_temp_del-"+email_temp_id).remove();
            } else {
                toastr.warning($('#demo_mode').val(), '', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
                }
            },
            close: function () {
				 $('.cp-loader').hide();
            }
        }
    });
    });
	
/* Employer Getting Id Of Candidate Send Email */
$(".email-template-btn").on("click", function() {
			var appID = $(this).attr("data-applierId");
			$("#data-applierId-email").val(appID);
	 });
	 
/* Employer Want To Send Email */
$('.email-status').hide();
$(function() { 
$(document).on('change', '#email_send_toggle', function() { 
var is_email = $(this).prop('checked');
$("#is_send_email").val(is_email);
if(!is_email)
{
	$('.no-email-status').show();
	$('.email-status').hide();
	$('.no-email-subject').hide();
	$('.no-email-body').hide();
}
else
{
	$('.no-email-status').hide();
	$('.email-status').show();
}
});
});
/* Employer Sending Email */
$(document).on('click', '.send_email', function() {
                $('.cp-loader').show();
                // Ajax for Registration
                $.post(nokri_ajax_url, {
                    action: 'sending_email',
                    email_data: $("form#email_template_action").serialize(),
                }).done(function(response) {
                    $('.cp-loader').hide();
                    if ($.trim(response) == '1') {
                        $.dialog({
					        title: get_strings.success,
							content: get_strings.action_success,
                            icon: 'fa fa-smile-o',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
				}); 
				setTimeout(function(){
								//location.reload();
								},2000);  
                    }
					else if ($.trim(response) == '2') {
		toastr.warning($('#demo_mode').val(), '', {
			timeOut: 2500,
			"closeButton": true,
			"positionClass": "toast-top-right"
		});
	} 
					else {
                        toastr.error(response, '', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-top-right"
                        });
                    }
                });

                return false;
           
       });
/*-- Getting Date Picker Value --*/
var is_candidate = $("#is_candidate").val();
	if(is_candidate)
	{
		$( ".datepicker-here, .datepicker-here-canidate" ).each(function( index ) {
			if($(this).val() == "")
			{
				//$(this).datepicker({minDate: $(this).val()});
			}
		});
 	}	



	/*-- DATE AND TIME PICKER Dynamically --*/
	
	$(document).on('click','body *',function() {
		
   		$( ".datepicker-here-canidate" ).each(function( index ) {
				
			if($(this).val() == "")
			{

				//$(this).datepicker({minDate: $(this).val()});
			}
		});
	
	});
	

/* Employer Activating/InActivating Job */
$(".inactive_job").on("click", function() {
var job_id     =   $(this).attr("data-value");
var job_status =   $(this).attr('id');
if(job_status == "active") 
{
	var title        = get_strings.confirmation; 
	var content      = get_strings.content;
	var poptype_type = 'green';
	var btn_class    = 'btn-green';
}
else
{
	var title        = get_strings.confirmation;
	var content      = get_strings.content;
	var poptype_type = 'red';
	var btn_class    = 'btn-red';
}
$.confirm
	({
				animationBounce: 1.5,
				closeAnimation: 'rotateXR',
				title: title,
				content: content,
				type: poptype_type,
				buttons: {
						tryAgain: {
						text: get_strings.btn_cnfrm,
						btnClass: btn_class,
						action: function(){
						$('.cp-loader').show();
						$.post(nokri_ajax_url, {
							action: 'inactive_job',
							job_id: job_id,
							job_status : job_status,
						}).done(function(response) {
							$('.cp-loader').hide();
							if ($.trim(response) == "1") {
								  $.dialog({
											title: get_strings.success,
											content: get_strings.action_success,
											icon: 'fa fa-smile-o',
											theme: 'modern',
											closeIcon: true,
											animation: 'scale',
											type: 'blue',
								});
								$("#all-jobs-list-box2-"+job_id).remove();
							} else {
								toastr.warning($('#demo_mode').val(), '', {
									timeOut: 2500,
									"closeButton": true,
									"positionClass": "toast-top-right"
								});
							}
						});
						}
					},
					close: function () {
						    $('.cp-loader').hide();
					}
				}
			});
	 });
	 
//Countries
  /* Level 1 */
$('#ad_country').on('change', function()
{
  $('.ajax_loader').show();
  $.post(nokri_ajax_url,	{action : 'sb_get_sub_states', cat_id:$( "#ad_country" ).val(), }).done( function(response)
  {
	  $('.cp-loader').hide();
	  $( "#ad_country_states" ).val('');
	  $( "#ad_cat_sub_sub" ).val('');
	  $( "#ad_cat_sub_sub_sub" ).val('');
	  if( $.trim(response) != "" )
	  {
			$('#ad_country_id').val( $( "#ad_cat" ).val() );
			$('#ad_country_sub_div').show();
			$('#ad_country_states').html(response);
			$('#ad_cat_sub_sub_div').hide();
			$('#ad_country_sub_sub_sub_div').hide();
	  }
	  else   
	  {
		  	$('#ad_country_sub_sub_div').hide();
			$('#ad_country_sub_div').hide();  
			$('#ad_cat_sub_sub_div').hide();
			$('#ad_country_sub_sub_sub_div').hide();
			  
	  }
	  
  });
});

/* Level 2 */
$('#ad_country_states').on('change', function()
{
  $('.cp-loader').show();
  $.post(nokri_ajax_url,	{action : 'sb_get_sub_states', cat_id:$( "#ad_country_states" ).val(), }).done( function(response)
  {
	  $('.cp-loader').hide();
	  $( "#ad_country_cities" ).val('');
	  $( "#ad_country_towns" ).val('');
	  if( $.trim(response) != "" )
	  {
			$('#ad_country_id').val( $( "#ad_country_states" ).val() );
			$('#ad_country_sub_sub_div').show();
			$('#ad_country_cities').html(response);
			$('#ad_country_sub_sub_sub_div').hide(); 
	  }
	  else
	  {
			$('#ad_country_sub_sub_div').hide();
			$('#ad_country_sub_sub_sub_div').hide();
	  }
  });
});

/* Level 3 */
$('#ad_country_cities').on('change', function()
{
  $('.cp-loader').show();
  $.post(nokri_ajax_url,	{action : 'sb_get_sub_states', cat_id:$( "#ad_country_cities" ).val(), }).done( function(response)
  {
	  $('.cp-loader').hide();
	  $( "#ad_country_towns" ).val('');
	  if( $.trim(response) != "" )
	  {
			$('#ad_country_id').val( $( "#ad_country_cities" ).val() );
			$('#ad_country_sub_sub_sub_div').show();
			$('#ad_country_towns').html(response); 
	  }
	  else
	  {
			$('#ad_country_sub_sub_sub_div').hide();
	  }
  });
});

/*-- Map Location --*/
if ( ($('#is_profile_edit').length > 0 || $('#is_post_job').length > 0 ) && get_strings.nokri_map_type == 'google_map' ) {
	var latoz = $('#ad_map_lat').val();
	var longoz = $('#ad_map_long').val();		
	var markers = [{
		"title": "",
		"lat": latoz,
		"lng": longoz,
	}, ];
	window.onload = function() {
		my_g_map(markers);
	}
}
	
$('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
$(document).ready(function() {   
  // if($( window ).scrollTop() > 10){   scroll down abit and get the action   
  $(".progress-bar").each(function(){
	  var each_bar_width= "";
    each_bar_width = $(this).attr('aria-valuenow');
    $(this).width(each_bar_width + '%');
  });
       
 //  }  
});

$('.agree-term input').iCheck({
    checkboxClass: 'icheckbox_minimal',
    increaseArea: '60%' // optional
  });


/* Candidate Employment Check  */
 
/*ICHECKBOXES*/
 $(document).ready(function($){
$('.dashboard-edit-profile input').iCheck({
    checkboxClass: 'icheckbox_minimal',
    increaseArea: '60%' // optional
  });
  
  $(document).on('ifChanged','input.icheckbox_minimal', function() {
    if($(this).is(':checked')) {
        $(this).parent().parent().find('.end-hide').attr('readonly', 'readonly');
		$(this).parent().parent().find('input.checked-input-hide').val('1');
		$(this).parent().parent().find('input .end-hide').removeClass("datepicker-here-canidate");
    }
	else 
	{
		 $(this).parent().parent().find('.end-hide').removeAttr('readonly');
		$(this).parent().parent().find('input .end-hide').addClass( "datepicker-here-canidate" );
		$(this).parent().parent().find('input.checked-input-hide').val('0');
	}
	 
});
});


/* user change password */
$('.cand_pass_pro').hide();
$('.change_password').click(
function(){
$('.cp-loader').show();
$('.change_password').hide();
$('.cand_pass_pro').show();
// Ajax for Registration
$.post(nokri_ajax_url, {
	action: 'change_password',
	password_data: $("form#change_password").serialize(),
}).done(function(response) {
	$('.cp-loader').hide();
	$('.cand_pass_pro').hide();
	$('.change_password').show();  
	if ($.trim(response) == '0') {
		toastr.error($('#old_password_miss').val(), '', {
			timeOut: 2500,
			"closeButton": true,
			"positionClass": "toast-top-right"
		});
	}
else	if ($.trim(response) == '1') {
		toastr.error($('#new_password').val(), '', {
			timeOut: 2500,
			"closeButton": true,
			"positionClass": "toast-top-right"
		});
	}
	 else if ($.trim(response) == '2') {
		toastr.success($('#set_password').val(), '', {
			timeOut: 2500,
			"closeButton": true,
			"positionClass": "toast-top-right"
		});
	}
	else if ($.trim(response) == '3') {
		toastr.error($('#old_password').val(), '', {
			timeOut: 2500,
			"closeButton": true,
			"positionClass": "toast-top-right"
		});
	}
	else if ($.trim(response) == '4') {
		toastr.warning($('#demo_mode').val(), '', {
			timeOut: 2500,
			"closeButton": true,
			"positionClass": "toast-top-right"
		});
	}
});
return false;
});

/* user del acount */

$(".del_acount").on("click", function() {  
	$.confirm({
	animationBounce: 1.5,
	closeAnimation: 'rotateXR',
	title: get_strings.confirmation,
	content: get_strings.content,
	type: 'red',
	buttons: {
		tryAgain: {
			text: get_strings.btn_cnfrm,
			btnClass: 'btn-red',
			action: function(){
	 $('.cp-loader').show();
	$.post(nokri_ajax_url, {
		action: 'delete_myaccount',
	}).done(function(response) {
		$('.cp-loader').hide();
		if ($.trim(response) == "0") {
			  $.dialog({
						title: get_strings.success,
						content: get_strings.action_success,
						icon: 'fa fa-smile-o',
						theme: 'modern',
						closeIcon: true,
						animation: 'scale',
						type: 'blue',
			});
		} else if ($.trim(response) == '4') {
		toastr.warning($('#demo_mode').val(), '', {
			timeOut: 2500,
			"closeButton": true,
			"positionClass": "toast-top-right"
		});
	} else {
			toastr.error($('#superadmin').val(), '', {
				timeOut: 2500,
				"closeButton": true,
				"positionClass": "toast-top-right"
			});
		}
	});
			}
		},
		close: function () {
			 $('.cp-loader').hide();
		}
	}
});
});
	

/* Newsletter function  */
function nokri_validateEmail(sEmail) 
{
	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (filter.test(sEmail))
	{
		return true;
	}
	else 
	{
		return false;
	}
}

$('#processing_req').hide();
$('#save_email').on('click', function() {
        var sb_email	=	$('#sb_email').val();
		var sb_action 	=	$('#sb_action').val();
		if( nokri_validateEmail( sb_email ) )
		{
			$('#save_email').hide();
			$('#processing_req').show();
			$.post(nokri_ajax_url, {
				action: 'sb_mailchimp_subcribe',
				'sb_email': sb_email,
				 sb_action:sb_action
			}).done(function(response) {
				$('#processing_req').hide();
				$('#save_email').show();
				if( response == 1 )
				{
					toastr.success($('#chimp_success').val(), '', {
								timeOut: 2500,
								"closeButton": true,
								"positionClass": "toast-top-right"
							});
					$('#sb_email').val('');
				}
				else
				{
					toastr.error($('#job_cv_action_fail').val(), '', {
						timeOut: 2500,
						"closeButton": true,
						"positionClass": "toast-top-right"
					});
				}
			});
		}
		else
		{
			toastr.error($('#chimp_mail_valid').val(), '', {
						timeOut: 2500,
						"closeButton": true,
						"positionClass": "toast-top-right"
					});
		}

    });



})(jQuery);







jQuery(document).ready(function($) {
	
	if($('#spinner').length > 0) {
        	document.getElementById('spinner').style.display = 'none';
		}
	
     var Accordion = function(el, multiple) {
     this.el = el || {};
     this.multiple = multiple || false;
   
     // Variables privadas
     var links = this.el.find('.profile-menu-link');
     // Evento
     links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
    };
   
    Accordion.prototype.dropdown = function(e) {
     var $el = e.data.el;
      $this = $(this),
      $next = $this.next();
   
     $next.slideToggle();
     $this.parent().toggleClass('open');
   
     if (!e.data.multiple) {
      $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
     }
    } ;
   
    var accordion = new Accordion($('#accordion'), false);

});

 function my_g_map(markers1) {
	
    var mapOptions = {
        center: new google.maps.LatLng(markers1[0].lat, markers1[0].lng),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var infoWindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();
    var geocoder = geocoder = new google.maps.Geocoder();
    var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
    var data = markers1[0]
    var myLatlng = new google.maps.LatLng(data.lat, data.lng);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: data.title,
        draggable: true,
        animation: google.maps.Animation.DROP
    });
	
	 
	
    (function(marker, data) {
		
        google.maps.event.addListener(marker, "click", function(e) {
            infoWindow.setContent(data.description);
            infoWindow.open(map, marker);
        });


        google.maps.event.addListener(marker, "dragend", function(e) {
            jQuery('.cp-loader').show();
            //document.getElementById("sb_loading").style.display	= "block";
            var lat, lng, address;
            geocoder.geocode({
                "latLng": marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    lat = marker.getPosition().lat();
                    lng = marker.getPosition().lng();
                    address = results[0].formatted_address;
                    document.getElementById("ad_map_lat").value = lat;
                    document.getElementById("ad_map_long").value = lng;
                    document.getElementById("sb_user_address").value = address;
                    jQuery('.cp-loader').hide();
                }
				
            });
        });
    })(marker, data);
    latlngbounds.extend(marker.position);
}


/*-- Add More Educational Degrees --*/

var room = 1;


function nokri_textarea_initial(call = '')
{
		$('button[data-remove-type='+call+'] ').parent().parent().closest('div').find( ".rich_textarea" ).jqte({
            link: false,
            unlink: false,
            formats: false,
            format: false,
            funit: false,
            fsize: false,
            fsizes: false,
            color: false,
            strike: false,
            source: false,
            sub: false,
            sup: false,
            indent: false,
            outdent: false,
            right: false,
            left: false,
            center: false,
            remove: false,
            rule: false,
            title: false,
        });		
	}

function education_fields() {
    "use strict";
	
	var my_Divs = $( ".for-edus div.ad-more-box-single" ).length;
	var  room = my_Divs+1;
	
	
    var objTo = document.getElementById('education_fields');
    var divtest = document.createElement("div");
	
	var date_class = 'date-here-'+room;
	
    divtest.setAttribute("class", "removeclass_edu" + room); 
    var rdiv = 'removeclass_edu' + ( room);
    divtest.innerHTML = '<div class= "ad-more-box-single"><div class="col-md-12 col-sm-12"><h4 class="dashboard-heading">'+get_strings.deghead+'</h4></div><div class="col-md-6 col-sm-6"> <div class="form-group"> <label>'+get_strings.degtitle+'<span class="required">*</span></label> <input type="text"  placeholder="'+get_strings.degtitle+'" name="cand_education[\'degree_name\'][]" class="form-control"></div></div><div class="col-md-6 col-sm-6"> <div class="form-group"> <label>'+get_strings.deginsti+'<span class="required">*</span></label> <input type="text"  placeholder="'+get_strings.deginsti+'" name="cand_education[\'degree_institute\'][]" class="form-control"></div></div><div class="col-md-6 col-xs-12 col-sm-6"> <div class="form-group"><label class="">'+get_strings.degstart+'</label><input type="text"  name="cand_education[\'degree_start\'][]" class="'+date_class+' form-control" /></div></div><div class="col-md-6 col-xs-12 col-sm-6"> <div class="form-group"><label class="">'+get_strings.degend+'</label><input type="text"  name="cand_education[\'degree_end\'][]" class="'+date_class+' form-control"/></div></div><div class="col-md-6 col-sm-6"> <div class="form-group"> <label>'+get_strings.degpercnt+'<span class="required">*</span></label> <input type="text"  placeholder="'+get_strings.degpercntplc+'" name="cand_education[\'degree_percent\'][]" class="form-control"> </div></div><div class="col-md-6 col-sm-6"> <div class="form-group"> <label>'+get_strings.deggrad+'<span class="required">*</span></label> <input type="text" placeholder="'+get_strings.deggradplc+'"  name="cand_education[\'degree_grade\'][]" class="form-control"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <div class="form-group"> <label>'+get_strings.degdesc+'</label> <textarea rows="6"  class="form-control rich_textarea" name="cand_education[\'degree_detail\'][]" id="ad_description2"></textarea> </div></div><div class="input-group-btn remove-btn"><button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');" data-remove-type="' + room + '"> <span class="ti-minus" aria-hidden="true"></span>'+get_strings.degremov+'</button></div></div><div class="clearfix"></div>'; 
    objTo.appendChild(divtest);
	
	nokri_get_date_picker('months',date_class,'MM yyyy');
	nokri_textarea_initial(room);
}

function remove_education_fields(rid) {
    "use strict";
	    $.confirm({
        title: get_strings.confirmation,  
        content: get_strings.content,
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: get_strings.btn_cnfrm,
                btnClass: 'btn-red',
                action: function(){
					jQuery('.removeclass_edu' + rid).remove();
                }
            },
            close: function () {
            }
        }
    });
}

/*-- Add More Professional Projects --*/
var room = 1;
function nokri_textarea_initial(call = '')
{
	$('button[data-remove-type='+call+'] ').parent().parent().closest('div').find( ".rich_textarea" ).jqte({
		link: false,
		unlink: false,
		formats: false,
		format: false,
		funit: false,
		fsize: false,
		fsizes: false,
		color: false,
		strike: false,
		source: false,
		sub: false,
		sup: false,
		indent: false,
		outdent: false,
		right: false,
		left: false,
		center: false,
		remove: false,
		rule: false,
		title: false,
	});		
}


function professional_fields() {
    "use strict";
    
	
	var my_Divs = $( ".for-pros div.ad-more-box-single" ).length;
	var  room = my_Divs+1;
	
    var objTo = document.getElementById('professional_fields');
    var divtest = document.createElement("div");
	
    divtest.setAttribute("class", "form-group removeclass_pro" + room);
    var rdiv = 'removeclass_pro' + room;
	
	var date_class_pro = 'date-here-pro'+room;
	
	
	
	
    divtest.innerHTML = '<div class= "ad-more-box-single"><div class="col-md-12 col-sm-12"><h4 class="dashboard-heading">'+get_strings.projthead+'(' + room + ')</h4></div><div class="col-md-6 col-sm-12"><div class="form-group"><label>'+get_strings.projorg+'<span class="required">*</span></label><input type="text"  placeholder="'+get_strings.projorg+'" name="cand_profession[\'project_organization\'][]" class="form-control"></div></div><div class="col-md-6 col-sm-12"><div class="form-group"><label>'+get_strings.projdesign+'<span class="required">*</span></label><input type="text"   placeholder="'+get_strings.projdesign+'" name="cand_profession[\'project_role\'][]" class="form-control"></div></div><div class="col-md-6 col-xs-12 col-sm-6"><div class="form-group"><label class="">'+get_strings.projstrt+'</label><input type="text"   name="cand_profession[\'project_start\'][]" class="'+date_class_pro+'  form-control" /></div></div><div class="col-md-6 col-xs-12 col-sm-6"><div class="form-group"><label class="">'+get_strings.projend+'</label><input type="text"  name="cand_profession[\'project_end\'][]" class="'+date_class_pro+'  form-control end-hide"  /><input type="hidden"  value="0" name="cand_profession[\'project_name\'][]"  class="checked-input-hide" /><input type="checkbox" name="checked"  class="icheckbox_minimal control-class-' + room + '">'+get_strings.projtitle+'</div></div><div class="col-md-12 col-sm-12 col-xs-12"><div class="form-group"><label>'+get_strings.projdesc+'</label><textarea rows="6"  class="form-control rich_textarea" name="cand_profession[\'project_desc\'][]" id="ad_description"></textarea></div></div></div></div><div class="input-group-btn remove-btn"><button class="btn btn-danger" type="button" onclick="remove_professional_fields(' + room + ');" data-remove-type="' + room + '"> <span class="ti-minus" aria-hidden="true"></span>'+get_strings.degremov+'</button></div></div></div><div class="clearfix"></div></div></div>';
	


    objTo.appendChild(divtest);
	var class_name = 'control-class-' + room;
	 nokri_get_date_picker('months',date_class_pro,'MM yyyy');
	$('input').iCheck({
    checkboxClass: 'icheckbox_minimal',
    /*increaseArea: '20%' // optional*/
  });
	nokri_textarea_initial(room);
}

function remove_professional_fields(rid) {
    "use strict";
	$.confirm({
        title: get_strings.confirmation,  
        content: get_strings.content,
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: get_strings.btn_cnfrm,
                btnClass: 'btn-red',
                action: function(){
					jQuery('.removeclass_pro' + rid).remove();
                }
            },
            close: function () {
            }
        }
    });
}

/*-- Add More Certifications --*/

var room = 1;

function nokri_textarea_initial(call = '')
	{
		$('button[data-remove-type='+call+'] ').parent().parent().closest('div').find( ".rich_textarea" ).jqte({
            link: false,
            unlink: false,
            formats: false,
            format: false,
            funit: false,
            fsize: false,
            fsizes: false,
            color: false,
            strike: false,
            source: false,
            sub: false,
            sup: false,
            indent: false,
            outdent: false,
            right: false,
            left: false,
            center: false,
            remove: false,
            rule: false,
            title: false,
        });		
	}

function certification_fields() {
    "use strict";

	var my_Divs = $( ".for-cert div.ad-more-box-single" ).length;
	var  room = my_Divs+1;

    var objTo   = document.getElementById('certification_fields');
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "removeclass_cert" + room);
    var rdiv = 'removeclass_cert' + room;
	
	var date_class_certi = 'date-here-certi'+room;
	
	
    divtest.innerHTML = '<div class= "ad-more-box-single"><div class="col-md-12 col-sm-12"><h4 class="dashboard-heading">'+get_strings.certhead+'(' + room + ')</h4></div><div class="col-md-12 col-sm-12"><div class="form-group"><label>'+get_strings.certtitle+'<span class="required">*</span></label> <input type="text" placeholder="'+get_strings.certtitle+'"  name="cand_certifications[\'certification_name\'][]" class="form-control"> </div></div><div class="col-md-6 col-xs-12 col-sm-6"> <div class="form-group"><label class="">'+get_strings.certstrt+'</label><input type="text"  name="cand_certifications[\'certification_start\'][]" class="'+date_class_certi+' form-control" /></div></div><div class="col-md-6 col-xs-12 col-sm-6"> <div class="form-group"><label class="">'+get_strings.certend+'</label><input type="text"  name="cand_certifications[\'certification_end\'][]" class="'+date_class_certi+' form-control" /></div></div><div class="col-md-6 col-sm-12"> <div class="form-group"> <label>'+get_strings.certdur+'<span class="required">*</span></label> <input type="text"  placeholder="'+get_strings.certdur+'" name="cand_certifications[\'certification_duration\'][]" class="form-control"> </div></div><div class="col-md-6 col-sm-12"> <div class="form-group"> <label>'+get_strings.certinst+'<span class="required">*</span></label> <input type="text"   placeholder="'+get_strings.certinst+'" name="cand_certifications[\'certification_institute\'][]" class="form-control"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <div class="form-group"> <label>'+get_strings.certdesc+'</label> <textarea rows="6" class="form-control rich_textarea"  name="cand_certifications[\'certification_desc\'][]" id="certification_description"></textarea> </div></div><div class="input-group-btn remove-btn"><button class="btn btn-danger" type="button" onclick="remove_certification_fields(' + room + ');" data-remove-type="' + room + '"> <span class="ti-minus" aria-hidden="true"></span>'+get_strings.degremov+'</button></div></div></div><div class="clearfix"></div></div></div>';

    objTo.appendChild(divtest);
	
	nokri_get_date_picker('months',date_class_certi,'MM yyyy');
	
	nokri_textarea_initial(room);
}

function remove_certification_fields(rid) {
    "use strict";
	$.confirm({
		theme: 'dark',
        title: get_strings.confirmation,  
        content: get_strings.content,
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: get_strings.btn_cnfrm,
                btnClass: 'btn-red',
                action: function(){
					 jQuery('.removeclass_cert' + rid).remove();
                }
            },
            close: function () {
            }
        }
    });
}


var $ = jQuery.noConflict();
jQuery(document).ready(function() {
 "use strict";
  $('.tool-tip').tipsy({
   arrowWidth: 10,
   attr: 'data-tipsy', 
   cls: null, 
   duration: 150, 
   offset: 7,
   position: 'top-center', 
   trigger: 'hover',
 });
  nokri_get_date_picker('months','datepicker-here-canidate','MM yyyy');
  nokri_get_date_picker('days','datepicker-cand-dob','mm/dd/yyyy');
});

 function nokri_get_date_picker(c_view , apl_class,date_format)
 {
	$('.'+apl_class).datepicker({
	view: c_view,
	minView:c_view,
	dateFormat: date_format,
	  language: {
    days: [get_strings.Sunday, get_strings.Monday, get_strings.Tuesday, get_strings.Wednesday, get_strings.Thursday, get_strings.Friday, get_strings.Saturday],
    daysShort: [get_strings.Sun, get_strings.Mon, get_strings.Tue, get_strings.Wed, get_strings.Thu, get_strings.Fri, get_strings.Sat],
    daysMin: [get_strings.Su, get_strings.Mo, get_strings.Tu, get_strings.We, get_strings.Th, get_strings.Fr, get_strings.Sa],
    months: [get_strings.January,get_strings.February,get_strings.March,get_strings.April,get_strings.May,get_strings.June, get_strings.July,get_strings.August,get_strings.September,get_strings.October,get_strings.November,get_strings.December],
    monthsShort: [get_strings.Jan, get_strings.Feb, get_strings.Mar, get_strings.Apr, get_strings.May, get_strings.Jun, get_strings.Jul, get_strings.Aug, get_strings.Sep, get_strings.Oct, get_strings.Nov, get_strings.Dec],
    today: get_strings.Today,
    clear: get_strings.Clear,
    timeFormat: 'hh:ii aa',
    firstDay: 0
},
	}); 
 }


var $ = jQuery.noConflict();
jQuery(document).ready(function() {
 "use strict";
  $('.tool-tip').tipsy({
   arrowWidth: 10,
   attr: 'data-tipsy', 
   cls: null, 
   duration: 150, 
   offset: 7,
   position: 'top-center', 
   trigger: 'hover',
 });
});

 
jQuery(document).ready(function() 
{
   "use strict";
	 jQuery(".rich_textarea").on("paste", function(e) {
		e.preventDefault();
		var text =  e.originalEvent.clipboardData.getData('text');   
	   // insert copied data @ the cursor location
	   document.execCommand("insertText", false, text);
	});
});

$(window).on('load',function() {
 //*MASONRY */
  $('.mansi').masonry();
  
  if ($('.rich_textarea').length > 0) {
        $('.rich_textarea').jqte({
            link: false,
            unlink: false, 
            formats: [
					["p",get_strings.p_text],
					["h2","H2"],
					["h3","H3"],
					["h4","H4"],
					],
            funit: false,
            fsize: false,
            fsizes: false,
            color: false,
            strike: false,
            source: false,
            sub: false,
            sup: false,
            indent: false,
            outdent: false,
            right: false,
            left: false,
            center: false,
            remove: false,
            rule: false,
            title: false,
			p:true,
        });

    }
});
//PLUGIN GRATIS - SIMPLEAJAX.1.0.js
//DIBUAT OLEH ADAM ALFIANSYAH
//KONTAK : adamalfiansyah@gmail.com
//DAPAT DIGUNAKAN OLEH SIAPA SAJA
//SEGALA SESUATU YANG TERJADI DENGAN PENGGUNAAN SIMPLEAJAX BUKAN TANGGUNG JAWAB PEMBUAT

(function ( $ ) {
 
    $.fn.simpleAjax = function( options ) {
 		
    	$element = this;

		$element.call_ajax = function($method, $dataType, $url, $data, $theTag, $callbackFunction){

			if ($.isFunction(window[$callbackFunction])) {
			    $callbackFunction = window[$callbackFunction];
			}

			$.ajax({
				type: $method,
				url: $url,
				data: $data,
				dataType: $dataType,
				success: function(response){

					response = JSON.stringify(response); 
					$callbackFunction(response, $theTag); 

				}
			});
		}	

		
		$element.click = function($theTag){
			if($theTag){
				$theTag.removeAttr("disabled");
				$(".clicked").fadeOut(function(){ $(".clicked").remove(); });					
			}
		}

	    $element.ajaxForm = function(){
			this.on("submit","form[ajax-callback]",function(event){	
				event.preventDefault();
				$(".clicked").remove();		

				var $formEl = $(this);					

				var $objButton = button_clicked($formEl);	
				var $button = $objButton.element;
				var $buttonParam = $objButton.param;

				var $callbackFunction = callback_function($formEl);

				use_ckeditor($formEl);

				var $dataType = data_type($formEl); 

				var $url = $formEl.attr("action");

				var $method = method($formEl);					
				
				var $data = $formEl.serialize()				

				$data += $buttonParam;

				$element.call_ajax($method, $dataType, $url, $data, $button, $callbackFunction);

				return false;
			});	    	
	    }

	    $element.ajaxLink = function(){
			this.on("click","a[ajax-callback]",function(event){
				event.preventDefault();
				$(".clicked").remove();			

				if ($(event.target).is("a[disabled]")) { return false; }

				var $linkEl = $(this); 
				
				$linkEl.attr("disabled",true);

				ajax_loader($linkEl);

				var $url = $linkEl.attr("href"); 
				
				var $callbackFunction = callback_function($linkEl);

				var $method = method($linkEl);		

				var $dataType = data_type($linkEl); 

				var $ajaxData = ajax_data($linkEl);

				$element.call_ajax($method, $dataType, $url, $ajaxData, $linkEl, $callbackFunction);

				return false;
			});    	
			
	    } 

		var callback_function = function( $el ) {	

			var $callbackFunction = ""; 
			
			if($el.attr("ajax-callback")){
				var $callbackFunction = window[$el.attr("ajax-callback")]; 
				return $callbackFunction;
			}
			
			return false; 
		}

		var use_ckeditor = function( $el ) {	
			
			if($el.attr("ajax-ckeditor")){
				CKEditorUpdate();			
			}

			return false;
		}

		var button_clicked = function( $el ) {	
			var $buttonCLicked;
			var $buttonParam;
			var $val;
			var $ajaxLoader;
			var $buttonData = {}
 

			$buttonCLicked = $el.find("input[type=submit]:focus, button[type=submit]:focus"); 
			$buttonCLicked.prop("disabled",true);

			if($el.attr("ajax-loader")){
				$ajaxLoader = $el.attr("ajax-loader");
				$buttonCLicked.attr("ajax-loader", $ajaxLoader);
			}

			if($buttonCLicked.val()){
				$val = $buttonCLicked.val();
			}else if($buttonCLicked.html()){
				$val = $buttonCLicked.html();
				ajax_loader($buttonCLicked);
			}
			

			$buttonData.element = $buttonCLicked;
			$buttonData.param = "&"+$buttonCLicked.attr("name")+"="+$val;			

			return $buttonData;
		}

		var data_type = function( $el ) {	

			var $dataType = "json"; 
			
			if($el.attr("ajax-type")){
				$dataType = $el.attr("ajax-type"); 
			}

			return $dataType;
		}

		var ajax_data = function( $el ) {	

			var $ajaxData = "json";
			
			if($el.attr("ajax-data")){
				$ajaxData = $el.attr("ajax-data"); 
			}

			return $ajaxData;
		}

		var ajax_loader = function( $el ) {	
			var $ajaxLoader = $el.attr("ajax-loader");

			if($ajaxLoader == "true"){
				$el.append("<span class='clicked'>&nbsp; <i class='fa fa-circle-o-notch fa-spin fa-fw'></i></span>");
			}

		}

		var method = function( $el ) {	

			var $method = "get"; 
			
			if($el.attr("ajax-method")){
				$method = $el.attr("ajax-method"); 
			}
			else if($el.attr("method")){
				$method = $el.attr("method"); 
			}

			return $method;
		}

		$element.json_decode = function (response){
			return eval('('+response+')');		
		}

    
	    $element.initialize = function() {

            $element.ajaxForm();
            $element.ajaxLink();

            return $element;
	    };

	    return $element.initialize();

    };
}( jQuery ));

function CKEditorUpdate(){
    for ( instance in CKEDITOR.instances ){	
        CKEDITOR.instances[instance].updateElement();
    }
}

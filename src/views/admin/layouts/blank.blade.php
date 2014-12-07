<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Panel Administrador : </title>
	<!-- BOOTSTRAP STYLES-->
	<link href="{{asset('packages/yaravel/yform/admin/css/styles.css')}}" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	
	<link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
	<!-- MORRIS CHART STYLES-->
	<link href="{{asset('packages/yaravel/yform/admin/js/morris/morris-0.4.3.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/summernote/dist/summernote.css')}}" rel="stylesheet" />
	<link href="{{asset('packages/yaravel/yform/admin/js/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />
	@yield('style')
</head>
<body>
	@yield('contentMaster')
	<!-- /. WRAPPER  -->
	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- JQUERY SCRIPTS -->
	<script type="text/javascript" src="{{asset('assets/js/jquery-2.1.1.min.js')}}"></script>
	<!-- DS SCRIPTS -->
	<script type="text/javascript" src="{{asset('assets/js/DS.js')}}"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script type="text/javascript" src="{{asset('packages/yaravel/yform/admin/js/bootstrap.min.js')}}"></script>
	<!-- METISMENU SCRIPTS -->
	<script type="text/javascript" src="{{asset('packages/yaravel/yform/admin/js/jquery.metisMenu.js')}}"></script>
	<!-- MORRIS CHART SCRIPTS -->
	<script type="text/javascript" src="{{asset('packages/yaravel/yform/admin/js/morris/raphael-2.1.0.min.js')}}"></script>

	<script type="text/javascript" src="{{asset('assets/summernote/dist/summernote.js')}}"></script>

	<script type="text/javascript" src="{{asset('packages/yaravel/yform/admin/js/dataTables/jquery.dataTables.js')}}"></script>
	<script type="text/javascript" src="{{asset('packages/yaravel/yform/admin/js/dataTables/dataTables.bootstrap.js')}}"></script>
	{{--<script type="text/javascript" src="{{asset('packages/yaravel/yform/admin/js/morris/morris.js')}}"></script>--}}
	<!-- CUSTOM SCRIPTS -->
	<script src="{{asset('packages/yaravel/yform/admin/js/custom.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			<?php $SelectVM = isset($SelectVM) ? $SelectVM : 'nav-home' ?>
            var menuActive = "{{ $SelectVM }}";
            var menuActiveSplit = menuActive.split("-",3);
            var menu = '#' + menuActiveSplit[0] + '-' + menuActiveSplit[1];
            var subMenu = '#' + menuActiveSplit.join("-")
			$(menu).addClass('active-menu');
            if(menuActiveSplit.length > 2){
                $(subMenu).addClass('active-menu');
                $(menu + '.active-menu').parent('li').toggleClass('active').children('ul').collapse('toggle');
            }
			$('#dataTables-example').dataTable({"order": [[ 0, "desc" ]]});
		});
		$('.summernote').summernote({
			height: 200
		});
		@yield('script')

		{{ yform::printJS() }}
	</script>
</body>
</html>
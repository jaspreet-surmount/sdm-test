<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        @section('title')
            {!! Lang::get('common.title') !!}
        @show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datatables-bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/datepicker/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    @inject('user', 'App\User')

    <header>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ URL::to('/') }}">{!! \Lang::get('common.brand') !!}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            @if (\Auth::check())
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('home') }}">{{ \Lang::get('common.home') }}</a></li>
                    @if ($user->hasPermission('user.index'))
                        <li><a href="{{ URL::route('user.index') }}">{{ \Lang::get('common.manage_users') }}</a></li>
                    @endif
                    <li><a href="{{ URL::route('student.index') }}">{{ \Lang::get('common.manage_students') }}</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">{{ \Lang::get('common.logged_in_as', ['role' => \Auth::user()->role->name]) }}</a></li>
                    <li><a href="{{ URL::to('auth/logout') }}">{{ \Lang::get('common.logout') }}</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
            @endif
          </div><!-- /.container-fluid -->
        </nav>
    </header>

    <section id="main-content">
            <div class="container">
                @include('notification')
            </div>
            <div class="container">
                @yield('main')
            </div>
        </section>
        <footer>
            <div id="copyright-container" class="container">
                <div class="container">
                    <p>{!! Lang::get('common.copy_right') !!}
                        <span class="pull-right">{{ \Lang::get('common.mail_us_at') }}
                            <a href="mailto:jaspreet.surmount@gmail.com" class="">jaspreet.surmount@gmail.com</a>
                        </span>
                    </p>
                </div>
            </div>
        </footer>
        <!-- Bootstrap model popup -->
        <div class="modal font" id="dynamicEdit" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="formTitle"> </h4>
                    </div>
                    <div id="datatResult" class="row modal-body">
                        ...
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ (asset('assets/js/jquery.min.js')) }}"></script>
        <script src="{{ (asset('assets/js/bootstrap.min.js')) }}"></script>
        <script src="{{ (asset('assets/js/jquery-ui.js')) }}"></script>
        <script src="{{ (asset('assets/js/datatables.min.js')) }}"></script>
        <script src="{{ (asset('assets/js/datatables-bootstrap.js')) }}"></script>
        <script src="{{ (asset('assets/js/datatables.fnReloadAjax.js')) }}"></script>
        <script src="{{ (asset('assets/js/jquery.validate.js'))}}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/bootbox.min.js') }}"></script>

        <!-- for enable datepicker in bootstrap model -->
        <script type="text/javascript">
            $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        </script>

        @yield('scripts')
	
<script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500,domain:'localhost:85'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
po.src = '//203.134.219.14:81/livehelperchat/lhc_web/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(top)/350/(units)/pixels/(leaveamessage)/true/(department)/1?r='+referrer+'&l='+location;
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
</body>
</html>

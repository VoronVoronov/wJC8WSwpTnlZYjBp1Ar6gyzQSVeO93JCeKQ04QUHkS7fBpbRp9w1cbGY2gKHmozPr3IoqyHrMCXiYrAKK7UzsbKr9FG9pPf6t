<!DOCTYPE html>
<html>
    <head>
        <title>MyUCP</title>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/style.min.css">
    </head>
    <body>
        <div class="container">
        <div class="login">
        <h3 class="authTitle">Login</a></h3>
        <div class="row row-sm-offset-3 socialButtons">
          <div class="col-xs-2 col-sm-2">
            <a href="/login/twitch" class="btn btn-lg btn-block lgn_btn-twitch" data-toggle="tooltip" data-placement="top" title="Twitch Login">
              <i class="fa fa-twitch fa-2x"></i>
              <span class="hidden-xs"></span>
            </a>
          </div>
          <div class="col-xs-2 col-sm-2">
            <a href="/login/vk" class="btn btn-lg btn-block lgn_btn-vk" data-toggle="tooltip" data-placement="top" title="vk.com Login">
              <i class="fa fa-vk fa-2x"></i>
              <span class="hidden-xs"></span>
            </a>
          </div>   
          <div class="col-xs-2 col-sm-2">
            <a href="/login/youtube" class="btn btn-lg btn-block lgn_btn-google-plus" data-toggle="tooltip" data-placement="top" title="YouTube login">
              <i class="fa fa-youtube fa-2x"></i>
              <span class="hidden-xs"></span>
            </a>
          </div>  
    </div><br>


        <div class="row row-sm-offset-3 loginOr">
            <div class="col-xs-12 col-sm-6">
                <hr class="hrOr">
                <span class="spanOr">or</span>
            </div>
        </div>
            <div class="content">
                <div class="title">MyUCP</div>
                <div class="description">PHP framework</div>
                <a href="/login/vk">Login vk</a>
                <a href="/login/twitch">Login twitch</a>
                <a href="/login/hitbox">Login hitbox</a>
                <a href="/user/logout">Logout</a>
            </div>

        </div>

    <script src="https://use.fontawesome.com/1d342aabb8.js"></script>
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    @if(IsOnline() && (IsOnline()->user_group == 0 || empty(IsOnline()->user_email)))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script><!--Validator-->
    <div id="emailModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <form data-toggle="validator" method="post" action="/user" role="form">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">{{ lang("profile/email.insert_email") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                {{ lang("profile/email.email_confirm_info") }}
                  <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input type="email" name="firstEmail" class="form-control" id="inputEmail" placeholder="Email" data-error="{{ lang('errors/user.incorrect_email') }}" required>
                    <div class="help-block with-errors"></div>
                  </div>
              </div>
              <div class="modal-footer">
                              <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ lang("main.submit") }}</button>
                  </div>
              </div>
            </div>
          </div>
        </form>
    </div>
    <script>
        $('#emailModal').modal('show');
        $('#emailForm').validator();
    </script>
    @endif
        <script src="/assets/js/fancywebsocket.js"></script> 

    <script>
      console.log('[Server]: Connecting...');
      Server = new FancyWebSocket('ws://127.0.0.1:889');

      //Let the user know we're connected
      Server.bind('open', function() {
        console.log("[Server]: Connected.");
        Server.send('notify','{"userid": {{ IsOnline()->user_id }}');
      });

      //OH NOES! Disconnection occurred.
      Server.bind('close', function(data) {
        console.log("[Server]: Disconnected.");
      });

      //Log any messages sent from server
      Server.bind('message', function(data) {
        console.log("[Server]: Message: " + data);
      });

      Server.connect();

      $("#btn").click(function() {
        Server.send('message', '{"id": "'+ $("#id").val() +'", "token": "'+ $("#token").val() +'", "user_name": "'+ $("#user_name").val() +'", "sum": "'+ $("#sum").val() +'", "curr": "'+ $("#curr").val() +'", "msg": "'+ $("#msg").val() +'"}');
        console.log("[Server]: Message sended.");
      });
    </script>

    </body>
</html>
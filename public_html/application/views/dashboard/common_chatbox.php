<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8">
jQuery.noConflict();

jQuery(document).ready(function () {
	var log_chat_message = function  (message, type) {

		var li = jQuery('<li />').text(message);

    $('#left_chat p').html(message);
    $('#left_chat #time').html($.now());

		li = jQuery('#left_chat').html();
		
    /*
    if (type === 'system') {
			li.css({'font-weight': 'bold'});
		} else if (type === 'leave' || type === 'error') {
			li.css({'font-weight': 'bold', 'color': '#F00'});
		}
		*/

		jQuery('#chat_log').append(li);
	};

	var socket = io.connect('http://localhost:3000');

  socket.emit('auth', {uai: <?php echo $uai;?>});
      
	socket.on('auth', function  (data) {
    
    alert('entrance' + data.message);
    log_chat_message(data.message, 'system');

  });

  socket.on('auth_response', function(data) {

    alert('auth_response : ' + data.message);

    if(data.message == 'success') {
      /**
       * auth success
       * emit user welcome message in room. 
       */
      log_chat_message(data.message, 'system');
      socket.emit('welcome', {uai: <?php echo $uai;?>};
    }
  });

  /* When user enters the chat box. */
  socket.on('welcome', function  (data) {
    alert('welcome' + data['message'] /*+ <?php echo $uai;?>*/);
		log_chat_message(data.message, 'system');
	});

	socket.on('exit', function  (data) {
    alert('exit' + data);
		log_chat_message(data.message, 'leave');
	});

	socket.on('message', function  (data) {
    alert('message ' + data.message);
		log_chat_message(data.message, 'normal');
	});

	socket.on('chat', function  (data) {
    alert('chat' + data.message);
    log_chat_message(data.message, 'normal');
  });

  socket.on('error', function  (data) {
    alert('error' + data.message);
		log_chat_message(data.message, 'error');
	});

	jQuery('#chat_box').keypress(function (event) {

    if (event.which == 13) {
      socket.emit('message', {message: jQuery('#chat_box').val()});
      //log_chat_message(jQuery('#chat_box').val(), 'normal');
			jQuery('#chat_box').val('');
		}
	});
      
});

</script>

 <div class="row">
          <div class="col-md-12">
            <h2 class="sub-header">Public Chat</h2>
          <div class="panel panel-info">
            <div class="panel-heading">
              <span class="glyphicon glyphicon-comment"></span> Chat
              <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-chevron-down"></span>
                  </button>
                  <ul class="dropdown-menu slidedown">
                      <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                      </span>Refresh</a></li>
                      <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                      </span>Available</a></li>
                      <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
                      </span>Busy</a></li>
                      <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
                          Away</a></li>
                      <li class="divider"></li>
                      <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
                          Sign Out</a></li>
                  </ul>
              </div>
            </div>

                <div class="panel-body">
                    <ul class="chat" id="chat_log">
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Masud</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">Nicola</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Masud</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                    <strong class="pull-right primary-font">Nicola</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input  id="chat_box" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>
                        </span>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div id="right_chat" style="display:none;">
            <li class="right clearfix"><span class="chat-img pull-right">
                  <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
              </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                        <strong class="pull-right primary-font">Nicola</strong>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                        dolor, quis ullamcorper ligula sodales.
                    </p>
                </div>
            </li>
          </div>
          <div id="left_chat" style="display:none;">
            <li class="left clearfix"><span class="chat-img pull-left">
                  <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
              </span>
                  <div class="chat-body clearfix">
                      <div class="header">
                          <strong class="primary-font">Masud</strong> <small class="pull-right text-muted">
                              <span class="glyphicon glyphicon-time"></span><span id="time">14 mins</span> ago</small>
                      </div>
                      <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                          dolor, quis ullamcorper ligula sodales.
                      </p>
                  </div>
              </li>
          </div>
<style>
/*              {
    list-style: none;
    margin: 0;
    padding: 0;
}
 */
.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}
 
.chat li.left .chat-body
{
    margin-left: 60px;
}
 
.chat li.right .chat-body
{
    margin-right: 60px;
}
 
.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}
 
.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}
 
.panel-body
{
    overflow-y: scroll;
    height: 300px;
}
 
::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}
 
::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}
 
::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
</style>
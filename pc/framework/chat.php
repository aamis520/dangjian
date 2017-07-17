<!-- start: Chat Section -->
<div id="chat" class="fixed">

    <div class="chat-inner">


        <h2 class="chat-header">
            <a href="#" class="chat-close" data-toggle="chat">
                <i class="fa-plus-circle rotate-45deg"></i>
            </a>

            在线交流
            <span class="badge badge-success is-hidden">0</span>
        </h2>

        <script type="text/javascript">
            // Here is just a sample how to open chat conversation box
            jQuery(document).ready(function($)
            {
                var $chat_conversation = $(".chat-conversation");

                $(".chat-group a").on('click', function(ev)
                {
                    ev.preventDefault();

                    $chat_conversation.toggleClass('is-open');

                    $(".chat-conversation textarea").trigger('autosize.resize').focus();
                });

                $(".conversation-close").on('click', function(ev)
                {
                    ev.preventDefault();
                    $chat_conversation.removeClass('is-open');
                });
            });
        </script>


        <div class="chat-group">
            <strong>工作群</strong>

            <a href="#"><span class="user-status is-busy"></span> <em>张总</em></a>
            <a href="#"><span class="user-status is-offline"></span> <em>王总</em></a>
            <a href="#"><span class="user-status is-offline"></span> <em>刘总</em></a>
        </div>



    </div>

    <!-- conversation template -->
    <div class="chat-conversation">

        <div class="conversation-header">
            <a href="#" class="conversation-close">
                &times;
            </a>

            <span class="user-status is-online"></span>
            <span class="display-name">张总</span>
            <small>在线</small>
        </div>

        <ul class="conversation-body">
            <li>
                <span class="user">Arlind Nushi</span>
                <span class="time">09:00</span>
                <p>Are you here?</p>
            </li>
            <li class="odd">
                <span class="user">Brandon S. Young</span>
                <span class="time">09:25</span>
                <p>This message is pre-queued.</p>
            </li>
            <li>
                <span class="user">Brandon S. Young</span>
                <span class="time">09:26</span>
                <p>Whohoo!</p>
            </li>
            <li class="odd">
                <span class="user">Arlind Nushi</span>
                <span class="time">09:27</span>
                <p>Do you like it?</p>
            </li>
        </ul>

        <div class="chat-textarea">
            <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
        </div>

    </div>

</div>
<!-- end: Chat Section -->

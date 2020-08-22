<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TalkJS User-to-Operator</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<div class="container" style="max-width: 800px">
    <div class="row">
        <h1>TalkJS User-to-Operator Example</h1>
        <h2>Operator console</h2>
        <p>This is a special page only for your operator. You'll probably want to password protect it somehow.</p>
        <p style="font-size: 75%">Note: Before this example will work, you will have to enter your TalkJS credentials in the source.</p>
    </div>
    <div class="row" id="talkjs-container">
    </div>
</div>
<script>
    (function(t,a,l,k,j,s){
        s=a.createElement('script');s.async=1;s.src="https://cdn.talkjs.com/talk.js";a.getElementsByTagName('head')[0].appendChild(s);k=t.Promise
        t.Talk={ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l.push([f])},catch:function(){return k&&new k()},c:l}}
    })(window,document,[]);
</script>
<script>
    Talk.ready.then(function() {
        // The core TalkJS lib has loaded, so let's identify the current user  to TalkJS.

        // Note: this code is exactly equal to the `var operator =` declaration in
        // user.html
        var me = new Talk.User({
            // just hardcode any user id, as long as your real users don't have this id
            id: "myapp_operator",
            name: "ExampleApp Operator",
            email: "support@example.com",
            photoUrl: "http://dmssolutions.nl/wp-content/uploads/2013/06/helpdesk.png",
            welcomeMessage: "Hi there! How can I help you?"
        });

        // TODO: replace the appId below with the appId provided in the Dashboard
        window.talkSession = new Talk.Session({
            appId: "tc7Q1y1H",
            me: me
        });

        var inbox = talkSession.createInbox();
        inbox.mount(document.getElementById("talkjs-container"));

    });

</script>
</body>

</html>

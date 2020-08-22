<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat</title>
    <link href="{{ asset('css/bs4/bootstrap-4.4.1.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
    </style>

</head>
<body>

<div id="talkjs-container" class="h-100 p-5"><i>Carregando o chat...</i></div>

<script>
    (function(t,a,l,k,j,s){
        s=a.createElement('script');s.async=1;s.src="https://cdn.talkjs.com/talk.js";a.head.appendChild(s)
        ;k=t.Promise;t.Talk={v:3,ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l
                    .push([f])},catch:function(){return k&&new k()},c:l}};})(window,document,[]);


    // var inbox = talkSession.createInbox();
    // inbox.mount(document.getElementById("inbox-container"));
    Talk.ready.then(function() {
        var empresa = new Talk.User({
            id: "654321",
            name: "Sebastian",
            email: "sebastian@example.com",
            photoUrl: "https://demo.talkjs.com/img/sebastian.jpg",
            welcomeMessage: "Hey, how can I help?"
        });

        var entregador = new Talk.User({
            id: "654322",
            name: "Chrystian",
            email: "chrystian@example.com",
            photoUrl: "https://demo.talkjs.com/img/sebastian.jpg",
            welcomeMessage: "Hey, how can I help?"
        });



        window.talkSession = new Talk.Session({
            appId: "x6yWS8qi",
            me: empresa
        });
        var conversation = talkSession.getOrCreateConversation(Talk.oneOnOneId(empresa, entregador))
        conversation.setParticipant(empresa);
        conversation.setParticipant(entregador);
        //var inbox = talkSession.createInbox({selected: conversation});
        var inbox = talkSession.createChatbox(conversation);
        inbox.mount(document.getElementById("talkjs-container"));

        inbox.on("sendMessage", (message) => {

            {{--var url = '{{ route('chat.push.entrega', ['id' => $entregador->id, 'empresaid' => $empresa->id, 'entregaid' => $entrega->id]) }}';--}}
            {{--axios.post(url, {mensagem: message.message})--}}
            {{--    .then(function (response) {--}}

            {{--    })--}}
            {{--    .catch(function (error) {--}}
            {{--        console.log(error);--}}
            {{--    })--}}
        })
    });
</script>

</body>
</html>

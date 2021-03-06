<a id="hit" href="http://<?php echo $url?>?route=hit&id=<?php echo $game_id ?>">Hit</a>
<a id="stand" href="http://<?php echo $url?>?route=stand&id=<?php echo $game_id ?>">Stand</a>

<script src="jquery.js"></script>
<script>
    //create event listeners for those 2 buttons
    $('#hit').click(function(e){
        e.preventDefault();
        var btn = $(e.target);
        $.ajax({
            'url': btn.attr('href'),
            'method': 'get'
        }).done(function(data){
            data = JSON.parse(data);
            if(data.result != null){
                alert(data.result);
                return;
            }
            var cards = $('#cards');
            cards.empty();
            for(var i = 0; i < data.player_cards.length; i++){
                var card = data.player_cards[i];
                var div = $('<div></div>');
                var shift_x = 0;
                if(card.value == 'A'){
                    shift_x = 0;
                }else if(card.value == 'J'){
                    shift_x = 10;
                }else if(card.value == 'Q'){
                    shift_x = 11;
                }else if(card.value == 'K'){
                    shift_x = 12;
                }else{
                    shift_x = card.value - 1;
                }
                var shift_y = 0;
                if(card.suit == 'clubs'){
                    shift_y = 0;
                }else if(card.suit == 'spades'){
                    shift_y = 1;
                }else if(card.suit == 'hearts'){
                    shift_y = 2;
                }else if(card.suit == 'diamonds'){
                    shift_y = 3;
                }
                console.log(shift_y);
                div.css({
                    'display': 'inline-block',
                    'width': '146px',
                    'height': '197px',
                    'border': '1px solid black',
                    'background': 'url("http://www.blackjack.local/cards.png")',
                    'background-position':  '-' + shift_x * 146 + 'px   -' + shift_y * 197   +  'px'
                });
//                $('#cards').append(card.suit + ' ' + card.value + '<br/>');
                cards.append(div);
            }
        }).fail(function(){
        })
    });
    $('#stand').click(function(e){
        e.preventDefault();
        var btn = $(e.target);
//        $('selector') //looks for elements in DOM matching the selector
//        $('<div></div>') //creates jQuery object from source
//        $(element) //JavaScript DOM object into jQuery object - enables us to use jQuery methods
        $.ajax({
            'url': btn.attr('href'),
            'method': 'get'
        }).done(function(data){
            console.log(data);
            data = JSON.parse(data);
            $('#cards').empty();
            for(var i = 0; i < data.player_cards.length; i++){
                var card = data.player_cards[i];
                var div = $('<div></div>');
                var shift_x = 0;
                if(card.value == 'A'){
                    shift_x = 0;
                }else if(card.value == 'J'){
                    shift_x = 10;
                }else if(card.value == 'Q'){
                    shift_x = 11;
                }else if(card.value == 'K'){
                    shift_x = 12;
                }else{
                    shift_x = card.value - 1;
                }
                var shift_y = 0;
                if(card.suit == 'clubs'){
                    shift_y = 0;
                }else if(card.suit == 'spades'){
                    shift_y = 1;
                }else if(card.suit == 'hearts'){
                    shift_y = 2;
                }else if(card.suit == 'diamonds'){
                    shift_y = 3;
                }
                console.log(shift_y);
                var backgroundPosition =
                    '-' + shift_x * 146 + 'px '+
                    '-' + shift_y * 197   +  'px';
                div.css({
                    'display': 'inline-block',
                    'width': '146px',
                    'height': '197px',
                    'border': '1px solid black',
                    'background': 'url("http://www.blackjack.local/cards.png")',
                    'background-position':  backgroundPosition
                });
//                $('#cards').append(card.suit + ' ' + card.value + '<br/>');
                $('#cards').append(div);
            }
            alert('player:' + data.player_sum +' dealer:' + data.dealer_sum)
            alert('You ' + data.result + '!');
        }).fail(function(){
            alert('something went wrong, come back soon...');
        });
    });
</script>

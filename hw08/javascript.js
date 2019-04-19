window.onload = start;

var categories = [];

//size of the letters displayed on the screen, modified by the set_size function
var size_of_letters = 25;

var _game = [
    "", "", "","", "", "", "", "", "", "", "", "", "", "",
    "", "", "","", "", "", "", "", "", "", "", "", "", "",
    "", "", "","", "", "", "", "", "", "", "", "", "", "",
    "", "", "","", "", "", "", "", "", "", "", "", "", "", ""
];

var backend_board = [
    "", "", "","", "", "", "", "", "", "", "", "", "", "",
    "", "", "","", "", "", "", "", "", "", "", "", "", "",
    "", "", "","", "", "", "", "", "", "", "", "", "", "",
    "", "", "","", "", "", "", "", "", "", "", "", "", ""
];

//player money to be made, global
var player_money = 0;
//global to change how much one might receive per spin
var spin = 0

//list of guessed letters
var guessed_letters = [];

//vowal list to be used in buying vowal
var vowal_list = [
    "A", "E", "I", "O", "U", "a", "e", "i", "o", "u"
];

//wheel of fortune, 0, 1 ,2 represent bankrupcy, free play, and lose a turn respectively
var wheel_of_fortune = [
    0, 0, 1, 2, 5000, 500, 900, 700, 300, 800, 550, 400, 500, 600, 350, 500, 900, 650,
    700, 800, 500, 450, 500, 300
];

//function that draws the game board
function initialize_game(phrase_to_use){
    console.log(phrase_to_use);
    var res = phrase_to_use.split(" ");
    var i;
    var w;
    var count = 1;
    for(i = 0; i < res.length; i++){
        var temp = res[i];
        for(w = 0; w < temp.length; w++){
            
            backend_board[count] = temp[w];
            count++;
        }
        count++;
    }
}

//function that initially changes the looks to begin the game
function start(){
    var i;
    for (i = 0; i < puzzles.length; i++){
        categories.push(puzzles[i][1]);
    }
    let unique = [...new Set(categories)];
    var example_set = unique.slice(7, 15);
    document.getElementById("category_list").innerHTML = example_set;
    var start_button = document.getElementById("select_button");
    start_button.onclick = begin_game;
}

//left off here, the changing of the size of the letters in real time is not yet working
//try using a listen thing that carman did in class, maybe that would work
// lines 87 + 88 are the ones causing the thing not to work

//sets the size of size_of_letters
    function set_size(){
        size_of_letters = document.getElementById("size").value;
        display_board();
    }

//function that initializes the game
    function begin_game(){
        var category = document.getElementById("category").value;
        var phrase_to_use = get_phrase(category);
        initialize_game(phrase_to_use);
        var size_button = document.getElementById("size_button");
        size_button.onclick = set_size;
        game_engine();
    }

//helper function to get the phrase from the puzzles.csv file
    function get_phrase(category){
        var random;
        for (random=Math.floor((Math.random() * 500) + 1); random < puzzles.length; random++){
            if(category == puzzles[random][1]){
                return puzzles[random][0];
            }
        }
    }

//function that runs the game until completion
    function game_engine(){
        display_board();
        var spin_dat_wheel = document.getElementById("spin_wheel");
        var guess = document.getElementById("guess-letter");
        guess.innerHTML = "";
        spin_dat_wheel.onclick = spun_wheel;
    }

//function that runs the game until completion
    function spun_wheel(){
        var random = Math.floor((Math.random() * 22) + 1);
        console.log(random);
        if(wheel_of_fortune[random] == 0){
            document.getElementById("playing_board").innerHTML = "<h1>GAME OVER: Bankrupcy</h1>";
        }else if(wheel_of_fortune[random] == 2){
            document.getElementById("playing_board").innerHTML = "<h1>LOSE TURN: GAME OVER</h1>";
        } else if(wheel_of_fortune[random] == 1){
            document.getElementById("possible-money").innerHTML = "Free Play! Guess a letter with no repercussions";
            //passes in zero because no money will be earned from this guess, but no penalty if not there
            options(0);
        } else{
            spin = wheel_of_fortune[random];
            document.getElementById("possible-money").innerHTML = "Possible money to be made = " + spin;
            //passes in the amount of money to earn from this guess
            options(spin);
        }
    }


//function that presents player with options
    function options(money_to_earn){
        console.log("hello options");
        var guess = document.getElementById("guess-letter");
        guess.innerHTML = "<input type='text' id='letter-guess' value='guess'><input type='text' id='buy_vowal' value='buy'><br><button id='choose-letter'>Pick a Letter</button><button id='buying_vowal'>Buy Vowal</button>";
        document.getElementById("choose-letter").onclick = guess_letter;
        var vowal = document.getElementById("buying_vowal");
        vowal.onclick = buying_vowal;
    }

//function that takes letter guess and decides if it's valid or not
    function guess_letter(){
        var letter_guess = document.getElementById("letter-guess").value;
        if(backend_board.includes(letter_guess)){
            guessed_letters.push(letter_guess);
            player_money += spin;
            document.getElementById("money").innerHTML = "$" + player_money;
            document.getElementById("letters-chosen").innerHTML = guessed_letters;
            add_letters(letter_guess);
            game_engine();
        } else {
            document.getElementById("random_messages").innerHTML = "Sorry, you chose poorly";
            game_engine();
        }
    }

//function that adds letters into visibility when guessed
    function add_letters(letter){
        var i;
        for (i = 0; i < backend_board.length; i++){
            if(backend_board[i] == letter){
                _game[i] = letter;
            }
        }
    }

//function that buys vowal if person has enough money

    function buying_vowal(){
        var vowal_val = document.getElementById("buy_vowal").value;
        if (player_money < 150){
            document.getElementById("random_messages").innerHTML = "You do not have enough money to buy vowal";
            options(spin);
        } else if(vowal_list.includes(vowal_val)){
            guessed_letters.push(vowal_val);
            add_letters(vowal_val);
            player_money -= 150;
            document.getElementById("money").innerHTML = "$" + player_money;
            game_engine();
        }
        else {
            document.getElementById("random_messages").innerHTML = "That is not a vowal";
            game_engine();
        }
    }

//function that displays the board of the game
function display_board(){
    var i;
    var table_html = "<table align='center'>";
    var count = 0;
    table_html += "<tr><td bgcolor='#FF0000'></td>";
    for (i = 0; i < 12; i++){
        if(backend_board[count] === ""){
            table_html += "<td>";
        } else{
            table_html += "<td bgcolor='blue'>";
        }
        table_html += "<input type='text' size='2' value='";
        table_html += _game[count];
        table_html += "'>"
        table_html += "</td>";
        count++;
    }
    table_html += "<td bgcolor='#FF0000'></td>";
    table_html += "</tr>";
    table_html += "<tr>";
    for (i = 0; i < 14; i++){
        if(backend_board[count] === ""){
            table_html += "<td>";
        } else{
            table_html += "<td bgcolor='blue'>";
        }
        table_html += "<input type='text' size='2' value='";
        table_html += _game[count];
        table_html += "'>"
        table_html += "</td>";
        count++;
    }
    table_html += "</tr>";
    table_html += "<tr>";
    for (i = 0; i < 14; i++){
        if(backend_board[count] === ""){
            table_html += "<td>";
        } else{
            table_html += "<td bgcolor='blue'>";
        }
        table_html += "<input type='text' size='2' value='";
        table_html += _game[count];
        table_html += "'>"
        table_html += "</td>";
        count++;
    }
    table_html += "</tr>";
    table_html += "<tr><td bgcolor='#FF0000'></td>";
    for (i = 0; i < 12; i++){
        table_html += "<td>";
        table_html += "<input type='text' size='2' value='";
        table_html += _game[count];
        table_html += "'>"
        table_html += "</td>";
        count++;
    }
    table_html += "<td bgcolor='#FF0000'>";
    table_html += "</table>";
    document.getElementById("playing_board").innerHTML = table_html;
}
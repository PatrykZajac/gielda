/**
 * Created by patrykzajac on 18.04.2017.
 */
function send(id_user_from, id_user_to, topic, body){
    var kasa = parseInt(document.getElementById("topic").value);
    var dataString = 'id='+id+'&kasa='+kasa+"&firma="+firma;
    $.ajax({
        type: "POST",
        url : url+"wyplac.php",
        data : dataString,
        success : function(data){
            if(data == 0){
                alert("Pomyślnie wypłacono pieniądze");
                var temp = parseInt(document.getElementById("portfel").innerHTML);
                temp += kasa;
                document.getElementById("portfel").innerHTML = temp;
                var temp2 = parseInt(document.getElementById("kapital").innerHTML);
                temp2 -= kasa;
                document.getElementById("kapital").innerHTML = temp2;
            }
            else if(data == 1) alert("Coś poszło nie tak");
            else if(data == 2) alert("Nie ma tyle pieniędzy w kasie firmy");
            else if(data == 3) alert("Możesz wypłacać tylko osobom ze swojej firmy");
        },
        error : function(data){
            consol.log("Coś nie tak");
        }
    },"json");
}
function search_user(str){
    var data = "";
    if (str.length==0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
    }
    var dataString = 'str='+str;
    $.ajax({
        type: "POST",
        url : "vendor/script/user_search.php?",
        data : dataString,
        success : function(data){
            document.getElementById("livesearch").innerHTML=data;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            console.log(data);
        },
        error : function(data){
            console.log(data);
        }
    },"json");
}

function autocomplite(id, login) {
    document.getElementById("user_to").value = login;
    document.getElementById("id_user_to").value = id;
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
}
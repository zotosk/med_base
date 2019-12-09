
window.onload = function(){
    let http = new XMLHttpRequest();

    http.onreadystatechange = function(){
        if(http.readyState == 4 && http.status == 200){
            console.log(JSON.parse(http.response));
        }
    };
   
    http.open("GET" , "../data/data.json" , true);
    http.send();
};

$.get("../data/data.json" , function(data){
    console.log(data);
});

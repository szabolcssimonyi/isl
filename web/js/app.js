var table;
var titles;
var filters;
var body;

$(document).ready(function(){
    table=$("#container").find("table").first();
    titles=$(table).find("thead").first().find("tr#titleRow").first();
    filters=$(table).find("thead").first().find("tr#filterRow").first();
    body=$(table).find("tbody");
});

function loadData(url){
    $.get(url+'&format=row',function(data){
        if(typeof data.error !== "undefined"){
            clearTable();
            $("h1#errorTitle").text(data.title);
            $("h2#errorPanel").text(data.error);
        }
        else{
            $("h1#errorTitle").empty();
            $("h2#errorPanel").empty();            
        }
        var header=[];
        for(var name in data.data[0]){
            header.push(name);
        }
        $("#container").find("div.panel-heading").first().text(data.title)
        updateTable(header, data.data);
    })
}

function clearTable(){
    $(titles).empty();
    $(filters).empty();
    $(body).empty();
}

function updateTable(header,data){
    clearTable();
    $(header).each(function(index,item){
       $(titles).append("<th>"+item+"</th>");
       $(filters).append("<th><input class='form-control'/></th>");
    });
    $(filters).find("input").keyup(function(e){
    })
    $(data).each(function(index,item){
        var tr=$("<tr></tr>");
        for(var name in item){
            $(tr).append("<td>"+item[name]+"</td>");
        }
        $(body).append(tr);
    })
    return table;
}


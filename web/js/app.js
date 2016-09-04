var table;
var titles;
var filters;
var body;
var keyUpTimer=null;

$(document).ready(function(){
    setMenu();
    table=$("#container").find("table").first();
    titles=$(table).find("thead").first().find("tr#titleRow").first();
    filters=$(table).find("thead").first().find("tr#filterRow").first();
    body=$(table).find("tbody");
    loadData('index.php?option=users');
});

function setMenu(){
    var links=$("*[data-target='menu']").find("a");
    $(links).click(function(e){
        var needle=$(e.target).attr("data-tag");
        var affecteds=$("*[data-tag='"+needle+"']");
        $(links).parents("li").removeClass("active");
        $(affecteds).parents("li").addClass("active");
    });
}

function setBusy(state){
    if(state){
        $("div.loader-container").css("display","block");
        $("div.content-container").css("display","none");
    }
    else{
        $("div.loader-container").css("display","none");
        $("div.content-container").css("display","block");
    }
}

function loadData(url){
    setBusy(true);
    $.get(url+'&format=row',function(data){
        if(typeof data.error !== "undefined"){
            clearTable();
            $("div#errorPanel span.sr-only").html(data.title+":");
            $("div#errorPanel span#errorContainer").text(data.error);
            $("div#errorPanel").css("display","block");
        }
        else{
            $("h1#errorTitle").empty();
            $("h2#errorPanel").empty();            
            $("div#errorPanel").css("display","none");
        }
        var header=[];
        for(var name in data.data[0]){
            header.push(name);
        }
        $("#container").find("div.panel-heading").first().text(data.title)
        updateTable(header, data.data);
        setTimeout(function(){setBusy(false);},300);
    })
}

function clearTable(){
    $(titles).empty();
    $(filters).empty();
    $(body).empty();
}

function createButton(title){
    var button=$("<div class='btn-group btn-group-justified' role='group'>"+
            "<div class='btn-group' role='group'>"+
            "<button onclick='sort(\""+title+"\")' class='btn btn-default'>"+title
            +"<span class='glyphicon'></span></button></div></div>");
    return button;
}

function updateTable(header,data){
    clearTable();
    $(header).each(function(index,item){
        var td=$("<th needle='"+item+"'></th>");
        td.append(createButton(item));
       $(titles).append(td);
       $(filters).append("<th><input needle='"+item+"' class='form-control'/></th>");
    });
    $(filters).find("input").keyup(function(e)
        {
            if(keyUpTimer!==null){
                clearTimeout(keyUpTimer);
            }
            keyUpTimer = setTimeout(function(){filterByColumn(e);},500);
        }
    )
    $(data).each(function(index,item){
        var tr=$("<tr></tr>");
        for(var name in item){
            $(tr).append("<td filter='"+name+"'>"+ (item[name]===null ? 'N/A' : item[name]) +"</td>");
        }
        $(body).append(tr);
    })
    return table;
}

function clearFilterButtons(spans){
    $(spans).removeClass("glyphicon glyphicon-sort-by-alphabet");
    $(spans).removeClass("glyphicon glyphicon-sort-by-alphabet-alt");
    $(spans).addClass("glyphicon");
}

function setOrderButtons(needle){
    
    var spans=$("#container table thead button span");
   
    var button=$("#container table thead").find("th[needle='"+needle+"'] button").first();
    var dir="asc";   
    if(button.find("span").length===0 || button.find("span").first().hasClass("glyphicon-sort-by-alphabet")){
        clearFilterButtons(spans);
        button.find("span").first().addClass("glyphicon-sort-by-alphabet-alt");
        dir="desc";
    }
    else{
        clearFilterButtons(spans);
        button.find("span").first().addClass("glyphicon-sort-by-alphabet");
    }
    
    return dir;
}

function sort(needle){
    
    var dir=setOrderButtons(needle);
    
    var rows=$("#container tbody").first().find("tr");
    var pos=0;
    
    while(pos<rows.length){
        var j=rows.length-1;
        while(j>pos){
            var td1=$(rows[j-1]).find("td[filter='"+needle+"']");
            var td2=$(rows[j]).find("td[filter='"+needle+"']");
            if((dir==="desc" && $(td1).html()<$(td2).html()) 
                    || dir==="asc" && $(td1).html()>$(td2).html()){
                var temp=rows[j];
                rows[j]=rows[j-1];
                rows[j-1]=temp;
            }
            j--;
        }
        pos++;
    }
    $("#container tbody").empty();
    rows=$("#container tbody").append(rows);    
}

function filterByColumn(e){
    keyUpTimer=null;
    var needle=$(e.target).val();
    var target=$(e.target).attr("needle");
    var columns=$("#container table").first().find("td[filter='"+target+"']");
    $(columns).each(function(){
        if($(this).html().toLowerCase().indexOf(needle)<0){
            $(this).parent().css("display","none");
        }
        else{
            $(this).parent().css("display","table-row");
        }
    });
}


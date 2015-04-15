function fade(item,speed) {$(item).fadeOut(speed);}
function Fade(item,speed) {$(item).fadeIn(speed);}
function switchAll(masterNode,item,ttime){
    // fadeIn $item - fadeOut All but $item 
    var elems = document.getElementById(masterNode).childNodes;
    for (var i=0; i<elems.length; i++){
        fade(elems[i],150);
    }
    Fade(item,ttime);
}

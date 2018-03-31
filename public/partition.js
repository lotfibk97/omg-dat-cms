
///////////////////////// needed initialization /////////////////////////

$(document).ready(function() {

    // materialize selectbox
    $('select').material_select();
    // materialize modal reopen fix
    $('.add-content').click(function() {
      $('#content-form').openModal();
    });

    // horizontal lines + grid board scroll sync
    $('.grid-container').scroll(function() {
      //console.log("grid"+this.scrollTop);
      document.querySelector(".horizontal-lines").scrollTop=this.scrollTop;
    });
    
});


///////////////////////// declaring variables  /////////////////////////

///////////////////////// attaching listeners   /////////////////////////

///////////////////////// defining functions   /////////////////////////

/*
var placeholder;
var placeorder;
var kpis_basket;
var board;
var tools;

var list;
var selected;
var selected_top=4;
var selected_left=4;
var selected_width=4;
var selected_height=4;

var move_left;
var move_right;
var move_top;
var move_bottom;

window.onload = function main() {

  list = document.querySelectorAll(".kpis_basket p");
  kpis_basket = document.querySelector(".kpis_basket");
  board = document.querySelector(".board");
  tools = document.querySelector("#tools");

  move_right=document.getElementById("right");
  move_right.addEventListener("click",moveRight);
  move_left=document.getElementById("left");
  move_left.addEventListener("click",moveLeft);
  move_top=document.getElementById("top");
  move_top.addEventListener("click",moveTop);
  move_bottom=document.getElementById("bottom");
  move_bottom.addEventListener("click",moveBottom);

  for ( var i=0; i< list.length ; i++ ) {
    list[i].style.order=list[i].id.charAt(1);
    list[i].addEventListener("click",addToBoard);
  };

};

function RemoveFromBoard(event) {
  //remove adequate place holder and move this from board to kpis_basket
}

function addToBoard(event) {
  //console.log(event.target.id.charAt(1));
  placeholder = document.createElement("p");
  placeholder.style.order=event.target.id.charAt(1);
  placeholder.textContent=event.target.textContent;
  placeholder.style.visibility="hidden";
  kpis_basket.appendChild(placeholder);
  kpis_basket.removeChild(event.target);
  board.appendChild(event.target);
  event.target.removeEventListener("click",addToBoard);
  selected=event.target;
  updatePosition(selected_top,selected_left,selected_width,selected_height);
  setPosition();
  showTools();
}

function showTools() {
  selected.appendChild(tools);
  tools.style.display="grid";
  tools.classList.toggle("tools-hidden");
}

function updatePosition(top,left,width,height) {
  selected_top=top;
  selected_left=left;
  selected_width=width;
  selected_heigh=height;
}

function setPosition() {
  selected.style.gridArea=""+selected_top+" / "+selected_left+" / span "+selected_width+" / span "+selected_height;
}

function moveRight (){
  if ( selected_left+selected_width < 13 ) {
    selected_left++;
    setPosition();
  }
}

function moveLeft() {
  if ( selected_left > 1  ) {
    selected_left--;
    setPosition();
  }
}

function moveTop() {
  if ( selected_top > 1  ) {
    selected_top--;
    setPosition();
  }
}

function moveBottom() {
    selected_top++;
    setPosition();
} */

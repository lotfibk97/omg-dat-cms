
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
      current_scroll=this.scrollTop;
    });

    // scroll to last visit scroll
    fixScroll(current_scroll);

    // select the last visit selected content
    selectContent(selected_content);

});


///////////////////////// declaring variables  /////////////////////////

var content_spaces=document.querySelectorAll(".content-space");
var grid_board=document.querySelector(".grid-board");

var selected_content_space=document.getElementById("cs-"+selected_content);
var selected_top=1,selected_left=3,selected_height=6,selected_width=7;

var inf_title=document.querySelector(".target-inf h5");
var inf_description=document.querySelector(".target-inf span");
var inf_owner=document.querySelector(".properties-basket p:nth-child(5)");
var inf_creator=document.querySelector(".properties-basket p:nth-child(6)");
var inf_responsible=document.querySelector(".properties-basket p:nth-child(7)");
var inf_type=document.querySelector(".properties-basket p:nth-child(8)");
var inf_top=document.querySelector(".inf-top");
var inf_left=document.querySelector(".inf-left");
var inf_width=document.querySelector(".inf-width");
var inf_height=document.querySelector(".inf-height");
var inf_cv=document.querySelector("#vertical-center");
var inf_ch=document.querySelector("#horizontal-center");



///////////////////////// attaching listeners   /////////////////////////

$('.add-to-board').click(createContentSpace);
$('.content-space').click(chooseContent);
$('.contents-basket .card-panel').click(chooseContent);

$('.move-top').click(moveTop);
$('.move-bot').click(moveBottom);
$('.move-left').click(moveLeft);
$('.move-right').click(moveRight);

$('.more-width').click(moreWidth);
$('.less-width').click(lessWidth);
$('.more-height').click(moreHeight);
$('.less-height').click(lessHeight);

///////////////////////// defining functions   /////////////////////////

// add a new content from the basket to the display board
function createContentSpace() {

  var id=getContentId(this.parentElement.id);

  var description=document.createElement("span");
  description.innerHTML=contents[id]["description"];
  var title=document.createElement("h5");
  title.innerHTML=contents[id]["title"];

  var content=document.createElement("div");
  content.classList.add("content-itself");
  content.classList.add("card-panel");
  content.classList.add("deep-orange-text");
  content.appendChild(title);
  content.appendChild(description);

  var space=document.createElement("div");
  space.classList.add("content-space");
  space.id="cs-"+id;
  space.appendChild(content);
  space.style.gridArea=""+contents[id]["top"]+"/"+contents[id]["left"]+"/ span "+contents[id]["height"]+"/ span "+contents[id]["width"];
  space.addEventListener("click",chooseContent);

  grid_board.appendChild(space);
  contents[id]["displayed"]=true;
}

// choose content by click
function chooseContent() {
  if ( contents[getContentId(this.id)]["displayed"])
  selectContent(getContentId(this.id));
}

// Set the controls to edit the new selected content
function selectContent(id) {

  selected_content=id; console.log("id:"+selected_content);
  selected_content_space=document.getElementById("cs-"+selected_content);

  selected_top=contents[id]["top"];
  selected_left=contents[id]["left"];
  selected_width=contents[id]["width"]; 
  selected_height=contents[id]["height"];

  updateProperties();
}

// update the displayed properties by the new ones
function updateProperties() {

  inf_title.innerHTML=contents[selected_content]["title"];
  inf_description.innerHTML=contents[selected_content]["description"];

  inf_owner.innerHTML=contents[selected_content]["owner"];
  inf_creator.innerHTML=contents[selected_content]["creator"];
  inf_responsible.innerHTML=contents[selected_content]["responsible"];
  inf_type.innerHTML=contents[selected_content]["type"];

  inf_top.value=selected_top;
  inf_left.value=selected_left;
  inf_width.value=selected_width;
  inf_height.value=selected_height;
}

function moveContent() {
  selected_content_space.style.gridArea=""+selected_top+" / "+selected_left+" / span "+selected_height+" / span "+selected_width;
  saveContentPosition(/* must add current params in case slow network*/);

  saveContext();
  fixScroll();
  extendGrid();
}

function saveContentPosition() {

  contents[selected_content]["top"]=selected_top;
  contents[selected_content]["left"]=selected_left;

  // Ajax post request to save the new position in the database post(contents[selected_content])

  updateProperties();
}

function moveRight (){
  if ( selected_left+selected_width < 13 ) {
    selected_left++;
    moveContent();
  }
}

function moveLeft() {
  if ( selected_left > 1  ) {
    selected_left--;
    moveContent();
  }
}

function moveTop() {
  if ( selected_top > 1  ) {
    selected_top--;
    moveContent();
  }
}

function moveBottom() {
    selected_top++;
    moveContent();
}

function resizeContent() {
  selected_content_space.style.gridArea=""+selected_top+" / "+selected_left+" / span "+selected_height+" / span "+selected_width;
  saveContentSize(/* must add current params in case slow network*/);

  saveContext();
  fixScroll();
  extendGrid();
}

function saveContentSize() {

  contents[selected_content]["width"]=selected_width;
  contents[selected_content]["height"]=selected_height;

  // Ajax post request to save the new size in the database post(contents[selected_content])

  updateProperties();
}

function moreWidth() {
  if(selected_left+selected_width < 13) {
    selected_width++;
    resizeContent();
  }
}

function lessWidth() {
  if(selected_width>1)
  selected_width--;
  resizeContent();
}

function moreHeight() {
  selected_height++;
  resizeContent();
  // can add some vertical lines here
}

function lessHeight() {
  if (selected_height>1)
  selected_height--;
  resizeContent();
}

////////////////////// fixing issues functions

function saveContext() {
  // ajax post of the last selected content and the actual grid rows number
}

function getContentId(id) {
  return id.substr(id.indexOf('-')+1,id.length);
}

function extendGrid() {
  for (var i =0 ; i< content_spaces.length ; i++ ) {
    var str = content_spaces[i].style.gridRow;
    var offset_rows = parseInt( str.substr(0,str.indexOf('/')) ) + parseInt( str.substr(str.indexOf('n')+1,str.length) );
    if ( grid_rows <= offset_rows ) {
      grid_rows=offset_rows+2;
      var calc = document.documentElement.clientHeight*0.08+2;
      grid_board.style.gridTemplateRows="repeat("+grid_rows+","+calc+"px)";
    }
  }
}

function fixScroll() {
  document.querySelector(".grid-container").scrollTop=current_scroll;
  document.querySelector(".horizontal-lines").scrollTop=current_scroll;
}


///////////////////////// needed initialization /////////////////////////

$(document).ready(function() {

    // configure token for ajax post
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });

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

    // make the grid extended to hold all the contents
    extendGrid();

    // select the last visit selected content
    if ( selected_content != null )
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
$('.add-content').click(newContent);
$('.edit-content').click(editContent);
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

$('.inf-top').click(editTopProperty);
$('.inf-top').blur(editTopProperty);
$('.inf-left').click(editLeftProperty);
$('.inf-left').blur(editLeftProperty);
$('.inf-width').click(editWidthProperty);
$('.inf-width').blur(editWidthProperty);
$('.inf-height').click(editHeightProperty);
$('.inf-height').blur(editHeightProperty);

$('#horizontal-center').change(editCHProperty);
$('#vertical-center').change(editCVProperty);

///////////////////////// defining functions   /////////////////////////

// Select then move/resize then updateOnBoard then updateData then updateDisplay then updateDB

// add a new content from the basket to the display board
function createContentSpace() {

  var id=getContentId(this.parentElement.id);
  if (contents[id]["displayed"]) return;

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
  contents[id]["displayed"]=1;

  content_spaces=document.querySelectorAll(".content-space");
}

// choose content by click
function chooseContent() {
  if (contents[getContentId(this.id)]["displayed"])
  selectContent(getContentId(this.id));
}

// Set the controls to edit the new selected content
function selectContent(id) {

  selected_content=id;
  selected_content_space=document.getElementById("cs-"+selected_content);

  selected_top=contents[id]["top"];
  selected_left=contents[id]["left"];
  selected_width=contents[id]["width"];
  selected_height=contents[id]["height"];

  updatePropertiesDisplay();
}

// Ajax post request to save the new position in the database post(contents[selected_content])
function updateContentDataBase() {

  var data=contents[selected_content];
  data["id"]=selected_content;
  data["rows"]=grid_rows;
  data["scroll"]=current_scroll;

  $.ajax({
    type: "POST",
    url: "/ajax",
    data: data,
    success: function(msg){
      //alert( "Data Saved: " + msg );
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert("an error has occured while saving data");
    },
  });

}

// update the displayed properties by the new ones
function updatePropertiesDisplay() {

  inf_title.innerHTML=contents[selected_content]["title"];
  inf_description.innerHTML=contents[selected_content]["description"];

  inf_owner.innerHTML=contents[selected_content]["owner"];
  inf_creator.innerHTML=contents[selected_content]["creator"];
  inf_responsible.innerHTML=contents[selected_content]["responsible"];
  inf_type.innerHTML=contents[selected_content]["type"];

  inf_top.value=contents[selected_content]["top"];
  inf_left.value=contents[selected_content]["left"];
  inf_width.value=contents[selected_content]["width"];
  inf_height.value=contents[selected_content]["height"];

  inf_ch.checked=contents[selected_content]["center-h"];
  inf_cv.checked=contents[selected_content]["center-v"];

  updateContentDataBase();
}

function updateContentDataArray() {

  contents[selected_content]["top"]=selected_top;
  contents[selected_content]["left"]=selected_left;
  contents[selected_content]["width"]=selected_width;
  contents[selected_content]["height"]=selected_height;

  updatePropertiesDisplay();
}

function updateContentOnTheBoard() {
  selected_content_space.style.gridArea=""+selected_top+" / "+selected_left+" / span "+selected_height+" / span "+selected_width;
  updateContentDataArray();

  fixScroll();
  extendGrid();
}

function moveRight (){
  if ( selected_left+selected_width < 13 ) {
    selected_left++;
    updateContentOnTheBoard();
  }
}

function moveLeft() {
  if ( selected_left > 1  ) {
    selected_left--;
    updateContentOnTheBoard();
  }
}

function moveTop() {
  if ( selected_top > 1  ) {
    selected_top--;
    updateContentOnTheBoard();
  }
}

function moveBottom() {
    selected_top++;
    updateContentOnTheBoard();
}

function moreWidth() {
  if(selected_left+selected_width < 13) {
    selected_width++;
    updateContentOnTheBoard();
  }
}

function lessWidth() {
  if(selected_width>2)
  selected_width--;
  updateContentOnTheBoard();
}

function moreHeight() {
  selected_height++;
  updateContentOnTheBoard();
  // can add some vertical lines here
}

function lessHeight() {
  if (selected_height>1)
  selected_height--;
  updateContentOnTheBoard();
}

function editTopProperty() {
  this.value=Math.floor(this.value);
  if ( this.value < 1 ) this.value=1;
  selected_top=parseInt(this.value);

  updateContentOnTheBoard();
}

function editLeftProperty() {
  this.value=Math.floor(this.value);
  if ( this.value < 1 ) this.value=1;
  if ( (parseInt(this.value) + selected_width) > 13 ) this.value=13-selected_width;
  selected_left=parseInt(this.value);

  updateContentOnTheBoard();
}

function editWidthProperty() {
  this.value=Math.floor(this.value);
  if ( this.value < 2 ) this.value=2;
  if ( (parseInt(this.value) + selected_left) > 13 ) this.value=13-selected_left;
  selected_width=parseInt(this.value);

  updateContentOnTheBoard();
}

function editHeightProperty() {
  this.value=Math.floor(this.value);
  if ( this.value < 1 ) this.value=1;
  selected_height=parseInt(this.value);

  updateContentOnTheBoard();
}

function editCHProperty() {
  var tmp=0;
  if (this.checked) tmp=1;
  contents[selected_content]["center-h"]=tmp;
  updateContentDataBase();
}

function editCVProperty() {
  var tmp=0;
  if (this.checked) tmp=1;
  contents[selected_content]["center-v"]=tmp;
  updateContentDataBase();
}

////////////////////// managing forms functions

function editContent() {
  if (selected_content == null ) return;
  document.getElementById("content-title").value=contents[selected_content]["title"];
  document.getElementById("content-description").value=contents[selected_content]["description"];

  var index=1;
  if ( contents[selected_content]["type"] == "image") index=2;
  if ( contents[selected_content]["type"] == "audio") index=3;
  if ( contents[selected_content]["type"] == "video") index=4;
  document.querySelector('#content-form #content-type').options.selectedIndex=index;
}

function newContent() {
  document.getElementById("content-title").value="";
  document.getElementById("content-description").value="";
  document.getElementById("content-type").value="0";
}

////////////////////// fixing issues functions

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

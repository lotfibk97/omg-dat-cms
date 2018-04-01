
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

});


///////////////////////// declaring variables  /////////////////////////

// use blade to populate content-spaces depending on "displayed attribute"
var content_spaces=document.querySelectorAll(".content-space");
var grid_board=document.querySelector(".grid-board");

var selected_content;
var selected_content_space=$('.content-space')[0];

var selected_top=1,selected_left=3,selected_height=6,selected_width=7;
var owner,creator,responsible,type;

///////////////////////// fixing issues vars
var current_scroll=0;
var grid_rows=20;


///////////////////////// attaching listeners   /////////////////////////

$('.add-to-board').click(createContentSpace);

$('.move-top').click(moveTop);
$('.move-bot').click(moveBottom);
$('.move-left').click(moveLeft);
$('.move-right').click(moveRight);

$('.more-width').click(moreWidth);
$('.less-width').click(lessWidth);
$('.more-height').click(moreHeight);
$('.less-height').click(lessHeight);

///////////////////////// defining functions   /////////////////////////

function moveContent() {
  selected_content_space.style.gridArea=""+selected_top+" / "+selected_left+" / span "+selected_height+" / span "+selected_width;
  saveContentPosition(/* must add current params in case slow network*/);

  saveContext();
  fixScroll();
  extendGrid();
}

function saveContentPosition() {
  // Ajax post request to save the new position in the database
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
  // Ajax post request to save the new size in the database
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
  console.log(space.style.gridArea);

  grid_board.appendChild(space);
  contents[id]["displayed"]=true;
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

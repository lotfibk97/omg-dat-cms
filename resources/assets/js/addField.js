var x = document.getElementById("clickme");
x.addEventListener("click", function(){
  var newLink = document.createElement('input');
  var newLabel = document.createElement('label');

  newLink.class="form-control";
  newLink.type="text";
  newLabel.class="center-align";

  document.getElementById("links").appendChild(newLink);
  document.getElementById("links").appendChild(newLabel);

  console.log("done");
});

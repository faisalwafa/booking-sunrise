$.trumbowyg.svgPath = "../../assets/icons.svg";
$(".editor").trumbowyg({
  btns: [
    ["viewHTML"],
    ["undo", "redo"], // Only supported in Blink browsers
    ["formatting"],
    ["strong", "em", "del"],
    ["superscript", "subscript"],
    ["link"],
    ["insertImage"],
    ["justifyLeft", "justifyCenter", "justifyRight", "justifyFull"],
    ["unorderedList", "orderedList"],
    ["horizontalRule"],
    ["removeformat"],
    ["fullscreen"],
    ["foreColor", "backColor"],
    ["emoji"],
    ["fontsize"]
  ]
});

function myFunction() {
  var checkBox = document.getElementById("check");
  var dateForm = document.getElementById("dateForm");
  var tourForm = document.getElementById("tourForm");
  if (checkBox.checked == true) {
    dateForm.style.display = "block";
    tourForm.style.display = "none";
  } else {
    dateForm.style.display = "none";
    tourForm.style.display = "block";
  }
}

function myFunction2() {
  var checkBox2 = document.getElementById("check2");
  var pricePerForm = document.getElementById("pricePerForm");
  var priceForm = document.getElementById("priceForm");
  if (checkBox2.checked == true) {
    pricePerForm.style.display = "block";
    priceForm.style.display = "none";
  } else {
    pricePerForm.style.display = "none";
    priceForm.style.display = "block";
  }
}

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
  var endDate = document.getElementById("endDate");
  var inputEndDate = document.getElementById("inputEndDate");
  if (checkBox.checked == true) {
    endDate.style.display = "block";
  } else {
    endDate.style.display = "none";
    inputEndDate.value = "";
  }
}

function myFunction2() {
  var checkBox2 = document.getElementById("check2");
  var childPrice = document.getElementById("childPrice");
  var inputChildPrice = document.getElementById("inputChildPrice");
  if (checkBox2.checked == true) {
    childPrice.style.display = "block";
  } else {
    childPrice.style.display = "none";
    inputChildPrice.value = "";
  }
}

function formAddSchedule() {
  var formSchedule = document.getElementById("formAddSchedule");
  if (formSchedule.style.display == "none") {
    formSchedule.style.display = "block";
  } else {
    formSchedule.style.display = "none";
  }
}

function saveSchedule() {
  var formSchedule = document.getElementById("formAddSchedule");
  formSchedule.style.display = "none";
}

function formEditDetail() {
  var formEditDetail = document.getElementById("editDetailForm");
  var detailTour = document.getElementById("detailTour");
  if (formEditDetail.style.display == "none") {
    formEditDetail.style.display = "block";
    detailTour.style.display = "none";
  } else {
    formEditDetail.style.display = "none";
    detailTour.style.display = "block";
  }
}

function saveChanges() {
  var formEditDetail = document.getElementById("editDetailForm");
  formSchedule.style.display = "none";
}

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

function selectboxChange() {
  const mirror = document.selmirror.mirror;
  const num = mirror.selectedIndex;
  const str = mirror.options[num].value;
  if (str == "select") return;
  $('section').fadeOut();
  $('section#' + str ).fadeIn();
}

function loadLang(lang){
  console.log(lang)
  $(location).attr('href', '?langSelect='+lang);
  // self.location['reload']();
  // setTimeout(refreshPage(), 100)
}

function formatUppersize(thiss){
  return $('#'+thiss.id).val(thiss.value.toUpperCase())
}

function formatUpEveryWord(thiss){
  var new_str = thiss.value.toLowerCase().replace(/\b[a-z]/g, function(txtVal) { return txtVal.toUpperCase() })
  return $('#'+thiss.id).val(new_str)
}

function refreshPage(){
  self.location['reload']();
}
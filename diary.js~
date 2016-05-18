doSubmit =function(){       
    if (validate()) {
         $('#form').submit(); //return true;
    }else{
	return false;		
	}
}


validate = function(){
   var ifEmpty1 =checkEmpty('frm_response','Rational response');
   var ifEmpty2 =checkEmpty('frm_thoughts','Automatic thoughts');
   var ifEmpty3 =checkEmpty('frm_emotion','Emotion');
   var ifEmpty4 =checkEmpty('frm_event','Event');
   var ifEmpty5 =checkEmpty('frm_whenwhere','When/Where');
   if(ifEmpty1&&ifEmpty2&&ifEmpty3&&ifEmpty4&&ifEmpty5){
      document.getElementById('warn').innerHTML ="";
   		return true;
   }
   return false;
}


checkEmpty = function(id, text){
	var inputarea = document.getElementById(id);
    if (inputarea.value =='') {
    document.getElementById('warn').innerHTML = '<p> Please input '+ text+'</p>';
   	return false;
   }
   return true;
}


clearInput = function() {
  document.getElementById("frm_whenwhere").value = "";
  document.getElementById("frm_event").value = "";
  document.getElementById("frm_emotion").value = "";
  document.getElementById("frm_thoughts").value = "";
  document.getElementById("frm_response").value = "";
}


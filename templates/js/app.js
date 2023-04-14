/* animation in text */
(function(){
	var element=document.getElementsByTagName('p');
  setInterval(function(){
	  if((element[0].clientWidth)==580) {
		element[1].classList.add('text');
	  }
	
  }, 1000)
  }());
  /* And animation in text */

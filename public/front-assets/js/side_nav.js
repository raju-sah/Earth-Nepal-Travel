    
// function openOffcanvas() {
    
	
  
// 	      document.getElementById("myOffcanvas").style.marginRight= "250px";
// 		   document.getElementById("myOffcanvas").style.transition="all 0.4s ease-in-out 0s";
// }
// function openNav3() {
//     document.getElementById("myCanvasNav").style.width = "100%";
//     document.getElementById("myCanvasNav").style.opacity = "0.9";  
 
// }

 
// function closeOffcanvas() {
 
 
// 		  document.getElementById("myOffcanvas").style.marginRight= "0%";
// 	          document.getElementById("myOffcanvas").style.right="-245px";
// 		   document.getElementById("myOffcanvas").style.transition="all 0.4s ease-in-out 0s";
	
//     document.body.style.backgroundColor = "white";
//     document.getElementById("myCanvasNav").style.width = "0%";
//     document.getElementById("myCanvasNav").style.opacity = "0"; 
 
// }
 
 
     
function openOffcanvas() {
    
	
  
    document.getElementById("myOffcanvas").style.marginRight= "250px";
     document.getElementById("myOffcanvas").style.transition="all 0.4s ease-in-out 0s";
     document.getElementById("hamburger").style.marginRight= "250px";
     document.getElementById("hamburger").style.transition="all 0.4s ease-in-out 0s";
     document.getElementById("hamburger").style.zIndex= "2";
     document.getElementById("toggle").style.display= "none";
     document.getElementById("close").style.display= "block";

}
function openNav3() {
document.getElementById("myCanvasNav").style.width = "100%";
document.getElementById("myCanvasNav").style.opacity = "0.5";  

}


function closeOffcanvas() {


    document.getElementById("myOffcanvas").style.marginRight= "0%";
        document.getElementById("myOffcanvas").style.right="-245px";
      
     document.getElementById("myOffcanvas").style.transition="all 0.4s ease-in-out 0s";


     document.getElementById("hamburger").style.marginRight= "0%";
  
     document.getElementById("hamburger").style.transition="all 0.4s ease-in-out 0s";
     document.getElementById("hamburger").style.zIndex= "1";
     document.getElementById("toggle").style.display= "block";
     document.getElementById("close").style.display= "none";


document.body.style.backgroundColor = "white";
document.getElementById("myCanvasNav").style.width = "0%";
document.getElementById("myCanvasNav").style.opacity = "0"; 




}



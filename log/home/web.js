// document.addEventListener('mousemove', e =>{
//     var timestamp = new Date();
//     sessionStorage.setItem('lastTimeStamp', timestamp);
// })

// function timechecker(){
//     setInterval(()=>{
//         var storedTimeStamp = sessionStorage.getItem('lastTimeStamp');
//         timecompare(storedTimeStamp);
//     },3000)
// }

// function timecompare(timestring){
//     var currentTime = new Date();
//     var pastTime = new Date(timestring);
//     var timeDiff = currentTime - pastTime;
//     var minPast = Math.floor(timeDiff/60000);

//     if(minPast > 1)//Greater than 1 min
//     {
//         sessionStorage.removeItem('lastTimeStamp');
//         window.location = 'logout.php';
//     }else{

//     }
// }

// timechecker();
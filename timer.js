let startingMinutes = document.getElementById("minutes");
let startingSeconds = document.getElementById("seconds");

let minutesConvert = parseInt(startingMinutes.innerHTML);
let secondsConvert = parseInt(startingSeconds.innerHTML);


let timer = setInterval(function (){
    secondsConvert--;
    if(secondsConvert < 0){
        if(secondsConvert <= 0 && minutesConvert <= 0){
            alert("times up");
            clearInterval(timer);
            document.getElementById("submit-exam").submit();
        }
        else{
            secondsConvert += 60;
            minutesConvert--;
            if (minutesConvert < 10){
                startingMinutes.innerHTML = "0" + minutesConvert;
                if (secondsConvert< 10){
                    startingSeconds.innerHTML = "0" + secondsConvert;
                }
                else{
                    startingSeconds.innerHTML = secondsConvert;
                }
            }
            else{
                startingSeconds.innerHTML = secondsConvert;
                startingMinutes.innerHTML = minutesConvert;
            }
            
        }   
    }
    else{
        if (secondsConvert< 10){
            startingSeconds.innerHTML = "0" + secondsConvert;
        }
        else{
            startingSeconds.innerHTML = secondsConvert;
        }   
    }
},1000);
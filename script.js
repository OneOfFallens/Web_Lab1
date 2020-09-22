"use strict";
let x_group = document.getElementsByClassName("X_group");
let r_group = document.getElementsByClassName("R_group");
let submit = document.getElementById("submitButton")
let field = document.getElementById("y")
field.addEventListener('input', () => {
	field.value = field.value.replace(/[^0-9\.\-\,]/g, '');
	field.value = field.value.replace(/[^0-9\.\-\,]/g, '');
});
submit.addEventListener("click", function (e) {
    field.value = field.value.replace(/[,]/, '.')
    if ((field.value <= 3) && (field.value >=-3)){
        if (field.value == ""){
            alert("Y не может быть пустым!")
        }
        else{
    e.preventDefault();
        let xhr = new XMLHttpRequest();
        var params = 'x=' + getX() +'&y='+ field.value + '&r=' + getR();  
        xhr.open("GET", "back.php?" + params, false);
        xhr.onloadend = function () {
            if (xhr.status === 200) {
                document.querySelector(".result_table").innerHTML = xhr.response;
            } else console.log("status: ", xhr.status)
        };
        xhr.open("GET", "back.php?" + params, false);
        xhr.send();
    }
    }
    else{
        alert("Значение Y некорректно!")
    }
});
function getX(){
	 for (let i = 0; i < 9; i++) {
        let radioButton = x_group.item(i);
        if (radioButton.checked) {
            return radioButton.value;
        }
    }
}
function getR(){
	 for (let i = 0; i < 5; i++) {
        let radioButton2 = r_group.item(i);
        if (radioButton2.checked) {
            return radioButton2.value;
        }
    }
}
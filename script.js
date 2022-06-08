function showForm() {
    const user = document.getElementById("enter").elements[0].value;
    const pass = document.getElementById("enter").elements[1].value;
    
    if(user == "admin" && pass == "admin") {
        alert("Login feito com sucesso!");
        document.getElementById("submission").innerHTML=
         `<form class="container" method="post" enctype="multipart/form-data">
            <p>
                <input type="file" onchange="renderFile()" name="filetag" accept="image/gif"> 
                    <br>
            </p>
            <p>
                <input type="submit" name="Enviar" >
            </p>    
         </form>`    
    } else alert("Credenciais incorretos!");
}

const renderFile = () => {
    const render = document.querySelector('img')
    const file = document.querySelector('input[type=file]').files[0]
    const reader = new FileReader();

    reader.addEventListener('load', ()=> {
        render.src = reader.result;
    }, false)

    if(file) {
        reader.readAsDataURL(file);
    }
}




/*
var fileTag = document.getElementById("filetag"),
preview = document.getElementById("preview");

if(fileTag) {fileTag.addEventListener("change", function() {
    changeGif(this);
});

    function changeGif() {
        var reader;
        if(input.files && input.files[0]) {
            reader = new FileReader();

            reader.onload = function(e) {
                preview.setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
}
function displayGif() {
    const display = document.getElementById("displayGifForm").elements[0].value;
    console.log(display.value)

    document.getElementById("gifResize").innerHTML=
    `<img src="display" > <br>
    <span class="psw"> <a href="display">display</a></span>
    <br>`
}
const newGif = document.querySelector("#newGif");
var uploadedGif = "";

if(newGif){
newGif.addEventListener("change", function(){
    console.log(newGif.value);
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        uploadedGif = reader.result;
        document.querySelector("#gifResize").style.backgroundImage = `url(${uploadedGif})`;
    });
    reader.readAsDataURL(this.files[0]);
});
}

<form method="post" enctype="multipart/form-data">
        <p>
            <input type="file" id="newGif" name="arquivo" accept="image/gif"> <br>
        </p>
        <p>
            <input type="submit" name="Enviar" >
        </p>    
        </form>
        */
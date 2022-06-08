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
                <input type="submit" name="submit" value="Enviar" >
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
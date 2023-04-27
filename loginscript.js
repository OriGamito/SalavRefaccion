window.addEventListener('load', () =>{
    let button = document.getElementById('formulario');
    let usuario = document.getElementById('usuario');
    let password = document.getElementById('password');
    let alert = document.getElementById('alerta');
    console.log(usuario);
    
    
    function data (){
        let datos = new FormData();
        datos.append("usuario", usuario.value);
        datos.append("password", password.value);
        fetch('validaruser.php',{
            method: "POST",
            body:datos
            
        }).then (Response=>Response.json())
        .then(({success}) => {
            if(success==1){
                location.href= 'Menu.php';
            }  
            else{
               alerta();

            }
        });
    }
    function alerta() {
        alert.innerHTML = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>DATOS INCORRECTOS, VERIFICA TU USUARIO O CONTRASEÑA</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
     ` ;
    }




    button.addEventListener('submit', (e) =>{
        e.preventDefault();
        data();
    });



});

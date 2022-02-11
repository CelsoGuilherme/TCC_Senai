var curtidas = new Boolean(false);
var salvos = new Boolean(false);

function somenteNumeros(){
    var sDigitos ="0123456789,.-()";
    var cTecla = event.key;
    if(sDigitos.indexOf(cTecla)==-1){
        return false;
    }else{
        return true;
    }
}

function somenteLetra(){
    var sDigitos = "qwertyuiopasdfghjklçzxcvbnmQWERTYUIOPASDFGHJKLÇZXCVBNMáéíóúÁÉÍÓÚâêôÂÊÔãõÃÕ' ";
    var cTecla = event.key;
    if(sDigitos.indexOf(cTecla)==-1){
        return false;
    }else{
        return true;
    }
}

function travaInputs() {
    var inputs = document.querySelectorAll(".inputInfoGeral");
    var ArrayInputs = Array.from(inputs);
    
    for (var i = 0;i <= ArrayInputs.length;i++) {
        ArrayInputs[i].disabled = true;
    }
}

function mostraCaminho(idInput) {
    inputPDF = document.getElementById(idInput);
    valorPATH = inputPDF.value;
    valorPATH = valorPATH.replace('fakepath','');
    valorPATH = valorPATH.replace('\\','');
    valorPATH = valorPATH.replace('\\','');
    valorPATH = valorPATH.replace('C:','');
    spanPATH = document.querySelector(".filePath").innerHTML = valorPATH;
}

function liked(id) {
    if (curtidas == false) {
        btnLike = document.getElementById(id);
        btnLike.classList.remove("far");
        btnLike.classList.add("fas");
        curtidas = true;
    } else if (curtidas == true) {
        btnLike = document.getElementById(id);
        btnLike.classList.remove("fas");
        btnLike.classList.add("far");
        curtidas = false;
    }
}

function abreEnviaCurriculo() {
    popupPost = document.querySelector("#containerPopupCurriculo");
    popupPost.classList.remove("d-none");
    popupPost.classList.add("d-flex");
    document.querySelector("#mainSidebar").style.filter = "brightness(0.4)";
    document.querySelector(".containerFeed").style.filter = "brightness(0.4)";
    document.querySelector(".containerChat").style.filter = "brightness(0.4)";
}

function fechaCurriculo() {
    popupPost = document.querySelector("#containerPopupCurriculo");
    popupPost.classList.remove("d-flex");
    popupPost.classList.add("d-none");
    document.querySelector("#mainSidebar").style.filter = "brightness(1)";
    document.querySelector(".containerFeed").style.filter = "brightness(1)";
    document.querySelector(".containerChat").style.filter = "brightness(1)";
}

function openPopup() {
    popupPost = document.querySelector("#containerPopupPost");
    popupPost.classList.remove("d-none");
    popupPost.classList.add("d-flex");
    document.querySelector("#mainSidebar").style.filter = "brightness(0.4)";
    document.querySelector(".containerFeed").style.filter = "brightness(0.4)";
    document.querySelector(".containerChat").style.filter = "brightness(0.4)";
}

function closePopup() {
    popupPost = document.querySelector("#containerPopupPost");
    popupPost.classList.remove("d-flex");
    popupPost.classList.add("d-none");
    document.querySelector("#mainSidebar").style.filter = "brightness(1)";
    document.querySelector(".containerFeed").style.filter = "brightness(1)";
    document.querySelector(".containerChat").style.filter = "brightness(1)";
}

function openPost(imagem){
    popupPost = document.querySelector(".containerPopupPost");
    popupPost.classList.remove("d-none");
    popupPost.classList.add("d-flex");
    document.querySelector("#mainSidebar").style.filter = "brightness(0.4)";
    document.querySelector(".containerFeed").style.filter = "brightness(0.4)";

    alert(imagem);

    //Criando e inserindo tag img
    var container = document.querySelector(".bodyPostPopup");
    var img = document.createElement("img");
    img.setAttribute("src", "img/"+imagem);
    container.appendChild(container);
}

function closePost() {
    popupPost = document.querySelector(".containerPopupPost");
    popupPost.classList.remove("d-flex");
    popupPost.classList.add("d-none");
    document.querySelector("#mainSidebar").style.filter = "brightness(1)";
    document.querySelector(".containerFeed").style.filter = "brightness(1)";
}

function abrePerfil(idNavLink) {
    perfil = document.querySelector(".profile");
    perfil.classList.remove("d-none");
    perfil.classList.add("d-flex");

    feed = document.querySelector(".feed");
    feed.classList.remove("d-flex");
    feed.classList.add("d-none");

    saves = document.querySelector(".saves");
    saves.classList.remove("d-flex");
    saves.classList.add("d-none");

    varNavLink = document.getElementById(idNavLink);
    varNavLink.classList.add("navLinkActived");

    varNavLinka = document.getElementById("navLinkHome");
    varNavLinka.classList.remove("navLinkActived");

    document.getElementById("navLinkSaves").classList.remove("navLinkActived");
}

function abreFeed(idNavLink) {
    feed = document.querySelector(".feed");
    feed.classList.remove("d-none");
    feed.classList.add("d-flex");

    perfil = document.querySelector(".profile");
    perfil.classList.remove("d-flex");
    perfil.classList.add("d-none");

    saves = document.querySelector(".saves");
    saves.classList.remove("d-flex");
    saves.classList.add("d-none");

    varNavLink = document.getElementById(idNavLink);
    varNavLink.classList.add("navLinkActived");

    varNavLinka = document.getElementById("navLinkPerfil");
    varNavLinka.classList.remove("navLinkActived");

    varNavLinkb = document.getElementById("navLinkSaves");
    varNavLinkb.classList.remove("navLinkSaves");

    document.getElementById("navLinkSaves").classList.remove("navLinkActived");
}

function abreSaves(idNavLink) {
    saves = document.querySelector(".saves");
    saves.classList.remove("d-none");
    saves.classList.add("d-flex");

    perfil = document.querySelector(".profile");
    perfil.classList.remove("d-flex");
    perfil.classList.add("d-none");

    feed = document.querySelector(".feed");
    feed.classList.remove("d-flex");
    feed.classList.add("d-none");

    varNavLink = document.getElementById(idNavLink);
    varNavLink.classList.add("navLinkActived");

    varNavLinka = document.getElementById("navLinkPerfil");
    varNavLinka.classList.remove("navLinkActived");

    varNavLinkb = document.getElementById("navLinkHome");
    varNavLinkb.classList.remove("navLinkActived");
}

function abreMudaPerfil() {
    popupPost = document.querySelector("#containerPopupPerfil");
    popupPost.classList.remove("d-none");
    popupPost.classList.add("d-flex");
    document.querySelector("#mainSidebar").style.filter = "brightness(0.4)";
    document.querySelector(".containerFeed").style.filter = "brightness(0.4)";
    document.querySelector(".containerChat").style.filter = "brightness(0.4)";
}

function fechaMudaPerfil() {
    popupPost = document.querySelector("#containerPopupPerfil");
    popupPost.classList.remove("d-flex");
    popupPost.classList.add("d-none");
    document.querySelector("#mainSidebar").style.filter = "brightness(1)";
    document.querySelector(".containerFeed").style.filter = "brightness(1)";
    document.querySelector(".containerChat").style.filter = "brightness(1)";
}

function abreBiografia() {
    popupPost = document.querySelector("#containerPopupBiografia");
    popupPost.classList.remove("d-none");
    popupPost.classList.add("d-flex");
    document.querySelector("#mainSidebar").style.filter = "brightness(0.4)";
    document.querySelector(".containerFeed").style.filter = "brightness(0.4)";
    document.querySelector(".containerChat").style.filter = "brightness(0.4)";
}

function fechaBiografia() {
    popupPost = document.querySelector("#containerPopupBiografia");
    popupPost.classList.remove("d-flex");
    popupPost.classList.add("d-none");
    document.querySelector("#mainSidebar").style.filter = "brightness(1)";
    document.querySelector(".containerFeed").style.filter = "brightness(1)";
    document.querySelector(".containerChat").style.filter = "brightness(1)";
}

function abreForm1() {
    fieldset1 = document.querySelector(".fieldset1")
    fieldset1.classList.add("fieldsetAtivo")

    divSubmit = document.querySelector(".infoGeral");
    divSubmit.classList.remove("d-none");
    divSubmit.classList.add("d-flex");
    
    var inputs = document.querySelectorAll(".inputInfoGeral");
    var ArrayInputs = Array.from(inputs);
    
    for (var i = 0;i <= ArrayInputs.length;i++) {
        ArrayInputs[i].disabled = false;
    }
}

function abreForm2() {
    fieldset1 = document.querySelector(".fieldset2")
    fieldset1.classList.add("fieldsetAtivo")

    divSubmit = document.querySelector(".infoEscolaridade");
    divSubmit.classList.remove("d-none");
    divSubmit.classList.add("d-flex");
    
    var inputs = document.querySelectorAll(".inputInfoEscolaridade");
    var ArrayInputs = Array.from(inputs);
    
    for (var i = 0;i <= ArrayInputs.length;i++) {
        ArrayInputs[i].disabled = false;
    }
}

function abreForm3() {
    fieldset1 = document.querySelector(".fieldset3")
    fieldset1.classList.add("fieldsetAtivo")

    divSubmit = document.querySelector(".infoExp");
    divSubmit.classList.remove("d-none");
    divSubmit.classList.add("d-flex");
    
    var inputs = document.querySelectorAll(".inputInfoExp");
    var ArrayInputs = Array.from(inputs);
    
    for (var i = 0;i <= ArrayInputs.length;i++) {
        ArrayInputs[i].disabled = false;
    }
}
function abrePopupPerfil(idPerfil,tabelPost) {
    document.cookie='tabelPost='+tabelPost;
    window.location.assign("./popupinfoPerfil.php?codigo="+idPerfil);
}

function fechaPopupPerfil() {
    window.location.assign("./index.php");
}

function NovoChat(idChat, tabelChat){
    document.cookie='idChat='+idChat;
    document.cookie='tabelChat='+tabelChat;
    window.location.assign("./pageChat.php");
}

function fechaNovoChat() {
    // window.location.assign("./index.php");
}
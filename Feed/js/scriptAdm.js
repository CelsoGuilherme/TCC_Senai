function abrePerfil(idNavLink) {
    perfil = document.querySelector(".profile");
    perfil.classList.remove("d-none");
    perfil.classList.add("d-flex");

    feed = document.querySelector(".feed");
    feed.classList.remove("d-flex");
    feed.classList.add("d-none");

    varNavLink = document.getElementById(idNavLink);
    varNavLink.classList.add("navLinkActived");

    varNavLinka = document.getElementById("navLinkHome");
    varNavLinka.classList.remove("navLinkActived");

    containerPrincipal = document.querySelector(".containerFeed");
    containerPrincipal.style.width = "70%";

    containerChat = document.querySelector(".containerChat");
    containerChat.classList.remove("d-block");
    containerChat.classList.add("d-none");
}

function abreFeed(idNavLink) {
    feed = document.querySelector(".feed");
    feed.classList.remove("d-none");
    feed.classList.add("d-flex");

    perfil = document.querySelector(".profile");
    perfil.classList.remove("d-flex");
    perfil.classList.add("d-none");

    varNavLink = document.getElementById(idNavLink);
    varNavLink.classList.add("navLinkActived");

    varNavLinka = document.getElementById("navLinkPerfil");
    varNavLinka.classList.remove("navLinkActived");

    containerPrincipal = document.querySelector(".containerFeed");
    containerPrincipal.style.width = "45%";

    containerChat = document.querySelector(".containerChat");
    containerChat.classList.remove("d-none");
    containerChat.classList.add("d-block");
}

function abrePopupPerfil(idPerfil,tabelPost) {
    document.cookie='tabelPost='+tabelPost;
    window.location.assign("./popupinfoPerfil.php?codigo="+idPerfil);
}

function fechaPopupAdm() {
    window.location.assign("./pagAdm.php");
}

var teste;
function abrePopupApaga(idPost) {
    apagaPost = document.getElementById("containerPopupApagaPost");
    apagaPost.classList.remove("d-none");
    apagaPost.classList.add("d-flex");
    document.cookie='idPost='+idPost;
    document.querySelector("#mainSidebar").style.filter = "brightness(0.2)";
    document.querySelector(".containerFeed").style.filter = "brightness(0.2)";
    document.querySelector(".containerChat").style.filter = "brightness(0.2)";

    teste = idPost;
}

function fechaPopupApaga() {
    apagaPost = document.getElementById("containerPopupApagaPost");
    apagaPost.classList.remove("d-flex");
    apagaPost.classList.add("d-none");

    document.querySelector("#mainSidebar").style.filter = "brightness(1)";
    document.querySelector(".containerFeed").style.filter = "brightness(1)";
    document.querySelector(".containerChat").style.filter = "brightness(1)";
}


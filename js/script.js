function popupLogin() {
  document.querySelector('.containerPopup').style.display = 'flex';
  document.getElementById('section-1').style.filter = 'blur(2px)';
  document.querySelector('#idBody').style.overflow = 'hidden';
  document.querySelector('#section-1').scrollIntoView();
}

function fechar() {
  document.querySelector('.containerPopup').style.display = 'none';
  document.getElementById('section-1').style.filter = 'blur(0px)';
  document.querySelector('#idBody').style.overflow = 'auto';
}

class MobileNavbar {
    constructor(mobilem, navl, navLinks) {
        this.mobilem = document.querySelector(mobilem);
        this.navl = document.querySelector(navl);
        this.navLinks = document.querySelectorAll(navLinks);
        this.activeClass = "active";
    
        this.handleClick = this.handleClick.bind(this);
    }
  
    animateLinks() {
      this.navLinks.forEach((link, index) => {
        link.style.animation
          ? (link.style.animation = "")
          : (link.style.animation = `navLinkFade 0.5s ease forwards ${
              index / 7 + 0.3
            }s`);
      });
    }
  
    handleClick() {
      this.navl.classList.toggle(this.activeClass);
      this.mobilem.classList.toggle(this.activeClass);
      this.animateLinks();
    }
  
    addClickEvent() {
      this.mobilem.addEventListener("click", this.handleClick);
    }
  
    init() {
      if (this.mobilem) {
        this.addClickEvent();
      }
      return this;
    }
}
  
const mobileNavbar = new MobileNavbar(
    ".mobilem",
    ".navl",
    ".navl li",
);
mobileNavbar.init();
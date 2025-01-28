const headlines = document.querySelectorAll(".block-headline");
const navLi = document.querySelectorAll(".page-navigation li");
let lastActive = null;

window.onscroll = () => {
  let current = "";

  headlines.forEach((headline) => {
    const sectionTop = headline.offsetTop;
    if (pageYOffset >= sectionTop - 60) {
      current = headline.getAttribute("id");
    }
  });

  navLi.forEach((li) => {
    if (li.classList.contains(current)) {
      if (lastActive !== li) {
        if (lastActive) {
          lastActive.classList.remove("active");
        }
        li.classList.add("active");
        lastActive = li;
      }
    }
  });
};

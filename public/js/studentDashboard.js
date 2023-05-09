setTimeout(()=>{

const btnSildesClass = document.querySelectorAll(".nav-btns");
const slidesClass = document.querySelector(".slides-list");
const btnDotsClass = document.querySelector(".btn-dots");

let curIndex = 0,
lastIndex = 0,
timeout;

//Next/Prev button click

btnSildesClass.forEach((btnSlides) => {
  btnSlides.addEventListener("click", function () {
    const self = this;
    const activeSlide = slidesClass.querySelector(".active-slide");
    curIndex = [...slidesClass.children].indexOf(activeSlide);
    lastIndex = slidesClass.children.length - 1;

    let nextIndex = 0;

    if (self.className.match("nav-btns-next")) {
      nextIndex = curIndex !== 0 ? curIndex - 1 : lastIndex;
    }
    else if (self.className.match("nav-btns-prev")) {
      nextIndex = curIndex !== lastIndex ? curIndex + 1 : 0;
    }

    setNextPrevSlide(curIndex, nextIndex);
    resetTimeout();
  });
});

//Dot button click

btnDotsClass.addEventListener("click", function (e) {
  if (e.target.classList.value === "btn-dot") {
      const curDot = btnDotsClass.querySelector(".active-dot");

      curIndex = [...btnDotsClass.children].indexOf(curDot);
      nextIndex = [...btnDotsClass.children].indexOf(e.target);
      setNextPrevSlide(curIndex, nextIndex);
      resetTimeout();
  }
});

function setNextPrevSlide(curIndex, nextIndex) {
  slidesClass.children[curIndex].classList.remove("active-slide");
  btnDotsClass.children[curIndex].classList.remove("active-dot");

  slidesClass.children[nextIndex].classList.add("active-slide");
  btnDotsClass.children[nextIndex].classList.add("active-dot");
  
}

//Auto Slide Transition
function autoSlide() {
  const activeSlide = document.querySelector(".active-slide");
  curIndex = [...slidesClass.children].indexOf(activeSlide);
  lastIndex = slidesClass.children.length - 1;

  let nextIndex = curIndex === lastIndex ? 0 : curIndex + 1;

  setNextPrevSlide(curIndex, nextIndex);

  timeout = setTimeout(autoSlide, 5000);
}

autoSlide();

function resetTimeout() {
  clearTimeout(timeout);
  timeout = setTimeout(autoSlide, 5000);
}

},50)


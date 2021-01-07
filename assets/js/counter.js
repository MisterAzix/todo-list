(function animateValue() {
    let current = 0;
    let obj = document.getElementById('todo-counter');
    let counter = obj.getAttribute('data-counter');
    let stepTime = Math.abs(Math.floor(3000 / counter));
    let timer = setInterval(() => {
        current++;
        obj.innerHTML = `${current}/100`;
        if (current == counter) clearInterval(timer);
    }, stepTime);
})();
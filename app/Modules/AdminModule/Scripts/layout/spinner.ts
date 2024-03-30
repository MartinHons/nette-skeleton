window.onload = () => {

    const spinner = document.getElementById('spinner')
    let opacity = 1

    setInterval(function() {
       if (opacity > 0) {
          opacity -= 0.05;
          spinner.style.opacity = opacity;
       }
       else {
            spinner.style.display = 'none'
       }
    }, 25)
}

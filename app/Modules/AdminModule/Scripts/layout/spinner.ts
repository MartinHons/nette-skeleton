window.onload = () => {

    const spinner = document.getElementById('spinner')
    const sidebar = document.getElementById('sidebar')
    let opacity = 1

    setInterval(function() {
       if (opacity > 0) {
          opacity -= 0.05;
          spinner.style.opacity = opacity;
       }
       else {
            spinner?.remove()
            sidebar.style.transition = 'all ease-in-out .5s'
            document.body.style.transition = 'all ease-in-out .5s'
       }
    }, 25)

}

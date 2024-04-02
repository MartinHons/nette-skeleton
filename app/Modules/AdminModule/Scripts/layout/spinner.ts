window.onload = () => {

    const spinner = document.getElementById('spinner')
    const sidebar = document.getElementById('sidebar')
    let opacity = 1

    const interval = setInterval(() => {
       if (opacity > 0) {
          opacity -= 0.05;
          spinner.style.opacity = opacity;
       }
       else {
            spinner?.remove()
            document.body.style.transition = 'all ease-in-out .5s'
            if (sidebar) {
               sidebar.style.transition = 'all ease-in-out .5s'
            }
            clearInterval(interval)
       }
    }, 25)

}

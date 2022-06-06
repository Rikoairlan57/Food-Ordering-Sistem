function addHeaderBg(){
    const header = document.getElementById('header')
    if(this.scrollY >= 50){
        header.classList.add('headerBg')
    }
    else{
        header.classList.remove('headerBg')
    }
}
window.addEventListener('scroll', addHeaderBg)


console.log("hellow eoersdad");

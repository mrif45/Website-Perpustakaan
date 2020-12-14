/*===== SHOW NAVBAR  =====*/ 
const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)

    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
            // show navbar
            nav.classList.toggle('show')
            // change icon
            toggle.classList.toggle('bx-x')
            // add padding to body
            bodypd.classList.toggle('body-pd')
            // add padding to header
            headerpd.classList.toggle('body-pd')
        })
    }
}

showNavbar('header-toggle','nav-bar','body-pd','header')

/*===== LINK ACTIVE  =====*/ 
const linkColor = document.querySelectorAll('.nav__link')

function colorLink(){
    if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
    }
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

/*===== LOGIN SHOW and HIDDEN =====*/
const signUp = document.getElementById('sign-up'),
    signIn = document.getElementById('sign-in'),
    admin  = document.getElementById('admin')
    loginIn = document.getElementById('login-in'),
    loginUp = document.getElementById('login-up')
    adminLogin = document.getElementById('admin-login')


signUp.addEventListener('click', ()=>{
    loginIn.classList.remove('block')
    loginUp.classList.remove('none')
    admin.classList.remove('block')

    loginIn.classList.toggle('none')
    loginUp.classList.toggle('block')
    admin.classList.toggle('none')
})

signIn.addEventListener('click', ()=>{
    loginIn.classList.remove('none')
    loginUp.classList.remove('block')
    admin.classList.remove('block')

    loginIn.classList.toggle('block')
    loginUp.classList.toggle('none')
    admin.classList.toggle('none')
})

adminLogin.addEventListener('click', ()=>{
    loginIn.classList.remove('block')
    loginUp.classList.remove('block')
    admin.classList.remove('none')

    loginIn.classList.toggle('none')
    loginUp.classList.toggle('none')
    admin.classList.toggle('block')
})
const under_login = document.getElementById("under_login");
    const under_signup = document.getElementById("under_signup");
    const login = document.querySelector(".login");
    const registration =document.querySelector(".registration");
    const auth_modal = document.querySelector(".auth-modal")

    under_login.addEventListener("click", (e)=>{
        e.preventDefault();
       auth_modal.classList.add("slide");
    })
    under_signup.addEventListener("click", (e)=>{
        e.preventDefault();
        auth_modal.classList.remove("slide");
    })
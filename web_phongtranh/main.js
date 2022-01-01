    function validateProduct()
    {
        let priceField = document.getElementById("findproduct");
        let errorField = document.getElementById("errorMessage");
        let price = priceField.value;
        console.log(price);
        if(price==="")
        {
            errorField.innerHTML = "Vui lòng nhập giá";
            errorField.style.display = "block";
            priceField.focus();
            return false;
        }
        else if (
            price.includes("'") ||
            price.includes("!") ||
            price.includes("?") ||
            price.includes("|") ||
            price.includes("<") ||
            price.includes(">")
        ) {
            errorField.innerHTML = "Giá không được chứa kí tự <,',!,?,|>,";
            errorField.style.display = "block";
            priceField.focus();
            return false;
        }
        else if(isNaN(price))
        {
            errorField.innerHTML = "Giá trị nhập vào sai";
            errorField.style.display = "block";
            priceField.focus();
            return false;
        }
        errorField.innerHTML = "";
        return true;
    }
    function validateInput() {
    let usernameField = document.getElementById("username");
    let passwordField = document.getElementById("password");
    let errorField = document.getElementById("errorMessage");
    let username = usernameField.value;
    let password = passwordField.value;
    
    if (username === "") {
        errorField.innerHTML = "Vui lòng nhập tên đăng nhập";
        errorField.style.display = "block";
        usernameField.focus();
        return false;
    } else if (
        password.includes("'") ||
        password.includes("!") ||
        password.includes("?") ||
        password.includes("|") ||
        password.includes("<") ||
        password.includes(">")
    ) {
        errorField.innerHTML = "Mật khẩu không được chứa kí tự <,',!,?,|>,";
        errorField.style.display = "block";
        passwordField.focus();
        return false;
    } else if (password === "") {
        errorField.innerHTML = "Vui lòng nhập mật khẩu";
        errorField.style.display = "block";
        passwordField.focus();
        return false;
    }else if (
        username.includes("'") ||
        username.includes("!") ||
        username.includes("?") ||
        username.includes("|") ||
        username.includes("<") ||
        username.includes(">")
    ) {
        errorField.innerHTML = "Tên đăng nhập không được chứa kí tự <,',!,?,|>,";
        errorField.style.display = "block";
        usernameField.focus();
        return false;
    }
    errorField.innerHTML = "";
    return true;
    }
    function clearErrorMessage() {
        
    let errorField = document.getElementById("errorMessage");
    if(errorField)
    {
        errorField.innerHTML = "";
        errorField.style.display = "none";
    }
    let errorField2 = document.getElementById("errorMessage2");
    if(errorField2)
    {
        errorField2.innerHTML = "";
        errorField2.style.display = "none";
    }
}
    function validateInput_forResetPassword() {
    let passwordField = document.getElementById("newpassword");
    let errorField = document.getElementById("errorMessage");
    let oldpassword = document.getElementById("oldpassword").value;
    let password = passwordField.value;
    let password_comfirm = document.getElementById("newpassword_comfirm").value;
    if(oldpassword==="")
    {
        errorField.innerHTML = "Vui lòng điền mật khẩu hiện tại";
        errorField.style.display = "block";
        passwordField.focus();
        return false;
    }
    else if(password==="")
    {
        errorField.innerHTML = "Vui lòng điền mật khẩu mới";
        errorField.style.display = "block";
        passwordField.focus();
        return false;
    }
    else if(password_comfirm==="")
    {
        errorField.innerHTML = "Vui lòng xác nhận mật khẩu mới";
        errorField.style.display = "block";
        passwordField.focus();
        return false;
    }
    else if(password!==password_comfirm)
    {
        errorField.innerHTML = "Mật khẩu không khớp";
        errorField.style.display = "block";
        passwordField.focus();
        return false;
    }
    else if (
        password.includes("'") ||
        password.includes("!") ||
        password.includes("?") ||
        password.includes("|") ||
        password.includes("<") ||
        password.includes(">") ||
        password.includes("&") 
    ) {
        errorField.innerHTML = "Mật khẩu không được chứa kí tự <,',!,?,|>,";
        errorField.style.display = "block";
        passwordField.focus();
        return false;
    } 
    else if(password.length <6)
    {
        errorField.innerHTML = "Mật khẩu không được ít hơn 6 chữ số";
        errorField.style.display = "block";
        passwordField.focus();
        return false;
    }
    errorField.innerHTML = "";
    return true;
}

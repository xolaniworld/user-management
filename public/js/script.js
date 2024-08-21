function valid() {
    if (document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password Field do not match  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
    }
    return true;
}
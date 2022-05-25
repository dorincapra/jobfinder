document.querySelector('#signUpForm').addEventListener('submit',
    (e) => {
        const par1 = document.querySelector('#signUpPass1').value;
        const par2 = document.querySelector('#signUpPass2').value;
        if(par1 == par2){
            return true;
        }
        else {
            alert('Parolele nu sunt identice!');
            e.preventDefault();
        }
});



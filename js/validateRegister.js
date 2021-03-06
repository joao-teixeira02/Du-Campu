let namePerson = document.querySelector("form input[name=n]");
if (namePerson) namePerson.addEventListener("input", validateName, false);
let username = document.querySelector("form input[name=u]");
if (username) username.addEventListener("input", validateUsername, false);
let password = document.querySelector("form input[name=p]");
if (password) password.addEventListener("input", validatePassword, false);
let passwordagain = document.querySelector("form input[name=p2]");
if (passwordagain && password) {
  passwordagain.addEventListener(
    "keyup",
    validateRepeat.bind(passwordagain, password),
    false
  );
  password.addEventListener("keyup",
  validateRepeat.bind(passwordagain, password),
  false
  );
}

let phoneNum = document.querySelector("form input[name=ph]");
if (phoneNum) phoneNum.addEventListener("input", validatePhone, false);

let emailAddr = document.querySelector("form input[name=m]");
if (emailAddr) emailAddr.addEventListener("input", validateEmail, false);

let register = document.querySelector("form.register_form");
if (register) register.addEventListener("submit", validateRegister, false);

function validatePassword() {
  if(!/^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/.test(this.value)) this.classList.add("invalid");
  else this.classList.remove("invalid");
}

function validateName() {
  if (!/^[a-zA-Z\s]*$/.test(this.value)) this.classList.add("invalid");
  else this.classList.remove("invalid");
}

function validateUsername() {
  if (!/^[a-z0-9]*$/.test(this.value)) this.classList.add("invalid");
  else this.classList.remove("invalid");
}

function validatePhone() {
  if (!/^[0-9]{9}$/.test(this.value)) this.classList.add("invalid");
  else this.classList.remove("invalid");
}

function validateEmail() {
 if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.value)) this.classList.add("invalid");
 else this.classList.remove("invalid");
}

function validateRepeat(password) {
  if (this.value !== password.value) this.classList.add("invalid");
  else this.classList.remove("invalid");
}

function validateRegister(event) {
  let inputs = this.querySelectorAll("input");
  for (let i = 0; i < inputs.length; i++)
    if (inputs[i].classList.contains("invalid")) event.preventDefault();
}
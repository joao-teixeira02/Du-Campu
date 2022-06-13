let namePerson = document.querySelector("form input[name=n]");
if (namePerson) namePerson.addEventListener("input", validateName, false);
let username = document.querySelector("form input[name=u]");
if (username) username.addEventListener("input", validateUsername, false);
let password = document.querySelector("form input[name=p]");
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

let profile = document.querySelector("form.profile_form");
if (profile) profile.addEventListener("submit", validateProfile, false);

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

function validateProfile(event) {
  let inputs = this.querySelectorAll("input");
  for (let i = 0; i < inputs.length; i++)
    if (inputs[i].classList.contains("invalid")) event.preventDefault();
}
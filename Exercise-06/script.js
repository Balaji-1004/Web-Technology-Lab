const menuToggle = document.querySelector('.menu-toggle');
const mainNav = document.querySelector('.main-nav');
if (menuToggle && mainNav) {
  menuToggle.addEventListener('click', () => {
    const open = mainNav.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', open);
  });
}

document.querySelectorAll('.password-toggle').forEach((button) => {
  button.addEventListener('click', () => {
    const input = document.getElementById(button.dataset.target);
    const visible = input.type === 'text';
    input.type = visible ? 'password' : 'text';
    button.textContent = visible ? 'Show' : 'Hide';
  });
});

document.querySelectorAll('.principle').forEach((button) => {
  button.addEventListener('click', () => {
    document.querySelectorAll('.principle').forEach((item) => item.classList.remove('active'));
    document.querySelectorAll('.principle-panel').forEach((panel) => panel.classList.add('hidden'));
    button.classList.add('active');
    document.getElementById(button.dataset.panel).classList.remove('hidden');
  });
});

const registrationForm = document.getElementById('register-form');
if (registrationForm) {
  registrationForm.addEventListener('submit', (event) => {
    const password = document.getElementById('password').value;
    const confirmation = document.getElementById('confirm_password').value;
    if (password !== confirmation) {
      event.preventDefault();
      document.getElementById('confirm_password').setCustomValidity('Passwords do not match');
      document.getElementById('confirm_password').reportValidity();
    } else {
      document.getElementById('confirm_password').setCustomValidity('');
    }
  });
}

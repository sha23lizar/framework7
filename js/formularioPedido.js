document.getElementById('showFormBtn').addEventListener('click', function() {
   document.getElementById('overlay').style.display = 'block';
   document.getElementById('shirtSizesForm').classList.add('visible');
   document.body.classList.add('dark-overlay');
});

document.getElementById('overlay').addEventListener('click', function() {
   document.getElementById('overlay').style.display = 'none';
   document.getElementById('shirtSizesForm').classList.remove('visible');
   document.body.classList.remove('dark-overlay');
});


document.addEventListener('DOMContentLoaded', function() {
   const form = document.getElementById('orderForm');
   const generoInput = document.getElementById('genero');
   const xsInput = document.getElementById('xs');
   const sInput = document.getElementById('s');
   const mInput = document.getElementById('m');
   const lInput = document.getElementById('l');
   const xlInput = document.getElementById('xl');
   const errorMessage = document.getElementById('error-message');

   const maleButton = document.querySelector('.btn-male');
   const femaleButton = document.querySelector('.btn-female');

   maleButton.addEventListener('click', function() {
       generoInput.value = 'M';
       maleButton.classList.add('selected');
       femaleButton.classList.remove('selected');
   });

   femaleButton.addEventListener('click', function() {
       generoInput.value = 'F';
       femaleButton.classList.add('selected');
       maleButton.classList.remove('selected');
   });

   form.addEventListener('submit', function(event) {
       errorMessage.classList.add('hidden');

       const totalShirts = parseInt(xsInput.value) + parseInt(sInput.value) +
                           parseInt(mInput.value) + parseInt(lInput.value) +
                           parseInt(xlInput.value);

       if (generoInput.value === '' || totalShirts === 0) {
           event.preventDefault();
           errorMessage.classList.remove('hidden');
       }
   });

   const buttonsMinus = document.querySelectorAll('.btn-minus');
   const buttonsPlus = document.querySelectorAll('.btn-plus');

   buttonsMinus.forEach(button => {
       button.addEventListener('click', function() {
           const input = this.nextElementSibling;
           if (input.value > 0) {
               input.value--;
           }
       });
   });

   buttonsPlus.forEach(button => {
       button.addEventListener('click', function() {
           const input = this.previousElementSibling;
           input.value++;
       });
   });
});

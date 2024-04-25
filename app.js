// This code for insert data into database 

const formEl = document.querySelector('#transaction-form');
const showAlert = document.querySelector('#show-alert');
const showTableEl = document.querySelector('#show-table');


formEl.addEventListener('submit', (e) => {
     e.preventDefault();
     let showError = document.querySelector('#show-error');
     let errorBoxEl = document.getElementById('error-box');
     let xhr = new XMLHttpRequest();
     let formData = new FormData(formEl);

     xhr.open("POST", "partial/_insert.php", true);
     xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {

               if (xhr.responseText.includes('Error')) {
                    errorBoxEl.classList.remove('d-none');
                    showError.innerHTML = xhr.responseText;
               } else {
                    showAlert.innerHTML = xhr.responseText;
               }
          }
     }
     xhr.send(formData);

})


// Action on transaction




// Update Record -> code start here

let actionBtnEl = document.querySelectorAll('.edit-btn');
let formInputEl = document.querySelectorAll('#transaction-form .form-control');
let selectBox = document.querySelector('#transaction-form .form-select');
let updateBtnEl = document.querySelector('#update-btn');
let submitBtnEl = document.querySelector('#submit-btn');
let updateRowId = document.getElementById('row-id');

// console.log(selectBox);

actionBtnEl.forEach((btn) => {
     // console.log(btn);
     btn.addEventListener('click', function () {
          let tdNoEl = btn.parentElement.parentElement.firstElementChild.textContent;
          let formData = new FormData();
          // console.log(tdNoEl);
          formData.append("id", tdNoEl);
          formData.append("select", 1);

          let res = fetch('./partial/_actionTable.php', {
               header: {},
               method: "POST",
               body: formData
          });

          res.then(r => r.json()).then(data => {
               console.log(data);
               formInputEl[0].value = data.t_date;
               formInputEl[1].value = data.t_amount;
               formInputEl[2].value = data.t_desc;
               updateRowId.value = data.t_id;
               updateBtnEl.classList.remove("d-none");
               submitBtnEl.classList.add("d-none");
          })
     })
})

// insert new record when click update btn
updateBtnEl.addEventListener('click', (event) => {
     let formData = new FormData();
     formData.append("dt", formInputEl[0].value);
     formData.append("amt", formInputEl[1].value);
     formData.append("desc", formInputEl[2].value);
     formData.append("choice", selectBox.value);
     formData.append("row-id", updateRowId.value);
     formData.append("update", 1); // accessing the particular block on _actionTable.php page

     let formObj = {
          header: {},
          method: 'POST',
          body: formData
     }

     fetch('partial/_actionTable.php', formObj)
          .then((res) => res.text())
          .then((data) => {
               alert(data);
          })
});

// Update Record -> code End here


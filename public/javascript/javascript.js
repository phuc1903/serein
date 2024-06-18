// var times = document.querySelectorAll(".user__time");
// var t = new Date();
// for (let i = 0; i < times.length; i++) {
//   times[i].innerHTML = t.getHours() + ":" + t.getMinutes();
// }

// function changeMainImage(thumbnailSrc) {
//     // Lấy thẻ img-main
//     var imgMain = document.querySelector('.img-main');

//     // Cập nhật src của img-main
//     imgMain.src = thumbnailSrc;
// }

// // Update the countdown every second
// // Update the countdown every second
// // const countdownInterval = setInterval(function() {
// //   // Get the current date and time
// //   const currentDate = new Date().getTime();

// //   // Calculate the remaining time in milliseconds
// //   const remainingTime = countdownDate - currentDate;

// //   // Calculate days, hours, minutes, and seconds
// //   const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
// //   const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
// //   const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
// //   const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

// //   // Update the HTML elements with the calculated values
// //   document.getElementById("days").innerText = days;
// //   document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
// //   document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
// //   document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;

// //   // Check if the countdown is over
// //   if (remainingTime < 0) {
// //       clearInterval(countdownInterval);
// //       document.getElementById("days").innerText = "0";
// //       document.getElementById("hours").innerText = "00";
// //       document.getElementById("minutes").innerText = "00";
// //       document.getElementById("seconds").innerText = "00";
// //   }
// // }, 1000);

// var detailPre = document.querySelector('.detail-pre');
// var detailAdd = document.querySelector('.detail-add');
// var quantityInput = document.getElementById('quantity-input');

// detailAdd.addEventListener('click', function () {
//     var currentQuantity = parseInt(quantityInput.value, 10);
//     quantityInput.value = currentQuantity + 1;
// });

// detailPre.addEventListener('click', function () {
//     var currentQuantity = parseInt(quantityInput.value, 10);

//     // Đảm bảo số lượng không âm
//     if (currentQuantity > 1) {
//         quantityInput.value = currentQuantity - 1;
//     } else {
//         // Nếu số lượng là 1 hoặc âm, đặt giá trị thành 1
//         quantityInput.value = 1;
//     }
// });

// quantityInput.addEventListener('blur', function () {
//   var currentQuantity = parseInt(quantityInput.value, 10);

//   // Đảm bảo số lượng không âm
//   if (currentQuantity < 1 || isNaN(currentQuantity)) {
//       quantityInput.value = 1;
//   }
// });

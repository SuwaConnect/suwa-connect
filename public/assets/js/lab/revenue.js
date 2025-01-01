// Function to handle form submissions
const paymentForm = document.querySelector('.payment-section form');
const invoiceForm = document.querySelector('.generate-invoice form');
const reportForm = document.querySelector('.reports form');
const refundForm = document.querySelector('.refunds-discounts form');

paymentForm.addEventListener('submit', (e) => {
  e.preventDefault();
  // Code to process payment
  console.log('Payment processed');
});

invoiceForm.addEventListener('submit', (e) => {
  e.preventDefault();
  // Code to generate invoice
  console.log('Invoice generated');
});

reportForm.addEventListener('submit', (e) => {
  e.preventDefault();
  // Code to generate report
  console.log('Report generated');
});

refundForm.addEventListener('submit', (e) => {
  e.preventDefault();
  // Code to process refund
  console.log('Refund processed');
});
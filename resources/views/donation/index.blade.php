<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate with Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-100 to-rose-100">
        <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Support Us with a Coffee</h1>
            <p class="text-center text-gray-600 mb-8">Choose a coffee to donate and select your payment method.</p>

            <!-- Coffee Selection -->
            <div class="space-y-4 mb-8">
                <div class="coffee-option bg-amber-50 p-4 rounded-lg flex justify-between items-center cursor-pointer hover:bg-amber-100" data-price="3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Espresso</h3>
                        <p class="text-gray-600">$3</p>
                    </div>
                    <img src="expresso.jpeg " alt="Espresso" class="w-12 h-12 rounded-full">
                </div>
                <div class="coffee-option bg-amber-50 p-4 rounded-lg flex justify-between items-center cursor-pointer hover:bg-amber-100" data-price="5">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Cappuccino</h3>
                        <p class="text-gray-600">$5</p>
                    </div>
                    <img src="capuccino.jpeg" alt="Cappuccino" class="w-12 h-12 rounded-full">
                </div>
                <div class="coffee-option bg-amber-50 p-4 rounded-lg flex justify-between items-center cursor-pointer hover:bg-amber-100" data-price="10">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Latte</h3>
                        <p class="text-gray-600">$10</p>
                    </div>
                    <img src="latte.jpeg" alt="Latte" class="w-12 h-12 rounded-full">
                </div>
            </div>

            <!-- Payment Method Selection (Hidden Initially) -->
            <div id="payment-section" class="hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Choose Payment Method</h2>
                <div class="space-y-4">
                    <div class="payment-option bg-gray-50 p-4 rounded-lg flex justify-between items-center cursor-pointer hover:bg-gray-100" data-method="paypal">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">PayPal</h3>
                            <p class="text-gray-600">Secure online payment</p>
                        </div>
                        <img src="paypal.jpeg " alt="PayPal" class="w-10 h-10">
                    </div>
                    <div class="payment-option bg-gray-50 p-4 rounded-lg flex justify-between items-center cursor-pointer hover:bg-gray-100" data-method="mpesa">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">M-Pesa</h3>
                            <p class="text-gray-600">Mobile payment</p>
                        </div>
                        <img src="mpesa.jpeg " alt="M-Pesa" class="w-10 h-10">
                    </div>
                </div>
                <button id="confirm-donation" class="mt-6 w-full bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 transition">Confirm Donation</button>
            </div>
        </div>
    </div>


    <!-- Modal for Mobile Number Input (Hidden Initially) -->
    <div id="mobile-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Enter Your Mobile Number</h3>
            <p class="text-gray-600 mb-4">Please provide your M-Pesa registered mobile number to receive the STK Push.</p>
            <input id="mobile-number" type="tel" placeholder="e.g., 254712345678" class="w-full p-2 border rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-amber-400" />
            <div class="flex justify-end space-x-2">
                <button id="cancel-mobile" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Cancel</button>
                <button id="submit-mobile" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Submit</button>
            </div>
        </div>
    </div>

    <script>
        const coffeeOptions = document.querySelectorAll('.coffee-option');
        const paymentSection = document.getElementById('payment-section');
        const paymentOptions = document.querySelectorAll('.payment-option');
        const confirmButton = document.getElementById('confirm-donation');
        const mobileModal = document.getElementById('mobile-modal');
        const mobileNumberInput = document.getElementById('mobile-number');
        const submitMobileButton = document.getElementById('submit-mobile');
        const cancelMobileButton = document.getElementById('cancel-mobile');
        let selectedCoffee = null;
        let selectedPayment = null;
        let mobileNumber = null;

        coffeeOptions.forEach(option => {
            option.addEventListener('click', () => {
                coffeeOptions.forEach(opt => opt.classList.remove('ring-2', 'ring-amber-400'));
                option.classList.add('ring-2', 'ring-amber-400');
                selectedCoffee = {
                    name: option.querySelector('h3').textContent,
                    price: option.getAttribute('data-price')
                };
                paymentSection.classList.remove('hidden');
                window.scrollTo({ top: paymentSection.offsetTop, behavior: 'smooth' });
            });
        });

        paymentOptions.forEach(option => {
            option.addEventListener('click', () => {
                paymentOptions.forEach(opt => opt.classList.remove('ring-2', 'ring-amber-400'));
                option.classList.add('ring-2', 'ring-amber-400');
                selectedPayment = option.getAttribute('data-method');

                 // If M-Pesa is selected
                 if (selectedPayment === 'mpesa') {
                    mobileModal.classList.remove('hidden');
                }
            });
        });

       // Cancel mobile number input
       cancelMobileButton.addEventListener('click', () => {
            mobileModal.classList.add('hidden');
            mobileNumberInput.value = '';
            selectedPayment = null;
            paymentOptions.forEach(opt => opt.classList.remove('ring-2', 'ring-amber-400'));
        });

        // Submit mobile number and initiate STK Push
        submitMobileButton.addEventListener('click', () => {
            mobileNumber = mobileNumberInput.value.trim();
            const phoneRegex = /^254\d{9}$/;
            if (!phoneRegex.test(mobileNumber)) {
                alert('Please enter a valid Kenyan mobile number starting with 254 (e.g., 254712345678).');
                return;
            }

            mobileModal.classList.add('hidden');
            alert('An STK Push has been sent to ' + mobileNumber + '. Please check your phone and enter your M-Pesa PIN to complete the payment.');

            // Simulate STK Push request (replace with actual backend API call)
            initiateSTKPush(selectedCoffee.price, mobileNumber);
        });

        // Confirm donation
        confirmButton.addEventListener('click', () => {
            if (!selectedCoffee) {
                alert('Please select a coffee to donate.');
                return;
            }
            if (!selectedPayment) {
                alert('Please select a payment method.');
                return;
            }
            if (selectedPayment === 'mpesa' && !mobileNumber) {
                alert('Please provide your mobile number for M-Pesa payment.');
                return;
            }

            if (selectedPayment === 'paypal') {
                alert(`Thank you for donating $${selectedCoffee.price} via PayPal!`);
                // Add PayPal integration here if needed
            }
            // M-Pesa confirmation will be handled via callback (not here)
        });

        // Function to initiate STK Push (placeholder for backend API call)
        async function initiateSTKPush(amount, phoneNumber) {
            try {
                // Replace this with an actual fetch call to your backend
                const response = await fetch('/api/stk-push', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        amount: amount,
                        phoneNumber: phoneNumber,
                    }),
                });

                const data = await response.json();
                if (data.success) {
                    console.log('STK Push initiated successfully:', data);
                } else {
                    alert('Failed to initiate STK Push. Please try again.');
                }
            } catch (error) {
                console.error('Error initiating STK Push:', error);
                alert('An error occurred while initiating the STK Push. Please try again.');
            }
        }
    </script>
</body>
</html>
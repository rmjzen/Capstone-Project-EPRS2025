window.addEventListener('DOMContentLoaded', () => {
            const scanMessage = document.getElementById('scanMessage');
            const barcodeInput = document.getElementById('barcodeInput');
            const barcodeInputArrival = document.getElementById('barcodeInputarrival');
            const countdownElement = document.getElementById('countdown');
            const lastFocusedInput = localStorage.getItem('lastFocusedInput');
            let countdown = 5; // Initial countdown value in seconds

            // Function to update the message based on focus
            // function updateMessage(focusedInputId) {
            //     if (focusedInputId === 'barcodeInput') {
            //         scanMessage.textContent = 'NOW SCAN ACTUAL TIME OF DEPARTURE';
            //     } else if (focusedInputId === 'barcodeInputarrival') {
            //         scanMessage.textContent = 'NOW SCAN ACTUAL TIME OF ARRIVAL';
            //     }
            // }

            function updateMessage(focusedInputId) {
                if (focusedInputId === 'barcodeInput') {
                    scanMessage.textContent = ' SCANED DEPARTURE NOW!';
                } else if (focusedInputId === 'barcodeInputarrival') {
                    scanMessage.textContent = ' SCANED ARRIVAL NOW!';
                }
            }

            // Determine which input to focus based on lastFocusedInput
            if (lastFocusedInput === 'barcodeInput') {
                barcodeInputArrival.focus();
                updateMessage('barcodeInputarrival');
                localStorage.setItem('lastFocusedInput', 'barcodeInputarrival');
            } else {
                barcodeInput.focus();
                updateMessage('barcodeInput');
                localStorage.setItem('lastFocusedInput', 'barcodeInput');
            }

            // Add event listeners to update message when inputs gain focus
            barcodeInput.addEventListener('focus', () => {
                updateMessage('barcodeInput');
                localStorage.setItem('lastFocusedInput', 'barcodeInput');
            });

            barcodeInputArrival.addEventListener('focus', () => {
                updateMessage('barcodeInputarrival');
                localStorage.setItem('lastFocusedInput', 'barcodeInputarrival');
            });

            // Countdown logic for page reload
            const countdownInterval = setInterval(() => {
                countdown--;
                countdownElement.textContent = countdown; // Update countdown display
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    window.location.reload(); // Reload the page when countdown ends
                }
            }, 1000); // 1 second intervals
        });
        document.getElementById('barcodeInput').addEventListener('change', function(event) {
            const code = event.target.value;

            fetch('/barcode/scan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Show success or error message
                    document.getElementById('barcoedeInput').value = ''; // Clear input
                    document.getElementById('barcodeInputarrival')
                        .focus(); // Switch focus back to departure input
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('barcodeInputarrival').addEventListener('change', function(event) {
            const code = event.target.value;

            fetch('/barcode/scanarrival', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Show success or error message
                    document.getElementById('barcodeInputarrival').value = ''; // Clear input
                    document.getElementById('barcodeInput').focus(); // Switch focus back to departure input
                })
                .catch(error => console.error('Error:', error));
        });

        function updateTime() {
            const now = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            document.getElementById('liveTime').innerText = now.toLocaleTimeString([], options);
        }

        // Update the time every second
        setInterval(updateTime, 1000);
        updateTime(); // Initial call to set the time immediately

import React, { useState } from 'react';

const MyComponent = () => {
  const [response, setResponse] = useState('');

  const sendRequest = async () => {
    // Data to be sent
    const user_id = 123;
    const amount = "210BDT";
    const trx = "RREDSD";
    
    // Secret key (shared between your server and the remote server)
    const secret_key = "your_secret_key";
    
    // Generate the hash using SHA-256
    const hashString = user_id + amount + trx + secret_key;
    const hash = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(hashString))
      .then(buffer => Array.from(new Uint8Array(buffer)))
      .then(hashArray => hashArray.map(b => b.toString(16).padStart(2, '0')).join(''));

    // Prepare the payload
    const postData = {
      user_id: user_id,
      amount: amount,
      TRX: trx,
      hash: hash
    };

    // Send POST request using Fetch API
    try {
      const res = await fetch('http://www.myproject.com/checkRequest', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(postData),
      });

      const result = await res.text(); // Assuming the response is in plain text

      // Set the response to state
      setResponse(result);
    } catch (error) {
      console.error('Error:', error);
      setResponse('Error: ' + error.message);
    }
  };

  return (
    <div>
      <button onClick={sendRequest}>Send Request</button>
      <div>
        <strong>Server Response:</strong>
        <p>{response}</p>
      </div>
    </div>
  );
};

export default MyComponent;

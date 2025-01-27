<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Pass Slip Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }

        .info {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 3px;
            margin-top: 20px;
        }

        .footer {
            font-size: 14px;
            color: #888;
            text-align: center;
            margin-top: 30px;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 style="color: #333;">Pass Slip Approval Request</h1>
        <h2 style="color: #555;">Hello {{ $name }},</h2>
        <p style="color: #555;">
            A new user,  has requested a pass slip and selected you to review and
            approve it.
        </p>
        <p style="color: #555;">
            Please review the details of their request and take the necessary action by clicking the button below:
        </p>
        <a href="https://pitepass.website" class="button"
            style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px;">
            CLICK HERE to Review the Request
        </a>
        <p style="color: #777; margin-top: 20px;">Thank you for your prompt attention to this request.</p>
    </div>

</body>

</html>

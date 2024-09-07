<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Card</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for Admit Card */
        .admit-card {
            width: 600px;
            margin: 20px auto;
            border: 2px solid #007bff;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        }
        .admit-card-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .admit-card-header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .admit-card-body {
            font-size: 16px;
            line-height: 1.5;
        }
        .admit-card .info-row {
            margin-bottom: 10px;
        }
        .admit-card .info-row label {
            font-weight: bold;
            color: #333;
        }
        .admit-card-footer {
            text-align: center;
            margin-top: 20px;
        }
        .admit-card-footer p {
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="admit-card">
    <div class="admit-card-header">
        <h1>Admit Card</h1>
        <p>Examination 2024</p>
    </div>
    
    <div class="admit-card-body">
        <div class="info-row">
            <label>Candidate Name:</label>
            <span>John Doe</span>
        </div>
        <div class="info-row">
            <label>Roll Number:</label>
            <span>123456</span>
        </div>
        <div class="info-row">
            <label>Exam Center:</label>
            <span>Central High School, Building A</span>
        </div>
        <div class="info-row">
            <label>Date of Exam:</label>
            <span>12th September 2024</span>
        </div>
        <div class="info-row">
            <label>Time of Exam:</label>
            <span>10:00 AM to 1:00 PM</span>
        </div>
    </div>
    
    <div class="admit-card-footer">
        <p>Please bring this admit card to the examination center along with a valid ID proof.</p>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

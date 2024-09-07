<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Card</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/school_4130952.png" type="image/x-icon">
    <style>
           .admit-card {
            width: 650px;
            margin: 20px auto;
            padding: 20px;
            border: 4px solid #6c757d; /* Dark gray border */
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            background-image: linear-gradient(45deg, #f8f9fa 25%, transparent 25%, transparent 75%, #f8f9fa 75%, #f8f9fa), 
                              linear-gradient(45deg, #f8f9fa 25%, transparent 25%, transparent 75%, #f8f9fa 75%, #f8f9fa);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
        }
        .admit-card-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .admit-card-header h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .admit-card-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            font-size: 16px;
            line-height: 1.6;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .info-row label {
            font-weight: bold;
            color: #333;
        }
        .info-row span {
            color: #007bff;
            
        }
        .admit-card-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #6c757d;
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
            <span>Touhid Khan</span>
        </div>
        <div class="info-row">
            <label>Roll Number:</label>
            <span>IMITA123456</span>
        </div>
        <div class="info-row">
            <label>Exam Center:</label>
            <span>LearnDash Academy, Building A</span>
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


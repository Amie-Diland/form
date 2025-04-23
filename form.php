<?php
session_start();

// Initialize feedbacks array if not already
if (!isset($_SESSION['feedbacks'])) {
    $_SESSION['feedbacks'] = [];
}

// On form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form inputs
    $name = htmlspecialchars($_POST['name']);
    $department = htmlspecialchars($_POST['department']);
    $gender = htmlspecialchars($_POST['gender']);
    $message = htmlspecialchars($_POST['message']);

    // Storing all my data in an associative array
    $feedback = [
        'name' => $name,
        'department' => $department,
        'gender' => $gender,
        'message' => $message,
        'time' => date("Y-m-d H:i:s") //to store my most recent time now
    ];

    // Store in session array
    $_SESSION['feedbacks'][] = $feedback;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form get</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color:rgb(10, 41, 245); }
        label { font-weight: bold; display: block; margin-top: 10px; }
    </style>
</head>
<body>

<h2>Feedback Form</h2>
<form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required maxlength="100">

    <label for="department">Department:</label>
    <select id="department" name="department" required>
        <option value="">Select Department</option>
        <option value="Sales">transport and logistic</option>
        <option value="HR">BANKING AND FINANCE 
        </option>
        <option value="IT">software engineering</option>
        <option value="Marketing">Marketing</option>
    </select>

    <label>Gender:</label>
    <input type="radio" name="gender" value="Male" id="male" required> 
    <label for="male" style="display:inline;">Male</label>
    <input type="radio" name="gender" value="Female" id="female" required>  
    <label for="female" style="display:inline;">Female</label>

    <label for="message">Feedback:</label>
    <textarea id="message" name="message" rows="4" required maxlength="300"></textarea>

    <br><br>
    <button type="submit">Submit Feedback</button>
</form>

<?php if (!empty($_SESSION['feedbacks'])): ?>
    <h3>Submitted Feedbacks</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Gender</th>
            <th>Message</th>
            <th>Time</th>
        </tr>
        <?php foreach (array_reverse($_SESSION['feedbacks']) as $fb): ?>
            <tr>
                <td><?= $fb['name'] ?></td>
                <td><?= $fb['department'] ?></td>
                <td><?= $fb['gender'] ?></td>
                <td><?= $fb['message'] ?></td>
                <td><?= $fb['time'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No feedback submitted yet, please kindly fill the required data above.</p>
<?php endif; ?>

</body>
</html>

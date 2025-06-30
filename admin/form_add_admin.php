<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['role'] === "superadmin") {

    include_once 'layouts/header.php'; 
?>

<link rel="stylesheet" href="css/style_form_add.css">

<div class="container_add">

    <h1>Add New Admin</h1>
    <?php if(isset($_GET['error'])){
        echo "<p style='color:red;text-align:center;'>".$_GET['error']."</p>" ;
    } ?>
    <form action="pages/add_admin.php" method="post" enctype="multipart/form-data">
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
        </select>

        <label for="tel_admin">Telephone:</label>
        <input type="text" id="tel_admin" name="tel_admin">

        <label for="img">Image:</label>
        <input type="file" id="img" name="img" accept="image/*">

        <button type="submit">Add Admin</button>
    </form>
</div>

<?php 
    include_once 'layouts/footer.php';
} else {
    header('Location:login.php');
    exit();
}
?>


<style>
    /* Style for form select element */
.container_add select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    color: #333;
    background: #F3F6F8;
    border:none;
    margin-top:.5em;
    margin-bottom:.5em;
    border-radius: 4px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    appearance: none; /* Removes default arrow */
}
</style>

<?php
  require_once('include.php');

  $db = getDatabaseConnection();

  output_header($db,"Checkout", null);

  protectPage();
?>

<main>
    <section class="container">
        <h1>Checkout</h1>
        <p>We are almost there!</p>
        <p>In a click, all your loved items will start to be sent to your door!</p>
        <form>
            <input type="text" placeholder="Delivery Spot">

            <input type="text" pattern="[0-9]{4}-[0-9]{3}" placeholder="ZipCode">
            <button>Pay</button>
        </form>

    <section>
</main>
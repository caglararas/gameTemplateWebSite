
<footer class="foot py-5 mt-2 text-white text-center">Copyright © Game Template 2021
<?php if (isAdmin()): ?>
<a href="/GameTemplate/gameTemplateAdmin.php" class="btn btn-outline-danger">Admin</a>
<?php endif; ?> 
</footer>
    <script src="https://kit.fontawesome.com/3798988652.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>
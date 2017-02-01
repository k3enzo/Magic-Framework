<div align="center">



            <?php if($hello['message'] == "mss"): ?>

                { $hello['message'] }

                <?php endif; ?>



    <form action="./example" method="post">
        <input type="hidden" name="url" value="khodemoni">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="family" placeholder="family">
        <input type="submit" name="submit">
    </form>

</div>
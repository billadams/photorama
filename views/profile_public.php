<?php include('partials/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="<?php echo htmlspecialchars($user->get_profile_image()); ?>">
            </div>
            <div class="col-md-10">
                <h1><?php echo htmlspecialchars($user->get_username()); ?></h1>
                <p>Number of galleries: <?php echo htmlspecialchars($num_categories['category_total']); ?></p>
                <p>Number of images: <?php echo htmlspecialchars($num_images['image_total']); ?></p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h2><?php echo htmlspecialchars($user->get_username()); ?>'s Galleries</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Disney World</h3>
                <ul class="profile_gallery">
                    <?php if (empty($disney_images)) : ?>
                        <p>No images in this gallery yet...</p>
                    <?php else :
                        foreach ($disney_images as $disney_image) :
                            ?>
                            <li>
                                <figure>
                                    <img src="<?php echo htmlspecialchars($disney_image['image_path']); ?>" alt="User Image" width="150px" height="150px">
                                    <figcaption><?php echo htmlspecialchars($disney_image['caption']); ?></figcaption>
                                </figure>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <h3>Colorado</h3>
                <ul class="profile_gallery">
                    <?php if (empty($colorado_images)) : ?>
                        <p>No images in this gallery yet...</p>
                    <?php else :
                        foreach ($colorado_images as $colorado_image) :
                            ?>
                            <li>
                                <figure>
                                    <img src="<?php echo htmlspecialchars($colorado_image['image_path']); ?>" alt="User Image" width="150px" height="150px">
                                    <figcaption><?php echo htmlspecialchars($colorado_image['caption']); ?></figcaption>
                                </figure>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <h3>Motocross</h3>
                <ul class="profile_gallery">
                    <?php if (empty($motocross_images)) : ?>
                        <p>No images in this gallery yet...</p>
                    <?php else :
                        foreach ($motocross_images as $motocross_image) :
                            ?>
                            <li>
                                <figure>
                                    <img src="<?php echo htmlspecialchars($motocross_image['image_path']); ?>" alt="User Image" width="150px" height="150px">
                                    <figcaption><?php echo htmlspecialchars($motocross_image['caption']); ?></figcaption>
                                </figure>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
        </div>

    </div> <!-- /container -->

<?php include('partials/header.php'); ?>
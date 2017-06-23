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

	    <?php //evar_dump($category_images); ?>
	    <?php //var_dump($category_objects); ?>

	    <?php foreach ($category_objects as $category_object) : ?>
            <div class="row">
                <div class="col-md-12">
                    <h3><?php echo htmlspecialchars($category_object->get_category_name()); ?></h3>
                    <ul class="profile_gallery">
					    <?php foreach ($category_object->get_category_images() as $category_image ) : ?>
						    <?php if (empty($category_image)) : ?>
                                <p>No images in this gallery yet...</p>
						    <?php else : ?>
							    <?php //var_dump($category_image); ?>
							    <?php for ($i = 0; $i < count($category_image); $i++) : ?>
                                    <li>
                                        <figure>
                                            <img src="<?php echo htmlspecialchars($category_image[$i]['image_path']); ?>" alt="User Image" width="150px" height="150px">
                                            <figcaption><?php echo htmlspecialchars($category_image[$i]['caption']); ?></figcaption>
                                        </figure>
                                    </li>
							    <?php endfor; ?>
						    <?php endif; ?>
					    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <hr>
	    <?php endforeach; ?>

    </div> <!-- /container -->

<?php include('partials/footer.php'); ?>
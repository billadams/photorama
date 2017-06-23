<?php include_once('partials/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo htmlspecialchars($user->get_profile_image()); ?>">
                        <p class="text-muted">Change profile image. For best results, use an image that is 150px x 150px.</p>
                        <form action="index.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="update_profile_image">
                            <input type="file" name="image" id='choose_file'>
                            <button class="btn btn-lg btn-primary" type="submit">Change Image</button>
                        </form>
                    </div>
                    <div class="col-md-9">
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
                                                    <img src="<?php echo htmlspecialchars($category_image[$i]['image_path']); ?>"
                                                         alt="<?php echo htmlspecialchars($category_image[$i]['alt_text']); ?>" width="150px" height="150px">
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
            </div>
            <div class="col-md-3" role="complementary">
                <h3>Add new image</h3>
                <p class="text-muted">For best results, use an image that is 500px x 500px.</p>

                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add_category_image">

                    <div class="form-group">
                        <label for="category_id">Select Category</label>
                        <select id="category_id" name="category_id" class="form-control">
		                    <?php foreach ($all_categories as $category) : ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
		                    <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="custom-file">
                            <input type="file" id="file" name="image" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
<!--                        <label for="choose_file">Choose image</label>-->
<!--                        <input type="file" name="image" id='choose_file'>-->
                    </div>
                    <div class="form-group">
                        <label for="image_caption" class="sr-only">Image Caption</label>
                        <input type="text" id="image_caption" name="image_caption" value="<?php echo htmlspecialchars($caption); ?>">
                    </div>
                    <div class="form-group">
                        <label for="image_alt" class="sr-only">Image Alt Text</label>
                        <input type="text" id="image_alt" name="image_alt" value="<?php echo htmlspecialchars($alt_text); ?>">
                    </div>

                    <button class="btn btn-lg btn-primary" type="submit">Add New Image</button>
                </form>
            </div>

        </div> <!-- outer row -->

    </div> <!-- /container -->

<?php include('partials/footer.php'); ?>
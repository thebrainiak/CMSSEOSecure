<!DOCTYPE html>
<html>
<head>
	<title>New Post</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<meta charset="utf-8">
</head>
<body>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">New Post</div>
					<div class="card-body">
						<form method="POST" action="generate_post.php">
							@csrf
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" name="title" required>
							</div>
							<div class="form-group">
								<label for="content">Content</label>
								<textarea class="form-control" id="content" name="content" rows="8" required></textarea>
							</div>
              <div class="form-group">
              <label for="schema" class="form-label">Schema SEO</label>
              <textarea class="form-control" id="schema" name="schema" rows="5" escape="false"></textarea>
            </div>

              <div class="form-group">
              <label for="meta-title" class="form-label">Meta Título</label>
              <input type="text" class="form-control" id="meta-title" name="meta-title" required>
              </div>
							<div class="form-group">
								<label for="meta_description">Meta Description</label>
								<input type="text" class="form-control" id="meta_description" name="meta_description">
							</div>
							<div class="form-group">
								<label for="meta_robots">Meta Robots</label>
								<input type="text" class="form-control" id="meta_robots" name="meta_robots">
							</div>
							<div class="form-group">
								<label for="canonical_url">Canonical URL</label>
								<input type="text" class="form-control" id="canonical_url" name="canonical_url">
							</div>
							<div class="form-group">
								<label for="og_locale">og:locale</label>
								<input type="text" class="form-control" id="og_locale" name="og_locale">
							</div>
							<div class="form-group">
								<label for="og_title">og:title</label>
								<input type="text" class="form-control" id="og_title" name="og_title">
							</div>
							<div class="form-group">
								<label for="og_description">og:description</label>
								<input type="text" class="form-control" id="og_description" name="og_description">
							</div>
							<div class="form-group">
								<label for="og_url">og:url</label>
								<input type="text" class="form-control" id="og_url" name="og_url">
							</div>
							<div class="form-group">
								<label for="og_site_name">og:site_name</label>
								<input type="text" class="form-control" id="og_site_name" name="og_site_name">
							</div>
							<div class="form-group">
								<label for="og_updated_time">og:updated_time</label>
								<input type="text" class="form-control" id="og_updated_time" name="og_updated_time" value="<?php echo date('Y-m-d H:i:s'); ?>">
							</div>
							<div class="form-group">
                <label for="og_type">og:type</label>
                <input type="text" class="form-control" id="og_type" name="og_type">
              </div>
              <div class="form-group">
                <label for="og_image">og:image</label>
                <input type="text" class="form-control" id="og_image" name="og_image">
              </div>
              <div class="form-group">
                <label for="twitter_title" class="form-label">Twitter title:</label>
                <input type="text" class="form-control" id="twitter_title" name="twitter_title" required>
              </div>
              <div class="form-group">
                <label for="twitter_description" class="form-label">Twitter description:</label>
                <textarea class="form-control" id="twitter_description" name="twitter_description" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="twitter_site" class="form-label">Twitter site:</label>
                <input type="text" class="form-control" id="twitter_site" name="twitter_site" required>
              </div>
              <div class="form-group">
                <label for="twitter_creator" class="form-label">Twitter creator:</label>
                <input type="text" class="form-control" id="twitter_creator" name="twitter_creator" required>
              </div>
              <div class="form-group">
                <label for="twitter_label1" class="form-label">Twitter label 1:</label>
                <input type="text" class="form-control" id="twitter_label1" name="twitter_label1" required>
              </div>
              <div class="form-group">
                <label for="twitter_data1" class="form-label">Twitter data 1:</label>
                <input type="text" class="form-control" id="twitter_data1" name="twitter_data1" required>
              </div>
              <div class="form-group">
                <label for="twitter_label2" class="form-label">Twitter label 2:</label>
                <input type="text" class="form-control" id="twitter_label2" name="twitter_label2" required>
              </div>
              <div class="form-group">
                <label for="twitter_data2" class="form-label">Twitter data 2:</label>
                <input type="text" class="form-control" id="twitter_data2" name="twitter_data2" required>
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>



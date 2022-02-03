<?php if (!empty($article->errors)) : ?>
    <ul>
        <?php foreach ($article->errors as $key => $value) : ?>
            <li><?= $value ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title" value="<?= htmlspecialchars($article->title); ?>">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="5" cols="7" placeholder="Content"><?= htmlspecialchars($article->content); ?></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime" id="published_at" name="published_at" placeholder="Published date" value="<?= htmlspecialchars($article->published_at); ?>">
    </div>
    <button>Save</button>
</form>